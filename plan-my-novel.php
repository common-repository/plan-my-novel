<?php
/*
 * Plugin Name: Plan My Novel
 * Version: 1.0.3
 * Plugin URI: http://cato.io/plan-my-novel
 * Description: Plan almost every aspect of a novel or other writing project
 * Author: Jamel Cato
 * Author URI: http://cato.io
 * Requires at least: 4.3
 * Tested up to: 4.6
 *
 * Text Domain: plan-my-novel
 *
 * @package WordPress
 * @author Jamel Cato
 * @since 1.0.0
 */
 
 
 /* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;

 
/**
 * Define constants
 * @return none
 */

Define( 'PMN_ROOT', plugin_dir_path( __FILE__ ) );
Define( 'PMN_URL', plugin_dir_url( __FILE__ ) );
Define( 'PMN_SETTINGS', admin_url( "edit.php?post_type=pmn_novel&page=pmn_options" ) ); 
Define( 'PMN_VERSION', '1.0.3' ); 

 

/**
 * Load Plugin Files
 *@return none
 */
require_once  __DIR__ . '/inc/pmn-init.php' ;
require_once  __DIR__ . '/inc/pmn-post-types.php' ;
require_once  __DIR__ . '/inc/pmn-novel-settings.php' ;
require_once  __DIR__ . '/inc/pmn-outline-settings.php' ;
require_once  __DIR__ . '/inc/pmn-character-settings.php' ;
require_once  __DIR__ . '/inc/pmn-plugin-settings.php' ;
require_once  __DIR__ . '/inc/pmn-functions.php' ;
require_once  __DIR__ . '/inc/pmn-reports.php' ;

// Only load CMB2 locally if it is not already installed elsewhere
If ( ! defined ( 'CMB2_LOADED'  ) ) {
		require_once  __DIR__ . '/lib/cmb2/init.php'; 	   
}




/**
* Add Settings Link to Plugin List
* @return array
*/

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'pmn_add_settings_link' );

function pmn_add_settings_link( $links ) {
    $settings_link = '<a href="'.admin_url( "edit.php?post_type=pmn_novel&page=pmn_options" ).'">' . __( 'Settings', 'plan-my-novel' ) . '</a>';
    array_unshift( $links, $settings_link );
  	return $links;
}


 

/**
* Load Plugin Text Domain
* @return none
*/
add_action( 'init', 'pmn_load_textdomain' );
  
function pmn_load_textdomain() {
  load_plugin_textdomain( 'plan-my-novel', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
