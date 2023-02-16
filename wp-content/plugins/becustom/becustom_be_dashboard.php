<?php
class Be_custom_be_dashboard extends Be_custom {
  const page_name = 'be_dashboard';

  public $options = array();

  public function get_template() {
    include_once( plugin_dir_path( __DIR__ ) . 'becustom/templates/'.self::page_name.'.php' );
  }

  public function add_menu() {
    $this->page = add_submenu_page(
      'be_custom',
      null,
      null,
      'manage_options',
      'be_custom_'.self::page_name,
      array( $this, 'get_template')
  );

    add_action('admin_print_styles-'. $this->page, array( $this, 'enqueue' ));
    remove_submenu_page('be_custom', 'be_custom_'.self::page_name);
  }

  public function form_handler() {
    $actual_user_schema = $this->options;

    if(!empty($_POST)) {
      foreach($_POST as $key => $value) {
        $actual_user_schema[$key]['value'] = $value;

        /*
        Workaround for tinymce editor
        It does not include the content while using variables :(
        */
        if(isset($_POST['becustom_tinymce_below_welcome'])){
          $actual_user_schema['below_welcome_text']['value'] = $_POST['becustom_tinymce_below_welcome'];
        }
        if(isset($_POST['becustom_tinymce_content'])){
          $actual_user_schema['content']['value'] = $_POST['becustom_tinymce_content'];
        }
      }

      update_option( 'be_custom_'.self::page_name, $actual_user_schema);

      //reload, display new, insertecd values in inputs
      $this->options = $this->iterate_merge_array(self::page_name);
    } else{
      //
    }
  }


  /*
  * Creating filters for branding
  */

  public function create_filters_loop() {
    foreach($this->options as $field){
      add_filter($field['filter_name'], array($this, 'create_filter_'.$field['filter_name']) );
    }
  }

  public function create_filter_betheme_dashboard_content($default) {
    $new_value = $this->options['content']['value'];

    if($new_value){
      $default = $new_value;
    }

    return $default;
  }

  public function create_filter_betheme_dashboard_below_welcome($default) {
    $new_value = $this->options['below_welcome_text']['value'];

    if($new_value){
      $default = $new_value;
    }

    return $default;
  }

  public function __construct() {
    parent::__construct();

    $this->be_dashboard['below_welcome_text']['popup_content']['image'] = plugin_dir_url( __FILE__ ).'assets/images/welcome-text-dashboard.png';
    $this->be_dashboard['content']['popup_content']['image'] = plugin_dir_url( __FILE__ ).'assets/images/welcometab-text-dashboard.png';

    add_action( 'admin_menu', array( $this, 'add_menu'));

    //values, iterated to check if there is no new attributes
    //some of them, are cached in database
    $this->options = $this->iterate_merge_array(self::page_name);

    //values straight from the php schema
    $this->get_attributes = $this->get_page_attributes(self::page_name);

    //filters
    if(!WHITE_LABEL){
      add_action( 'admin_menu', array($this, 'create_filters_loop'));
    }
  }
}

new Be_custom_be_dashboard();
