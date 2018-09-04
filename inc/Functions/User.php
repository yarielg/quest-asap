<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Functions;

class User{

	public function register(){

		add_action( 'show_user_profile', array($this , 'extra_user_profile_fields') );
		add_action( 'edit_user_profile', array($this , 'extra_user_profile_fields' ));
		add_action( 'personal_options_update', array($this , 'save_extra_user_profile_fields' ));
		add_action( 'edit_user_profile_update', array($this , 'save_extra_user_profile_fields'));
	}

	

	function extra_user_profile_fields( $user ) { 
		$qsap_ip = get_option('qsap_ip');
      	$qsap_port = get_option('qsap_port');
      	$qsap_key = get_option('qsap_key');

      	$price_lists= array();

      	$url = "http://$qsap_ip:$qsap_port/ItemService.svc/getItems?key=$qsap_key&itemcode=ALL&cardcode=ALL&customerpricelist=ALL";
      
        $file_headers = @get_headers($url);
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
           echo '</ul>Connection Error, please test the connection <a href="admin.php?page=main-menu">HERE</a>'; 
      }else{
           $json = file_get_contents($url);
           $json = (array) json_decode($json); //Array de array std
            foreach ($json as $product) {
                  $product = (array)$product;
                      if(!in_array($product['CustomerPriceList'], $price_lists) && $product['Company'] == 'QUEST TECHNOLOGY'){
                        array_push($price_lists, $product['CustomerPriceList']);
                      }  
            }


      }
		?>
	    <h2><?php _e("Price List Inventory (SAP)", "blank"); ?></h2>
	    <table class="form-table">
	    <tr>
	        <th><label for="category_pricing"><?php _e("Company"); ?></label></th>
	        <td>
	            <input type="text" name="category_pricing" id="address" value="<?php echo esc_attr( get_the_author_meta( 'category_pricing', $user->ID ) ); ?>" class="regular-text" /><br />
	            <span class="description"><?php _e("Please enter your category pricing."); ?></span>
	        </td>
	        
	    </tr>
	    <tr>
	    	<th><label for="price_list"><?php _e("Price List"); ?></label></th>
	    	<td>
	        	<select name="price_list" id="price_list"  value="<?php echo esc_attr( get_the_author_meta( 'price_list', $user->ID ) ); ?>">
	        	<option>Select an option</option>
				 <?php foreach ($price_lists as $key => $value) {

				 	if(get_the_author_meta( 'price_list', $user->ID ) == $value){
				 		echo "<option value='$value' selected>$value</option>";
				 	}else{
				 		echo "<option value='$value'>$value</option>";
				 	}
				 } ?>
				  
				</select>
				<br>
				<span class="description"><?php _e("Please enter the Price List that user belong."); ?></span>
	        </td>
	    </tr>
	    </table>

	<?php }
	

	function save_extra_user_profile_fields( $user_id ) {
	    if ( !current_user_can( 'edit_user', $user_id ) ) { 
	        return false; 
	    }
	    update_user_meta( $user_id, 'category_pricing', $_POST['category_pricing'] );
	    update_user_meta( $user_id, 'price_list', $_POST['price_list'] );
	}
}