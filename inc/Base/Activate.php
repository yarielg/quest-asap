<?php 	

/*
*
* @package yariko		
*
*/
namespace Inc\Base;

class Activate{

	public static function activate(){
	flush_rewrite_rules();	
  		
	/*global $wpdb;

	$table_name = $wpdb->prefix . 'qsap_service';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );*/

	add_option( 'qsap_ip', '10.0.0.1' );
	add_option( 'qsap_port', '64000' );
	add_option( 'qsap_key', 'whateverkey' );
	}	

		

}
