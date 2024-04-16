<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */
define( 'BEGIN_THEME_DIR', get_template_directory() );
define( 'BEGIN_THEME_URI', get_template_directory_uri() );
define( 'BEGIN_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'BEGIN_THEME_NAME', $themeData->get('Name'));
	define( 'BEGIN_THEME_VERSION', $themeData->get('Version'));
endif;

/* ---------------------------------------------------------------------------
 * Loads Kirki
 * ---------------------------------------------------------------------------*/
require_once( BEGIN_THEME_DIR .'/kirki/index.php' );

/* ---------------------------------------------------------------------------
 * Loads Codestar
 * ---------------------------------------------------------------------------*/
require_once BEGIN_THEME_DIR .'/cs-framework/cs-framework.php';

if( !defined( 'CS_ACTIVE_TAXONOMY' ) ) { define( 'CS_ACTIVE_TAXONOMY',   false ); }
define( 'CS_ACTIVE_SHORTCODE',  false );
define( 'CS_ACTIVE_CUSTOMIZE',  false );

/* ---------------------------------------------------------------------------
 * Create function to get theme options
 * --------------------------------------------------------------------------- */
function begin_cs_get_option($key, $value = '') {

	$v = cs_get_option( $key );

	if ( !empty( $v ) ) {
		return $v;
	} else {
		return $value;
	}
}

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * ---------------------------------------------------------------------------*/ 
define( 'BEGIN_LANG_DIR', BEGIN_THEME_DIR. '/languages' );
load_theme_textdomain( 'begin', BEGIN_LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads the Admin Panel Style
 * ---------------------------------------------------------------------------*/
function begin_admin_scripts() {
	wp_enqueue_style('begin-admin', BEGIN_THEME_URI .'/cs-framework-override/style.css');
}
add_action( 'admin_enqueue_scripts', 'begin_admin_scripts' );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * ---------------------------------------------------------------------------*/

// Functions --------------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-functions.php' );
require_once( BEGIN_THEME_DIR .'/framework/utils.php' );

// Header -----------------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-head.php' );

// Menu -------------------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-menu.php' );
require_once( BEGIN_THEME_DIR .'/framework/register-mega-menu.php' );

// Hooks ------------------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-hooks.php' );

// Likes ------------------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-likes.php' );

// Widgets ----------------------------------------------------------------------
add_action( 'widgets_init', 'begin_widgets_init' );
function begin_widgets_init() {
	require_once( BEGIN_THEME_DIR .'/framework/register-widgets.php' );

	if(class_exists('DTCorePlugin')) {
		register_widget('Begin_Twitter');
	}

	register_widget('Begin_Flickr');
	register_widget('Begin_Recent_Posts');
	register_widget('Begin_Portfolio_Widget');
}
if(class_exists('DTCorePlugin')) {
	require_once( BEGIN_THEME_DIR .'/framework/widgets/widget-twitter.php' );
}
require_once( BEGIN_THEME_DIR .'/framework/widgets/widget-flickr.php' );
require_once( BEGIN_THEME_DIR .'/framework/widgets/widget-recent-posts.php' );
require_once( BEGIN_THEME_DIR .'/framework/widgets/widget-recent-portfolios.php' );

// Plugins ---------------------------------------------------------------------- 
require_once( BEGIN_THEME_DIR .'/framework/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) ){
	require_once( BEGIN_THEME_DIR .'/framework/register-woocommerce.php' );
}

// WP Store Locator -------------------------------------------------------------
if( begin_is_plugin_active( 'wp-store-locator/wp-store-locator.php' ) ){
	require_once( BEGIN_THEME_DIR .'/framework/register-storelocator.php' );
}

// Reservation Module -----------------------------------------------------------
if(class_exists('DTDoctorAddon'))
	require_once( BEGIN_THEME_DIR .'/framework/register-reservation.php' ); 
	
// Privacy & Cookies ------------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-privacy.php' );

// Register Gutenberg -----------------------------------------------------------
require_once( BEGIN_THEME_DIR .'/framework/register-gutenberg-editor.php' );

?>