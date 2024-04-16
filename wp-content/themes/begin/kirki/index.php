<?php

require_once get_template_directory() . '/kirki/kirki-utils.php';
require_once get_template_directory() . '/kirki/include-kirki.php';
require_once get_template_directory() . '/kirki/kirki.php';

$config = begin_kirki_config();

add_action('customize_register', 'begin_customize_register');
function begin_customize_register( $wp_customize ) {

	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );

	$wp_customize->remove_section('themes');
	$wp_customize->get_section('title_tagline')->priority = 10;
}

add_action( 'customize_controls_print_styles', 'begin_enqueue_customizer_stylesheet' );
function begin_enqueue_customizer_stylesheet() {
	wp_register_style( 'begin-customizer-css', BEGIN_THEME_URI.'/kirki/assets/css/customizer.css', NULL, NULL, 'all' );
	wp_enqueue_style( 'begin-customizer-css' );	
}

add_action( 'customize_controls_print_footer_scripts', 'begin_enqueue_customizer_script' );
function begin_enqueue_customizer_script() {
	wp_register_script( 'begin-customizer-js', BEGIN_THEME_URI.'/kirki/assets/js/customizer.js', array('jquery', 'customize-controls' ), false, true );
	wp_enqueue_script( 'begin-customizer-js' );
}

# Theme Customizer Begins
BEGIN_Kirki::add_config( $config , array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

	# Site Identity	
		# use-custom-logo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'use-custom-logo',
			'label'    => __( 'Logo ?', 'begin' ),
			'section'  => 'title_tagline',
			'priority' => 1,
			'default'  => begin_defaults('use-custom-logo'),
			'description' => __('Switch to Site title or Logo','begin'),
			'choices'  => array(
				'on'  => esc_attr__( 'Logo', 'begin' ),
				'off' => esc_attr__( 'Site Title', 'begin' )
			)			
		) );

		# custom-logo
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'custom-logo',
			'label'    => __( 'Logo', 'begin' ),
			'section'  => 'title_tagline',
			'priority' => 2,
			'default' => begin_defaults( 'custom-logo' ),
			'active_callback' => array(
				array( 'setting' => 'use-custom-logo', 'operator' => '==', 'value' => '1' )
			)
		));

		# custom-dark-logo
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'custom-dark-logo',
			'label'    => __( 'Dark Logo', 'begin' ),
			'section'  => 'title_tagline',
			'priority' => 3,
			'default' => begin_defaults( 'custom-dark-logo' ),
			'active_callback' => array(
				array( 'setting' => 'use-custom-logo', 'operator' => '==', 'value' => '1' )
			)
		));	
		
		# site-title-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'custom-title',
			'label'    => __( 'Site Title Color', 'begin' ),
			'section'  => 'title_tagline',
			'priority' => 4,
			'active_callback' => array(
				array( 'setting' => 'use-custom-logo', 'operator' => '!=', 'value' => '1' )
			),
			'output' => array(
				array( 'element' => '#header .logo-title > h1 a, #header .logo-title h2 a' , 'property' => 'color' )
			),
			'choices' => array( 'alpha' => true ),
		));	

	# Site Layout
	require_once get_template_directory() . '/kirki/options/site-layout.php';

	# Site Skin
	require_once get_template_directory() . '/kirki/options/site-skin.php';

	# Site Breadcrumb
	BEGIN_Kirki::add_panel( 'dt_site_breadcrumb_panel', array(
		'title' => __( 'Site Breadcrumb', 'begin' ),
		'description' => __('Site Breadcrumb','begin'),
		'priority' => 25
	) );
	require_once get_template_directory() . '/kirki/options/site-breadcrumb.php';
	
	# Site Header
	BEGIN_Kirki::add_panel( 'dt_site_header_panel', array(
		'title' => __( 'Site Header', 'begin' ),
		'description' => __('Site Header','begin'),
		'priority' => 30
	) );
	require_once get_template_directory() . '/kirki/options/site-header.php';

	# Site Menu
	BEGIN_Kirki::add_panel( 'dt_site_menu_panel', array(
		'title' => __( 'Site Menu', 'begin' ),
		'description' => __('Site Menu','begin'),
		'priority' => 35
	) );
	require_once get_template_directory() . '/kirki/options/site-menu/navigation.php';		

	# Site Footer I
		BEGIN_Kirki::add_panel( 'dt_site_footer_i_panel', array(
			'title' => __( 'Site Footer I', 'begin' ),
			'priority' => 40
		) );
		require_once get_template_directory() . '/kirki/options/site-footer-i.php';

	# Site Footer II
	BEGIN_Kirki::add_panel( 'dt_site_footer_ii_panel', array(
		'title' => __( 'Site Footer II', 'begin' ),
		'priority' => 45
	) );
	#require_once get_template_directory() . '/kirki/options/site-footer-ii.php';

	# Site Footer Copyright
	BEGIN_Kirki::add_panel( 'dt_footer_copyright_panel', array(
		'title' => __( 'Site Copyright', 'begin' ),
		'priority' => 50
	) );
	require_once get_template_directory() . '/kirki/options/site-footer-copyright.php';

	# Additional JS
	require_once get_template_directory() . '/kirki/options/custom-js.php';

	# Typography
	BEGIN_Kirki::add_panel( 'dt_site_typography_panel', array(
		'title' => __( 'Typography', 'begin' ),
		'description' => __('Typography Settings','begin'),
		'priority' => 220
	) );	
	require_once get_template_directory() . '/kirki/options/site-typography.php';	
# Theme Customizer Ends