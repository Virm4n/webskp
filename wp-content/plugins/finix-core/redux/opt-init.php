<?php
/**
 * Redux_Framework_Plugin main class
 *
 * @package Finix Core
 * @since 1.1.0
 */

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}
// This is your option name where all the Redux data is stored.
$opt_name;
$opt_name = "finix_redux";

$theme = wp_get_theme(); // For use with some settings. Not necessary.
$url = get_template_directory_uri();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__( 'Finix Options', 'finix' ),
    'page_title'           => esc_html__( 'Finix Options', 'finix' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);


Redux::setArgs( $opt_name, $args );

// General Option
require_once(FINIX_THEME_ROOT . 'redux/option-general.php');
// Body-backgrond Option
require_once(FINIX_THEME_ROOT . 'redux/option-body-backgrond.php');
// Loader Option
require_once(FINIX_THEME_ROOT . 'redux/option-loader.php');
// Logo Option
require_once(FINIX_THEME_ROOT . 'redux/option-logo.php');
// Header Option
require_once(FINIX_THEME_ROOT . 'redux/option-header.php');
// Page Header Option
require_once(FINIX_THEME_ROOT . 'redux/option-page-header.php');
// Footer Option
require_once(FINIX_THEME_ROOT . 'redux/option-footer.php');
// Blog Option
require_once(FINIX_THEME_ROOT . 'redux/option-blog.php');
// Shop Option
require_once(FINIX_THEME_ROOT . 'redux/option-shop.php');
// Page Option
require_once(FINIX_THEME_ROOT . 'redux/option-page.php');
// Search Page Option
require_once(FINIX_THEME_ROOT . 'redux/option-search.php');
// Color Option
require_once(FINIX_THEME_ROOT . 'redux/option-color.php');
// Site-info Option
require_once(FINIX_THEME_ROOT . 'redux/option-site-info.php');
// Social-Media Option
require_once(FINIX_THEME_ROOT . 'redux/option-social-media.php');
// Typography Option
require_once(FINIX_THEME_ROOT . 'redux/option-typography.php');
// Mailchimp
require_once(FINIX_THEME_ROOT . 'redux/option-mailchimp.php');
// 404 Option
require_once(FINIX_THEME_ROOT . 'redux/option-404.php');
// Maintenance
require_once(FINIX_THEME_ROOT . 'redux/option-maintenance.php');
// Custom CSS/JS Option
require_once(FINIX_THEME_ROOT . 'redux/option-custom-css-js.php');