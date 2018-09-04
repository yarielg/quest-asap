<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Pages;

class QuestProducts{

	public function register(){

		add_action( 'admin_menu' , array( $this , 'add_submenu_products') );//add a menu element

	}

	function add_submenu_products(){
			add_submenu_page('main-menu','Quest Products','Quest Products','manage_options','products-menu',array($this ,'product_index'));
			
		}

	function product_index(){
		require_once PLUGIN_PATH . 'templates/quest-products.php';
	}
}