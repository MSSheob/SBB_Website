<?php
$config = begin_kirki_config();

# Breadcrumb Settings
BEGIN_Kirki::add_section( 'dt_site_breadcrumb_section', array(
	'title' => __( 'Breadcrumb', 'begin' ),
	'priority' => 24,	
) );

# Breadcrumb Typography

	# customize-breadcrumb-title-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'customize-breadcrumb-title-typo',
		'label'    => __( 'Customize Title ?', 'begin' ),
		'section'  => 'dt_site_breadcrumb_section',
		'default'  => begin_defaults('customize-breadcrumb-title-typo'),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)			
	));
	
	# breadcrumb-title-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'typography',
		'settings' => 'breadcrumb-title-typo',
		'label'    => __( 'Title Typography', 'begin' ),
		'section'  => 'dt_site_breadcrumb_section',
		'output' => array(
			array( 'element' => '.main-title-section h1, h1.simple-title' )
		),
		'default' => begin_defaults( 'breadcrumb-title-typo' ),
		'active_callback' => array(
			array( 'setting' => 'customize-breadcrumb-title-typo', 'operator' => '==', 'value' => '1' )
		)		
	));		
	
	# customize-breadcrumb-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'customize-breadcrumb-typo',
		'label'    => __( 'Customize Link ?', 'begin' ),
		'section'  => 'dt_site_breadcrumb_section',
		'default'  => begin_defaults('customize-breadcrumb-typo'),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)			
	));
	
	# breadcrumb-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'typography',
		'settings' => 'breadcrumb-typo',
		'label'    => __( 'Link Typography', 'begin' ),
		'section'  => 'dt_site_breadcrumb_section',
		'output' => array(
			array( 'element' => 'div.breadcrumb a' )
		),
		'default' => begin_defaults( 'breadcrumb-typo' ),
		'active_callback' => array(
			array( 'setting' => 'customize-breadcrumb-typo', 'operator' => '==', 'value' => '1' )
		)		
	));