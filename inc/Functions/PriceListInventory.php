<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Functions;

class PriceListInventory{

	public function register(){

		// Simple, grouped and external products
		add_filter('woocommerce_product_get_price', array( $this, 'custom_price' ), 99, 2 );
		add_filter('woocommerce_product_get_regular_price', array( $this, 'custom_price' ), 99, 2 );
		// Variable
		add_filter('woocommerce_product_variation_get_regular_price', array( $this, 'custom_price' ), 99, 2 );
		add_filter('woocommerce_product_variation_get_price', array( $this, 'custom_price' ), 99, 2 );
	}

	 function custom_price( $price, $product ) {


	    return 'Loading...' ;
	}


}