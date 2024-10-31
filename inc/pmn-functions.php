<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;




/**
 * Callback for novel selector
 * @param array  
 * @return array             
 */
function pmn_get_novel_options( $query_args ) {

	$args = wp_parse_args( $query_args, array(
		'post_type'   => 'pmn_novel',
		'numberposts' => 10,
	) );

	$posts = get_posts( $args );

	$post_options = array();
	if ( $posts ) {
		foreach ( $posts as $post ) {
		  $post_options[ $post->ID ] = $post->post_title;
		}
	}

	return $post_options;
}




/**
 * Display up to 10 novels to choose from
 * @return array 
 */
function pmn_list_novels() {
	return pmn_get_novel_options( array( 'post_type' => 'pmn_novel', 'numberposts' => 10 ) );
}
			

			

/**
 * Get the ID of the current novel
 * @return int
 */
add_action( 'cmb2_init', 'pmn_get_novel_id' );

function pmn_get_novel_id() {
	
	if ( is_admin() ) {
	
				$post_id = 0;

				if ( isset( $_GET['post'] ) ) {
					$post_id = $_GET['post'];
				} elseif ( isset( $_POST['post_ID'] ) ) {
					$post_id = $_POST['post_ID'];
				}
												
				return $post_id;

	}			
	
}			
			
			
			
			
/**
 * Attempt to prevent FOUC by hiding the interface until the tabs have been rendered
 * @return none
 */
add_action( 'admin_head', 'pmn_inject_early', 2 );

function pmn_inject_early() {
	
	if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
	return;

	$pmn_loader = PMN_URL. 'images/pmn-loader.gif';
	
?>
<script>jQuery( document ).ready( function( $ ) { $( '.post-type-pmn_novel #edit-slug-box' ).append( '<div id="pmn-loading" class="center"><img src="<?php echo $pmn_loader; ?>" /></div>' ); });</script>
<style> .post-type-pmn_novel #postbox-container-2 {display:none} </style>
<script>jQuery( document ).ready( function( $ ) { $( '#pmn-loading' ).delay(2000).fadeOut( 'fast'); $(  '.post-type-pmn_novel #postbox-container-2, .post-type-pmn_novel .tabs-menu ' ).delay(200).fadeIn(); });</script>
<?php
}			
			
			
			
			
/**
 * Display tabbed interface
 * @return none
 */

 /* cmb2_before_post_form_{MY_ID_HERE} must match id of the main metabox in novel-settings.php */ 
 add_action( 'cmb2_before_post_form_pmn_tabs', 'pmn_tabs', 10, 2 ); 

function pmn_tabs( $object_id, $cmb2 ) {
	
	if ( is_admin() ) {
		
		if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
		return;		

		echo '<ul class="tabs-menu" style="display:none">';

		$i = 0;
		foreach( $cmb2->meta_box['fields'] as $field_name => $field ) {
			if( $field['type'] == 'group' && ( isset( $field['options']['show_as_tab'] ) && ( $field['options']['show_as_tab'] == true ) ) ){
				
				$class = 'class="pmn-tab" '; 
				
				$tab_num = $i+1;
				
				
				if ( $tab_num == 1 ) {
					
					echo '<li id="general-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';
					
				} elseif ( $tab_num == 2 ) {
					
					echo '<li id="marketing-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';
					
				} elseif ( $tab_num == 3 ) {
					
					echo '<li id="budget-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';				
				
				} elseif ( $tab_num == 4 ) {
					
					echo '<li id="content-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';			
					
				} elseif ( $tab_num == 5 ) {
					
					echo '<li id="manage-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';				
		
				} elseif ( $tab_num == 6 ) {
					
					echo '<li id="files-li"  '. $class .'><a href="#tab-' . $tab_num . '">' . $field['options']['group_title'] . '</a></li>';
		
				} else {
					
					// Nothing to show
					
				}
			
			}
			$i++;
		}
		echo '</ul>';
	
	}
	
}

			
		

		

