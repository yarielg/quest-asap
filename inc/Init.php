<?php 

namespace Inc;

final class Init{

	public static function get_services(){
		
		return [
			Pages\Admin::class,
			Pages\QuestProducts::class,
			Pages\PriceListGroup::class,
			Base\Enqueue::class,
			Functions\User::class,
			Functions\CheckAvailability::class,
			Functions\PriceListInventory::class

		] ;
	}

	public static function register_services(){

		foreach (self::get_services() as $class) {
			$service = self::instantiate($class);
			if(method_exists( $service , 'register')){
				$service->register();
			}
		}

	}

	private static function instantiate($class){

		$service = new $class();
		return $service;
	}	
}

/*use Inc\Base\Activate;
use Inc\Base\Deactivate;

if( !class_exists( 'Yariko' )){ 

		class Yariko {

		public $plugin;

		function __construct(){

			$this->plugin = plugin_basename( __FILE__ );
			add_action( 'init' , array( $this , 'custom_post_type' ) ) ; //action to  create CPT

		}

		function register(){
			
			

			add_filter('plugin_action_links_' . $this->plugin , array( $this , 'settings_link'));//this filter is to add a link on list of pluging
		}


		

		function settings_link( $links ){

			$settings_link = '<a href="admin.php?page=yariko-main-menu">Settings</a>';
			array_push( $links, $settings_link );
			return $links;	
		}

		

		function custom_post_type(){
			register_post_type( 'book', [ 'public' => true , 'label' => 'Books' , 'show_ui' => true , 'menu_icon' => 'dashicons-book' ] ); 
		}


	}//End Class Plugin

	$yariko = new Yariko();
	$yariko->register(); 
}

// activation
register_activation_hook( __FILE__, array('Activate','activate') ); 

// deactivation
register_activation_hook( __FILE__, array('Deactivate','deactivate') );
*/
