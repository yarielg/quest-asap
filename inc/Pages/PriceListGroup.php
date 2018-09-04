<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Pages;

class PriceListGroup{

	public function register(){

		add_action( 'admin_menu' , array( $this , 'add_submenu_group_price_list') );//add a menu element

	}

	function add_submenu_group_price_list(){
			add_submenu_page('main-menu','Price List Group','Price List Group','manage_options','price-list-menu',array($this ,'group_index'));
			
		}

	function group_index(){
		require_once PLUGIN_PATH . 'templates/group-list.php';
	}
}