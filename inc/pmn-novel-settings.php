<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;


/**
* Settings for Novel CPT
* @return none
*/

add_action( 'cmb2_init', 'pmn_novel_options' );


function pmn_novel_options() {
	
			$prefix = '_pmn_';
			

			
				/**
				 * Plugin Info Metabox
				 */
			 
				$pmn_info = new_cmb2_box( array(
					'id'           => 'pmn_plugin_info_box',
					'title'        => 'Plugin Info',
					'object_types' => array( 'pmn_novel', 'pmn_outline', 'pmn_character' ), 
					'context'      => 'side',
					'priority'     => 'low',
				) );					
			
			
			
				$pmn_info->add_field( array(
								'id'   => $prefix . 'fld_plugin_info_content',
								'name' => '',
								'desc' => '',
								'type' => 'title',
								'after_field' => pmn_side_content(),

							) );
							
		
			/**
			 * Main Novel-Level Settings
			 */
			 
				$pmn_novel = new_cmb2_box( array(
				'id'           => 'pmn_tabs',
				'title'        => 'Novel Details',
				'object_types' => array( 'pmn_novel' ), 
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
			) );
			
		
				
				
				 /* GENERAL TAB  
				  *************************************************************************************************/

				$pmn_group_id_general = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_general',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content tab-general" id="tab-1">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'General', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				
				
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_title_basic_details',
										'name' => '',
										'desc' => __( 'Core information about your novel', 'plan-my-novel' ),
										'type' => 'title',
									) );
				
									
									
				
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
												'id'      => $prefix . 'fld_publishing_model',
												'name'    => __( 'Publishing Model:', 'plan-my-novel' ),
												'type'    => 'radio',
												'before_field' => '<strong>'.__( 'This novel will be:', 'plan-my-novel' ).'</strong><br><br>',
												'options' => array(
																				__( 'This novel will be self published', 'plan-my-novel' )									=> __( 'Self Published', 'plan-my-novel' ),
																				__( 'This novel will be published by a third-party publisher', 'plan-my-novel' )	=> __( 'Published by a third-party publisher', 'plan-my-novel' ),
																				__( 'This novel will be self published electronically and by a third-party publisher in print', 'plan-my-novel' ) => __( 'Self published electronically and by a third-party publisher in print', 'plan-my-novel' ),																					
																				__( 'This novel\'s publishing model is currently unknown or undecided', 'plan-my-novel'  )					=> __( 'Unknown or Undecided', 'plan-my-novel'  ),
																			)
									) );

									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
												'id'      => $prefix . 'fld_general_formats',
												'name'    => __( 'Formats:', 'plan-my-novel' ),
												'type'    => 'radio',
												'desc' => __( 'Check all that apply.', 'plan-my-novel' ),
												'before_field' => '<strong>'.__( 'This novel will be produced in the following formats:', 'plan-my-novel' ).'</strong><br>',
												'type'    => 'multicheck',
																				'options' => array(
																												__( 'Electronic', 'plan-my-novel' )	 			=> __( 'Electronic', 'plan-my-novel' ),
																												__( 'Hardcover', 'plan-my-novel' )	 			=> __( 'Hardcover', 'plan-my-novel' ),
																												__( 'Trade Paperback', 'plan-my-novel' )		=> __( 'Trade Paperback', 'plan-my-novel' ),
																												__( 'Custom Paperback', 'plan-my-novel' )	=> __( 'Custom Paperback', 'plan-my-novel' ),	
																												__( 'Audio Book', 'plan-my-novel' )				=> __( 'Audio Book', 'plan-my-novel' ),																														
																					
																				),
												'before_row' => '<div id="pmn-format-types" class="pmn-row">',
												'after_row' => '</div>',										
																				
									) );
									

									$pmn_novel->add_group_field( $pmn_group_id_general, array(
												'id'      => $prefix . 'fld_general_file_types',
												'name'    => __( 'File Types:', 'plan-my-novel' ),
												'type'    => 'radio',
												'desc' => '',
												'before_field' => '<strong><br>'.__( 'Check all electronic file types this novel will be produced in. This list is not comprehensive.', 'plan-my-novel' ).'</strong><br>',
												'type'    => 'multicheck',
																				'options' => array(
																												__( 'Kindle Format', 'plan-my-novel' )	=> __( 'Kindle Format', 'plan-my-novel' ),
																												__( 'Mobi', 'plan-my-novel' )		 		=> __( 'Mobi', 'plan-my-novel' ),
																												__( 'PDF', 'plan-my-novel' )					=> __( 'PDF', 'plan-my-novel' ),
																												__( 'ePub', 'plan-my-novel' )				=> __( 'ePub', 'plan-my-novel' ),			 																										
																					
																				),
												'before_row' => '<div id="pmn-file-types" class="pmn-row">',
												'after_row' => '</div>',
									) );										
									
									
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
												'id'      => $prefix . 'fld_general_authorship',
												'name'    => __( 'Authorship:', 'plan-my-novel' ),
												'type'    => 'radio',
												'before_field' => '<strong>'.__( 'This novel will have:', 'plan-my-novel' ).'</strong><br><br>',
												'options' => array(
																				'author_single' => __( 'A single author', 'plan-my-novel' ),
																				'author_multiple' => __( 'Multiple authors', 'plan-my-novel' ),
																			),
																			
												'before_row' => '<div id="pmn-authorship" class="pmn-row">',
												'after_row' => '</div>',																				
																			
									) );
									
								
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_author',
										'name' => __( 'Written By', 'plan-my-novel' ),
										'desc' => __( 'Enter the author\'s name or pen name', 'plan-my-novel' ),
										'type' => 'text',
										'default' => '',
									) );

									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_author_2',
										'name' => __( 'Co-author', 'plan-my-novel' ),
										'desc' => __( 'Enter the co-author\'s name or pen name', 'plan-my-novel' ),
										'type' => 'text',
										'before_row' => '<div id="pmn-coauthor" class="pmn-row">',
										'after_row' => '</div>',												
									) );										
									
									
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_genre',
										'name' => __( 'Primary Genre', 'plan-my-novel' ),
										'desc' => __( 'Such as Mystery, Romance, Science Fiction, etc.', 'plan-my-novel' ),
										'type' => 'text',
									) );										
									
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_subgenre',
										'name' => __( 'Primary Subgenre (Optional)', 'plan-my-novel' ),
										'desc' => __( 'Such as Police Procedural, Paranormal, etc.', 'plan-my-novel' ),
										'type' => 'text',
									) );											
									


									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_series',
										'name' => __( 'Series (Optional)', 'plan-my-novel' ),
										'desc' => __( 'Enter the series this novel is a part of', 'plan-my-novel' ),
										'type' => 'text',
									) );		
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_isbn',
										'name' => __( 'ISBN Number (Optional)', 'plan-my-novel' ),
										'desc' => '',
										'type' => 'text',
									) );											
									
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_asin',
										'name' => __( 'ASIN Number (Optional)', 'plan-my-novel' ),
										'desc' => __( 'An Amazon.com specific identifier assigned after publication', 'plan-my-novel' ),
										'type' => 'text',
									) );		
									
									$pmn_novel->add_group_field( $pmn_group_id_general, array(
										'id'   => $prefix . 'fld_general_other',
										'name' => __( 'Other Information', 'plan-my-novel' ),
										'desc' => __( 'Enter any other core information that is not captured above', 'plan-my-novel' ),
										'type' => 'textarea',
									) );												
									
									
									
									
				 /* MARKETING  TAB
				  *************************************************************************************************/

				$pmn_group_id_marketing = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_marketing',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content tab-marketing pmn-accordion" id="tab-2">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'Marketing', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				
				
				
						$date_format = pmn_get_option( 'pmn_setting_date_format' ); 
						
						
						
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_title_marketing',
										'name' => '',
										'desc' => __( 'These settings deal with the marketing and distribution of your completed novel. Click each topic.', 'plan-my-novel' ),
										'type' => 'title',
									) );
						
				
				
								// SCHEDULE
								/*--------------------------------------------------------------------------------------*/
								
									 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_schedule_instructions',
											'name' => '',
											'desc' =>  __( 'Enter key dates in your publication timeline.', 'plan-my-novel' ),
											'type' => 'title',
											'before_row' => sprintf( __( " %s RELEASE SCHEDULE %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">'  ),
										) );										
								
								
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_edit_date',
											'name' => __( 'Target Editorial Date', 'plan-my-novel' ),
											'desc' => '<span> '.__( 'Date when manuscript will be available to editors.', 'plan-my-novel' ).'</span>',
											'type' => 'text_date',
										//	'date_format' => $date_format,
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_preview_date',
											'name' => __( 'Target Preview Date', 'plan-my-novel' ),
											'desc' => '<span> '.__( 'Date when edited novel will available to beta readers.', 'plan-my-novel' ).'</span>',
											'type' => 'text_date',
											// 'date_format' => $date_format,
									) );
									
				
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_release_date',
											'name' => __( 'Target Release Date', 'plan-my-novel' ),
											'desc' => '<span> '.__( 'Date when novel will be available to the public.', 'plan-my-novel' ).'</span>',
											'type' => 'text_date',
											// 'date_format' => $date_format,
											'after_row' => '</div>'		// Last row, close accordion												 
									) );
									
									
							
							
							
								// PRICING
								/*--------------------------------------------------------------------------------------*/
								
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_pricing_instructions',
										'name' => '',
										'desc' =>  sprintf( __( 'Enter every price applicable to your novel. If you plan to distribute through Amazon, you should be familiar with Amazon’s %sPricing Page%s and %sList Price Requirements%s. If your book will be free, enter 0.00.','plan-my-novel'), '<a href="https://kdp.amazon.com/help?topicId=A29FL26OKE7R7B">','</a>', '<a href="https://kdp.amazon.com/help?topicId=A301WJ6XCJ8KW0">','</a>' ),
										'type' => 'title',
										'before_row' => sprintf( __( " %s PRICING %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">' ),
									) );									
								
								
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_ebook_price',
											'name' => __( 'Electronic Price', 'plan-my-novel' ),
											'desc' => '<span> '.__( 'The price as an ebook, incuding the Kindle Store', 'plan-my-novel' ).'</span>',
											'type' => 'text_money',
									) );								
							 
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_hardcover_price',
											'name' => __( 'Hardcover Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',											
									) );								
															
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_trade_price',
											'name' => __( 'Trade Paperback Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',									
									) );								
																				
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_special_price',
											'name' => __( 'Custom Paperback Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',
											'before_row' => '',
											'after_row' => '</div>'		// Last row, close accordion											
									) );									
							
							
							
								// CATEGORIZATION
								/*--------------------------------------------------------------------------------------*/
								
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_category_instructions',
										'name' => '',
										'desc' =>  __( 'Enter the categories in which you will list your book. Note that Amazon allows a maximum of two choices.', 'plan-my-novel' ),
										'type' => 'title',
										'before_row' => sprintf( __( " %s LISTING CATEGORIES %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">'  ),
									) );									
								
								
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_cat1',
											'name' => __( 'Listing Category 1', 'plan-my-novel' ),
											'desc' => 'For example: Science Fiction & Fantasy > Fantasy > Urban Fantasy',
											'type' => 'text',									
									) );	

									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_cat2',
											'name' => __( 'Listing Category 2', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
									) );										
																	
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_cat3',
											'name' => __( 'Listing Category 3', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
									) );										
															
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_cat4',
											'name' => __( 'Listing Category 4', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'after_row' => '</div>'		// Last row, close accordion
									) );										
												
												
							
								// DISTRIBUTION CHANNELS
								/*--------------------------------------------------------------------------------------*/
								
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_distro_instructions',
										'name' => '',
										'desc' =>  __( 'Select the primary channels you plan to use to distribute your book. Check all that apply. The list below is not comprehensive.', 'plan-my-novel' ),
										'type' => 'title',
										'before_row' => sprintf( __( " %s DISTRIBUTION CHANNELS %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></span></p><div class="accordion-content">'  ),
									) );									
								
								
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'      => $prefix . 'fld_marketing_channels',
										'name'    => '',
										'desc'    => '',
													'type'    => 'multicheck',
													// 'multiple' => true, // Store values in individual rows
													'options' => array(
														__( 'Publisher chosen channels', 'plan-my-novel' ) 					 				=> __( 'My publisher will decide', 'plan-my-novel' ),
														__( 'Direct sales from author\'s website', 'plan-my-novel' )						=> __( 'Direct sales from my website', 'plan-my-novel' ),
														__( 'Direct sales from in-person events', 'plan-my-novel' )							=> __( 'Direct sales from in-person events', 'plan-my-novel' ),
														__( 'Indirect sales via Print-on-Demand provider(s)', 'plan-my-novel' )		=> __( 'Indirect sales via Print-on-Demand provider', 'plan-my-novel' ),			 												
														__( 'Amazon - Physical Book Sales', 'plan-my-novel' )								=> __( 'Amazon - Physical Books', 'plan-my-novel' ),
														__( 'Amazon - Kindle Direct Publishing (ebooks)', 'plan-my-novel' )			=> __( 'Amazon - Kindle Direct Publishing (ebooks)', 'plan-my-novel' ),
														__( 'Apple iBooks Store', 'plan-my-novel' )												=> __( 'Apple iBooks Store', 'plan-my-novel' ),
														__( 'Barnes & Noble - Nook Press (ebooks)', 'plan-my-novel' )					=> __( 'Barnes & Noble - Nook Press (ebooks)', 'plan-my-novel' ),
														__( 'Kobo Store (ebooks)', 'plan-my-novel' )											=> __( 'Kobo Store (ebooks)', 'plan-my-novel' ),
														__( 'Wholesale to a distributor', 'plan-my-novel' )										=> __( 'Wholesale to a distributor', 'plan-my-novel' ),
														__( 'Wholesale to independent book stores', 'plan-my-novel' )					=> __( 'Wholesale to independent book stores', 'plan-my-novel' ),
														__( 'Consignment to book stores or other retailers', 'plan-my-novel' )			=> __( 'Consignment to book stores or other retailers', 'plan-my-novel' ),															
														
													),
									) );								
							
							
							
									$distro_placeholder = 'Enter description';
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_distro_other1',
											'name' => __( 'Other Channel 1', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $distro_placeholder,
																			),
									) );									
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_distro_other2',
											'name' => __( 'Other Channel 2', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $distro_placeholder,
																			),
									) );										
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_distro_other3',
											'name' => __( 'Other Channel 3', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $distro_placeholder,
																			),
									) );										
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_distro_other4',
											'name' => __( 'Other Channel 4', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $distro_placeholder,
																			),
											'after_row' => '</div>'		// Last row, close accordion																				
									) );										
							
					
				


								// VIABILITY
								/*--------------------------------------------------------------------------------------*/
								
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_viability_instructions',
										'name' => '',
										'desc' =>  __( 'Hone the appeal of your book by first identifying your target audience and then analyzing something that has proven to be a success with that audience. ', 'plan-my-novel' ),
										'type' => 'title',
										'before_row' => sprintf( __( " %s VIABILITY %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">'  ),
									) );	


									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_target_audience',
											'name' => __( 'Target Market', 'plan-my-novel' ),
											'desc' => '<br>'.__('Describe the target audience for your novel.','plan-my-novel' ).'',
											'type' => 'textarea',
																												
									) );	

									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_model_instructions',
										'name' => '<p class="pmn-success">'.__( 'Successful Model 1', 'plan-my-novel' ).'</p>',
										'desc' =>  __( 'Identify a novel that has recently been successful with your target audience and enter the following details about it. The purpose of this exercise is to ensure your familiarity with the things that have proven successful with your target market, even if your novel will have different characteristics.', 'plan-my-novel' ),
										'type' => 'title',
									) );	
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_include_model1',
											'name' => '',
											'desc' => __( 'Check to include in reports', 'plan-my-novel' ),
											'type' => 'checkbox',
									) );											

									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_title',
											'name' => __( 'Title', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );										

									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_author',
											'name' => __( 'Author', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );												
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_price_ebook',
											'name' => __( 'Electronic Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',																													
									) );	
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_price_paper',
											'name' => __( 'Paperback Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',																													
									) );	
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cover_pic',
											'name' => __( 'Cover Art', 'plan-my-novel' ),
											'desc' => 'Upload a picture of the novel\'s cover',
											'type' => 'file',
											'options' => array(
																			'url' => false, 
																		),
											'text'    => array(
																			'add_upload_file_text' => 'Add Cover Image' 
																),											
									) );									
									
									
				
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_length',
											'name' => __( 'Page Length', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );									
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_pov',
											'name' => __( 'Point of View', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'select',			
											'options' => array(
																			false => __( '--Please choose--', 'plan-my-novel' ),																				
																			__( 'First Person', 'plan-my-novel' ) 	=> __( 'First Person', 'plan-my-novel' ),
																			__( 'Second Person', 'plan-my-novel' ) => __( 'Second Person', 'plan-my-novel' ),																				
																			__( 'Third Person', 'plan-my-novel' ) 	=> __( 'Third Person', 'plan-my-novel' ),
																			__( 'Multiple POVs', 'plan-my-novel' )	=> __( 'Multiple POVs', 'plan-my-novel' ),

																		)												
									) );									
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cat1',
											'name' => __( 'Listing Category 1', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );						

									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cat2',
											'name' => __( 'Listing Category 2', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );	
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_notes',
											'name' => __( 'Other Notes', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'textarea',
											'options' => array( 'textarea_rows' => 2, ),														
									) );											

									/*--------------------------------------------*/
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_model_instructions2',
										'name' => '<p class="pmn-success">'.__( 'Successful Model 2', 'plan-my-novel' ).'</p>',
										'desc' =>  '',
										'type' => 'title',
										'before_row' => '<p></p>',	
									) );	
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_include_model2',
											'name' => '',
											'desc' => __( 'Check to include in reports', 'plan-my-novel' ),
											'type' => 'checkbox',
									) );	
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_title2',
											'name' => __( 'Title', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',	
										
									) );																				

									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_author2',
											'name' => __( 'Author', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );	

									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_price_ebook2',
											'name' => __( 'Electronic Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',																													
									) );	
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_price_paper2',
											'name' => __( 'Paperback Price', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text_money',																													
									) );	
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cover_pic2',
											'name' => __( 'Cover Art', 'plan-my-novel' ),
											'desc' => 'Upload a picture of the novel\'s cover',
											'type' => 'file',
											'options' => array(
																			'url' => false, 
																		),
											'text'    => array(
																			'add_upload_file_text' => 'Add Cover Image' 
																),											
									) );	
									
				
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_length2',
											'name' => __( 'Page Length', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );									
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_pov2',
											'name' => __( 'Point of View', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'select',			
											'options' => array(
																			false => __( '--Please choose--', 'plan-my-novel' ),																				
																			__( 'First Person', 'plan-my-novel' ) 	=> __( 'First Person', 'plan-my-novel' ),
																			__( 'Second Person', 'plan-my-novel' ) => __( 'Second Person', 'plan-my-novel' ),																				
																			__( 'Third Person', 'plan-my-novel' ) 	=> __( 'Third Person', 'plan-my-novel' ),
																			__( 'Multiple POVs', 'plan-my-novel' )	=> __( 'Multiple POVs', 'plan-my-novel' ),

																		)												
									) );									
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cat1_2',
											'name' => __( 'Listing Category 1', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );						

									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_cat2_2',
											'name' => __( 'Listing Category 2', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',																													
									) );	
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_model_notes2',
											'name' => __( 'Other Notes', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'textarea',
											'options' => array( 'textarea_rows' => 2, ),		
											'after_row' => '</div>'		// Last row, close accordion													
									) );																					
									
									
									
								// LAUNCH PLAN
								/*--------------------------------------------------------------------------------------*/
								
								 $pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'   => $prefix . 'fld_marketing_launch_instructions',
										'name' => '',
										'desc' =>  __( 'A strong launch is critical to the success of your novel. Choose the methods you plan to use to give your book the most exposure and momentum upon release. Check all that apply. ', 'plan-my-novel' ),
										'type' => 'title',
										'before_row' => sprintf( __( " %s LAUNCH PLAN %s", "plan-my-novel"), '<p class="pmn-group-title accordion-toggle">','<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content"><div id="pmn-launch-methods">'  ),
										'before_field' => '',
										'after_field' => '',
									
									
									) );	


									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
										'id'      => $prefix . 'fld_marketing_launch_methods',
										'name'    => '',
										'desc'    => '',
													'type'    => 'multicheck',
													// 'multiple' => true, // Store values in individual rows
													'options' => array(
													
														/* Free */
														''		=> '<br><p class="pmn-method">'.__( 'Methods with no cost', 'plan-my-novel' ).'</p>',
														__( 'Email Blast to Author\'s Own Mailing List', 'plan-my-novel' )	 												 => __( 'Email Blast to Your Own Mailing List', 'plan-my-novel' ),															
														__( 'Updates to Author\'s website', 'plan-my-novel' ) 																 => __( 'Update your own website', 'plan-my-novel' ),
														__( 'Updates to all of Author\'s social media accounts (Twitter, Facebook, etc.)', 'plan-my-novel' )	 => __( 'Updates to all of your social media accounts (Twitter, Facebook, etc.)', 'plan-my-novel' ),
														__( 'Post or announcement in Writer\'s Group or Forum', 'plan-my-novel' )	 								 => __( 'Post or announcement in your Writer\'s Group or Forum', 'plan-my-novel' ),
														__( 'Joining the GoodReads Author Program', 'plan-my-novel' )	 												 => __( 'Join the GoodReads Author Program', 'plan-my-novel' ),															
														__( 'Posting the novel\'s cover art on Pintrest', 'plan-my-novel' )	 											 => __( 'Post your novel\'s cover art on Pintrest', 'plan-my-novel' ),
														__( 'Hosting an online Chat/Q&A session about the novel', 'plan-my-novel' )	 							 => __( 'Host an online Chat/Q&A session about your novel', 'plan-my-novel' ),
														__( 'Making guest appearances on relevant podcast(s)', 'plan-my-novel' )	 								 => __( 'Make guest appearances on relevant podcast(s)', 'plan-my-novel' ).'<br><br><p class="pmn-method">'.__( 'Methods that may have costs', 'plan-my-novel' ).'</p>',													
														
														
														/*Not Free*/
														__( 'Email Blast to a third-party or purchased mailing list', 'plan-my-novel' )	 			=> __( 'Email Blast to a third-party or purchased mailing list', 'plan-my-novel' ),															
														__( 'Blog Book Tour', 'plan-my-novel' ) 																	=> __( 'Blog Book Tour', 'plan-my-novel' ),
														__( 'Traditional Book Tour (involving physical travel)', 'plan-my-novel' )	 					=> __( 'Traditional Book Tour (involving physical travel)', 'plan-my-novel' ),
														__( 'Sponsored Tweet(s)', 'plan-my-novel' )	 															=> __( 'Sponsored Tweet(s)', 'plan-my-novel' ),	
														__( 'Sponsored Blog Post(s)', 'plan-my-novel' )	 														=> __( 'Sponsored Blog Post(s)', 'plan-my-novel' ),
														__( 'Giveaway(s) of promotional items')																	=> __( 'Giveaways (such as giving the first 10 readers a new...)', 'plan-my-novel' ),															
														__( 'Providing Free Review Copies', 'plan-my-novel' )												=> __( 'Providing Free Review Copies', 'plan-my-novel' ),			
														__( 'BookBub Campaign', 'plan-my-novel' )	 															=> __( 'BookBub Campaign', 'plan-my-novel' ),	
														__( 'Purchasing Online Advertisements', 'plan-my-novel' )	 										=> __( 'Purchase Online Advertisements', 'plan-my-novel' ),
														__( 'Purchasing Print or other offline advertisements', 'plan-my-novel' ) 						=> __( 'Purchase Print or other offline advertisements', 'plan-my-novel' ),
														__( 'Creating a video trailer for your novel', 'plan-my-novel' ) 									=> __( 'Make a video trailer for your novel', 'plan-my-novel' ),													
																												
														
													),
									) );								
							
							
							
									$launch_placeholder = 'Enter description';
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_launch_other1',
											'name' => __( 'Other Method 1', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $launch_placeholder,
																			),
																				
									) );											
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_launch_other2',
											'name' => __( 'Other Method 2', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $launch_placeholder,
																			),																				
									) );										
							
							
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_launch_other3',
											'name' => __( 'Other Method 3', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $launch_placeholder,
																			),																					
									) );									
									
									
									$pmn_novel->add_group_field( $pmn_group_id_marketing, array(
											'id'   => $prefix . 'fld_marketing_launch_info',
											'name' => __( 'Launch Notes', 'plan-my-novel' ),
											'desc' => __( 'Enter any notes or other information pertaining to your launch', 'plan-my-novel' ),
											'type' => 'textarea',
											'after_row' => '</div></div>',		// Last row, close accordion and #pmn-launch-methods																				
									) );											
									
							

				  /* BUDGET TAB
				  *************************************************************************************************/

				$pmn_group_id_budget = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_budget',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content tab-budget" id="tab-3">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'Budget', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				
				
				
				
				
								$currency =  pmn_get_option( 'pmn_setting_currency' ) ? pmn_get_option( 'pmn_setting_currency' ) : '$' ; 
								$enter_vendor = __( 'Enter vendor or notes (optional)', 'plan-my-novel' );
				

				
								$pmn_novel->add_group_field( $pmn_group_id_budget, array(
										'id'   => $prefix . 'fld_title_budget',
										'name' => __( 'Budget', 'plan-my-novel' ),
										'desc' => __( 'Not every item below will apply to your novel or publishing model.', 'plan-my-novel' ),
										'type' => 'title',
									) );
				

	
								// Design Work
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_cover_art',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Cover Art %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => '<div class="pmn-grand-total">'.__( 'GRAND TOTAL', 'plan-my-novel' ).' </div> <span id="pmn-rpt-gt" class="pmn-the-total"></span>
																	<p class="pmn-group-title">'.__( 'DESIGN WORK', 'plan-my-novel' ).'</p>' ,
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_cover_art_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_interior_design',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Interior Design/Typesetting %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_interior_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );			
								/*--------------------------------------------------------------------------------------*/	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other_artwork',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Other Artwork %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other_artwork_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );			
								/*--------------------------------------------------------------------------------------*/	

								
								
								// Editorial Work
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_copyeditor',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Copyediting %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => sprintf( _( " %s EDITORIAL WORK %s"), '<p class="pmn-group-title">','</p>' ),
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_copyeditor_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_line_editing',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Line Editing %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_line_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_structural_editing',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Content/Structural Editing %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_structural_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_proofreading',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Proof Reader(s) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_proof_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor

																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_beta',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Beta Reader(s) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_beta_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );	



								// Printing
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_proof',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Cost of Printed Proof(s) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => sprintf( _( " %s PRINTING %s"), '<p class="pmn-group-title">','</p>' ),
									) );	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_proof_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor

																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_run',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Print Run %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_run_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_shipping_you',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Shipping (Printer to you) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ship_you_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );		
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_ship_dist',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Shipping (You to distributor) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ship_dist_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );					
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ship_supplies',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Shipping/Storage Supplies %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ship_supplies_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
									
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_storage',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Physical Storage %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_print_storage_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pod_fee1',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s P.O.D. One time Fee No.1 %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pod_fee1_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pod_fee2',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s P.O.D. One time Fee No.2 %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pod_fee2_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
									
									
									
								// Author Platform
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_author_domain',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Domain Registration - Author's Website %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => sprintf( _( " %s AUTHOR PLATFORM %s"), '<p class="pmn-group-title">','</p>' ),
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_author_domain_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );										
									
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_web_dev',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Web Design or Wordpress Theme %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_web_dev_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_web_hosting',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Website Hosting%s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_web_host_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_mailing_list',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Mailing List Service (Mailchimp, etc.) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_mailing_list_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_video_editing',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Video Editing/Conversion %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_video_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );										

									
									
									
									
									

								// Marketing Budget
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_launch',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Launch Budget %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => sprintf( _( " %s MARKETING %s"), '<p class="pmn-group-title">','</p>' ),
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_launch_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ads',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Advertisements %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ad_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pro_promotions',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Post-Launch Promotions %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_promotions_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_publicist',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Book Publicist %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_publicist_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_marketing_postage',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Postage for Review Copies %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_postage_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );							
									
									
									
									
								// OTHER
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_isbn',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Cost of ISBN(s) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'before_row' => sprintf( _( " %s OTHER EXPENSES %s"), '<p class="pmn-group-title">','</p>' ),
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_isbn_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_ebook_conversion',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s eBook Conversion Service %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_conversion_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );										
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pro_reviews',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Professional Reviews (Kirkus, etc.) %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_reviews_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );												
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_pro_photos',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Professional Photos/Headshots %s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_photo_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );											
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other1',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Other Expense 1%s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other1_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );												
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other2',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Other Expense 2%s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other2_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>'
									) );		
								/*--------------------------------------------------------------------------------------*/
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other3',
											'name' => '',
											'desc' => '',
											'type' => 'text_money',
											'before_field' => sprintf( _( " %s Other Expense 3%s %s"), '<span class="pmn-line-item">','</span>', $currency ),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
									) );	
	
									$pmn_novel->add_group_field( $pmn_group_id_budget, array(
											'id'   => $prefix . 'fld_budget_other3_vendor',
											'name' => '',
											'desc' => '',
											'type' => 'text',
											'attributes' => array (
																				'placeholder' => $enter_vendor
																			),
											'before' => '<section class="pmn-inline">',
											'after' => '</section>',
											'after_row' => '<p>&nbsp;</p><div class="pmn-grand-total">'.__( 'GRAND TOTAL', 'plan-my-novel' ).' </div> <span class="pmn-the-total"></span>',
									) );		


									
									
	
				  /* CONTENT TAB
				  *************************************************************************************************/

				$pmn_group_id_content = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_content',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content content_tab" id="tab-4">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'Content', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				
				
				
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_title_content',
										'name' => '',
										'desc' => __( 'These settings pertain to the acutal content of your novel.', 'plan-my-novel' ),
										'type' => 'title',
									) );
				
				
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_outlines',
										'name' => __( 'Outlines & Characters', 'plan-my-novel' ),
										'desc' =>  '<p  id="pmn-outline-note">'.sprintf( _( " For outlines, use the built-in %soutline tool%s.  For characters, use the built-in %scharacter tool%s."), '<a href="'.admin_url("edit.php?post_type=pmn_outline").'">','</a>', '<a href="'.admin_url("edit.php?post_type=pmn_character").'">','</a>' ).'</p>',
										'type'    => 'title',
									) );	

									
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
											'id'   => $prefix . 'fld_content_cover_pic',
											'name' => __( 'Cover Art', 'plan-my-novel' ),
											'desc' => 'Upload a picture of this novel\'s cover',
											'type' => 'file',		
											// Optional:
											'options' => array(
																			'url' => false, 
																		),
											'text'    => array(
																			'add_upload_file_text' => 'Add Cover Image' 
																),											
									) );									
									
									
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_word_count',
										'name' => __( 'Target Length', 'plan-my-novel' ),
										'desc' => __( 'Enter a word count, such as 70,000', 'plan-my-novel' ),
										'type'    => 'text',
									) );				
				
				
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_structure',
										'name' => __( 'Plot Structure (Optional)', 'plan-my-novel' ),
										'desc' => __( 'Enter your story structure, such as Three Act, Snowflake, etc. ', 'plan-my-novel' ),
										'type'    => 'text',
									) );		
									
				
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
												'id'      => $prefix . 'fld_content_pov',
												'name'    => __( 'Point of View', 'plan-my-novel' ),
												'type'    => 'radio',
												'before_field' => '<strong>'.__('This novel will be told in:', 'plan-my-novel' ).'</strong><br><br>', 

												'options' => array(
																				__( 'First Person', 'plan-my-novel' ) => __( 'First Person', 'plan-my-novel' ),
																				__( 'Third Person', 'plan-my-novel' ) => __( 'Third Person', 'plan-my-novel' ),
																				__( 'Multiple POVs', 'plan-my-novel' ) => __( 'Multiple POVs', 'plan-my-novel' ),
																				__( 'Second Person', 'plan-my-novel' )  => __( 'Second Person (very rare)', 'plan-my-novel' ),
																			)
									) );			
									
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_synopsis',
										'name' => __( 'Synopsis', 'plan-my-novel' ),
										'desc' => __( 'A brief summation of your story in one or two paragraphs. An effective synopsis typically tells who the story is about, where it happens and the hook or conflict that would make it interesting to your target audience. ', 'plan-my-novel' ),
										'type'    => 'wysiwyg',
										'options' => array( 'textarea_rows' => 12, 'media_buttons' => false, 'tinymce' => true),
									) );										
									

									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_pitch',
										'name' => __( 'Elevator Pitch', 'plan-my-novel' ),
										'desc' => __( 'A one or two sentence description of your novel that could be fully told during the time it takes to complete a typical elevator ride. Also known as a logline.', 'plan-my-novel' ),
										'type'    => 'wysiwyg',
										'options' => array( 'textarea_rows' => 2, 'media_buttons' => false, 'tinymce' => true),
									) );		

									
									$pmn_novel->add_group_field( $pmn_group_id_content, array(
										'id'   => $prefix . 'fld_content_setting',
										'name' => __( 'Setting (Optional)', 'plan-my-novel' ),
										'desc' => __( 'Describe your novel\'s setting in greater detail', 'plan-my-novel' ),
										'type'    => 'wysiwyg',
										'options' => array( 'textarea_rows' => 5, 'media_buttons' => false, 'tinymce' => true),
									) );								



	




				  /* MANAGE TAB
				  *************************************************************************************************/

				$pmn_group_id_manage = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_manage',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content tab-manage" id="tab-5">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'Manage', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				
				
									$action_btns = 	'
															<br>
															<div class="pmn-action-row" id="pmn-full-rpt">
															
																	<div class="pmn-mng-left">
																		<p class="pmn-action-title">'.__( 'Full Report', 'plan-my-novel').'</p>
																		<button id="full-print">'.__( "Print", "plan-my-novel").' </button> <button id="full-dl">'.__( "Download", "plan-my-novel").'</button>
																	</div>
																	
																	<div class="pmn-mng-right">
																		<p class="pmn-desc">'.__( 'All data, including outlines and characters. The download button produces an unformatted text file you can edit in your favorite word processor.', 'plan-my-novel').'</p>
																	</div>
															
															</div>
																															
																															
															<div class="pmn-action-row" id="pmn-summary-rpt">
															
																	<div class="pmn-mng-left">
																		<p class="pmn-action-title">'.__( 'Summary Report', 'plan-my-novel').'</p>
																		<button id="summary-print">'.__( "Print", "plan-my-novel").' </button> 
																	</div>	
																	
																	<div class="pmn-mng-right">																	
																		<p class="pmn-desc">'.__( 'Print a summary overview of your novel. ', 'plan-my-novel').'</p>
																	</div>
																
															</div>
															
															
															<div class="pmn-action-row" id="pmn-outline-rpt">
															
																	<div class="pmn-mng-left">
																		<p class="pmn-action-title">'.__( 'Outline Report', 'plan-my-novel').'</p>
																		<button id="outline-print">'.__( "Print", "plan-my-novel").' </button> 
																	</div>	
																	
																	<div class="pmn-mng-right">																	
																		<p class="pmn-desc">'.__( 'Print a standalone outline report.', 'plan-my-novel').'</p>
																	</div>
																
															</div>																
															
															
															<div class="pmn-action-row" id="pmn-character-rpt">
															
																	<div class="pmn-mng-left">
																		<p class="pmn-action-title">'.__( 'Character Report', 'plan-my-novel').'</p>
																		<button id="character-print">'.__( "Print", "plan-my-novel").' </button> 
																	</div>	
																	
																	<div class="pmn-mng-right">																	
																		<p class="pmn-desc">'.__( 'Print a standalone character report.', 'plan-my-novel').'</p>
																	</div>
																
															</div>																	
															

															<div class="pmn-action-row" id="pmn-export-csv">
															
																	<div class="pmn-mng-left">
																		<p class="pmn-action-title">'.__( 'Budget Export', 'plan-my-novel').'</p>
																		<!--<button id="export-csv">'.__( "Export", "plan-my-novel").' </button>-->
																		<a id="export-budget" class="pmn-link-btn" href="#!">'.__( "Export", "plan-my-novel").' </a>
																	</div>	
																	
																	<div class="pmn-mng-right">																	
																		<p class="pmn-desc">'.__( 'Download your novel\'s budget as a CSV file that you can edit in your favorite spreadsheet application.', 'plan-my-novel').'</p>
																	</div>
																
															</div>
															

															';
				
				
									$pmn_novel->add_group_field( $pmn_group_id_manage, array( 
										'id'   => $prefix . 'fld_title_manage',
										'name' => '',
										'desc' => sprintf(__( 'Take action with your novel\'s data. You can change what is included in the plugin\'s <a href="%s">settings</a>', 'plan-my-novel' ), PMN_SETTINGS ),
										 'before_row' => pmn_get_print_content(),
										 'after' => $action_btns, 
										'type' => 'title',
									) );					
				

				
									$pmn_novel->add_group_field( $pmn_group_id_manage, array(
											'id'   => $prefix . 'fld_mark_complete',
											'name' => __( 'Mark novel as complete', 'plan-my-novel' ),
											'desc' => '',
											'type' => 'checkbox',
											'before_row' => pmn_get_character_content(),		
											'after_row' => pmn_get_outline_content(), 
											'after' => pmn_get_summary_content(),	
											
									) );	






				  /* STORAGE TAB
				  *************************************************************************************************/

				$pmn_group_id_files = $pmn_novel->add_field( array(
					'id'           => $prefix . 'tab_files',
					'type'         => 'group',
					'repeatable'   => false,
					'before_group' => '<div class="tab-content tab-files" id="tab-6">',
					'after_group'  => '</div>',
					'options'      => array(
						'group_title'   => __( 'Files', 'plan-my-novel' ),
						'sortable'      => false, // beta
						'show_as_tab'   => true
					)
				) );
				

									$pmn_novel->add_group_field( $pmn_group_id_files, array( 
										'id'   => $prefix . 'fld_title_files',
										'name' => __( 'Attach documents related to this novel', 'plan-my-novel' ),
										'desc' => '<p  class="cmb2-metabox-description">'.sprintf( _( " Common examples include manuscript drafts, contracts and research materials. %sImportant note%s."), '&nbsp;<a id="pmn-show-backup-note" href="#!">','</a>').'</p>',
										'type' => 'title',
										'after_field' => '<p id="pmn-backup-note" class="cmb2-metabox-description">'.__( 'Like all Wordpress attachments, these files will be stored in the uploads folder on your server and NOT in the database. Be sure to backup your website folders regularly or use a backup plugin that includes both the database and files.','plan-my-novel' ).'</p>',
									) );		
									
									
									$pmn_novel->add_group_field( $pmn_group_id_files, array(
										'id'         => $prefix . 'fld_file_attachments',
										'name'    => '',
										'desc'      => '',
										'type'         => 'file_list',
										'after_field' => '<p><span class="dashicons dashicons-warning"></span> '.__('Remember to click Update after adding new files.','plan-my-novel' ).'</p>',
										'options' => array(
																		'add_upload_files_text' => '+ Add New File',
																	),
																	
										'after_row' => pmn_list_attachments()							
					
																	
																	
																	
			) );



	
	} // Close function pmn_novel_options