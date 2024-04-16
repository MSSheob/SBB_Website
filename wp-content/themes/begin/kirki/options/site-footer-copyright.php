<?php
$config = begin_kirki_config();

# Footer Copyright
	BEGIN_Kirki::add_section( 'dt_footer_copyright', array(
		'title'	=> __( 'Copyright', 'begin' ),
		'description' => __('Footer Copyright Settings','begin'),
		'panel' 		 => 'dt_footer_copyright_panel',
		'priority' => 1
	) );

		# show-copyright-text
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'show-copyright-text',
			'label'    => __( 'Show Copyright Text ?', 'begin' ),
			'section'  => 'dt_footer_copyright',
			'default'  =>  begin_defaults('show-copyright-text'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		) );

		# copyright-text
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'textarea',
			'settings' => 'copyright-text',
			'label'    => __( 'Add Content', 'begin' ),
			'section'  => 'dt_footer_copyright',
			'default'  =>  begin_defaults('copyright-text'),
			'active_callback' => array(
				array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' )
			)
		) );

		# enable-copyright-darkbg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-copyright-darkbg',
			'label'    => __( 'Enable Copyright Dark BG ?', 'begin' ),
			'section'  => 'dt_footer_copyright',
			'default'  =>  begin_defaults('enable-copyright-darkbg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		) );		

		# copyright-next
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'copyright-next',
			'label'    => __( 'Show Sociable / menu ?', 'begin' ),
			'description'    => __( 'Add description here.', 'begin' ),
			'section'  => 'dt_footer_copyright',
			'default'  => begin_defaults('copyright-next'),
			'choices'  => array(
				'hidden'  => esc_attr__( 'Hide', 'begin' ),
				'disable'  => esc_attr__( 'Disable', 'begin' ),
				'sociable' => esc_attr__( 'Show sociable', 'begin' ),
				'footer-menu' => esc_attr__( 'Show menu', 'begin' ),
			)
		) );

# Footer Copyright Background		
	BEGIN_Kirki::add_section( 'dt_footer_copyright_bg', array(
		'title'	=> __( 'Background', 'begin' ),
		'panel' => 'dt_footer_copyright_panel',
		'priority' => 3,
	) );

		# customize-footer-copyright-bg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-copyright-bg',
			'label'    => __( 'Customize Background ?', 'begin' ),
			'section'  => 'dt_footer_copyright_bg',
			'default'  => begin_defaults('customize-footer-copyright-bg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array(
					array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'copyright-next', 'operator' => 'in', 'value' =>  array( 'sociable', 'footer-menu') )
				)
			)
		));

		# footer-copyright-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'footer-copyright-bg-color',
			'label'    => __( 'Background Color', 'begin' ),
			'section'  => 'dt_footer_copyright_bg',
			'output' => array(
				array( 'element' => '.footer-copyright' , 'property' => 'background-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-footer-copyright-bg', 'operator' => '==', 'value' => '1' ),
				array(
					array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'copyright-next', 'operator' => 'in', 'value' =>  array( 'sociable', 'footer-menu') )				
				)
			)
		));

		# footer-copyright-bg-image
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'footer-copyright-bg-image',
			'label'    => __( 'Background Image', 'begin' ),
			'description'    => __( 'Add Background Image for footer', 'begin' ),
			'section'  => 'dt_footer_copyright_bg',
			'output' => array(
				array( 'element' => '.footer-copyright' , 'property' => 'background-image' )
			),
			'active_callback' => array(
				array( 'setting' => 'customize-footer-copyright-bg', 'operator' => '==', 'value' => '1' ),
				array(
					array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'copyright-next', 'operator' => 'in', 'value' =>  array( 'sociable', 'footer-menu') )		
				)
			)
		));

		# footer-copyright-bg-position
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-copyright-bg-position',
			'label'    => __( 'Background Image Position', 'begin' ),
			'section'  => 'dt_footer_copyright_bg',
			'output' => array(),
			'default' => 'center',
			'multiple' => 1,
			'choices' => begin_image_positions(),
			'active_callback' => array(
				array( 'setting' => 'customize-footer-copyright-bg', 'operator' => '==', 'value' => '1' ),
				array(
					array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'copyright-next', 'operator' => 'in', 'value' =>  array( 'sociable', 'footer-menu') )		
				),
				array( 'setting' => 'footer-copyright-bg-image', 'operator' => '!=', 'value' => '' )				
			)			
		));

		# footer-copyright-bg-repeat
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'footer-copyright-bg-repeat',
			'label'    => __( 'Background Image Repeat', 'begin' ),
			'section'  => 'dt_footer_copyright_bg',
			'output' => array(),
			'default' => 'repeat',
			'multiple' => 1,
			'choices' => begin_image_repeats(),
			'active_callback' => array(
				array( 'setting' => 'customize-footer-copyright-bg', 'operator' => '==', 'value' => '1' ),
				array(
					array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'copyright-next', 'operator' => 'in', 'value' =>  array( 'sociable', 'footer-menu') )		
				),
				array( 'setting' => 'footer-copyright-bg-image', 'operator' => '!=', 'value' => '' )
			)			
		));

# Footer Copyright Typography
	BEGIN_Kirki::add_section( 'dt_footer_copyright_typo', array(
		'title'	=> __( 'Typography', 'begin' ),
		'panel' => 'dt_footer_copyright_panel',
		'priority' => 4,
	) );

		# customize-footer-copyright-text-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-copyright-text-typo',
			'label'    => __( 'Customize Copyright Text ?', 'begin' ),
			'section'  => 'dt_footer_copyright_typo',
			'default'  => begin_defaults('customize-footer-copyright-text-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' )
			)			
		));

		# footer-copyright-text-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-copyright-text-typo',
			'label'    => __( 'Text Typography', 'begin' ),
			'section'  => 'dt_footer_copyright_typo',
			'output' => array(
				array( 'element' => '.footer-copyright' )
			),
			'default' => begin_defaults( 'footer-copyright-text-typo' ),
			'active_callback' => array(
				array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'customize-footer-copyright-text-typo', 'operator' => '==', 'value' => '1' )
			)		
		));

		# Divider
		BEGIN_Kirki::add_field( $config ,array(
			'type'=> 'custom',
			'settings' => 'footer-copyright-text-typo-divider',
			'section'  => 'dt_footer_copyright_typo',
			'default'  => '<div class="customize-control-divider"></div>',
			'active_callback' => array(
				array( 'setting' => 'show-copyright-text', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'copyright-next', 'operator' => '==', 'value' => 'footer-menu' )
			)			
		));		

		# customize-footer-menu-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-footer-menu-typo',
			'label'    => __( 'Customize Footer Menu ?', 'begin' ),
			'section'  => 'dt_footer_copyright_typo',
			'default'  => begin_defaults('customize-footer-menu-typo'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'copyright-next', 'operator' => '==', 'value' => 'footer-menu' )
			)			
		));

		# footer-menu-typo
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'typography',
			'settings' => 'footer-menu-typo',
			'label'    => __( 'Menu Typography', 'begin' ),
			'section'  => 'dt_footer_copyright_typo',
			'output' => array(
				array( 'element' => '' )
			),
			'default' => begin_defaults( 'footer-menu-typo' ),
			'active_callback' => array(
				array( 'setting' => 'copyright-next', 'operator' => '==', 'value' => 'footer-menu' ),
				array( 'setting' => 'customize-footer-menu-typo', 'operator' => '==', 'value' => '1' )
			)		
		));		