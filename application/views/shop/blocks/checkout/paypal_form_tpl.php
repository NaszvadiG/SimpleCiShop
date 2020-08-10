<form action="https://www.paypal.com/row/cgi-bin/webscr" method="post" name="paypal_form">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="charset" value="utf-8">
	<input type="hidden" name="business" value="<?= $paypal_business_email ?? '' ?>">
	<input type="hidden" name="item_name" value="Item Name">
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="amount" value="<?= $price ?? '' ?>">
	<input type="hidden" name="cancel_return" value="<?= site_url('shop/home') ?>">
	<input type="hidden" name="cancel_return" value="<?= site_url('checkout/thankyou') ?>">
	<input type="hidden" name="invoice" value=" <?= $order_id ?? '' ?>">
	<input type="hidden" name="email" value="<?= $email ?? '' ?>">
	<input type="hidden" name="first_name" value="<?= $first_name ?? '' ?>">
	<input type="hidden" name="last_name" value="<?= $last_name ?? '' ?>">
	<input type="hidden" name="address_override" value="1">
	<input type="hidden" name="address1" value="<?= $street ?? '' ?>">
	<input type="hidden" name="city" value="<?= $city ?? '' ?>">
	<input type="hidden" name="zip" value="<?= $zip ?? '' ?>">

	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
</form>
<script type="text/javascript">document.paypal_form.submit()</script>
