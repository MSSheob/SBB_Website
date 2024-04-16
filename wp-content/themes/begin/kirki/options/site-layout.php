<?php
$config = begin_kirki_config();

BEGIN_Kirki::add_section( 'dt_site_layout_section', array(
	'title' => __( 'Site Layout', 'begin' ),
	'priority' => 20
) );

	# site-responsive
	#BEGIN_Kirki::add_field( $config, array(
	#	'type'     => 'switch',
	#	'settings' => 'site-responsive',
	#	'label'    => __( 'Is Site Responsive?', 'begin' ),
	#	'section'  => 'dt_site_layout_section',
	#	'default'  => begin_defaults('site-responsive'),
	#	'choices'  => array(
	#		'on'  => esc_attr__( 'Yes', 'begin' ),
	#		'off' => esc_attr__( 'No', 'begin' )
	#	)
	#));

	# site-layout
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'radio-image',
		'settings' => 'site-layout',
		'label'    => __( 'Site Layout', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'default'  => begin_defaults('site-layout'),
		'choices' => array(
			'boxed' =>  BEGIN_THEME_URI.'/kirki/assets/images/site-layout/boxed.png',
			'wide' => BEGIN_THEME_URI.'/kirki/assets/images/site-layout/wide.png',
		)
	));

	# site-boxed-layout
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'site-boxed-layout',
		'label'    => __( 'Customize Boxed Layout?', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'default'  => '1',
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		),
		'active_callback' => array(
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
		)			
	));

	# body-bg-type
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-type',
		'label'    => __( 'Background Type', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'multiple' => 1,
		'default'  => 'none',
		'choices'  => array(
			'pattern' => esc_attr__( 'Predefined Patterns', 'begin' ),
			'upload' => esc_attr__( 'Set Pattern', 'begin' ),
			'none' => esc_attr__( 'None', 'begin' ),
		),
		'active_callback' => array(
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-pattern
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'radio-image',
		'settings' => 'body-bg-pattern',
		'label'    => __( 'Predefined Patterns', 'begin' ),
		'description'    => __( 'Add Background for body', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-image' )
		),
		'choices' => array(
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern1.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern1.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern2.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern2.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern3.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern3.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern4.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern4.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern5.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern5.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern6.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern6.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern7.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern7.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern8.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern8.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern9.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern9.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern10.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern10.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern11.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern11.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern12.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern12.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern13.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern13.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern14.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern14.jpg',
			BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern15.jpg'=> BEGIN_THEME_URI.'/kirki/assets/images/site-layout/pattern15.jpg',
		),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => '==', 'value' => 'pattern' ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)						
	));

	# body-bg-image
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'image',
		'settings' => 'body-bg-image',
		'label'    => __( 'Background Image', 'begin' ),
		'description'    => __( 'Add Background Image for body', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-image' )
		),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => '==', 'value' => 'upload' ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-position
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-position',
		'label'    => __( 'Background Position', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-position' )
		),
		'default' => 'center',
		'multiple' => 1,
		'choices' => begin_image_positions(),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => 'contains', 'value' => array( 'pattern', 'upload') ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-repeat
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-repeat',
		'label'    => __( 'Background Repeat', 'begin' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-repeat' )
		),
		'default' => 'repeat',
		'multiple' => 1,
		'choices' => begin_image_repeats(),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => 'contains', 'value' => array( 'pattern', 'upload' ) ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));	