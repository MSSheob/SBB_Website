<?php
$config = begin_kirki_config();

# Footer II Layout
	BEGIN_Kirki::add_section( 'dt_footer_ii_layout', array(
		'title'	=> __( 'Layout', 'begin' ),
		'description' => __('Footer Column Layout Settings','begin'),
		'panel' => 'dt_site_footer_ii_panel',
		'priority' => 1	
	) );
		# show-footer-ii
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'show-footer-ii',
			'label'    => __( 'Show Footer Columns ?', 'begin' ),
			'section'  => 'dt_footer_ii_layout',
			'default'  => begin_defaults('show-footer-ii'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));

		# footer-ii-columns
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'radio-image',
			'settings' => 'footer-ii-columns',
			'label'    => __( 'Footer Columns Layout ?', 'begin' ),
			'section'  => 'dt_footer_ii_layout',
			'default'  => begin_defaults('footer-ii-columns'),
			'choices' => array(
				'1' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-column.png',
				'2' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-half-column.png',
				'3' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-third-column.png',
				'4' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-fourth-column.png',
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' )
			)
		));

# Footer II Background		
	BEGIN_Kirki::add_section( 'dt_footer_ii_bg', array(
		'title'	=> __( 'Background', 'begin' ),
		'panel' => 'dt_site_footer_ii_panel',
		'priority' => 2,
	) );

		# customize-footer-ii-bg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-ii-bg',
			'label'    => __( 'Customize Background ?', 'begin' ),
			'section'  => 'dt_footer_ii_bg',
			'default'  => begin_defaults('customize-footer-ii-bg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-ii-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'footer-ii-bg-color',
			'label'    => __( 'Background Color', 'begin' ),
			'section'  => 'dt_footer_ii_bg',
			'output' => array(
				array( 'element' => 'ul.menu' , 'property' => 'background-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# footer-ii-bg-image
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'footer-ii-bg-image',
			'label'    => __( 'Background Image', 'begin' ),
			'description'    => __( 'Add Background Image for footer', 'begin' ),
			'section'  => 'dt_footer_ii_bg',
			'output' => array(
				array( 'element' => 'ul.menu' , 'property' => 'background-image' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# footer-ii-bg-position
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-ii-bg-position',
			'label'    => __( 'Background Image Position', 'begin' ),
			'section'  => 'dt_footer_ii_bg',
			'output' => array(),
			'default' => 'center',
			'multiple' => 1,
			'choices' => begin_image_positions(),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'footer-ii-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));

		# footer-ii-bg-repeat
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-ii-bg-repeat',
			'label'    => __( 'Background Image Repeat', 'begin' ),
			'section'  => 'dt_footer_ii_bg',
			'output' => array(),
			'default' => 'repeat',
			'multiple' => 1,
			'choices' => begin_image_repeats(),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'footer-ii-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));

# Footer II Typography
	BEGIN_Kirki::add_section( 'dt_footer_ii_typo', array(
		'title'	=> __( 'Typography', 'begin' ),
		'panel' => 'dt_site_footer_ii_panel',
		'priority' => 3,
	) );

		# customize-footer-ii-title-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-ii-title-typo',
			'label'    => __( 'Customize Title ?', 'begin' ),
			'section'  => 'dt_footer_ii_typo',
			'default'  => begin_defaults('customize-footer-ii-title-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-ii-title-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-ii-title-typo',
			'label'    => __( 'Title Typography', 'begin' ),
			'section'  => 'dt_footer_ii_typo',
			'output' => array(
				array( 'element' => '' )
			),
			'default' => begin_defaults( 'footer-ii-title-typo' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-title-typo', 'operator' => '==', 'value' => '1' )
			)		
		));

		# Divider
		BEGIN_Kirki::add_field( $config ,array(
			'type'=> 'custom',
			'settings' => 'footer-ii-title-typo-divider',
			'section'  => 'dt_footer_ii_typo',
			'default'  => '<div class="customize-control-divider"></div>',
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-title-typo', 'operator' => '==', 'value' => '1' )
			)			
		));

		# customize-footer-ii-content-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-ii-content-typo',
			'label'    => __( 'Customize Content ?', 'begin' ),
			'section'  => 'dt_footer_ii_typo',
			'default'  => begin_defaults('customize-footer-ii-content-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-ii-content-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-ii-content-typo',
			'label'    => __( 'Content Typography', 'begin' ),
			'section'  => 'dt_footer_ii_typo',
			'output' => array(
				array( 'element' => '' )
			),
			'default' => begin_defaults( 'footer-ii-content-typo' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer-ii', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-ii-content-typo', 'operator' => '==', 'value' => '1' )
			)		
		));		