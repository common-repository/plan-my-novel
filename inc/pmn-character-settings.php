<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;




/**
 * Get Character Name
 * @return string
 */

function pmn_character_title() {

	if( 'pmn_character' != get_post_type( pmn_get_novel_id() ) )
	return;
	
	$the_id = $_GET['post'];
	
	$var1 =  get_post_meta( $the_id, '_pmn_character_container' , true );  
			
	$the_title = $var1[0][_pmn_fld_character_title]; 	
	$scene_label = 'Character {#}';
	

	if ( $var1 ) {
		
				if( substr($scene_label,-1) == '1' ) { $cnt = 0; } else { $cnt = 1; }

				$var2 = $scene_label.' - '.$var1[0][_pmn_fld_character_title];
	
	} else {
		
		$var2 = 'Character {#}';
	
	}
	
	return $var2;	
	
}





/**
 * Settings for Character CPT
 * @return none
 */

add_action( 'cmb2_admin_init', 'pmn_character_options' );
	

function pmn_character_options() {
	
	if( 'pmn_character' != get_post_type( pmn_get_novel_id() ) )
	return;
	
	
	$prefix = '_pmn_';
			
	
	$pmn_character = new_cmb2_box( array(
				'id'           => 'pmn_characters',
				'title'        => 'Character Set',
				'object_types' => array( 'pmn_character' ), 
				'context'      => 'normal',
				'priority'     => 'high',
			) );
			
			
			
	$pmn_character->add_field( array(
						'name'             => __( 'Characters in:', 'plan-my-novel' ),
						'desc'             =>'Select which novel these characters belong to',
						'id'               => $prefix . 'associate_characters',
						'type'             => 'select',
						'show_option_none' => 'Please select a novel',
						'default'          => 'custom',
						'options_cb' => 'pmn_list_novels', 
				) );
			
		
		
		
		/* SETTINGS FIELDS
		--------------------------------------------------------------------------------------------------------------------------------------*/	

		$pmn_group_id_character = $pmn_character->add_field( array(
			'id'           => $prefix . 'character_container',
			'type'        => 'group',
			'description' => sprintf( __( 'Note: Some features are controlled by the <a href="%s">plugin\'s settings</a>', 'plan-my-novel' ), PMN_SETTINGS ),
			'options'     => array(		
											'group_title'   => '',	
											'add_button'    => __( 'Add Another Character', 'cmb2' ),
											'remove_button' => __( 'Delete Character', 'cmb2' ),
											'sortable'      => true, 
											 'closed'     => true, // true to have the groups closed by default
											),
		) );
		
		
							$pmn_character->add_group_field( $pmn_group_id_character, array(
								'id'   => $prefix . 'fld_character_title',
								'name' => __( 'Character\'s Name', 'cmb2' ),
								'type' => 'text',
							) );
							
							$pmn_character->add_group_field( $pmn_group_id_character, array(
								'id'   => $prefix . 'fld_character_description',
								'name' => __( 'Description', 'cmb2' ),
								'desc' => __( 'Describe the character, their physical appearance and their role in the story.  ', 'cmb2' ),
								'type'    => 'textarea',
								'options' => array( 'textarea_rows' => 4, ),
							) );
							

					$pmn_character->add_group_field( $pmn_group_id_character, array(
								'id'   => $prefix . 'fld_character_pics',
								'name' => __( 'Photo (Optional)', 'cmb2' ),
								'desc' => __( 'Attach a photo of someone who looks close to the way you envision this character\'s appearance. Please respect image copyrights and permissions.', 'plan-my-novel' ),
								'type' => 'file',
								// Optional:
								'options' => array(
																'url' => false, // Hide the text input for the url
															),
								'text'    => array(
																'add_upload_file_text' => 'Add Character Photo' // Change upload button text. Default: "Add or Upload File"
													),
													
							) );							
							
							
							
						if ( pmn_get_option( 'pmn_setting_include_backstory' ) ) {
						
								$pmn_character->add_group_field( $pmn_group_id_character, array(
										'id'   => $prefix . 'fld_character_backstory',
										'name' => __( 'Backstory', 'cmb2' ),
										'desc' => __( 'Describe this character\'s history and motivations.  ', 'cmb2' ),
										'type'    => 'textarea',
										'options' => array( 'textarea_rows' => 4, ),
									) );	
							
						}
						
						$pmn_character->add_group_field( $pmn_group_id_character, array(
								'id'   => $prefix . 'fld_protagonist_flag',
								'name' => __( 'Main Character?', 'cmb2' ),
								'desc' => __( 'Check if this is the main character. ', 'cmb2' ),
								'before' => '<section class="protag-flag">',
								'after' => '</section>', 
								'type' => 'checkbox',
							) );	
							
	

}