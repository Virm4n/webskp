<?php
/**
 * Plugin Name: BeCustom
 * Plugin URI: https://muffingroup.com/betheme/features/be-custom/
 * Description: Rebrand Be & WordPress Admin And Take Your Business To The Next Level. Be like PRO!
 * Version: 1.0.2
 * Author: Muffin Group
 * Author URI: https://muffingroup.com
 */

class Be_custom {

  public $becustom_subpages = array('branding', 'built_in_features', 'wp_login', 'be_dashboard', 'advanced'); //always must be in proper setup, LTR in tabs
  public $betheme_fields;

  /* Subpages above fields used */
  public $branding = array(
      'betheme_label' => array(
        'type' => 'text',
        'filter_name' => 'betheme_label',
        'title' => 'Default BeTheme text',
        'value' => '',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option changes default <strong>Betheme</strong> text located in main WP dashboard and just after the Welcome text in <i>Betheme > Dashboard</i> section.',
        )
      ),
      'replaced_logo_url' => array(
        'type' => 'upload',
        'filter_name' => 'betheme_logo',
        'title' => 'Betheme & Muffin group logo',
        'value' => '',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option changes any Betheme & Muffin group logo (some located in <i>Betheme > Dashboard</i> section, other in Muffin Builder.)',
        )
      ),
      'replaced_theme_image' => array(
        'type' => 'upload',
        'filter_name' => 'betheme_image',
        'title' => 'Default Betheme theme image',
        'value' => '',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option replaces default Betheme image in <i>Appearance > Themes</i> section.',
        )
      ),
      'replaced_theme_desc' => array(
        'type' => 'text',
        'filter_name' => 'betheme_desc',
        'title' => 'Theme description WP',
        'value' => '',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option replaces default Betheme description in <i>Appearance > Themes</i> section.',
        )
      ),
      'replaced_theme_author' => array(
        'type' => 'text',
        'filter_name' => 'betheme_author',
        'title' => 'Default Betheme author',
        'value' => 'Muffin Group',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option replaces default Betheme author in <i>Appearance > Themes</i> section.',
        )
      ),
      'betheme_url_slug' => array(
        'type' => 'text',
        'filter_name' => 'betheme_slug',
        'title' => 'be friendly URL',
        'value' => '',
        'popup_content' => array(
          'image' => '',
          'text' => 'This option replaces each occurance of default <b>be</b> in URL.',
        )
        ),

      //FIELDS WHERE USERS CANNOT CHANGE ANYTHING
      'betheme_dynamic_slug' => array(
        'type' => 'text',
        'filter_name' => 'betheme_dynamic_slug',
      ),
      'betheme_input_options' => array( //theme options input value
        'type' => 'text',
        'filter_name' => 'betheme_options_filed_options',
      ),
      'betheme_input_title' => array( //theme options title value
        'type' => 'text',
        'filter_name' => 'betheme_options_filed_title',
      ),
      'betheme_input_desc' => array( //theme options desc value
        'type' => 'text',
        'filter_name' => 'betheme_options_filed_desc',
      ),
      'betheme_replaced_logo_nohtml' => array(
        'type' => 'upload',
        'filter_name' => 'betheme_logo_nohtml',
      ),
  );

  public $built_in_features = array(
    'disable_theme_version' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_theme_version',
      'title' => 'Theme version',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes theme version visible or hidden in <i>Betheme > Theme Options</i>.',
      )
    ),
    'disable_support_link' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_support',
      'title' => 'Manual & Support tab',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes Betheme <b>Manual & Support</b> tab visible or hidden in <i>Betheme > Dashboard</i>.',
      )
    ),
    'disable_changelog_link' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_changelog',
      'title' => 'Changelog tab',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes Betheme <b>Changelog</b> tab visible or hidden in <i>Betheme > Dashboard</i>.',
      )
    ),
    'disable_theme_update' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_theme_update',
      'title' => 'Theme Update',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option disable/enable <b>Betheme Update</b> button in <i>Betheme > Dashboard</i>.',
      )
    ),
    'disable_advanced_tab' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_advanced',
      'title' => 'Advanced tab',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes <b>Advanced</b> tab visible or hidden in <i>Betheme > Theme Options</i>.',
      )
    ),
    'disable_hooks_tab' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_hooks',
      'title' => 'Hooks tab',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes <b>Hooks</b> tab visible or hidden in <i>Betheme > Theme Options</i>.',
      )
    ),
    'disable_footer_copy' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_footer',
      'title' => 'Footer copyright',
      'value' => false,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option makes <b>Footer copyright</b> visible or hidden in front-end.',
      )
    ),
  );

  public $wp_login = array(
    'enable_custom_login' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_disable_custom_login',
      'title' => 'Enable the custom WP-Login page',
      'value' => false
    ),
    'custom_wplogin_logo' => array(
      'type' => 'upload',
      'filter_name' => 'betheme_wplogin_logo',
      'title' => 'Custom WP-Login logo',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'this option replaces default WP logo on WP-Login page with your own.',
      )
    ),
    'custom_background_color' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_bg_color',
      'title' => 'WP-Login page background color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default background color on WP-Login page.',
      )
    ),
    'custom_font_color' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_font_color',
      'title' => 'WP-Login page font color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default font color on WP-Login page for texts like <i>Lost your password?</i> or <i><- Go to XYZ</i>.',
      )
    ),
    'custom_background_image' => array(
      'type' => 'upload',
      'filter_name' => 'betheme_wplogin_bg_image',
      'title' => 'WP-Login page background image',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default background color on WP-Login page with custom background image.',
      )
    ),
    'custom_background_size' => array(
      'type' => 'select',
      'filter_name' => 'betheme_wplogin_bg_size',
      'title' => 'WP-Login page background image size',
      'value' => 'Auto',
      'popup_content' => array(
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Example_image.png',
        'text' => 'Oh boy',
      )
    ),
    'custom_background_position' => array(
      'type' => 'select',
      'filter_name' => 'betheme_wplogin_bg_position',
      'title' => 'WP-Login page background image position',
      'value' => 'no-repeat;left top;;',
      'popup_content' => array(
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Example_image.png',
        'text' => 'Oh boy',
      )
    ),
    'custom_login_container_position' => array(
      'type' => 'select',
      'filter_name' => 'betheme_wplogin_container_position',
      'title' => 'WP-Login Container position',
      'value' => 'unset',
      'std' => 'unset',
      'popup_content' => array(
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Example_image.png',
        'text' => 'Oh boy',
      )
    ),
    'custom_login_container_background' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_container_bg',
      'title' => 'WP-Login container background color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default background color on WP-Login page container with custom background color.',
      )
    ),
    'custom_login_container_font_color' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_container_font_color',
      'title' => 'WP-Login container font color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default font color inside container on WP-Login page.',
      )
    ),
    'custom_login_container_input_background' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_container_input_bg',
      'title' => 'WP-Login container input background color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default input background color inside container on WP-Login page.',
      )
    ),
    'custom_login_container_input_font_color' => array(
      'type' => 'text',
      'filter_name' => 'betheme_wplogin_container_input_color',
      'title' => 'WP-Login container input font color',
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces default input font color inside container on WP-Login page.',
      )
    ),
    'enable_forgot_password' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_wplogin_enable_forgot_password',
      'title' => 'Forgot Password',
      'value' => true,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option enable/disable <b>Forgot Password</b> feature located under container on WP-Login page.',
      )
    ),
    'enable_goto_link' => array(
      'type' => 'switch',
      'filter_name' => 'betheme_wplogin_enable_gotolink',
      'title' => '"Go TO XYZ"',
      'value' => true,
      'popup_content' => array(
        'image' => '',
        'text' => 'This option enable/disable <b>Go to XYZ</b> feature located under container on WP-Login page.',
      )
    ),
  );

  public $be_dashboard = array(
    'content' => array(
      'type'  => 'text',
      'filter_name' => 'betheme_dashboard_content',
      'title' => "Change content in <i>Welcome</i> tab.",
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces content located in <i>Welcome</i> tab in <i>Betheme > Dashboard</i>.',
      )
    ),
    'below_welcome_text' => array(
      'type'  => 'text',
      'filter_name' => 'betheme_dashboard_below_welcome',
      'title' => "Change text below the <i>Welcome to Betheme</i>",
      'value' => '',
      'popup_content' => array(
        'image' => '',
        'text' => 'This option replaces content just underneath <i>Welcome to Betheme</i>.',
      )
    )
  );

  public $advanced = array(

  );

  /**
   * Register the templates, required to tabs work
   */

  public function get_template() {
    include_once( plugin_dir_path( __DIR__ ) . 'becustom/templates/general.php' );
  }

  public function load_subpages() {
    if( defined('MFN_THEME_VERSION') ){
      foreach($this->becustom_subpages as $page){
        include_once( plugin_dir_path( __DIR__ ) . 'becustom/becustom_'.$page.'.php');

        //to clear all records
        //delete_option('be_custom_'.$page);
      }
    }
  }

  public function add_menu() {
    $default_theme_slug = 'be';
    $default_theme_label = 'betheme';

    $this->page = add_submenu_page(
        apply_filters('betheme_dynamic_slug', 'betheme'),
        __( 'BeCustom', 'mfn-translate' ),
        'BeCustom',
        'edit_theme_options',
        'be_custom',
        array( $this, 'get_template')
    );

    add_action('admin_print_scripts-'. $this->page, array( $this, 'becustom_mfn_essentials'));
    add_action('admin_print_styles-'. $this->page, array( $this, 'enqueue' ));
  }


  /**
   * Register or display tables
   * It will iterate and check the form values and names
   */
  public function iterate_merge_array(string $page_name) {
    $user_settings = get_option( 'be_custom_'.$page_name );

    $db_schema = $this->$page_name;
    $merge_first_dimension = shortcode_atts( $db_schema, $user_settings);

    $merged_array = array();

    foreach($db_schema as $tableName => $tableValue){
      $merged_array[$tableName] = shortcode_atts($db_schema[$tableName], $merge_first_dimension[$tableName]);
    }

    return $merged_array;
  }

  /*
    Provide popup html
  */

  public function popup($attribute_name){
    $roll_uid = uniqid();

    return '<a href="#popup-'. $roll_uid .'" class="popup-link mfn-option-btn"><span class="mfn-icon mfn-icon-information"></span></a>
      <div id="popup-'. $roll_uid .'" class="popup-content">
        <div class="popup-inner" style="padding:10px;">
          <div class="becustom-popup-image">
            <img src="'. $this->get_attributes[$attribute_name]['popup_content']['image'] .'" />
          </div>
          <div class="becustom-popup-text">
            '. $this->get_attributes[$attribute_name]['popup_content']['text'] .'
          </div>
        </div>
      </div>';
  }

  /*
    Pass values straight from the array
  */

  public function get_page_attributes($page_name){
    return $this->$page_name;
  }

  /**
   * Enqueue styles and scripts
  */

	public function enqueue()
	{
		wp_register_script('be_custom_js', '/wp-content/plugins/becustom/assets/script.js', array('jquery'), '', true);
    wp_register_style('be_custom_css', '/wp-content/plugins/becustom/assets/style.css');

    wp_enqueue_script('be_custom_js');
    wp_enqueue_style('be_custom_css');
	}


  /**
   * BeTheme fields + CSS/JS files
  */

  public function becustom_mfn_essentials() {
    //do not load, when the theme is not betheme!
    if( defined('MFN_THEME_VERSION') ){
      require_once(get_template_directory().'/functions/builder/class-mfn-builder-admin.php');

      wp_register_script('be_custom_mfn_js', get_theme_file_uri('/muffin-options/js/options.js'), array('jquery'), time(), true);
      wp_register_style('be_custom_mfn_css', get_theme_file_uri('/muffin-options/css/options.css'), false, time(), 'all');

      wp_enqueue_script('be_custom_mfn_js');
      wp_enqueue_style('be_custom_mfn_css');
    }
  }

  /**
   *	Registration | Is hosted
  */

  function mfn_is_hosted()
  {
    return defined( 'ENVATO_HOSTED_KEY' ) ? true : false;
  }

  /**
   *	Registration | Is registered
  */

  function mfn_is_registered()
  {
    if ( $this->mfn_is_hosted() ) {
      return $this->mfn_is_hosted();
    }

    if ( $this->mfn_get_purchase_code() ) {
      return strlen( $this->mfn_get_purchase_code() );
    }

    return false;
  }

  /**
   *	Registration | Get purchase code
  */

  function mfn_get_purchase_code()
  {
    if ( $this->mfn_is_hosted() ) {
      return SUBSCRIPTION_CODE;
    }

    $code = get_site_option( 'envato_purchase_code_7758048' );

    if( ! $code ){
      // BeTheme < 21.0.8 backward compatibility
      $code = get_site_option( 'betheme_purchase_code' );
      if( $code ){
        update_site_option( 'envato_purchase_code_7758048', $code );
        delete_site_option( 'betheme_purchase_code' );
        delete_site_option( 'betheme_registered' );
      }
    }

    return $code;
  }

  /*
    This function is used only when theme is not
    registered, to check, if label is changed (proper redirect after registering)
  */
  public function becustom_check_without_register(string $default){
    $theme_slug = $this->iterate_merge_array( 'branding' )['betheme_url_slug']['value'];

    if(($theme_slug)){
      $default = preg_replace('/betheme/', $theme_slug, $default);
    }

    return $default;
  }

  public function __construct() {
    if( $this->mfn_is_registered() ) {
      //menu & subpages
      add_action( 'admin_menu', array( $this, 'add_menu'), 20);
      add_action( 'load_textdomain', array( $this, 'load_subpages' ), 1 );
    }else{
      add_filter( 'becustom_check_without_register',  array( $this, 'becustom_check_without_register' ), 1, 3);
    }
  }
}

new Be_custom();
