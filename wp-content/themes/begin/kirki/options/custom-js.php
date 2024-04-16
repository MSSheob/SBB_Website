<?php
$config = begin_kirki_config();

BEGIN_Kirki::add_section( 'dt_custom_js_section', array(
	'title' => __( 'Additional JS', 'begin' ),
	'priority' => 210
) );

	# custom-js
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'enable-custom-js',
		'section'  => 'dt_custom_js_section',
		'label'    => __( 'Enable Custom JS?', 'begin' ),
		'default'  => begin_defaults('enable-custom-js'),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)		
	));

	# custom-js
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'code',
		'settings' => 'custom-js',
		'section'  => 'dt_custom_js_section',
		'transport' => 'postMessage',
		'label'    => __( 'Add Custom JS', 'begin' ),
		'choices'     => array(
			'language' => 'javascript',
			'theme'    => 'dark',
		),
		'active_callback' => array(
			array( 'setting' => 'enable-custom-js' , 'operator' => '==', 'value' =>'1')
		)
	));