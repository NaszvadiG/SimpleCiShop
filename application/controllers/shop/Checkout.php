<?php

class Checkout extends CI_Controller {
	var $lang;
	function __construct()
	{
		parent::__construct();
	}

	function index($lang=NULL)
	{
		if($lang!="greek") redirect('shop/index/greek');

		$this->config->set_item('language', $lang);


		$cart = $this->cart_library->get_cart();

		$content_data = array();

		$content_data['lang'] = $lang;
		$content_data['cart_costs'] = $this->_getPriceSum($cart, $lang);
		$content_data['affiliate'] = $this->_getAffiliate();

		$data['contents'] = $this->load->view('shop/contents/checkout_tpl', $content_data, TRUE);

		$data['rblock'] = $this->load->view('shop/blocks/category_block_tpl', array('categories_arr' => ($this->category_model->get_all_category_ids_recursive()), "parent" => array(), "childs" => array(), "current" => 0), TRUE);

		$data['title'] = '';
		$data['pagename'] = 'main_checkout';
		$data['lang'] = $lang;
		$data['scripts'] = '<style type="text/css">@import url('.base_url().'assets/jscalendar/calendar-win2k-1.css);</style>
					<script type="text/javascript" src="'.base_url().'assets/jscalendar/calendar.js"></script>
					<script type="text/javascript" src="'.base_url().'assets/jscalendar/lang/calendar-en.js"></script>
					<script type="text/javascript" src="'.base_url().'assets/jscalendar/calendar-setup.js"></script>';

		$data['scripts'] .= '<script type="text/javascript">function shippment_sum(){
					var text="";
					var cart_costs = parseFloat($("cart_costs").innerHTML);
					var sum = parseFloat($("shippment_costs").innerHTML);


					if($("shippment_cash_on_delivery").checked) { text+=" + "; text+='.$this->lang->line('main_shippment_cash_on_delivery_costs').'; sum+=parseFloat('.$this->lang->line('main_shippment_cash_on_delivery_costs').');}
					text+=" = " + sum;
					$("shippment_sum").innerHTML = text;
					$("costs_sum").innerHTML = sum + " = " + (cart_costs + sum);
					$("price").value = (cart_costs + sum);
					}
					</script>';
		$this->load->view('shop/container', $data);
	}

	function get_user($lang=NULL)
	{

		$user = $this->user_model->search_user($this->input->post('user_code'), $this->input->post('user_phone_or_email'));

		echo "<script type='text/javascript'>";
		if($user) {
			extract($user);

			echo "\$('user_name').value='".$user_name."';";
			echo "\$('user_surname').value='".$user_surname."';";
			echo "\$('user_email').value='".$user_email."';";
			echo "\$('user_url').value='".$user_url."';";
			echo "\$('user_birthdate').value='".date("d/m/Y", $user_birthdate)."';";
			echo "\$('user_address').value='".$user_address."';";
			echo "\$('user_city').value='".$user_city."';";
			echo "\$('user_zip').value='".$user_zip."';";
			echo "\$('user_country').value='".$user_country."';";
			echo "\$('user_phone').value='".$user_phone."';";
			echo "\$('userID').value='".$userID."';";
			echo "\$('user_stars').value='".$user_stars."';";
			echo "\$('stars').innerHTML='".$user_stars."';";
			echo "\$('user_language').value='".$lang."';";
		}
		else {
			//echo "Form.reset('checkout_form')";
			//echo "alert('dffdfd+".$this->input->post('user_email')."');";
		}

		echo "</script>";

	}

	function _get_coupon()
	{
		// loads the given coupon if exists

		$coupon = $this->coupon_model->get_coupon($this->input->post('coupon'));

		if(count($coupon)>0) {

		}
	}

	function _getAffiliate()
	{
		$cart = $this->session->userdata('cart');

		if(isset($cart['affiliate'])) return $cart['affiliate'];
		return "";
	}

	function order($lang=NULL)
	{
		if($lang!="greek") redirect('shop/index/greek');
		$this->config->set_item('language', $lang);

		$orderID = NULL;

		$products = $this->cart_library->get_cart();

		if($this->input->post('userID')) {
			$this->user_model->set_user($this->input->post('userID'));
			$orderID = $this->order_model->add_order($this->input->post('userID'));
			$this->order_model->add_order_products($orderID, $products);

		}
		else {

			$userID = $this->user_model->add_user();
			$orderID = $this->order_model->add_order($userID);
			$this->order_model->add_order_products($orderID, $products);

		}

		if($this->input->post('shippment_cash_on_delivery') === "1" OR $this->input->post('shippment_cash_on_delivery') === "3") redirect('checkout/thankyou/'.$lang);
		else {

			// if it's paid with paypal post with redirect

			$form = '<form action="https://www.paypal.com/row/cgi-bin/webscr" method="post" name="paypal_form">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="charset" value="utf-8">
				<input type="hidden" name="business" value="orders@cool-clean-quiet.com">
				<input type="hidden" name="item_name" value="Item Name">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="amount" value="'.$this->input->post('price').'">
				<input type="hidden" name="cancel_return" value="'.site_url('shop/index/'.$lang).'">
				<input type="hidden" name="cancel_return" value="'.site_url('checkout/thankyou/'.$lang).'">
				<input type="hidden" name="invoice" value="'. $orderID .'">
				<input type="hidden" name="email" value="'.$this->input->post('user_email').'">
				<input type="hidden" name="first_name" value="'.$this->input->post('user_name').'">
				<input type="hidden" name="last_name" value="'.$this->input->post('user_surname').'">
				<input type="hidden" name="address_override" value="1">
				<input type="hidden" name="address1" value="'.$this->input->post('user_address').'">
				<input type="hidden" name="city" value="'.$this->input->post('user_city').'">
				<input type="hidden" name="zip" value="'.$this->input->post('user_zip').'">

				<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
				</form>
				<script type="text/javascript">document.paypal_form.submit()</script>';

			echo $form;
		}
	}

	function thankyou($lang=NULL)
	{
		if($lang!="greek") redirect('shop/index/greek');

		$this->config->set_item('language', $lang);


		$cart = $this->cart_library->get_cart();

		$content_data = array();

		$content_data['lang'] = $lang;

		$data['contents'] = $this->load->view('shop/contents/'.$lang.'/thankyou_tpl', $content_data, TRUE);

		$data['rblock'] = $this->load->view('shop/blocks/category_block_tpl', array('categories_arr' => ($this->category_model->get_all_category_ids_recursive()), "parent" => array(), "childs" => array(), "current" => 0), TRUE);

		$data['title'] = '';
		$data['pagename'] = 'main_checkout';
		$data['lang'] = $lang;

		$data['scripts'] = '';
		$this->load->view('shop/container', $data);
	}


	function _getPriceSum($cart, $lang)
	{

		$products = array();
		$sum=0;
		foreach($cart as $product => $value) {
			$products[$product] = $this->product_model->get_product($product);
			$products[$product] += $this->product_model->get_product_text($product);
			$products[$product]['quantity'] = $value;
			for($i=0;$i<$products[$product]['quantity'];$i++) {
				$sum += $products[$product]['price_'.$lang];
			}
		}

		return $sum;
	}
}
