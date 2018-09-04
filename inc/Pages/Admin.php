<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Pages;

class Admin{

	public function register(){

		add_action( 'admin_menu' , array( $this , 'add_admin_page') );//add a menu element

	}

	function add_admin_page(){
			add_menu_page( 'Quest-SAP','Quest-SAP', 'manage_options','main-menu', array( $this , 'admin_index' ), '
dashicons-image-rotate-right',  110 );

		}

	function admin_index(){
		require_once PLUGIN_PATH . 'templates/admin.php';
	}
}