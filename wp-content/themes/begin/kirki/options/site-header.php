<?php
$config = begin_kirki_config();

# Header Settings
	BEGIN_Kirki::add_section( 'dt_site_header_section', array(
		'title' => __( 'Header Style', 'begin' ),
		'panel' => 'dt_site_header_panel',
		'priority' => 1
	) );

		# header-type
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'radio-image',
			'settings' => 'header-type',
			'label'    => __( 'Site Header', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('header-type'),
			'choices' => array(
				'fullwidth-header' 				=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/fullwidth-header.jpg',
				'boxed-header' 					=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/boxed-header.jpg',
				'split-header boxed-header' 	=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/splitted-boxed-header.jpg',
				'split-header fullwidth-header' => BEGIN_THEME_URI.'/kirki/assets/images/site-headers/splitted-fullwidth-header.jpg',
				'fullwidth-header header-align-center fullwidth-menu-header' 	=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/fullwidth-menu-center.jpg',
				'two-color-header' 			=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/two-color-header.jpg',			
				'fullwidth-header header-align-left fullwidth-menu-header' 		=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/fullwidth-menu-left.jpg',
				'left-header' 				=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/left-header.jpg',
				'left-header-boxed' 		=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/left-header-boxed.jpg',			
				'creative-header' 			=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/creative-header.jpg',
				'overlay-header' 			=> BEGIN_THEME_URI.'/kirki/assets/images/site-headers/overlay-header.jpg',
			)
		));

		# enable-sticy-nav
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-sticy-nav',
			'label'    => __( 'Sticky Navigation ?', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('enable-sticy-nav'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
					'fullwidth-header',
					'boxed-header',
					'split-header boxed-header',
					'split-header fullwidth-header',
					'fullwidth-header header-align-center fullwidth-menu-header',
					'two-color-header',
					'fullwidth-header header-align-left fullwidth-menu-header'
				) ),
			)			
		));	

		# header-position
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'header-position',
			'label'    => __( 'Header Position', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('header-position'),		
			'choices'  => array(
				'above slider' => esc_attr__( 'Above slider','begin'),
				'on slider' => esc_attr__( 'On slider','begin'),
				'below slider' => esc_attr__( 'Below slider','begin')				
			),
			'active_callback' => array(
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 
					'fullwidth-header', 'boxed-header', 'split-header boxed-header',
					'split-header fullwidth-header',
					'fullwidth-header header-align-center fullwidth-menu-header',
					'two-color-header',
					'fullwidth-header header-align-left fullwidth-menu-header' ) ),
			)		
		));

		# header-transparency
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'header-transparency',
			'label'    => __( 'Header Transparency', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('header-transparency'),		
			'choices'  => array(
				'default' => esc_attr__( 'Default','begin'),
				'semi-transparent-header' => esc_attr__( 'Semi Transparent','begin'),
				'transparent-header' => esc_attr__( 'Transparent','begin')				
			),	
		));		

		# enable-header-darkbg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-header-darkbg',
			'label'    => __( 'Enable Dark BG', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('enable-header-darkbg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)		
		));			

		# menu-search-icon
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'menu-search-icon',
			'label'    => __( 'Search Icon ?', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => '',
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 'fullwidth-header', 'boxed-header', 'two-color-header' ) ),
			)		
		));

		# search-box-type
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'search-box-type',
			'label'    => __( 'Search Box Style', 'begin' ),
			'section'  => 'dt_site_header_section',
			'default'  => begin_defaults('search-box-type'),
			'choices'  => array(
				'type1'   => esc_attr__( 'Default','begin'),
				'type2'   => esc_attr__( 'Full Screen','begin')
			),
			'active_callback' => array(
				array( 'setting' => 'menu-search-icon', 'operator' => '==', 'value' => '1' ),
			)
		));

		if( function_exists( 'is_woocommerce' ) ):
			# menu-cart-icon
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'menu-cart-icon',
				'label'    => __( 'Cart Icon ?', 'begin' ),
				'section'  => 'dt_site_header_section',
				'default'  => '',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				),
				'active_callback' => array(
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
						'fullwidth-header',
						'boxed-header',
						'two-color-header') ),
				)
			));
		endif;	

		# Top bar Color

			# enable-top-bar-content
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'enable-top-bar-content',
				'label'    => __( 'Show Top Bar', 'begin' ),
				'section'  => 'dt_site_header_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				),
				/*'active_callback' => array(
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 
						'fullwidth-header',					
						'fullwidth-header header-align-center fullwidth-menu-header',
						'two-color-header',
						'fullwidth-header header-align-left fullwidth-menu-header' ) ),
				)*/
			));

			# top-bar-content
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'textarea',
				'settings' => 'top-bar-content',
				'label'    => __( 'Content', 'begin' ),
				'section'  => 'dt_site_header_section',
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ),
					/*array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 
						'fullwidth-header',
						'fullwidth-header header-align-center fullwidth-menu-header',
						'two-color-header',
						'fullwidth-header header-align-left fullwidth-menu-header' ) ),	*/		
				)
			) );

			# customize-top-bar		
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'customize-top-bar',
				'label'    => __( 'Customize Top Bar', 'begin' ),
				'section'  => 'dt_site_header_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				),
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ), 
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 
						'fullwidth-header',					
						'fullwidth-header header-align-center fullwidth-menu-header',
						'two-color-header',
						'fullwidth-header header-align-left fullwidth-menu-header' ) ),
				)
			));

			# top-bar-bg-color 			
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'top-bar-bg-color',
				'label'    => __( 'Top Bar BG Color', 'begin' ),
				'section'  => 'dt_site_header_section',
				'output' => array(
					array( 'element' => '.top-bar' , 'property' => 'background-color' )
				),
				'choices' => array( 'alpha' => true ),
				'default'  => begin_defaults('top-bar-bg-color'),
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ), 
					array( 'setting' => 'customize-top-bar', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
						'fullwidth-header', 'two-color-header',
						'fullwidth-header header-align-center fullwidth-menu-header',
						'fullwidth-header header-align-left fullwidth-menu-header' )
					)
				)		
			));

			# top-bar-text-color 			
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'top-bar-text-color',
				'label'    => __( 'Top Bar Text Color', 'begin' ),
				'section'  => 'dt_site_header_section',
				'output' => array(
					array( 'element' => '.top-bar' , 'property' => 'color' )
				),
				'choices' => array( 'alpha' => true ),
				'default'  => begin_defaults('top-bar-text-color'),
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ), 
					array( 'setting' => 'customize-top-bar', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
						'fullwidth-header', 'two-color-header',
						'fullwidth-header header-align-center fullwidth-menu-header',
						'fullwidth-header header-align-left fullwidth-menu-header' )
					)
				)		
			));

			# top-bar-a-color 			
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'top-bar-a-color',
				'label'    => __( 'Top Bar Anchor Color', 'begin' ),
				'section'  => 'dt_site_header_section',
				'output' => array(
					array( 'element' => '.top-bar a' , 'property' => 'color' )
				),
				'choices' => array( 'alpha' => true ),
				'default'  => begin_defaults('top-bar-a-color'),				
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ), 
					array( 'setting' => 'customize-top-bar', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
						'fullwidth-header', 'two-color-header',
						'fullwidth-header header-align-center fullwidth-menu-header',
						'fullwidth-header header-align-left fullwidth-menu-header' )
					)
				)
			));

			# top-bar-a-hover-color 			
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'top-bar-a-hover-color',
				'label'    => __( 'Top Bar Anchor Hover Color', 'begin' ),
				'section'  => 'dt_site_header_section',
				'output' => array(
					array( 'element' => '.top-bar a:hover' , 'property' => 'color' )
				),
				'choices' => array( 'alpha' => true ),
				'default'  => begin_defaults('top-bar-a-hover-color'),
				'active_callback' => array(
					array( 'setting' => 'enable-top-bar-content', 'operator' => '==', 'value' => '1' ), 
					array( 'setting' => 'customize-top-bar', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array(
						'fullwidth-header', 'two-color-header',
						'fullwidth-header header-align-center fullwidth-menu-header',
						'fullwidth-header header-align-left fullwidth-menu-header' )
					)
				)		
			));

		# enable-header-left-content	
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-header-left-content',
			'label'    => __( 'Show Header Left', 'begin' ),
			'section'  => 'dt_site_header_section',
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 'fullwidth-header header-align-center fullwidth-menu-header', 'left-header', 'left-header-boxed', 'creative-header' ) ),
			)				
		));

		# header-left-content
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'textarea',
			'settings' => 'header-left-content',
			'label'    => __( 'Left Content', 'begin' ),
			'section'  => 'dt_site_header_section',
			'active_callback' => array(
				array( 'setting' => 'enable-header-left-content', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 'fullwidth-header header-align-center fullwidth-menu-header', 'left-header', 'left-header-boxed', 'creative-header' ) ),
			)
		) );

		# enable-header-right-content	
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'enable-header-right-content',
			'label'    => __( 'Show Header Right', 'begin' ),
			'section'  => 'dt_site_header_section',
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			),
			'active_callback' => array(
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 
					'fullwidth-header header-align-center fullwidth-menu-header',
					'fullwidth-header header-align-left fullwidth-menu-header' ) ),
			)				
		));

		# header-right-content
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'textarea',
			'settings' => 'header-right-content',
			'label'    => __( 'Right Content', 'begin' ),
			'section'  => 'dt_site_header_section',
			'active_callback' => array(
				array( 'setting' => 'enable-header-right-content', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'header-type', 'operator' => 'contains', 'value' => array( 'fullwidth-header header-align-center fullwidth-menu-header', 'fullwidth-header header-align-left fullwidth-menu-header') ),
			)
		) );

