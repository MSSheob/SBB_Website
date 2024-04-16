<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Kriya for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once BEGIN_THEME_DIR . '/framework/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'begin_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function begin_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> esc_html__('Visual Composer', 'begin'),
			'slug'     				=> 'js_composer',
			'source'   				=> get_template_directory() . '/framework/plugins/js_composer.zip',
			'version' 				=> '6.0.3',
			'required' 				=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> esc_html__('Ultimate Addons for Visual Composer', 'begin'),
			'slug'     				=> 'Ultimate_VC_Addons',
			'source'   				=> get_template_directory() . '/framework/plugins/Ultimate_VC_Addons.zip',
			'version' 				=> '3.18.0',
			'required' 				=> false,
		),

		array(
			'name'     				=> esc_html__('Layer Slider', 'begin'),
			'slug'     				=> 'LayerSlider',
			'source'   				=> get_template_directory() . '/framework/plugins/LayerSlider.zip',
			'version' 				=> '6.8.4',
		),

		array(
			'name'     				=> esc_html__('Revolution Slider', 'begin'),
			'slug'     				=> 'revslider',
			'source'   				=> get_template_directory() . '/framework/plugins/revslider.zip',
			'version' 				=> '5.4.8.3',
		),

		array(
			'name'     				=> esc_html__('DesignThemes Core Features Plugin', 'begin'),
			'slug'     				=> 'designthemes-core-features',
			'source'   				=> get_template_directory() . '/framework/plugins/designthemes-core-features.zip',
			'required' 				=> true,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name' 					=> esc_html__('Contact Form 7', 'begin'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('WooCommerce - excelling eCommerce', 'begin'),
			'slug' 					=> 'woocommerce',
			'required' 				=> false,
		),

		array(
			'name'					=> esc_html__('Envato Market', 'begin'),
			'slug'					=> 'envato-market',
			'source'				=> get_template_directory() . '/framework/plugins/envato-market.zip',
		),

		array(
			'name'     				=> esc_html__('Unyson', 'begin'),
			'slug'     				=> 'unyson',
			'required' 				=> true,
		),
		
		array(
			'name'     				=> esc_html__('Kirki Toolkit', 'begin'),
			'slug'     				=> 'kirki',
			'required' 				=> true,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'begin',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}?>