<?php
$config = begin_kirki_config();

# Footer I Layout
	BEGIN_Kirki::add_section( 'dt_footer_layout', array(
		'title'	=> __( 'Layout', 'begin' ),
		'description' => __('Footer Column Layout Settings','begin'),
		'panel' => 'dt_site_footer_i_panel',
		'priority' => 1	
	) );
	
		# show-footer
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'show-footer',
			'label'    => __( 'Show Footer Columns ?', 'begin' ),
			'section'  => 'dt_footer_layout',
			'default'  => begin_defaults('show-footer'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));

		# footer-columns
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'radio-image',
			'settings' => 'footer-columns',
			'label'    => __( 'Footer Columns Layout ?', 'begin' ),
			'section'  => 'dt_footer_layout',
			'transport' => 'refresh',
			'default'  => begin_defaults('footer-columns'),
			'choices' => array(
				'1' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-column.png',
				'2' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-half-column.png',
				'3' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-third-column.png',
				'4' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-fourth-column.png',
				'5' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-fifth-column.png',
				'6' => BEGIN_THEME_URI.'/kirki/assets/images/columns/one-sixth-column.png',

				'12' => BEGIN_THEME_URI.'/kirki/assets/images/columns/onefourth-onefourth-onehalf-column.png',
				'13' => BEGIN_THEME_URI.'/kirki/assets/images/columns/onehalf-onefourth-onefourth-column.png',
				'11' => BEGIN_THEME_URI.'/kirki/assets/images/columns/onefourth-onehalf-onefourth-column.png',

				'7' => BEGIN_THEME_URI.'/kirki/assets/images/columns/onefourth-threefourth-column.png',
				'8' => BEGIN_THEME_URI.'/kirki/assets/images/columns/threefourth-onefourth-column.png',

				'9' => BEGIN_THEME_URI.'/kirki/assets/images/columns/onethird-twothird-column.png',
				'10' => BEGIN_THEME_URI.'/kirki/assets/images/columns/twothird-onethird-column.png',
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' )
			)
		));

		# footer-darkbg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-footer-darkbg',
			'label'    => __( 'Enable Footer Dark BG', 'begin' ),
			'section'  => 'dt_footer_layout',
			'default'  => begin_defaults('enable-footer-darkbg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));		


# Footer 1 Background		
	BEGIN_Kirki::add_section( 'dt_footer_bg', array(
		'title'	=> __( 'Background', 'begin' ),
		'panel' => 'dt_site_footer_i_panel',
		'priority' => 2,
	) );

		# customize-footer-bg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-bg',
			'label'    => __( 'Customize Background ?', 'begin' ),
			'section'  => 'dt_footer_bg',
			'default'  => begin_defaults('customize-footer-bg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'footer-bg-color',
			'label'    => __( 'Background Color', 'begin' ),
			'section'  => 'dt_footer_bg',
			'output' => array(
				array( 'element' => 'div.footer-widgets' , 'property' => 'background-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# footer-bg-image
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'footer-bg-image',
			'label'    => __( 'Background Image', 'begin' ),
			'description'    => __( 'Add Background Image for footer', 'begin' ),
			'section'  => 'dt_footer_bg',
			'output' => array(
				array( 'element' => 'div.footer-widgets' , 'property' => 'background-image' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# footer-bg-position
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-bg-position',
			'label'    => __( 'Background Image Position', 'begin' ),
			'section'  => 'dt_footer_bg',
			'output' => array(
				array( 'element' => 'div.footer-widgets' , 'property' => 'background-position' )
			),
			'default' => 'center',
			'multiple' => 1,
			'choices' => begin_image_positions(),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'footer-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));

		# footer-bg-repeat
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-bg-repeat',
			'label'    => __( 'Background Image Repeat', 'begin' ),
			'section'  => 'dt_footer_bg',
			'output' => array(
				array( 'element' => 'div.footer-widgets' , 'property' => 'background-repeat' )				
			),
			'default' => 'repeat',
			'multiple' => 1,
			'choices' => begin_image_repeats(),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'footer-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));

# Footer I Typography
	BEGIN_Kirki::add_section( 'dt_footer_typo', array(
		'title'	=> __( 'Typography', 'begin' ),
		'panel' => 'dt_site_footer_i_panel',
		'priority' => 3,
	) );

		# customize-footer-title-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-title-typo',
			'label'    => __( 'Customize Title ?', 'begin' ),
			'section'  => 'dt_footer_typo',
			'default'  => begin_defaults('customize-footer-title-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-title-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-title-typo',
			'label'    => __( 'Title Typography', 'begin' ),
			'section'  => 'dt_footer_typo',
			'output' => array(
				array( 'element' => 'div.footer-widgets h3.widgettitle' )
			),
			'default' => begin_defaults( 'footer-title-typo' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-title-typo', 'operator' => '==', 'value' => '1' )
			)		
		));

		# Divider
		BEGIN_Kirki::add_field( $config ,array(
			'type'=> 'custom',
			'settings' => 'footer-title-typo-divider',
			'section'  => 'dt_footer_typo',
			'default'  => '<div class="customize-control-divider"></div>',
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-title-typo', 'operator' => '==', 'value' => '1' )
			)			
		));

		# customize-footer-content-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-content-typo',
			'label'    => __( 'Customize Content ?', 'begin' ),
			'section'  => 'dt_footer_typo',
			'default'  => begin_defaults('customize-footer-content-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-content-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-content-typo',
			'label'    => __( 'Content Typography', 'begin' ),
			'section'  => 'dt_footer_typo',
			'output' => array(
				array( 'element' => 'div.footer-widgets .widget' )
			),
			'default' => begin_defaults( 'footer-content-typo' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-content-typo', 'operator' => '==', 'value' => '1' )
			)		
		));

		# footer-content-a-color		
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'color',
			'settings' => 'footer-content-a-color',
			'label'    => __( 'Anchor Color', 'begin' ),
			'section'  => 'dt_footer_typo',
			'choices' => array( 'alpha' => true ),
			'output' => array(
				array( 'element' => '.footer-widgets a, #footer a' )
			),
			'default' => begin_defaults( 'footer-content-a-color' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-content-typo', 'operator' => '==', 'value' => '1' )
			)		
		));

		# footer-content-a-hover-color
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'color',
			'settings' => 'footer-content-a-hover-color',
			'label'    => __( 'Anchor Hover Color', 'begin' ),
			'section'  => 'dt_footer_typo',
			'choices' => array( 'alpha' => true ),			
			'output' => array(
				array( 'element' => '.footer-widgets a:hover, #footer a:hover' )
			),
			'default' => begin_defaults( 'footer-content-a-hover-color' ),
			'active_callback' => array(
				array( 'setting' => 'show-footer', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-content-typo', 'operator' => '==', 'value' => '1' )
			)		
		));