# Header Background Settings
	BEGIN_Kirki::add_section( 'dt_site_header_bg_section', array(
		'title' => __( 'Header Background', 'begin' ),
		'panel' => 'dt_site_header_panel',
		'priority' => 2
	) );

		# customize-header-bg
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-header-bg',
			'label'    => __( 'Customize Background ?', 'begin' ),
			'section'  => 'dt_site_header_bg_section',
			'default'  => begin_defaults('customize-header-bg'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)						
		));

		# header-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'header-bg-color',
			'label'    => __( 'Background Color', 'begin' ),
			'section'  => 'dt_site_header_bg_section',
			'output' => array(
				array( 'element' => '.main-header-wrapper, .is-sticky .main-header-wrapper, .fullwidth-header .main-header-wrapper, .boxed-header .main-header, .boxed-header .is-sticky .main-header-wrapper, .header-align-left.fullwidth-menu-header .is-sticky .menu-wrapper, .header-align-center.fullwidth-menu-header .is-sticky .menu-wrapper, .standard-header .is-sticky .main-header-wrapper, .two-color-header .main-header-wrapper:before, .header-on-slider .is-sticky .main-header-wrapper, .left-header .main-header-wrapper, .left-header .main-header, .overlay-header .overlay, .dt-menu-toggle' , 'property' => 'background-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-header-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# header-bg-image
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'image',
			'settings' => 'header-bg-image',
			'label'    => __( 'Background Image', 'begin' ),
			'description'    => __( 'Add Background Image for breadcrumb', 'begin' ),
			'section'  => 'dt_site_header_bg_section',
			'output' => array(
				array( 'element' => '#main-header-wrapper' , 'property' => 'background-image' )
			),
			'active_callback' => array(
				array( 'setting' => 'customize-header-bg', 'operator' => '==', 'value' => '1' )
			)
		));

		# header-bg-position
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'header-bg-position',
			'label'    => __( 'Background Image Position', 'begin' ),
			'section'  => 'dt_site_header_bg_section',
			'output' => array(
				array( 'element' => '#main-header-wrapper' , 'property' => 'background-position' )				
			),
			'default' => 'center',
			'multiple' => 1,
			'choices' => begin_image_positions(),
			'active_callback' => array(
				array( 'setting' => 'customize-header-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'header-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));

		# header-bg-repeat
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'select',
			'settings' => 'header-bg-repeat',
			'label'    => __( 'Background Image Repeat', 'begin' ),
			'section'  => 'dt_site_header_bg_section',
			'output' => array(
				array( 'element' => '#main-header-wrapper' , 'property' => 'background-repeat' )				
			),
			'default' => 'repeat',
			'multiple' => 1,
			'choices' => begin_image_repeats(),
			'active_callback' => array(
				array( 'setting' => 'customize-header-bg', 'operator' => '==', 'value' => '1' ),
				array( 'setting' => 'header-bg-image', 'operator' => '!=', 'value' => '' )
			)
		));		