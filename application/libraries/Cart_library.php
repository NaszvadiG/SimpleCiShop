<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_library {

	/**
	 * @var	CI_Controller	$CI
	 */
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	/**
	 * @param	int	$product_id
	 */
	public function cart_add($product_id)
	{
		$cart = $this->CI->session->userdata('cart');

		$cart['products'][$product_id] = (isset($cart['products'][$product_id])) ? $cart['products'][$product_id] + 1 : 1;

		$this->CI->session->set_userdata(['cart' => $cart]);
	}

	/**
	 * @param	int	$product_id
	 */
	public function cart_remove($product_id)
	{
		$cart = $this->CI->session->userdata('cart');

		if (! isset($cart['products'][$product_id])) {
			return;
		}

		$cart['products'][$product_id]--;

		if (0 === $cart['products'][$product_id]) {
			unset($cart['products'][$product_id]);
		}

		$this->CI->session->set_userdata(['cart' => $cart]);
	}

	/**
	 * @return	array
	 */
	public function get_cart()
	{
		$cart = $this->CI->session->userdata('cart');

		if (empty($cart))
		{
			return [];
		}

		if (isset($cart['affiliate']))
		{
			unset($cart['affiliate']);
		}

		return $cart;
	}
}