/**
 * Display list of files attached to this particular novel 
 * @return string            
 */ 
function pmn_list_attachments() {
	
	if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

				$attached_content = '';
				$files = '';
				$the_files = '';					
				$the_id = pmn_get_novel_id();
				

				/* Everything submitted through the Files tab */
				$tab_files = get_post_meta( $the_id, '_pmn_tab_files', true ); 

				/* Only files attachments within the array above  */
				if ( $tab_files and isset( $tab_files[0]['_pmn_fld_file_attachments'] ) ) {
					$files = $tab_files[0]['_pmn_fld_file_attachments'];
				}


				if ( $files ) {

						foreach ( $files as $key => $value ) {	
						
							if ( $value ) {
								
								if ( 'trash' == get_post_status( $key ) or !get_post_status( $key ) ) {
									
									/* Delete the actual file */
									wp_delete_attachment( $key );
									
									/* Remove reference from this novel's list of attached files */
									$tab_files[0]['_pmn_fld_file_attachments'][$key] = '';
									update_post_meta( $the_id, '_pmn_tab_files', $tab_files ); 
									

								}
						
								
								$the_files .= '<li> <section>'.__( 'File: ','plan-my-novel').' <strong> '.basename( $value ).'</strong></section> <a target="_blank" href="'.$value.'">Download</a> | <a class="pmn-delete-file" href="'. get_delete_post_link($key).'">Delete</a> </li>';
						}
				}

				} else {
					
					$the_files .= '<p class="cmb2-metabox-description">'.__( 'There are no files attached to this novel', 'plan-my-novel' ).'</p>';
				}
				

			$attached_content .= '<div id="pmn-files-container"><h3 class="pmn-group-title">'.__( 'Currently Attached Files', 'plan-my-novel' ).'</h3><ul id="pmn-file-list">';
			$attached_content .= wp_kses_post( $the_files);
			$attached_content .= '</ul></div>';
										
			return $attached_content;
	
}		



/**
 * Display image(s) attached to characters
 * @return string            
 */ 
function pmn_display_character_image() {
	
	global $wpdb;
	
	if( 'pmn_character' != get_post_type( pmn_get_novel_id() ) )
			return;

				$attached_content = '';
				$files = '';
				$the_files = '';					
				$the_id = pmn_get_novel_id();
				$the_status = '';
				$hide_container = '';
				

				/* Everything submitted through the Character Metabox */
				$tab_content = get_post_meta( $the_id, '_pmn_character_container', true ); 
				if ( !$tab_content ) return;

		

								foreach ( $tab_content[0]['_pmn_fld_character_attachments']  as $key => $value ) {	
								

									if ( $value ) {

										
												/* Look up the actual post status since get_post_status ($key) had a bug. */
												foreach( 	
																	$wpdb->get_results(
																									$wpdb->prepare(
																																"SELECT post_status 
																																 FROM $wpdb->posts 
																																 WHERE ID = %s LIMIT 1"
																																, $the_id																				
																														   )
																									
																							 ) as $db_key => $row
															) {
														
																	$the_status = $row->post_status;
															}							
												
												
												
												if (  'trash' == $the_status OR '' == $the_status  ) {
													
													/* Remove reference from this novel's list of attached files */
													$tab_content[0]['_pmn_fld_character_attachments'][$key] = '';
													update_post_meta( $the_id, '_pmn_character_container', $tab_content ); 									
													
													/* Delete the attachment from the Media Library (WP leaves the actual in the uploads folder) */
													wp_delete_attachment( $key );																		
													
												} 
										
												$the_files .= '<div><section><img class="pmn-character-img" src="'.$value.'" /></section> <a target="_blank" href="'.$key.'">'.__( 'View Full Size', 'plan-my-novel' ).'</a> | <a class="pmn-delete-file" href="'. get_delete_post_link($key).'">'.__( 'Delete', 'plan-my-novel' ).'</a> </div>';
								
								} 

								
							}

	

			$attached_content .= '<div class="pmn-image-container" '.$hide_container.'>';
			$attached_content .= wp_kses_post( $the_files ); // Sanitize the output
			$attached_content .= '</div>';
										
			return $attached_content;
	
	
}	



