<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;



 /**
 * Data for Full Report
 * @return string
 */   

function pmn_get_print_content() {
	
global $wpdb;
	
if ( is_admin() ) {	
	
			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;
		
		
			/* Initialize variables */
			$the_id = pmn_get_novel_id();
			$date_format = pmn_get_option( 'pmn_setting_date_format' ) ? pmn_get_option( 'pmn_setting_date_format' ) : 'm-d-Y'; 
			$currency_symbol = pmn_get_option( 'pmn_setting_currency' ) ? pmn_get_option( 'pmn_setting_currency' ) : '$' ; 
			$print_content 		= '';
			$general_data 		= '';
			$marketing_data 	= '';
			$budget_data 		= '';
			$content_data 		= '';		
			$cover_pic 			= '';
			

			/* REPORT COVER PAGE
			--------------------------------------------------------------------------------------------------------------------------------------*/				
			$cover_img = get_post_meta( $the_id, '_pmn_tab_content', true );  	
							
			$rpt_cover_page = '';
			
			if ( $cover_img ) {
				
				foreach ( $cover_img as $key ){
					
																		if ( isset( $key['_pmn_fld_content_cover_pic'] ) ) {																			
																			$cover_pic .= '<img id="rpt-cover-img" class="img-thumbnail" src="'.$key['_pmn_fld_content_cover_pic'].'"/>';
																		}
										
										
											$rpt_cover_page .= '<div id="pmn-rpt-cover-page">
																		<h4>'.__( 'A NOVEL', 'plan-my-novel' ).' </h4>'.													
																		$cover_pic.'
																		<h4>'.__( 'FULL REPORT', 'plan-my-novel' ).'</h4>
																		<p>'.date( $date_format ).'</p>
																		</div>
																		<div class="pmn-print-section">&nbsp;</div>
																		';
									
							}

												
					
			}							

		
			
			/* GENERAL 
			--------------------------------------------------------------------------------------------------------------------------------------*/					
			$general_meta = get_post_meta( $the_id, '_pmn_tab_general', true );  	
			
			if ( $general_meta ) {
			
						$general_data = '';
						
						
						$general_data .= '<div class="pmn-print-section pmn-print-general">'; 
						$general_data .= '<h2>'.__( 'CORE INFORMATION', 'plan-my-novel' ).'</h2>';						
						$general_data .= '<table class="table pure-table pure-table-horizontal">
													<thead>
													  <tr>
													<th class="pmn-left-col"></th>
													<th class="pmn-right-col"></th>
													  </tr>
													  </thead>
													  <tbody>
													';		
													
													
						foreach ( $general_meta as $key ){
									
									$general_data .= '<tr><td><h4>'.__( 'Basic Details', 'plan-my-novel' ).'</h4></td><td></td></tr>';									
									

									if( isset( $key['_pmn_fld_general_author_2'] ) ) { $coauthor = 'and '.$key['_pmn_fld_general_author_2'];  }  	else { $coauthor = ''; }												
									if (  isset( $key['_pmn_fld_general_author'] ) ) {	 $general_data .= '<tr><td>'.__( 'Written by: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_author'].' '.$coauthor.'</td></tr>';}				

									if (  isset( $key['_pmn_fld_general_series'] ) ) {				
											$general_data .= '<tr><td>'.__( 'Series: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_series'].'</td></tr>';														
									}									
									
									if (  isset( $key['_pmn_fld_general_genre'] ) ) {	$general_data .= '<tr><td>'.__( 'Primary Genre: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_genre'].'</td></tr>';	}
									if(  isset( $key['_pmn_fld_general_subgenre'] ) )  { 	$general_data .= '<tr><td>'.__( 'Subgenre: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_subgenre'].'</td></tr>'; }									
												
									if (  isset( $key['_pmn_fld_publishing_model'] ) ) {	$general_data .= '<tr><td>'.__( 'Publishing Model: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_publishing_model'].'</td></tr>'; }										
									

									if (  isset( $key['_pmn_fld_general_isbn'] ) OR isset( $key['_pmn_fld_general_asin'] ) ) {														
											if (  $key['_pmn_fld_general_isbn'] ) {	$general_data .= '<tr><td>'.__( 'ISBN: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_isbn'].'</td></tr>';	}		
											if (  $key['_pmn_fld_general_asin'] ) {	$general_data .= '<tr><td>'.__( 'ASIN: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_asin'].'</td></tr>';	}	
									
									}									
																				
									// Multicheck. Show eveything the user selected.
									if ( isset( $key['_pmn_fld_general_formats'] ) ) {		
											$general_data .= '<tr class="pmn-add-borders"><td><br>'.__( 'Formats', 'plan-my-novel' ).'</h4></td><td></td></tr>';		
											$general_data .= '<tr><td>'.__( 'This novel will be published in the following formats:', 'plan-my-novel' ).'</td>';	
											$general_data .= '<td><ul>';									
											

												foreach (  $key['_pmn_fld_general_formats'] as $format_key ) {						
													$general_data .= '<li>'.$format_key.'</li>';
											}
											$general_data .= '</ul><br><br></td></tr>';
									}
									
									// Multicheck. Show eveything the user selected.
									if ( isset( $key['_pmn_fld_general_file_types'] )  ) {									
											$general_data .= '<tr class="pmn-add-borders"><td>'.__( 'File Types', 'plan-my-novel' ).'</h4></td><td></td></tr>';		
											$general_data .= '<tr><td>'.__( 'This novel will be produced in the following file types:', 'plan-my-novel' ).'</td>';	
											$general_data .= '<td><ul>';			
											
												foreach (  $key['_pmn_fld_general_file_types'] as $type_key ) {						
													$general_data .= '<li>'.$type_key.'</li>';
											}								
											$general_data .= '</ul><p>&nbsp;</p></td></tr>';										
									}
									

									
									if (  isset( $key['_pmn_fld_general_other'] ) ) {			
											$general_data .= '<tr ><td><h4>'.__( 'Other Information', 'plan-my-novel' ).'</h4></td><td></td></tr>';								
											$general_data .= '<tr><td>'.__( 'Other Information: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_other'].'</td></tr>';				
									}								
									
									
									
								}
								//------------------------------
								$general_data .= '</tbody>';											
								$general_data .= '</table>';											
								$general_data .= '</div>';									
					
			}
			
			
			
			/* MARKETING
			--------------------------------------------------------------------------------------------------------------------------------------*/					
			$marketing_meta = get_post_meta( $the_id, '_pmn_tab_marketing', true );  						

			if( $marketing_meta ) {
				
						$marketing_data = '';
						
						
						$marketing_data .= '<div class="pmn-print-section pmn-print-marketing">';
						$marketing_data .= '<h2>'.__( 'MARKETING', 'plan-my-novel' ).'</h2>';						
						$marketing_data .= '<table class="table pure-table pure-table-horizontal">
													<thead>
													  <tr>
													<th class="pmn-left-col"></th>
													<th class="pmn-right-col"></th>
													  </tr>
													  </thead>
													  <tbody>
													';									
					
						
						foreach ( $marketing_meta as $key ){

									if( isset( $key['_pmn_fld_marketing_edit_date'] ) OR isset($key['_pmn_fld_marketing_preview_date'] ) OR isset($key['_pmn_fld_marketing_release_date'] ) ) {								
										$marketing_data .= '<tr><td><h4>'.__( 'Release Schedule', 'plan-my-novel' ).'</h4></td><td></td></tr>';	
									}									
									if( isset( $key['_pmn_fld_marketing_edit_date'] ) ) { 			$marketing_data .= '<tr><td>'.__( 'Target Editorial Date: ', 'plan-my-novel' ).'</td> <td>'.date( $date_format, strtotime( $key['_pmn_fld_marketing_edit_date'] ) ).'</td></tr>'; }	
									if( isset($key['_pmn_fld_marketing_preview_date'] ) ) { 	$marketing_data .= '<tr><td>'.__( 'Target Preview Date: ', 'plan-my-novel' ).'</td> <td>'.date( $date_format, strtotime( $key['_pmn_fld_marketing_preview_date'] ) ).'</td></tr>'; }
									if( isset($key['_pmn_fld_marketing_release_date'] ) ) { 		$marketing_data .= '<tr><td>'.__( 'Target Release Date: ', 'plan-my-novel' ).'</td> <td>'.date( $date_format, strtotime( $key['_pmn_fld_marketing_release_date'] ) ).'</td></tr>'; }									

									if( isset( $key['_pmn_fld_marketing_ebook_price']  ) OR isset($key['_pmn_fld_marketing_trade_price'] )  ) {										
									$marketing_data .= '<tr><td><h4>'.__( 'Pricing', 'plan-my-novel' ).'</h4></td><td></td></tr>';	
									}									
									if( isset($key['_pmn_fld_marketing_ebook_price'] ) ) { 		$marketing_data .= '<tr><td>'.__( 'Electronic Price: ', 'plan-my-novel' ).'</td> <td>'.$currency_symbol.' '.$key['_pmn_fld_marketing_ebook_price'].'</td></tr>';	}								
									if( isset($key['_pmn_fld_marketing_hardcover_price'] ) ) { $marketing_data .= '<tr><td>'.__( 'Hardcover Price: ', 'plan-my-novel' ).'</td> <td>'.$currency_symbol.' '.$key['_pmn_fld_marketing_hardcover_price'].'</td></tr>';	}
									if( isset($key['_pmn_fld_marketing_trade_price'] ) ) { 		$marketing_data .= '<tr><td>'.__( 'Trade Paperback Price: ', 'plan-my-novel' ).'</td> <td>'.$currency_symbol.' '.$key['_pmn_fld_marketing_trade_price'].'</td></tr>';	}
									if( isset($key['_pmn_fld_marketing_special_price'] ) ) { 		$marketing_data .= '<tr><td>'.__( 'Custom Paperback Price: ', 'plan-my-novel' ).'</td> <td>'.$currency_symbol.' '.$key['_pmn_fld_marketing_special_price'].'</td></tr>';	}								

									if( isset($key['_pmn_fld_marketing_cat1'] ) ) {									
										$marketing_data .= '<tr><td><h4>'.__( 'Categorization', 'plan-my-novel' ).'</h4></td><td></td></tr>';	
									}									
									if( isset($key['_pmn_fld_marketing_cat1'] ) ) { $marketing_data .= '<tr><td>'.__( 'Listing Category 1: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_marketing_cat1'].'</td><tr>';	}								
									if( isset($key['_pmn_fld_marketing_cat2'] ) ) { $marketing_data .= '<tr><td>'.__( 'Listing Category 2: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_marketing_cat2'].'</td><tr>';	}
									if( isset($key['_pmn_fld_marketing_cat3'] ) ) { $marketing_data .= '<tr><td>'.__( 'Listing Category 3: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_marketing_cat3'].'</td><tr>';	}
									if( isset($key['_pmn_fld_marketing_cat4'] ) ) { $marketing_data .= '<tr><td>'.__( 'Listing Category 4: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_marketing_cat4'].'</td><tr>';	}		

									// Multicheck. Show eveything the user selected.
									if ( isset($key['_pmn_fld_marketing_channels']  ) ) {									
											$marketing_data .= '<tr><td><h4>'.__( 'Distribution Channels', 'plan-my-novel' ).'</h4></td><td></td></tr>';		
											$marketing_data .= '<tr><td>'.__( 'This novel will be distributed through the following channels:', 'plan-my-novel' ).'</td>';	
											$marketing_data .= '<td><ul>';									

												foreach (  $key['_pmn_fld_marketing_channels'] as $dist_key ) {						
													$marketing_data .= '<li>'.$dist_key.'</li>';
												}	
									}
									if( isset($key['_pmn_fld_marketing_distro_other1'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_distro_other1'].'</li>';	}								
									if( isset($key['_pmn_fld_marketing_distro_other2'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_distro_other2'].'</li>';	}
									if( isset($key['_pmn_fld_marketing_distro_other3'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_distro_other3'].'</li>';	}
									if( isset($key['_pmn_fld_marketing_distro_other4'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_distro_other4'].'</li>';	}									
									$marketing_data .= '</ul></td></tr>';						

									if( isset( $key['_pmn_fld_marketing_target_audience'] ) OR isset($key['_pmn_fld_marketing_include_model1'] ) ) {
										$marketing_data .= '<tr><td><h4>'.__( 'Viability', 'plan-my-novel' ).'</h4></td><td></td></tr>';	
									}
									
									if( isset( $key['_pmn_fld_marketing_target_audience'] ) ) { $marketing_data .= '<tr><td>'.__( 'Target Audience: ', 'plan-my-novel' ).'</td><td><p>'.$key['_pmn_fld_marketing_target_audience'].'</p></td></tr>';	}			


									if( pmn_get_option( 'pmn_marketing_include_model1' ) AND isset($key['_pmn_fld_marketing_include_model1'] ) ) {
											if( isset($key['_pmn_fld_marketing_model_title'] ) ) { $marketing_data .= '<tr><td><section>'.__( 'Successful Model No.1: ', 'plan-my-novel' ).'</section><section>'.$key['_pmn_fld_marketing_model_title'].' '.__( 'by','plan-my-novel').' '.$key['_pmn_fld_marketing_model_author'].'</section></td>';	}										
											$marketing_data .= '<td><ul>';							
											if( isset($key['_pmn_fld_marketing_model_price_ebook'] ) ) { 	$marketing_data .= '<li>'.__( 'Electronic Price: ', 'plan-my-novel' ).$currency_symbol.' '.$key['_pmn_fld_marketing_model_price_ebook'].'</li>';	}
											if( isset($key['_pmn_fld_marketing_model_price_paper'] ) ) { 	$marketing_data .= '<li>'.__( 'Paperback Price: ', 'plan-my-novel' ).$currency_symbol.' '.$key['_pmn_fld_marketing_model_price_paper'].'</li>';	}
											if( isset($key['_pmn_fld_marketing_model_length'] ) ) { 			$marketing_data .= '<li>'.__( 'Page Length: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_length'].'</li>';	}	
											if( isset($key['_pmn_fld_marketing_model_pov'] ) ) { 				$marketing_data .= '<li>'.__( 'Point of View: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_pov'].'</li>';	}				
											if( isset($key['_pmn_fld_marketing_model_cat1'] ) ) { 				$marketing_data .= '<li>'.__( 'Listing Category 1: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_cat1'].'</li>';	}				
											if( isset($key['_pmn_fld_marketing_model_cat2'] ) ) { 				$marketing_data .= '<li>'.__( 'Listing Category 2: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_cat2'].'</li>';	}											
											$marketing_data .= '</ul></td></tr>';									
									}
									
									$marketing_data .= '<p>&nbsp;</p>';									
									
									if( pmn_get_option( 'pmn_marketing_include_model2' ) AND isset( $key['_pmn_fld_marketing_include_model2'] ) ) {
											if( isset($key['_pmn_fld_marketing_model_title2'] ) ) { $marketing_data .= '<tr><td><section>'.__( 'Successful Model No.2: ', 'plan-my-novel' ).'</section><section>'.$key['_pmn_fld_marketing_model_title2'].' '.__( 'by','plan-my-novel').' '.$key['_pmn_fld_marketing_model_author2'].'</section></td>';	}										
											$marketing_data .= '<td><ul>';												
											if( isset($key['_pmn_fld_marketing_model_price_ebook2'] ) ) { 	$marketing_data .= '<li>'.__( 'Electronic Price: ', 'plan-my-novel' ).$currency_symbol.' '.$key['_pmn_fld_marketing_model_price_ebook2'].'</li>';	}
											if( isset($key['_pmn_fld_marketing_model_price_paper2'] ) ) { 	$marketing_data .= '<li>'.__( 'Paperback Price: ', 'plan-my-novel' ).$currency_symbol.' '.$key['_pmn_fld_marketing_model_price_paper2'].'</li>';	}
											if( isset($key['_pmn_fld_marketing_model_length2'] ) ) { 			$marketing_data .= '<li>'.__( 'Page Length: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_length2'].'</li>';	}	
											if( isset($key['_pmn_fld_marketing_model_pov2'] ) ) { 				$marketing_data .= '<li>'.__( 'Point of View: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_pov2'].'</li>';	}				
											if( isset($key['_pmn_fld_marketing_model_cat1_2'] ) ) { 			$marketing_data .= '<li>'.__( 'Listing Category 1: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_cat1_2'].'</li>';	}				
											if( isset($key['_pmn_fld_marketing_model_cat2_2'] ) ) { 			$marketing_data .= '<li>'.__( 'Listing Category 2: ', 'plan-my-novel' ).$key['_pmn_fld_marketing_model_cat2_2'].'</li>';	}											
											$marketing_data .= '</ul></td></tr>';									
									}

									// Multicheck. Show eveything the user selected.
									if ( isset($key['_pmn_fld_marketing_launch_methods'] )  ) {									
											$marketing_data .= '<tr><td><h4>'.__( 'Launch Plan', 'plan-my-novel' ).'</h4></td><td></td></tr>';
											$marketing_data .= '<tr><td>'.__( 'This novel will be launched using the following methods:', 'plan-my-novel' ).'</td>';	
											$marketing_data .= '<td><ul>';									

												foreach (  $key['_pmn_fld_marketing_launch_methods'] as $launch_key ) {						
													$marketing_data .= '<li>'.$launch_key.'</li>';
												}

									}
									if( isset($key['_pmn_fld_marketing_launch_other1'] ) )  { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_launch_other1'].'</li>';	}								
									if( isset($key['_pmn_fld_marketing_launch_other2'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_launch_other2'].'</li>';	}
									if( isset($key['_pmn_fld_marketing_launch_other3'] ) ) { $marketing_data .= '<li>'.$key['_pmn_fld_marketing_launch_other3'].'</li>';	}								

									$marketing_data .= '</ul></td></tr>';	
									
									if( isset($key['_pmn_fld_marketing_launch_info'] ) ) { 	$marketing_data .= '<tr><td>'.__( 'Other Launch Information: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_marketing_launch_info'].'</td></tr>';	}								
									
									
						}	
									
								//------------------------------
								$marketing_data .= '</tbody>';											
								$marketing_data .= '</table>';											
								$marketing_data .= '</div>';							
														
					
			}		


			
			/* BUDGET
			--------------------------------------------------------------------------------------------------------------------------------------*/					
			$budget_meta = get_post_meta( $the_id, '_pmn_tab_budget', true );  	
			
			
			if ( $budget_meta ) {	
			
							$budget_data = '';
				
		
							$budget_data .= '<div class="pmn-print-section pmn-print-budget">';
							$budget_data .= '	<h2>'.__( 'BUDGET', 'plan-my-novel' ).'</h2>';						
							$budget_data .= '	<table class="table pure-table pure-table-horizontal">
													<thead>
													  <tr>
															<th class="pmn-bud-col-1">'.__( 'ITEM ', 'plan-my-novel' ).'</th>
															<th class="pmn-bud-col-2">'.__( 'AMOUNT ', 'plan-my-novel' ).'</th>
															<th class="pmn-bud-col-3">'.__( 'VENDOR ', 'plan-my-novel' ).'</th>																	
													  </tr>
													  </thead>
													  <tbody>
													';	
							
								$grand_total = 0;
								foreach ( $budget_meta as $key ){
									
											/* Check Vendors */
											if ( isset( $key['_pmn_fld_budget_cover_art_vendor'] ) ) 		{ $vendor2 = $key['_pmn_fld_budget_cover_art_vendor'];  } else { $vendor2 = ''; } 
											if ( isset( $key['_pmn_fld_budget_interior_vendor'] ) ) 			{ $vendor3 = $key['_pmn_fld_budget_interior_vendor'];  } else { $vendor3 = ''; } 
											if ( isset( $key['_pmn_fld_budget_other_artwork_vendor'] ) ) 	{ $vendor4 = $key['_pmn_fld_budget_other_artwork_vendor'];  } else { $vendor4 = ''; } 
											if ( isset( $key['_pmn_fld_budget_copyeditor_vendor'] ) ) 		{ $vendor5 = $key['_pmn_fld_budget_copyeditor_vendor'];  } else { $vendor5 = ''; } 
											if ( isset( $key['_pmn_fld_budget_line_vendor'] ) ) 					{ $vendor6 = $key['_pmn_fld_budget_line_vendor'];  } else { $vendor6 = ''; } 
											if ( isset( $key['_pmn_fld_budget_structural_vendor'] ) ) 		{ $vendor7 = $key['_pmn_fld_budget_structural_vendor'];  } else { $vendor7 = ''; } 
											if ( isset( $key['_pmn_fld_budget_proof_vendor'] ) ) 				{ $vendor8 = $key['_pmn_fld_budget_proof_vendor']; } else { $vendor8 = ''; } 
											if ( isset( $key['_pmn_fld_budget_beta_vendor'] ) ) 				{ $vendor9 = $key['_pmn_fld_budget_beta_vendor'];  } else { $vendor9 = ''; } 
											if ( isset( $key['_pmn_fld_budget_print_proof_vendor'] ) ) 		{ $vendor10 = $key['_pmn_fld_budget_print_proof_vendor'];  } else { $vendor10 = ''; } 
											if ( isset( $key['_pmn_fld_budget_print_run_vendor'] ) ) 			{ $vendor11 = $key['_pmn_fld_budget_print_run_vendor'];  } else { $vendor11 = ''; } 
											if ( isset( $key['_pmn_fld_budget_print_ship_you_vendor'] ) )  { $vendor12 = $key['_pmn_fld_budget_print_ship_you_vendor'];  } else { $vendor12 = ''; } 
											if ( isset( $key['_pmn_fld_budget_print_ship_dist_vendor'] ) )  { $vendor13 = $key['_pmn_fld_budget_print_ship_dist_vendor'];  } else { $vendor13 = ''; } 
											if ( isset( $key['_pmn_fld_budget_print_storage_vendor'] ) ) 	{ $vendor14 = $key['_pmn_fld_budget_print_storage_vendor'];  } else { $vendor14 = ''; } 
											if ( isset( $key['_pmn_fld_budget_pod_fee1_vendor'] ) ) 		{ $vendor15 = $key['_pmn_fld_budget_pod_fee1_vendor'];  } else { $vendor15 = ''; } 
											if ( isset( $key['_pmn_fld_budget_pod_fee2_vendor'] ) ) 		{ $vendor16 = $key['_pmn_fld_budget_pod_fee2_vendor'];  } else { $vendor16 = ''; } 
											if ( isset( $key['_pmn_fld_budget_author_domain_vendor'] ) ) { $vendor17 = $key['_pmn_fld_budget_author_domain_vendor'];  } else { $vendor17 = ''; } 
											if ( isset( $key['_pmn_fld_budget_web_dev_vendor'] ) ) 			{ $vendor18 = $key['_pmn_fld_budget_web_dev_vendor'];  } else { $vendor18 = ''; } 
											if ( isset( $key['_pmn_fld_budget_web_hosting_vendor'] ) ) 	{ $vendor19 = $key['_pmn_fld_budget_web_hosting_vendor'];  } else { $vendor19 = ''; } 
											if ( isset( $key['_pmn_fld_budget_mailing_list_vendor'] ) ) 		{ $vendor20 = $key['_pmn_fld_budget_mailing_list_vendor'];  } else { $vendor20 = ''; } 
											if ( isset( $key['_pmn_fld_budget_video_vendor'] ) ) 				{ $vendor21 = $key['_pmn_fld_budget_video_vendor'];  } else { $vendor21 = ''; } 
											if ( isset( $key['_pmn_fld_budget_launch_vendor'] ) ) 			{ $vendor22 = $key['_pmn_fld_budget_launch_vendor'];  } else { $vendor22 = ''; } 
											if ( isset( $key['_pmn_fld_budget_ads_vendor'] ) ) 					{ $vendor23 = $key['_pmn_fld_budget_ads_vendor'];  } else { $vendor23 = ''; } 
											if ( isset( $key['_pmn_fld_budget_promotions_vendor'] ) ) 		{ $vendor24 = $key['_pmn_fld_budget_promotions_vendor'];  } else { $vendor24 = ''; } 
											if ( isset( $key['_pmn_fld_budget_publicist_vendor'] ) ) 			{ $vendor25 = $key['_pmn_fld_budget_publicist_vendor'];  } else { $vendor25 = ''; } 
											if ( isset( $key['_pmn_fld_budget_launch_vendor'] ) ) 			{ $vendor26 = $key['_pmn_fld_budget_launch_vendor'];  } else { $vendor26 = ''; } 
											if ( isset( $key['_pmn_fld_budget_isbn_vendor'] ) ) 				{ $vendor27 = $key['_pmn_fld_budget_isbn_vendor'];  } else { $vendor27 = ''; } 
											if ( isset( $key['_pmn_fld_budget_ebook_conversion'] ) ) 		{ $vendor28 = $key['_pmn_fld_budget_ebook_conversion'];  } else { $vendor28 = ''; } 
											if ( isset( $key['_pmn_fld_budget_reviews_vendor'] ) ) 			{ $vendor29 = $key['_pmn_fld_budget_reviews_vendor'];  } else { $vendor29 = ''; } 
											if ( isset( $key['_pmn_fld_budget_photos_vendor'] ) ) 			{ $vendor30 = $key['_pmn_fld_budget_photos_vendor'];  } else { $vendor30 = ''; } 
											if ( isset( $key['_pmn_fld_budget_other1_vendor'] ) ) 			{ $vendor31 = $key['_pmn_fld_budget_other1_vendor'];  } else { $vendor31 = ''; } 
											if ( isset( $key['_pmn_fld_budget_other2_vendor'] ) ) 			{ $vendor32 = $key['_pmn_fld_budget_other2_vendor'];  } else { $vendor32 = ''; } 
											if ( isset( $key['_pmn_fld_budget_other3_vendor'] ) ) 			{ $vendor33 = $key['_pmn_fld_budget_other3_vendor'];  } else { $vendor33 = ''; } 



											
											
											if ( isset( $key['_pmn_fld_budget_cover_art'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'Cover Art ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_cover_art'].'</td><td>'.$vendor2.'</td></tr>';	}
											if ( isset( $key['_pmn_fld_budget_interior_design'] ) ) 	{ $budget_data .= '<tr><td>'.__( 'Interior Design/Typesetting ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_interior_design'].'</td><td>'.$vendor3.'</td></tr>';	}
											if ( isset( $key['_pmn_fld_budget_other_artwork']) ) 		{ $budget_data .= '<tr><td>'.__( 'Other Artwork ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_other_artwork'].'</td><td>'.$vendor4.'</td></tr>';		}										
	
											if ( isset($key['_pmn_fld_budget_copyeditor'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'Copyediting ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_copyeditor'].'</td><td>'.$vendor5.'</td></tr>';	}
											if ( isset( $key['_pmn_fld_budget_line_editing'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'Line Editing ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_line_editing'].'</td><td>'.$vendor6.'</td></tr>';	 }
											if ( isset( $key['_pmn_fld_budget_structural_editing']) )	{ $budget_data .= '<tr><td>'.__( 'Content/Structural Editing ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_structural_editing'].'</td><td>'.$vendor7.'</td></tr>';		}										
											if ( isset( $key['_pmn_fld_budget_proofreading']) ) 		{ $budget_data .= '<tr><td>'.__( 'Proof Readers ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_proofreading'].'</td><td>'.$vendor8.'</td></tr>';	}
											if ( isset( $key['_pmn_fld_budget_beta']) ) 					{ $budget_data .= '<tr><td>'.__( 'Beta Readers ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_beta'].'</td><td>'.$vendor9.'</td></tr>';	}

											if ( isset( $key['_pmn_fld_budget_print_proof']) ) 			{ $budget_data .= '<tr><td>'.__( 'Cost of Printed Proof(s) ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_print_proof'].'</td><td>'.$vendor10.'</td></tr>'; }	
											if ( isset($key['_pmn_fld_budget_print_run'] ) ) 				{ $budget_data .= '<tr><td>'.__( 'Print Run ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_print_run'].'</td><td>'.$vendor11.'</td></tr>';	}
											if ( isset( $key['_pmn_fld_budget_print_shipping_you']) ){ $budget_data .= '<tr><td>'.__( 'Shipping (Printer to you) ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_print_shipping_you'].'</td><td>'.$vendor12.'</td></tr>';		}
											if ( isset( $key['_pmn_fld_budget_print_ship_dist'] ) ) 		{ $budget_data .= '<tr><td>'.__( 'Shipping (You to distributor) ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_print_ship_dist'].'</td><td>'.$vendor13.'</td></tr>';	}	
											if ( isset( $key['_pmn_fld_budget_print_storage']) ) 		{ $budget_data .= '<tr><td>'.__( 'Physical Storage ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_print_storage'].'</td><td>'.$vendor14.'</td></tr>';	}		
											if ( isset( $key['_pmn_fld_budget_pod_fee1'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'P.O.D. One time Fee No.1 ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_pod_fee1'].'</td><td>'.$vendor15.'</td></tr>'; }												
											if ( isset( $key['_pmn_fld_budget_pod_fee2']) ) 				{ $budget_data .= '<tr><td>'.__( 'P.O.D. One time Fee No.2', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_pod_fee2'].'</td><td>'.$vendor16.'</td></tr>'; }

											if ( isset($key['_pmn_fld_budget_author_domain'] ) ) 		{ $budget_data .= '<tr><td>'.__( 'Domain Registration - Author\'s Website ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_author_domain'].'</td><td>'.$vendor17.'</td></tr>'; }		
											if ( isset( $key['_pmn_fld_budget_web_dev']) ) 				{ $budget_data .= '<tr><td>'.__( 'Web Design or Wordpress Theme ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_web_dev'].'</td><td>'.$vendor18.'</td></tr>'; }		
											if ( isset( $key['_pmn_fld_budget_web_hosting']) ) 			{ $budget_data .= '<tr><td>'.__( 'Website Hosting ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_web_hosting'].'</td><td>'.$vendor19.'</td></tr>';	}
											if ( isset($key['_pmn_fld_budget_mailing_list'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'Mailing List Service ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_mailing_list'].'</td><td>'.$vendor20.'</td></tr>'; }
											if ( isset( $key['_pmn_fld_budget_video_editing']) ) 		{ $budget_data .= '<tr><td>'.__( 'Video Editing/Conversion ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_video_editing'].'</td><td>'.$vendor21.'</td></tr>';	}

											if ( isset($key['_pmn_fld_budget_launch'] ) ) 					{ $budget_data .= '<tr><td>'.__( 'Launch Budget ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_launch'].'</td><td>'.$vendor22.'</td></tr>'; }	
											if ( isset( $key['_pmn_fld_budget_ads']) ) 						{ $budget_data .= '<tr><td>'.__( 'Advertisements ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_ads'].'</td><td>'.$vendor23.'</td></tr>'; }
											if ( isset( $key['_pmn_fld_budget_pro_promotions']) ) 	{ $budget_data .= '<tr><td>'.__( 'Post-Launch Promotions ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_pro_promotions'].'</td><td>'.$vendor24.'</td></tr>'; }
											if ( isset( $key['_pmn_fld_budget_publicist']) ) 				{ $budget_data .= '<tr><td>'.__( 'Book Publicist ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_publicist'].'</td><td>'.$vendor25.'</td></tr>';									}		
											if ( isset( $key['_pmn_fld_marketing_launch']) ) 			{ $budget_data .= '<tr><td>'.__( 'Postage for Review Copies ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_marketing_launch'].'</td><td>'.$vendor26.'</td></tr>';			}			
											
											if ( isset($key['_pmn_fld_budget_isbn'] ) ) 						{ $budget_data .= '<tr><td>'.__( 'Cost of ISBN(s) ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_isbn'].'</td><td>'.$vendor27.'</td></tr>';	}
											if ( isset($key['_pmn_fld_budget_ebook_conversion'] ) ) { $budget_data .= '<tr><td>'.__( 'eBook Conversion Service ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_ebook_conversion'].'</td><td>'.$vendor28.'</td></tr>';	}										
											if ( isset($key['_pmn_fld_budget_pro_reviews'] ) ) 			{ $budget_data .= '<tr><td>'.__( 'Professional Reviews ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_pro_reviews'].'</td><td>'.$vendor29.'</td></tr>'; }						
											if ( isset( $key['_pmn_fld_budget_pro_photos']) ) 			{ $budget_data .= '<tr><td>'.__( 'Professional Photos ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_pro_photos'].'</td><td>'.$vendor30.'</td></tr>'; }						
											if ( isset($key['_pmn_fld_budget_other1'] ) ) 					{ $budget_data .= '<tr><td>'.__( 'Other Expense 1 ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_other1'].'</td><td>'.$vendor31.'</td></tr>'; }
											if ( isset( $key['_pmn_fld_budget_other2']) ) 					{ $budget_data .= '<tr><td>'.__( 'Other Expense 2 ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_other2'].'</td><td>'.$vendor32.'</td></tr>';	}			
											if ( isset( $key['_pmn_fld_budget_other3']) ) 					{ $budget_data .= '<tr><td>'.__( 'Other Expense 3 ', 'plan-my-novel' ).'</td><td>'.$currency_symbol.' '.$key['_pmn_fld_budget_other3'].'</td><td>'.$vendor33.'</td></tr>';	}										
								
								
								}	
								
							$budget_data .= '<tr id="pmn-gt-row"><td>'.__( 'GRAND TOTAL', 'plan-my-novel' ).'</td><td id="pmn-gt"></td><td></td></tr>';	
							$budget_data .= '</tbody>';								
							$budget_data .= '</table>';									
							$budget_data .= '</div>';		


			}		
			
			

			/* CONTENT
			--------------------------------------------------------------------------------------------------------------------------------------*/					
			$content_meta = get_post_meta( $the_id, '_pmn_tab_content', true );  	
			
			$content_data = '';
			if ( $content_meta ) {
				
				foreach ( $content_meta as $key ){

							$content_data .= '<div class="pmn-print-section pmn-print-content">';
							$content_data .= '	<h2>'.__( 'CONTENT', 'plan-my-novel' ).'</h2>';						
							$content_data .= '	<table class="table pure-table pure-table-horizontal">
													<thead>
													  <tr>
															<th class="pmn-left-col"></th>
															<th class="pmn-right-col"></th>
													  </tr>
													  </thead>
													  <tbody>
													';	

							if( isset( $key['_pmn_fld_content_word_count'] ) ) { 	$content_data .= '<tr><td>'.__( 'Target Word Count : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_word_count'].'</td></tr>';	}	
													
							if ( isset( $key['_pmn_fld_content_cover_pic'] ) ) {	

											$content_data .= '<tr><td>'.__( 'Cover Art: ', 'plan-my-novel' ).'</td>';
											$content_data .= '<td>';	
											$content_data .= '<img class="img-thumbnail" src="'.$key['_pmn_fld_content_cover_pic'].'"/>';
											$content_data .= '</td></tr>';										
										}

							
					
							if( isset( $key['_pmn_fld_content_structure'] ) )  { 		$content_data .= '<tr><td>'.__( 'Plot Structure : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_structure'].'</td></tr>';	}
							if( isset( $key['_pmn_fld_content_pov'] ) ) 		{ 		$content_data .= '<tr><td>'.__( 'Point of View : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_pov'].'</td></tr>';			}		
							if( isset( $key['_pmn_fld_content_synopsis'] ) ) 	{ 		$content_data .= '<tr><td>'.__( 'Synopsis : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_synopsis'].'</td></tr>';			}
							if( isset( $key['_pmn_fld_content_pitch'] ) ) 		{ 		$content_data .= '<tr><td>'.__( 'Logline : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_pitch'].'</td></tr>';					}	
							if( isset( $key['_pmn_fld_content_setting'] ) ) 	{ 		$content_data .= '<tr><td>'.__( 'Setting : ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_setting'].'</td></tr>';				}									

							
							
						}							
						//------------------------------
							$content_data .= '</tbody>';								
							$content_data .= '</table>';									
							$content_data .= '</div>';									
					
			}	


							
			
			/*--------------------------------------------------------------------------------------------------------------------------------------*/					
			

			$print_content .= ' <div id="pmn-print-container">';
			/*---------------------------------------------------*/		
			$print_content .= '<h1>'.get_the_title( pmn_get_novel_id() ).'</h1>';		
			if ( pmn_get_option ( 'pmn_setting_rpt_include_cover' ) ) { 		$print_content .= wp_kses_post( $rpt_cover_page );	}
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_general' ) ) { 		$print_content .= wp_kses_post( $general_data ); 		}
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_marketing' ) ) {	$print_content .= wp_kses_post( $marketing_data ); 	}
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_budget' ) ) { 		$print_content .= wp_kses_post( $budget_data ); 		}
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_content' ) ) { 		$print_content .= wp_kses_post( $content_data ); 		}
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_outline' ) ) {		$print_content .=  pmn_rpt_outline(); 							}			
			if ( !pmn_get_option ( 'pmn_setting_rpt_hide_general' ) ) {		$print_content .=  pmn_rpt_characters(); 					}										
			/*---------------------------------------------------*/
			//$print_content .=  pmn_plugin_credit();	
			$print_content .= ' </div>'; //<!-- #pmn-print-container -->
			
		
			return $print_content;

			
	} // Close is_admin check
	
}

		
		
/**
 * Display Character reports
 * @return string
 */		

function pmn_get_character_content() {		

			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;		

			$print_content = '';		
			$print_content .= ' <div class="pmn-print-section" id="pmn-print-characters">';	
			$print_content .= '<h1>'.get_the_title( pmn_get_novel_id() ).'</h1>';					
			$print_content .=  pmn_rpt_characters();						
			$print_content .= ' </div>'; 

			return $print_content;			
}		
		

		

/**
 * Display Outline Reports
 * @return string
 */		

function pmn_get_outline_content() {		

			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

			$print_content = '';		
			$print_content .= ' <div class="pmn-print-section" id="pmn-print-outline">';	
			$print_content .= '<h1>'.get_the_title( pmn_get_novel_id() ).'</h1>';
			$print_content .=  pmn_rpt_outline();	
			$print_content .= ' </div>'; 

			return $print_content;			
}	

	


/**
 * Display Summary Report
 * @return string
 */		

function pmn_get_summary_content() {		

			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

			$print_content = '';		
			$print_content .= ' <div class="pmn-print-section" id="pmn-print-summary">';				
			$print_content .= '<h1>'.get_the_title( pmn_get_novel_id() ).'</h1>';
			$print_content .=  pmn_rpt_summary();					
			$print_content .= ' </div>'; 
			

			return $print_content;			
}		
			
		
		
		
/**
 * Data for Outline reports
 * @return string
 */ 
 
 function pmn_rpt_outline() {
	 
	 global $wpdb;
	 
	 if ( is_admin() ) {

	 
			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

			$the_id = pmn_get_novel_id();
			$outline_data = '';
							
		
			/* Get the ID of the outline associated with this novel */
			$meta_key = '_pmn_associate_outline';
			$meta_value = $the_id;
			$outline_id = $wpdb->get_results(
																$wpdb->prepare(

																							"SELECT post_id 
																							 FROM $wpdb->postmeta
																							 WHERE meta_key = %s AND  meta_value = %s LIMIT 1"
																							,$meta_key
																							,$meta_value
																	),ARRAY_A
															);
															
			if ( $outline_id ) {			
			
					$outlines = array_filter( get_post_meta( $outline_id[0]['post_id'], '_pmn_outline_container', true ) ); 		


													
					$outline_data .= '<div class="pmn-print-section">';				
					$outline_data .= '<h2>'.__( 'OUTLINE', 'plan-my-novel' ).'</h2>';						
					$outline_data .= '<table class="table pure-table pure-table-horizontal">
												<thead>
												  <tr>
													<th class="pmn-left-col">'.__( 'SCENE', 'plan-my-novel').'</th>
													<th class="pmn-right-col">'.__( 'CONTENT', 'plan-my-novel').'</th>
												  </tr>
												  </thead>
												  <tbody>
												';	
					
					if ( $outlines ) {
							foreach ( $outlines as $key ) {	
							
									$outline_data .= '<tr class="pmn-add-borders">';
									$outline_data .= ' <td><span class="pmn-item-title">'.$key['_pmn_fld_scene_title'].'</span></td>';
									$outline_data .= ' 	<td>';
									if ( isset($key['_pmn_fld_scene_content'] ) ) { $outline_data .= '<p> '.$key['_pmn_fld_scene_content'].'</p>'; }
									if( pmn_get_option( 'pmn_setting_display_conflict' ) AND isset( $key['_pmn_fld_scene_conflict'] ) ) { 			$outline_data .= '<h4>'.__( 'Scene Conflict: ', 'plan-my-novel' ).'</h4> <p>'.$key['_pmn_fld_scene_conflict'].'</p>';	}		
									if( pmn_get_option( 'pmn_setting_display_why' ) AND isset( $key['_pmn_fld_scene_why'] ) ) { 				$outline_data .= '<h4>'.__( 'Scene Justification: ', 'plan-my-novel' ).'</h4><p> '.$key['_pmn_fld_scene_why'].'</p>';	}										
									if ( pmn_get_option( 'pmn_setting_include_notes' ) AND isset( $key['_pmn_fld_scene_notes'] )) {  $outline_data .= '<h4>'.__( 'Author Notes: ', 'plan-my-novel' ).'</h4><p> '.$key['_pmn_fld_scene_notes'].'</p>';	}														
									$outline_data .=	'</td>';
									$outline_data .= '</tr>';
							}
					}
					
					
								$outline_data .= '</tbody>';
								$outline_data .= '</table>';									
								$outline_data .= '</div>';								
									
			
			}	
			
		$sanitized_outline_data = wp_kses_post( $outline_data );			
		 
		return $sanitized_outline_data;
	
	 } 
	 
 }
 
 
 
 
 /**
 * Data for Character reports
 * @return string
 */ 
 
 function pmn_rpt_characters() {
	 
	 global $wpdb;
	 
	 if ( is_admin() ) {
		 
		 	 
			if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
			return;

			$the_id = pmn_get_novel_id();
			$character_data = '';		
			$character_pics = '';	
																	
			/* Get the ID of the character set associated with this novel */
			$meta_key = '_pmn_associate_characters';
			$meta_value = $the_id;
			$character_id = $wpdb->get_results(
																$wpdb->prepare(

																							"SELECT post_id 
																							 FROM $wpdb->postmeta
																							 WHERE meta_key = %s AND  meta_value = %s LIMIT 1"
																							,$meta_key
																							,$meta_value
																	),ARRAY_A
															);																																
																	
																	
					if ( $character_id ) { 	
					
							$characters = get_post_meta( $character_id[0]['post_id'], '_pmn_character_container', true ); 											

							if ( $characters ) {
								

								$character_data .= '<div class="pmn-print-section">';
								$character_data .= '<h2>'.__( 'CHARACTERS', 'plan-my-novel' ).'</h2>';						
								$character_data .= '<table class="table pure-table pure-table-horizontal">
															<thead>
															  <tr>
															<th class="pmn-left-col">'.__( 'CHARACTER', 'plan-my-novel').'</th>
															<th class="pmn-right-col">'.__( 'DETAILS', 'plan-my-novel').'</th>
															  </tr>
															  </thead>
															  <tbody>
															';	
								

									foreach ( $characters as $key ) {	
									
									
											$character_data .= ' <tr class="pmn-add-borders">';									
											if ( isset( $key['_pmn_fld_character_title'] ) ) { $character_data .= ' 	<td><p><span class="pmn-item-title"> '.$key['_pmn_fld_character_title'].'</span></p>';	}
											/*-------------------------------------------------------------------------------------*/											

											if ( isset( $key['_pmn_fld_character_pics'] ) ) { $character_data .= '<img class="pmn-character-pic" src="'.$key['_pmn_fld_character_pics'].'"/>'; }
										
											/*-------------------------------------------------------------------------------------*/
											if ( isset( $key['_pmn_fld_protagonist_flag'] ) ) {
												$character_data .= '<p><span class="pmn-protag-marker">'.__( 'Main Character', 'plan-my-novel' ).'</span></p>'; 																	
											}
											/*-------------------------------------------------------------------------------------*/																						
											$character_data .= '</td>';
											if ( isset($key['_pmn_fld_character_description'] ) ) { $character_data .= ' <td><p>'.$key['_pmn_fld_character_description'].'</p>'; }
																			
											if ( pmn_get_option( 'pmn_setting_display_backstory' ) AND isset( $key['_pmn_fld_character_backstory'] ) ) {	
												$character_data .= '<p>&nbsp;</p><p>'.$key['_pmn_fld_character_backstory'].'</p>';													
											}																			
																		
											$character_data .= '</td>';																			
											$character_data .= ' </tr>';												
					
									}		

								$character_data .= '</tbody>';										
								$character_data .= '</table>';									
								$character_data .= '</div>';								
									
							}
					 } 

					
			$sanitized_character_data = wp_kses_post( $character_data );			
			 
			return $sanitized_character_data;
					
	
	 } // Close is_admin check
	 
 }
		
		
		
		
 
 /**
  * Data for Summary Report
  * @return string
  */ 
 
 function pmn_rpt_summary() {	 
	 
	 if ( is_admin() ) {		
	 
	 
					if( 'pmn_novel' != get_post_type( pmn_get_novel_id() ) )
					return;
		
			
					$print_content = '';
					$the_id = pmn_get_novel_id();

					
					$print_content .= '<div class="pmn-print-section">';
					$print_content .= '<h2>'.__( 'SUMMARY OVERVIEW', 'plan-my-novel' ).'</h2>';						
					$print_content .= '<table class="table pure-table pure-table-horizontal">
												<thead>
												  <tr>
												<th class="pmn-left-col"></th>
												<th class="pmn-right-col"></th>
												  </tr>
												  </thead>
												  <tbody>
												';
															
					
					$general_meta = get_post_meta( $the_id, '_pmn_tab_general', true );  	
					
					if ( $general_meta ) {	 
	 

	 								foreach ( $general_meta as $key   ){
																													
													if( isset( $key['_pmn_fld_general_author_2'] )  ) 	{ $coauthor = 'and '.$key['_pmn_fld_general_author_2'] ;  }  else { $coauthor = ''; }
													if ( isset( $key['_pmn_fld_general_author'] ) ) 		{ $print_content .= '<tr><td>'.__( 'Written By: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_author'].' '.$coauthor.'</td></tr>'; 	}			
													if ( isset( $key['_pmn_fld_general_genre'] ) ) 		{ $print_content .= '<tr><td>'.__( 'Primary Genre: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_genre'].'</td></tr>'; 	}													
													if ( isset( $key['_pmn_fld_general_subgenre']  ) ) 	{ $print_content .= '<tr><td>'.__( 'Subgenre: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_general_subgenre'].'</td></tr>';	  }

									}
					}
	 

	 
					$content_meta = get_post_meta( $the_id, '_pmn_tab_content', true );  	

					if ( $content_meta ) {
						
						foreach ( $content_meta as $key  ){ 
						
													if ( isset( $key['_pmn_fld_content_synopsis'] ) ) { $print_content .= '<tr><td>'.__( 'Synopsis: ', 'plan-my-novel' ).'</td><td>'.$key['_pmn_fld_content_synopsis'].'</td></tr>'; 	}	
							}
					}	 
	 
	 
								$print_content .= '</tbody>';										
								$print_content .= '</table>';									
								$print_content.= '</div>';		 
	 
	 
				$sanitized_summary_data = wp_kses_post( $print_content );			
				 
				return $sanitized_summary_data;	 
	 
		}
 }