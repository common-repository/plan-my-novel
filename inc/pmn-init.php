<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;



 /**
  * Set default settings values 
  * @return none
  */
$pmn_options = get_option( 'pmn_options' );

if ( !$pmn_options ) {
	
	$pmn_defaults = array();

	$pmn_defaults['pmn_setting_date_format'] 	  = 'm-d-Y';
	$pmn_defaults['pmn_setting_currency'] 				= '$';		
	$pmn_defaults['pmn_setting_rpt_include_cover'] 	= 'on';	
	$pmn_defaults['pmn_setting_include_conflict'] 		= 'on';	
	$pmn_defaults['pmn_setting_include_why'] 			= 'on';	
	$pmn_defaults['pmn_setting_include_char_pic'] 	= 'on';		
	$pmn_defaults['pmn_setting_include_backstory'] 	= 'on';		
	
	update_option( 'pmn_options', $pmn_defaults );

}




/**
  * Load Assets 
  * @return none
  */

add_action( 'admin_head', 'pmn_load_assets' , 15 );
		
function pmn_load_assets() {
	
			/* Only load on this plugin's screens */
			if( 'pmn_' != substr( get_post_type( pmn_get_novel_id() ),0,4 ) ) 
				return;
			
			/* CSS */
			wp_enqueue_style( 'pmn-plugin', PMN_URL . 'css/pmn-admin.css', null, PMN_VERSION, 'screen' );
			wp_enqueue_style( 'pmn-print', PMN_URL . 'css/pmn-print.css', null, PMN_VERSION, 'print' );			
								
			/* Javascript */
			wp_enqueue_script( 'pmn-print', PMN_URL . 'js/jquery.print.js',array( 'jquery' ), null, true ); 
			wp_enqueue_script( 'pmn-scripts', PMN_URL . 'js/pmn-scripts.js', array( 'jquery' ), null, true ); 
			wp_enqueue_script( 'jquery-ui-sortable' );			
			
			/* Localized data */
			 $data = array (
										'filename_full' => sanitize_file_name( get_the_title( pmn_get_novel_id() ).'-'.__( "full","plan-my-novel" ).'-'.current_time( "Ymd" ) ).'.txt',
										'filename_budget' => sanitize_file_name( get_the_title( pmn_get_novel_id() ).'-'.__( "budget","plan-my-novel" ).'-'.current_time( "Ymd" ) ).'.csv',
										'pmn_print_stylesheet' => esc_url( PMN_URL . 'css/pmn-print.css' ),
										'act_one_string' => sanitize_text_field ( __( 'Act I', 'plan-my-novel' ) ),
										'act_two_string' => sanitize_text_field ( __( 'Act II', 'plan-my-novel' ) ),
										'act_three_string' => sanitize_text_field ( __( 'Act III', 'plan-my-novel' ) ),
										'pmn_rpt_credit' => pmn_plugin_credit(),
										
									);
			 
			wp_localize_script( 'pmn-scripts', 'php_data', $data );
}




/**
  * Remove unwanted default metaboxes from the Novel CPT
  * @return none
  */
  
add_action( 'admin_menu' , 'pmn_remove_default_metaboxes' );
  
function pmn_remove_default_metaboxes() {
	
	$cpt = 'pmn_novel';
	
	remove_meta_box( 'slugdiv', $cpt, 'normal' ); 
	remove_meta_box( 'linktargetdiv', $cpt, 'normal' );
	remove_meta_box( 'linkxfndiv', $cpt, 'normal' );
	remove_meta_box( 'linkadvanceddiv', $cpt, 'normal' );
	remove_meta_box( 'postexcerpt', $cpt, 'normal' );
	remove_meta_box( 'trackbacksdiv', $cpt, 'normal' );
	remove_meta_box( 'postcustom', $cpt, 'normal' );
	remove_meta_box( 'commentstatusdiv', $cpt, 'normal' );
	remove_meta_box( 'commentsdiv', $cpt, 'normal' );
	remove_meta_box( 'revisionsdiv', $cpt, 'normal' );
	remove_meta_box( 'authordiv', $cpt, 'normal' );
	remove_meta_box( 'sqpt-meta-tags', $cpt, 'normal' ); 
	remove_meta_box( 'categorydiv', $cpt, 'normal' ); 	
	remove_meta_box( 'formatdiv', $cpt, 'normal' ); 
	remove_meta_box( 'pageparentdiv', $cpt, 'normal' );
	remove_meta_box( 'postimagediv', $cpt, 'normal' ); 	

}