/**
 * Display cover image(s) attached to this novel
 * @return string            
 */ 
function pmn_display_cover_image() {
	
	global $wpdb;
	
	if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

				$attached_content = '';
				$the_files = '';					
				$files = '';
				$the_id = pmn_get_novel_id();
				$the_status = '';
				$hide_container = '';
				

				/* Everything submitted through the Character Metabox */
				$tab_content = get_post_meta( $the_id, '_pmn_tab_content', true ); 
				if ( !$tab_content ) return;

				/* Only character images within the array above  */
				if ( $tab_content ) {
					if (isset ( $tab_content[0]['_pmn_fld_content_cover'] ) ) {
						$files = $tab_content[0]['_pmn_fld_content_cover'];
					}
				}



				if ( $files ) {

						foreach ( $files as $key => $value ) {	
						
							if ( $value ) {
								
								/* Look up the actual post status since get_post_status ($key) had a bug. */
								foreach( 	
													$wpdb->get_results(
																					$wpdb->prepare(
																												"SELECT post_status 
																												 FROM $wpdb->posts 
																												 WHERE ID = %s LIMIT 1"
																												, $key																					
																										   )
																					
																			 ) as $db_key => $row
											) {
										
													$the_status = $row->post_status;
											}							
								
								
								
								if (  'trash' == $the_status OR '' == $the_status  ) {
									
									/* Remove reference from this novel's list of attached files */
									$tab_content[0]['_pmn_fld_content_cover][$key'] = '';
									update_post_meta( $the_id, '_pmn_tab_content', $tab_content ); 									
									
									/* Delete the attachment from the Media Library (the actual file remains in the uploads folder) */
									wp_delete_attachment( $key );																		
									
								}
								
								$the_files .= '<div><section><img class="pmn-cover-img" src="'.$value.'" /></section> <a target="_blank" href="'.$value.'">'.__( 'View Full Size', 'plan-my-novel' ).'</a> | <a class="pmn-delete-file" href="'. get_delete_post_link($key).'">'.__( 'Delete', 'plan-my-novel' ).'</a> </div>';
						}
				}

				} else {
					
					$hide_container = 'style="display:none"';
				}
				

			$attached_content .= '<div class="pmn-image-container" '.$hide_container.'>';
			$attached_content .= wp_kses_post( $the_files ); // Sanitize the output
			$attached_content .= '</div>';
										
			return $attached_content;
	
}	



/**
 * Info for Sidebar Metabox
 * @return string
 */		

function pmn_side_content() {		

	$side_content = '
								<div id="pmn-plugin-info">
										<p><span>'.__( "Version", "plan-my-novel" ).':</span> '.PMN_VERSION.'</p>
										<p><span>'.__( "Docs", "plan-my-novel" ).':</span> <a href="https://cato.io/plan-my-novel">cato.io/plan-my-novel</a></p>
										<p><span>'.__( "Rate", "plan-my-novel" ).':</span> <a href="https://wordpress.org/plugins/plan-my-novel">'.__( "Rate the plugin", "plan-my-novel" ).'</a></p>																	
								   </div>
								   
							';

	return $side_content;			
}	





/**
 * Display Plugin Credit on Reports
 * @return string
 */		

function pmn_plugin_credit() {		

		$credit = '';

		if ( !pmn_get_option ( 'pmn_setting_display_credit' ) ) {
			
			$credit .= __( 'This report was produced by the Plan My Novel WordPress plugin.', 'plan-my-novel' );

		}		

		return $credit;			
			
}	


