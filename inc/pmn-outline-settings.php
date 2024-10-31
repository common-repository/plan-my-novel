<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;




/**
 * Settings for Outline CPT
 * @return none
 */

add_action( 'cmb2_admin_init', 'pmn_outline_options' );
	

function pmn_outline_options() {
	
	
	if( 'pmn_outline' != get_post_type( pmn_get_novel_id() ) )
	return;
	
	$prefix = '_pmn_';
			
	
	$pmn_outline = new_cmb2_box( array(
		'id'           => 'pmn_outline',
		'title'        => 'Novel Outline',
		'object_types' => array( 'pmn_outline' ), 
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	



	$pmn_outline->add_field( array(
				'name'             => __( 'This outline is for:', 'plan-my-novel' ),
				'desc'             =>'',
				'id'               => $prefix . 'associate_outline',
				'type'             => 'select',
				'show_option_none' => 'Please select a novel',
				'default'          => 'custom',
				'options_cb' => 'pmn_list_novels', 
	) );
		
		
		
		
		/* SETTINGS FIELDS
		--------------------------------------------------------------------------------------------------------------------------------------*/	

		$pmn_group_id_outline = $pmn_outline->add_field( array(
			'id'           => $prefix . 'outline_container',
			'type'        => 'group',
			'description' => __( 'Tip: You can drag and drop scenes to reorder them.', 'plan-my-novel' ),
			'options'     => array(
											'group_title'   => __( 'Chapter {#}', 'plan-my-novel' ), 
											'add_button'    => __( 'Add Another Scene', 'plan-my-novel' ),
											'remove_button' => __( 'Delete Scene', 'plan-my-novel' ),
											'sortable'      => true, 
											 'closed'     => true, // true to have the groups closed by default
											),
		) );
		
		
		
							$pmn_outline->add_group_field( $pmn_group_id_outline, array(
								'id'   => $prefix . 'fld_scene_title',
								'name' => __( 'Scene Title', 'plan-my-novel' ),
								'desc' => __( 'Enter a working title, such as "Bill confronts Joe" or "Chapter 3". ', 'plan-my-novel' ),
								'default' => '',
								'type' => 'text',
							) );
							
							$pmn_outline->add_group_field( $pmn_group_id_outline, array(
								'id'   => $prefix . 'fld_scene_content',
								'name' => __( 'Scene Summary', 'plan-my-novel' ),
								'desc' => __( 'Briefly describe what happens. Remember this is for an outline and not the novel itself.  ', 'plan-my-novel' ),
								'type'    => 'textarea',
								'options' => array( 'textarea_rows' => 5, ),
							) );
							
							if ( pmn_get_option( 'pmn_setting_include_conflict' ) ) {
									$pmn_outline->add_group_field( $pmn_group_id_outline, array(
										'id'   => $prefix . 'fld_scene_conflict',
										'name' => __( 'Conflict', 'plan-my-novel' ),
										'desc' => __( 'What conflict occurs? Many writing experts recommend that every scene contain conflict.  ', 'plan-my-novel' ),
										'type'    => 'textarea',
										'options' => array( 'textarea_rows' => 3, ),
									) );					
							}
							
							if ( pmn_get_option( 'pmn_setting_include_why' ) ) {										
									$pmn_outline->add_group_field( $pmn_group_id_outline, array(
										'id'   => $prefix . 'fld_scene_why',
										'name' => __( 'Why is the scene necessary?', 'plan-my-novel' ),
										'desc' => __( 'Briefly justify this scene. Many writing experts recommend asking this of every scene as a form of self-editing. ', 'plan-my-novel' ),
										'type'    => 'textarea',
										'options' => array( 'textarea_rows' => 2, ),
									) );		
							}										
							
						$pmn_outline->add_group_field( $pmn_group_id_outline, array(
								'id'   => $prefix . 'fld_scene_attachments',
								'name' => __( 'Add Documents', 'plan-my-novel' ),
								'desc' => __( 'Attach almost any kind of file. This is a great place to store research materials relevant to the scene.', 'plan-my-novel' ),
								'type' => 'file_list',
							) );										
							
		
						 $pmn_outline->add_group_field( $pmn_group_id_outline, array(
								'id'   => $prefix . 'fld_scene_notes',
								'name' => __( 'Author Notes', 'plan-my-novel' ),
								'desc' => __( 'Notes or anything else relevant to the scene. ', 'plan-my-novel' ),
								'type'    => 'textarea',
								'options' => array( 'textarea_rows' => 3 ),
							) );	
							

							
						if ( pmn_get_option( 'pmn_setting_include_act' ) ) {	
							
							 $pmn_outline->add_group_field( $pmn_group_id_outline, array(
									'id'   => $prefix . 'fld_act_indicator',
									'name' => __( 'Scene is part of:', 'plan-my-novel' ),
									'desc' => '',
									'type' => 'select',
									//'show_option_none' => true,
									'options'          => array(
																			false => __( '--Please select--', 'cmb2' ),
																			'act_one' => __( 'Act I', 'cmb2' ),
																			'act_two'   => __( 'Act II', 'cmb2' ),
																			'act_three'     => __( 'Act III', 'cmb2' ),
																		),
									'before' => '<section class="act-flag">',
									'after' => '</section>'											
								) );											
							
							
						}	
							

}