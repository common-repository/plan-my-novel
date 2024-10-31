<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;



/**
 * Register Custom Post Types
 * @return none
 */
 
 
add_action( 'init', 'pmn_post_types', 0 );
 
function pmn_post_types() {


			$labels = array(
				'name'                  			=> _x( 'Novels', 'Post Type General Name', 'plan-my-novel' ),
				'singular_name'         		=> _x( 'Novel', 'Post Type Singular Name', 'plan-my-novel' ),
				'menu_name'             		=> __( 'Plan My Novel', 'plan-my-novel' ),
				'name_admin_bar'        		=> __( 'Novels', 'plan-my-novel' ),
				'archives'              			=> __( 'Item Archives', 'plan-my-novel' ),
				'parent_item_colon'    		=> __( 'Parent Item:', 'plan-my-novel' ),
				'all_items'             				=> __( 'All Novels', 'plan-my-novel' ),
				'add_new_item'         			=> __( 'Add New Novel', 'plan-my-novel' ),
				'add_new'               			=> __( 'Add New Novel', 'plan-my-novel' ),
				'new_item'              			=> __( 'New Item', 'plan-my-novel' ),
				'edit_item'             			=> __( 'Edit Item', 'plan-my-novel' ),
				'update_item'           			=> __( 'Update Item', 'plan-my-novel' ),
				'view_item'             			=> __( 'View Item', 'plan-my-novel' ),
				'search_items'          			=> __( 'Search Item', 'plan-my-novel' ),
				'not_found'             			=> __( 'Not found', 'plan-my-novel' ),
				'not_found_in_trash'    		=> __( 'Not found in Trash', 'plan-my-novel' ),
				'featured_image'        		=> __( 'Featured Image', 'plan-my-novel' ),
				'set_featured_image'    		=> __( 'Set featured image', 'plan-my-novel' ),
				'remove_featured_image' 	=> __( 'Remove featured image', 'plan-my-novel' ),
				'use_featured_image'    		=> __( 'Use as featured image', 'plan-my-novel' ),
				'insert_into_item'      			=> __( 'Insert into item', 'plan-my-novel' ),
				'uploaded_to_this_item' 		=> __( 'Uploaded to this item', 'plan-my-novel' ),
				'items_list'            				=> __( 'Items list', 'plan-my-novel' ),
				'items_list_navigation' 		=> __( 'Items list navigation', 'plan-my-novel' ),
				'filter_items_list'     			=> __( 'Filter items list', 'plan-my-novel' ),
			);
			
			$rewrite = array(
				'slug'                 	=> 'plan-my-novel',
				'with_front'            => true,
				'pages'                 	=> true,
				'feeds'                 	=> true,
			);
			
			$args = array(
				'label'                 			=> __( 'Novel', 'plan-my-novel' ),
				'description'           		=> __( 'A novel or other work of fiction', 'plan-my-novel' ),
				'labels'                			=> $labels,
				'supports'              		=> array( 'title', ),
				'taxonomies'            		=> array( 'chapter' ),
				'hierarchical'          		=> false,
				'public'                			=> true,
				'show_ui'               		=> true,
				'show_in_menu'          	=> true,
				'menu_position'         		=> 25,
				'menu_icon'             		=> 'dashicons-book',
				'show_in_admin_bar'     	=> true,
				'show_in_nav_menus'     => true,
				'can_export'            		=> true,
				'has_archive'           		=> true,		
				'exclude_from_search'   => true,
				'publicly_queryable'    	=> true,
				'rewrite'               			=> $rewrite,
				'capability_type'       		=> 'page',
			);
			
			register_post_type( 'pmn_novel', $args );
			
			
			/*------------------------------------------------------------------------------------------------------------------------------------------------------------*/
			
			
			$labels = array(
				'name'                  			=> _x( 'Outlines', 'Post Type General Name', 'plan-my-novel' ),
				'singular_name'         		=> _x( 'Outline', 'Post Type Singular Name', 'plan-my-novel' ),
				'menu_name'             		=> __( 'Outlines', 'plan-my-novel' ),
				'name_admin_bar'        		=> __( 'Outlines', 'plan-my-novel' ),
				'archives'              			=> __( 'Item Archives', 'plan-my-outline' ),
				'parent_item_colon'    		=> __( 'Parent Item:', 'plan-my-outline' ),
				'all_items'             				=> __( 'Outlines', 'plan-my-outline' ),
				'add_new_item'         			=> __( 'Add New Outline', 'plan-my-outline' ),
				'add_new'               			=> __( 'Add New Outline', 'plan-my-outline' ),
				'new_item'              			=> __( 'New Item', 'plan-my-outline' ),
				'edit_item'             			=> __( 'Edit Item', 'plan-my-outline' ),
				'update_item'           			=> __( 'Update Item', 'plan-my-outline' ),
				'view_item'             			=> __( 'View Item', 'plan-my-outline' ),
				'search_items'          			=> __( 'Search Item', 'plan-my-outline' ),
				'not_found'             			=> __( 'Not found', 'plan-my-outline' ),
				'not_found_in_trash'    		=> __( 'Not found in Trash', 'plan-my-outline' ),
				'featured_image'        		=> __( 'Featured Image', 'plan-my-outline' ),
				'set_featured_image'    		=> __( 'Set featured image', 'plan-my-outline' ),
				'remove_featured_image' 	=> __( 'Remove featured image', 'plan-my-outline' ),
				'use_featured_image'    		=> __( 'Use as featured image', 'plan-my-outline' ),
				'insert_into_item'      			=> __( 'Insert into item', 'plan-my-outline' ),
				'uploaded_to_this_item' 		=> __( 'Uploaded to this item', 'plan-my-outline' ),
				'items_list'            				=> __( 'Items list', 'plan-my-outline' ),
				'items_list_navigation' 		=> __( 'Items list navigation', 'plan-my-outline' ),
				'filter_items_list'     			=> __( 'Filter items list', 'plan-my-outline' ),
			);
			
			$rewrite = array(
				'slug'                 	=> 'novel-outline',
				'with_front'            => true,
				'pages'                 	=> true,
				'feeds'                 	=> true,
			);
			
			$args_outline = array(
				'label'                 			=> __( 'Outline', 'plan-my-outline' ),
				'description'           		=> __( 'An outline for a novel or other work of fiction', 'plan-my-outline' ),
				'labels'                			=> $labels,
				'supports'              		=> array( 'title', ),
				'taxonomies'            		=> array( 'chapter' ),
				'hierarchical'          		=> false,
				'public'                			=> true,
				'show_ui'               		=> true,
				'show_in_menu'          	=> 'edit.php?post_type=pmn_novel',
				//'menu_position'         		=> 25,
				'menu_icon'             		=> 'dashicons-book',
				'show_in_admin_bar'     	=> true,
				'show_in_nav_menus'     => true,
				'can_export'            		=> true,
				'has_archive'           		=> true,		
				'exclude_from_search'   => true,
				'publicly_queryable'    	=> true,
				'rewrite'               			=> $rewrite,
				'capability_type'       		=> 'page',
			);
			
			register_post_type( 'pmn_outline', $args_outline );
			
			
			/*------------------------------------------------------------------------------------------------------------------------------------------------------------*/
			
				$labels = array(     
				'name'                  			=> _x( 'Characters', 'Post Type General Name', 'plan-my-novel' ),
				'singular_name'         		=> _x( 'Character', 'Post Type Singular Name', 'plan-my-novel' ),
				'menu_name'             		=> __( 'Characters', 'plan-my-novel' ),
				'name_admin_bar'        		=> __( 'Characters', 'plan-my-novel' ),
				'archives'              			=> __( 'Item Archives', 'plan-my-novel' ),
				'parent_item_colon'    		=> __( 'Parent Item:', 'plan-my-novel' ),
				'all_items'             				=> __( 'Characters', 'plan-my-novel' ),
				'add_new_item'         			=> __( 'Add New Character Set', 'plan-my-novel' ),
				'add_new'               			=> __( 'Add New Character Set', 'plan-my-novel' ),
				'new_item'              			=> __( 'New Item', 'plan-my-novel' ),
				'edit_item'             			=> __( 'Edit Item', 'plan-my-novel' ),
				'update_item'           			=> __( 'Update Item', 'plan-my-novel' ),
				'view_item'             			=> __( 'View Item', 'plan-my-novel' ),
				'search_items'          			=> __( 'Search Item', 'plan-my-novel' ),
				'not_found'             			=> __( 'Not found', 'plan-my-novel' ),
				'not_found_in_trash'    		=> __( 'Not found in Trash', 'plan-my-novel' ),
				'featured_image'        		=> __( 'Featured Image', 'plan-my-novel' ),
				'set_featured_image'    		=> __( 'Set featured image', 'plan-my-novel' ),
				'remove_featured_image' 	=> __( 'Remove featured image', 'plan-my-novel' ),
				'use_featured_image'    		=> __( 'Use as featured image', 'plan-my-novel' ),
				'insert_into_item'      			=> __( 'Insert into item', 'plan-my-novel' ),
				'uploaded_to_this_item' 		=> __( 'Uploaded to this item', 'plan-my-novel' ),
				'items_list'            				=> __( 'Items list', 'plan-my-novel' ),
				'items_list_navigation' 		=> __( 'Items list navigation', 'plan-my-novel' ),
				'filter_items_list'     			=> __( 'Filter items list', 'plan-my-novel' ),
			);
			
			$rewrite = array(
				'slug'                 	=> 'novel-character',
				'with_front'            => true,
				'pages'                 	=> true,
				'feeds'                 	=> true,
			);
			
			$args_characters = array(
				'label'                 			=> __( 'Character', 'plan-my-novel' ),
				'description'           		=> __( 'A character for a novel or other work of fiction', 'plan-my-novel' ),
				'labels'                			=> $labels,
				'supports'              		=> array( 'title' ),
				'taxonomies'            		=> array( 'chapter' ),
				'hierarchical'          		=> false,
				'public'                			=> true,
				'show_ui'               		=> true,
				'show_in_menu'          	=> 'edit.php?post_type=pmn_novel',
				//'menu_position'         		=> 25,
				'menu_icon'             		=> 'dashicons-admin-users',
				'show_in_admin_bar'     	=> false,
				'show_in_nav_menus'     => false,
				'can_export'            		=> true,
				'has_archive'           		=> true,		
				'exclude_from_search'   => true,
				'publicly_queryable'    	=> true,
				'rewrite'               			=> $rewrite,
				'capability_type'       		=> 'page',
			);
			
			register_post_type( 'pmn_character', $args_characters );
			
			
}



/**
 * Remove default editor on this plugin's screens
 * @return none
 */
 
add_action( 'admin_head', 'pmn_remove_editor' );
 
function pmn_remove_editor() {
		
	if( 'pmn_' != substr( get_post_type( pmn_get_novel_id() ),0,4 ) ) 
	return;
	
	remove_post_type_support( 'pmn_novel','editor' );
	remove_post_type_support( 'pmn_character','editor' );
	remove_post_type_support( 'pmn_outline','editor' );
  
}