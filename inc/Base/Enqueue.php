<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Base;

class Enqueue{

	public function register(){

		add_action( 'admin_enqueue_scripts', array( $this , 'enqueue' ) ); //action to include script to the backend, in order to include in the frontend is just wp_enqueue_scripts instead admin_enqueue_scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend'));
		
	}

	function enqueue(){
		//enqueue all our scripts admin
		wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );

		wp_enqueue_style('my_customs_styles',  PLUGIN_URL . '/assets/mystyle.css' );

		wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
		wp_enqueue_script( 'popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js');

		wp_enqueue_script('my_customs_scripts', PLUGIN_URL . '/assets/myscript.js' );
	}

	function enqueue_frontend(){
		//enqueue all our scripts frontend

		wp_enqueue_script('my_frontend_scripts', PLUGIN_URL . '/assets/frontend.js' );
	}
}