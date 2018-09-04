<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Functions;

class CheckAvailability{

	public function register(){
		//creando el stock availability 
		add_action( 'woocommerce_before_add_to_cart_button', array($this,'market_show_availability' ),1);
	}

	function market_show_availability(){
		$user_id = get_current_user_id();
		$price_list_user = esc_attr(get_the_author_meta( 'price_list', $user_id ));
		  //the js functionality is my_custom_js in market theme js
		  echo '<div id="quest_availability_container" class="row" style="clear:both">
		  <hr>
		  <div class="col-lg-3">  
		    <div class="input-group">
		      <span class="input-group-btn">
		        <h5 style="margin-top:5px;font-weight:bold;">Enter Quantity:</h5>
		      </span>
		    </div>
		  </div>
		  <div class="col-lg-5">
		    <div class="input-group">
		      <input id="quest_availability_text" type="text" class="form-control" placeholder="">
		      <span class="input-group-btn">
		        <button id="quest_check_availability" type="button" class="btn btn-danger ">
		          Check Stock!
		        </button>
		      </span>
		    </div>
		  </div>
		  <div id="availability_text" class="col-lg-4"><h5></h5></div>
		  
		</div>
		<br>
		' . 
		'<input id="ip_sap" name="ip" value="'. get_option('qsap_ip') .'" hidden>'
		. 
		'<input id="port_sap" name="port" value="'. get_option('qsap_port') .'" hidden>'

		. 
		'<input id="ip_real_sap" name="ip_real_sap" value="'. $_SERVER['REMOTE_ADDR'] .'" hidden>'

		. 
		'<input id="key_sap" name="key" value="'. get_option('qsap_key') .'" hidden>'

		. 
		'<input user_id="'.$user_id.'" id="price_list_user" name="price_list_user" value="'. $price_list_user . '" hidden>'

		;
}
	
}


