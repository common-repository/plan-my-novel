<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;

/**
 * 
 * This file runs when the plugin in uninstalled (deleted).
 * This will not run when the plugin is deactivated.
 * Ideally you will add all your clean-up scripts here
 * that will clean-up unused meta, options, etc. in the database.
 *
 */

// If plugin is not being uninstalled, exit (do nothing)
if ( defined( 'WP_UNINSTALL_PLUGIN' ) ) {

	pmn_cleanup();

} else {

	exit;

}


 /**
 * Cleanup database when plugin is uninstalled
 * @return none
 */ 

function pmn_cleanup() { 

if ( is_admin() ) { 

	delete_post_meta_by_key( '_pmn_tab_general' );
	delete_post_meta_by_key( '_pmn_tab_marketing' );
	delete_post_meta_by_key( '_pmn_tab_budget' );
	delete_post_meta_by_key( '_pmn_tab_manage' );
	delete_post_meta_by_key( '_pmn_tab_files' );
	delete_post_meta_by_key( '_pmn_outline_container' );
	delete_post_meta_by_key( '_pmn_character_container' );
	delete_option ( 'pmn_options' );

	}

}