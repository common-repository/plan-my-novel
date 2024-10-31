<?php

/* Prevent direct access outside of WordPress */
function_exists( 'add_action' ) OR exit;



/**
 * Plan My Novel Settings
 * @version 1.0.1
 */
class PlanMyNovel_Admin {
	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'pmn_options';
	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'pmn_option_metabox';
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';
	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';
	/**
	 * Holds an instance of the object
	 *
	 * @var Catoprefix_Admin
	 **/
	private static $instance = null;
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	private function __construct() {
		// Set our title
		$this->title = __( 'Plan My Novel Settings', 'plan-my-novel' );
	}
	/**
	 * Returns the running object
	 *
	 * @return Catoprefix_Admin
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}
	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		add_action( 'cmb2_admin_init', array( $this, 'pmn_settings_assets' ) );		
	}
	
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}
	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		
		$this->submenu_page = add_submenu_page(
																				'edit.php?post_type=pmn_novel',
																				$this->title, /*page title*/
																				__( 'Settings', 'plan-my-novel' ), 
																				'manage_options', 
																				$this->key,
																				array( $this, 'admin_page_display' )  
																				
		);
		
		
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css'  ) );
		add_action( "admin_print_styles-{$this->submenu_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
		
	}
	
	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		</div>
		
		<div class="wrap">

						<div id="poststuff">

							<div id="post-body" class="metabox-holder columns-2">

								<!-- main content -->
								<div id="post-body-content">

									<div class="meta-box-sortables ui-sortable">

										<div class="postbox">

											<div class="handlediv" title="Click to toggle"><br></div>
											<!-- Toggle -->

											<h2 class="hndle"><span><?php esc_attr_e( 'Settings', 'plan-my-novel' ); ?></span>
											</h2>

											
											<div class="inside">
												<p><?php echo sprintf( __( 'Click any section below to access its settings. These settings apply to %sall novels%s.','plan-my-novel' ), '<a href="'.admin_url("edit.php?post_type=pmn_novel").'">' ,'</a>' ); ?></p> 
												<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>						
											</div>
											
											
										</div>
										<!-- .postbox -->

									</div>
									<!-- .meta-box-sortables .ui-sortable -->

								</div>
								<!-- post-body-content -->

								<!-- sidebar -->
								<div id="postbox-container-1" class="postbox-container">

									<div class="meta-box-sortables">

										<div class="postbox">

											<div class="handlediv" title="Click to toggle"><br></div>
											<!-- Toggle -->

											<h2 class="hndle"><span><?php esc_attr_e(
														'Plugin Info', 'plan-my-novel'
													); ?></span></h2>

											<div class="inside">
											<?php echo pmn_side_content(); ?> 
											</div>
											<!-- .inside -->

										</div>
										<!-- .postbox -->

									</div>
									<!-- .meta-box-sortables -->

								</div>
								<!-- #postbox-container-1 .postbox-container -->

							</div>
							<!-- #post-body .metabox-holder .columns-2 -->

							<br class="clear">
						</div>
						<!-- #poststuff -->

			</div> <!-- .wrap -->
		
		
		<?php
	}
	
	
		
		public function pmn_settings_assets() {
			
			if ( isset( $_GET['page'] ) &&  'pmn_options'==$_GET['page'] ) {
									
			    wp_enqueue_style( 'pmn-plugin', PMN_URL . 'css/pmn-admin.css', array(), PMN_VERSION );			
				wp_enqueue_script( 'pmn-scripts', PMN_URL . 'js/pmn-settings.js', array( 'jquery' ), null, true ); 				
				
			}
			
		}
		
		
	
	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	public function add_options_page_metabox() {
		

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );
		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => true,
			'cmb_styles' => true,

			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		
		
		
		/* GENERAL PLUGIN SETTINGS
		------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/		
		$cmb->add_field( array(
	//	'name' => '',
	//	'desc' => '',
		'id'   => 'pmn_setting_subtitle_general',
		'type' => 'title',
		'before_row' =>  '<div id="pmn-plugin-settings"><p class="pmn-group-title accordion-toggle">'.__( 'General Plugin Settings', 'plan-my-novel' ).'<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">' ,		 	
		) );	
		
		
		$cmb->add_field( array(
		'name' => __( 'Date Format', 'plan-my-novel' ),
		'desc' => __( 'Enter your preferred date format. Note: Only affects reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_date_format',
		'type' => 'select',
		'default' => 'm-d-Y',		
		'options'          => array(
										'm-d-Y' => 'MM-DD-YYYY',
										'd-m-Y'   => 'DD-MM-YYYY',
										'Y-m-d'     => 'YYYY-MM-DD',
									),

		) );		
		
		
		$cmb->add_field( array(
		'name' => __( 'Currency Symbol', 'plan-my-novel' ),
		'desc' =>'<br>'.__( 'Enter your preferred currency symbol', 'plan-my-novel' ),
		'id'   => 'pmn_setting_currency',
		'type' => 'text_small',
		'default' => '$',		
		'after_row' => '</div>',		// Last row, close accordion			
		) );
		


		
		/* REPORT SETTINGS
		------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/			
		
		$cmb->add_field( array(
		'name' => '',
		'desc' => '',
		'id'   => 'pmn_setting_subtitle_reports',
		'type' => 'title',
		'before_row' =>  '<p class="pmn-group-title accordion-toggle">'.__( 'Report Settings', 'plan-my-novel' ).'<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">' ,		 	
		) );			

		
		$cmb->add_field( array(
		'name' => __( 'Hide Plugin Credit?', 'plan-my-novel' ),
		'desc' => __( 'Check to hide the plugin credit at the end of reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_display_credit',
		'type' => 'checkbox',	
		) );		
		
		$cmb->add_field( array(
		'name' => __( 'Include cover page?', 'plan-my-novel' ),
		'desc' => __( 'Check to include a cover page in the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_include_cover',
		'type' => 'checkbox',
		) );

		$cmb->add_field( array(
		'name' => __( 'Hide General Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the General section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_general',
		'type' => 'checkbox',
		) );		
		
		$cmb->add_field( array(
		'name' => __( 'Hide Marketing Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the Marketing section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_marketing',
		'type' => 'checkbox',
		) );				
		
		$cmb->add_field( array(
		'name' => __( 'Hide Budget Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the Budget section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_budget',
		'type' => 'checkbox',
		) );				
		
		$cmb->add_field( array(
		'name' => __( 'Hide Content Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the Content section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_content',
		'type' => 'checkbox',
		) );	

		$cmb->add_field( array(
		'name' => __( 'Hide Outline Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the Outline section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_outline',
		'type' => 'checkbox',
		) );			

		$cmb->add_field( array(
		'name' => __( 'Hide Character Section?', 'plan-my-novel' ),
		'desc' => __( 'Check to remove the Character section from the full report.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_rpt_hide_character',
		'type' => 'checkbox',
		'after_row' => '</div>',		// Last row, close accordion			
		) );	
		
		
		
		/* OUTLINE SETTINGS
		------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/			
		
		$cmb->add_field( array(
		'name' => '',
		'desc' => '',
		'id'   => 'pmn_setting_subtitle_outline',
		'type' => 'title',
		'before_row' =>  '<p class="pmn-group-title accordion-toggle">'.__( 'Outline Settings', 'plan-my-novel' ).'<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">' ,		 	
		) );			

		
		$cmb->add_field( array(
		'name' => __( 'Include author notes?', 'plan-my-novel' ),
		'desc' => __( 'Check to include author notes in reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_include_notes',
		'type' => 'checkbox',
		) );
		
		$cmb->add_field( array(
		'name' => __( 'Include Scene Conflict?', 'plan-my-novel' ),
		'desc' => __( 'Check to include a scene conflict option in every scene.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_include_conflict',
		'type' => 'checkbox',
		) );		
		
		
		$cmb->add_field( array(
		'name' => __( 'Display Conflict?', 'plan-my-novel' ),
		'desc' => __( 'Check to display the scene conflict in reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_display_conflict',
		'type' => 'checkbox',
		) );
		
		
		$cmb->add_field( array(
		'name' => __( 'Include Scene Justification?', 'plan-my-novel' ),
		'desc' => __( 'Check to include an option to justify every scene.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_include_why',
		'type' => 'checkbox',
		) );			
		
		
		$cmb->add_field( array(
		'name' => __( 'Display Justification?', 'plan-my-novel' ),
		'desc' => __( 'Check to display the scene justification in reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_display_why',
		'type' => 'checkbox',
		) );
		

		$cmb->add_field( array(
		'name' => __( 'Act Indicator', 'plan-my-novel' ),
		'desc' => sprintf( __( 'Check to include an Act selector in every scene. %s The three choices are: Act I, Act II, Act III.', 'plan-my-novel' ), '<br>'),
		'id'   => 'pmn_setting_include_act',
		'type' => 'checkbox',
		'after_row' => '</div>',		// Last row, close accordion			
		) );

		

		/* CHARACTER SETTINGS
		------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/			
		
		$cmb->add_field( array(
		'name' => '',
		'desc' => '',
		'id'   => 'pmn_setting_subtitle_character',
		'type' => 'title',
		'before_row' =>  '<p class="pmn-group-title accordion-toggle">'.__( 'Character Settings', 'plan-my-novel' ).'<span class="dashicons dashicons-arrow-down"></span><span class="dashicons dashicons-arrow-up"></p><div class="accordion-content">' ,		 	
		) );		
		

		$cmb->add_field( array(
		'name' => __( 'Include Character Photos?', 'plan-my-novel' ),
		'desc' => __( 'Check to include character photos in printed reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_include_char_pic',
		'type' => 'checkbox',
		) );		
		
		$cmb->add_field( array(
		'name' => __( 'Include Backstory?', 'plan-my-novel' ),
		'desc' => __( 'Check to include a Backstory option for every character.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_include_backstory',
		'type' => 'checkbox',
                                                                                      
		) );		
		
		
		$cmb->add_field( array(
		'name' => __( 'Display Backstory?', 'plan-my-novel' ),
		'desc' => __( 'Check to display character backstories in reports.', 'plan-my-novel' ),
		'id'   => 'pmn_setting_display_backstory',
		'type' => 'checkbox',
		'after_row' => '</div>
							  </div>
							  <p>&nbsp;</p>	
							  ',                                                                                                 //-----------> Close entire #pmn-plugin-settings
		) );			
		
		
	}
	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}
		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'myprefix' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}
	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		throw new Exception( 'Invalid property: ' . $field );
	}
}
/**
 * Helper function to get/return the Catoprefix_Admin object
 * @since  0.1.0
 * @return Catoprefix_Admin object
 */
function pmn_admin() {
	return PlanMyNovel_Admin::get_instance();
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function pmn_get_option( $key = '' ) {
	return cmb2_get_option( pmn_admin()->key, $key );
}
// Get it started
pmn_admin();