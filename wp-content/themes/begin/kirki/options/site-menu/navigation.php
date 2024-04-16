<?php
$config = begin_kirki_config();

# Main menu
	BEGIN_Kirki::add_section( 'dt_site_navigation_section', array(
		'title' => __( 'Main Menu', 'begin' ),
		'panel' => 'dt_site_menu_panel',
		'priority' => 1
	) );

		# menu-active-style
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'menu-active-style',
			'label'    => __( 'Menu Active Style', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'default'  => '',
			'choices'  => array(
				"menu-default" => esc_attr__( 'Default','begin'),
				"menu-active-with-icon menu-active-highlight" => esc_attr__( 'Highlight with Plus Icon','begin'),
				"menu-active-highlight" => esc_attr__( 'Highlight','begin'),
				"menu-active-highlight-grey" => esc_attr__( 'Highlight Grey','begin'),
				"menu-active-highlight-with-arrow" => esc_attr__( 'Highlight with Arrow','begin'),
				"menu-active-with-two-border" => esc_attr__( 'Two Border','begin'),
				"menu-active-with-double-border" => esc_attr__( 'Double Border','begin'),
				"menu-active-border-with-arrow" => esc_attr__( 'Border with Arrow','begin'),
				"menu-with-slanting-splitter" => esc_attr__( 'Slanting Splitter','begin'),
			)
		));

		# Divider
		BEGIN_Kirki::add_field( $config ,array(
			'type'=> 'custom',
			'settings' => 'menu-bg-color-divider',
			'section'  => 'dt_site_navigation_section',
			'default'  => '<div class="customize-control-divider"></div>',
			'active_callback' => array(
				array( 'setting' => 'customize-menu-bg-color', 'operator' => '==', 'value' => '1' ),
			)			
		));

		# customize-menu-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-menu-bg-color',
			'label'    => __( 'Customize Menu BG ?', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'default'  => begin_defaults('customize-menu-bg-color'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));		

		# menu-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'menu-bg-color',
			'label'    => __( 'Background Color', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'output' => array(
				array( 'element' => '.menu-wrapper, .dt-menu-toggle' , 'property' => 'background-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-menu-bg-color', 'operator' => '==', 'value' => '1' ),
			)		
		));

		# Divider
		BEGIN_Kirki::add_field( $config ,array(
			'type'=> 'custom',
			'settings' => 'menu-link-color-divider',
			'section'  => 'dt_site_navigation_section',
			'default'  => '<div class="customize-control-divider"></div>'
		));

		# customize-menu-link
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-menu-link',
			'label'    => __( 'Customize Menu Link Colors ?', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'default'  => begin_defaults('customize-menu-link'),
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));

		# menu-a-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'menu-a-color',
			'label'    => __( 'Menu link Color', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'output' => array(
				array( 'element' => '#main-menu ul.menu > li > a' , 'property' => 'color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-menu-link', 'operator' => '==', 'value' => '1' ),
			)		
		));

		# menu-a-hover-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'menu-a-hover-color',
			'label'    => __( 'Menu link hover Color', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'output' => array(
				array( 'element' => '#main-menu ul.menu > li > a:hover, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu > li.menu-item-simple-parent:hover > a' , 'property' => 'color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-menu-link', 'operator' => '==', 'value' => '1' ),
			)		
		));

		# menu-a-active-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'menu-a-active-color',
			'label'    => __( 'Active Menu Color', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'output' => array(
				array( 'element' => '.menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a:before, 

					.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:after, 

					.menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:before,  .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:after, 

					.menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:after' , 'property' => 'background-color' ),

				array( 'element' => '.menu-active-with-double-border #main-menu > ul.menu > li.current_page_item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-ancestor > a' , 'property' => 'border-color' ),

				array( 'element' => '.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before' , 'property' => 'border-bottom-color' ),

				array( 'element' => '#main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a, .left-header #main-menu > ul.menu > li.current_page_item > a,.left-header #main-menu > ul.menu > li.current_page_ancestor > a,.left-header #main-menu > ul.menu > li.current-menu-item > a, .left-header #main-menu > ul.menu > li.current-menu-ancestor > a, 

					.menu-active-highlight #main-menu > ul.menu > li.current_page_item > a, .menu-active-highlight #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-item > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-ancestor > a' , 'property' => 'color' ),

			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-menu-link', 'operator' => '==', 'value' => '1' ),
			)		
		));

		# menu-a-active-bg-color
		BEGIN_Kirki::add_field( $config, array(
			'type' => 'color',
			'settings' => 'menu-a-active-bg-color',
			'label'    => __( 'Active Menu BG Color', 'begin' ),
			'section'  => 'dt_site_navigation_section',
			'output' => array(
				array( 'element' => '#main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu > ul.menu > li.current-menu-ancestor > a,  .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor, 

					.menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a' , 'property' => 'background-color' ),

				array( 'element' => '.menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before' , 'property' => 'border-top-color' )
			),
			'choices' => array( 'alpha' => true ),
			'active_callback' => array(
				array( 'setting' => 'customize-menu-link', 'operator' => '==', 'value' => '1' ),
			)		
		));

# Sub menu
	BEGIN_Kirki::add_section( 'dt_site_sub_menu_section', array(
		'title' => __( 'Sub Menu', 'begin' ),
		'panel' => 'dt_site_menu_panel',
		'priority' => 2
	) );

		# menu-hover-animation-style
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'menu-hover-style',
			'label'    => __( 'Sub Menu Wrapper Animation', 'begin' ),
			'section'  => 'dt_site_sub_menu_section',
			'default'  => '',
			'choices'  => begin_animations()
		));

		# customize-sub-menu-wrapper
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'customize-sub-menu-wrapper',
				'label'    => __( 'Customize Sub Menu Wrapper ?', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				)
			));

			# Sub Menu Wrapper Background Color
			
				# allow-sub-menu-bg-color
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'allow-sub-menu-bg-color',
					'label'    => __( 'Custom BG - Sub Menu Wrapper', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-bg-color-type
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'select',
					'settings' => 'sub-menu-bg-color-type',
					'label'    => __( 'BG Color Type', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'default'  => 'simple',
					'choices'  => array(
						'simple' => esc_html__('Simple','begin'),
						'gradient' => esc_html__('Gradient','begin')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
					)			
				));

				# sub-menu-bg-color
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'sub-menu-bg-color',
					'label'    => __( 'BG Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices' => array( 'alpha' => true ),
					'output' => array(
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'background-color')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'simple' ),
					)
				));			

				# sub-menu-bg-color-1
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'sub-menu-bg-color-1',
					'label'    => __( 'Gradient BG 1', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices' => array( 'alpha' => true ),
					'output' => array(
						array( 'element' => '', 'property' => 'background-color')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'gradient' ),
					)				
				));

				# sub-menu-bg-color-1-stop
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-bg-color-1-stop',
					'label'    => __( 'Gradient BG 1 Stop (in %)', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'default'	=> 30,
					'choices'     => array( 'min'  => '0', 'max'  => '100', 'step' => '1' ),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-1', 'operator' => '!==', 'value' => '' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'gradient' )
					)			
				));

				# sub-menu-bg-color-2
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'sub-menu-bg-color-2',
					'label'    => __( 'Gradient BG 2', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices' => array( 'alpha' => true ),
					'output' => array(
						array( 'element' => '', 'property' => 'background-color')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'gradient' ),
					)				
				));

				# sub-menu-bg-color-2-stop
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-bg-color-2-stop',
					'label'    => __( 'Gradient BG 2 Stop (in %)', 'begin' ),
					'default'	=> 50,
					'choices'     => array( 'min'  => '0', 'max'  => '100', 'step' => '1' ),
					'section'  => 'dt_site_sub_menu_section',			
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-2', 'operator' => '!==', 'value' => '' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'gradient' )
					)			
				));

				# sub-menu-bg-color-direction
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'select',
					'settings' => 'sub-menu-bg-color-direction',
					'label'    => __( 'Gradient Direction', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'default'  => 'to top',
					'choices'  => array(
						'to top' => esc_html__('Bottom to Top','begin'),
						'to bottom' => esc_html__('Top to Bottom','begin'),
						'to right' => esc_html__('Left to Right','begin'),
						'to left' => esc_html__('Right to Left','begin'),
						'to top left' => esc_html__('Bottom Right to Top Left','begin'),
						'to top right' => esc_html__('Bottom Left to Right Top','begin'),
						'to bottom right' => esc_html__('Left Top to Bottom Right','begin'),
						'to bottom left' => esc_html__('Right Top to Bottom Left','begin'),
					),			
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-bg-color', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'sub-menu-bg-color-type', 'operator' => '==', 'value' => 'gradient' ),
						array( 'setting' => 'sub-menu-bg-color-1', 'operator' => '!==', 'value' => '' ),
						array( 'setting' => 'sub-menu-bg-color-2', 'operator' => '!==', 'value' => '' ),
					)			
				));
			# Sub Menu Wrapper Background Color
			
			# Sub Menu Wrapper Border
				# allow-sub-menu-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'allow-sub-menu-border',
					'label'    => __( 'Sub Menu Wrapper Border?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' )					
					)
				));

				# sub-menu-border-style
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'select',
					'settings' => 'sub-menu-border-style',
					'label'    => __( 'Sub-Menu Wrapper Border Style', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-style')
					),
					'default'  => 'solid',
					'choices'  => begin_border_styles(),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)			
				));
			
				# sub-menu-top-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-top-border',
					'label'    => __( 'Top Border', 'begin' ),
					'description'    => __( 'sub menu top border value in px', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-top-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)			
				));

				# sub-menu-right-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-right-border',
					'label'    => __( 'Right Border', 'begin' ),
					'description'    => __( 'sub menu right border value in px', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-right-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)			
				));

				# sub-menu-bottom-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-bottom-border',
					'label'    => __( 'Bottom Border', 'begin' ),
					'description'    => __( 'sub menu bottom border value in px', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-bottom-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)			
				));

				# sub-menu-left-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-left-border',
					'label'    => __( 'Left Border', 'begin' ),
					'description'    => __( 'sub menu left border value in px', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-left-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)			
				));	

				# sub-menu-border-color
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'sub-menu-border-color',
					'label'    => __( 'Sub-Menu Wrapper Border Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices' => array( 'alpha' => true ),
					'output' => array(
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-color')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-border', 'operator' => '==', 'value' => '1' ),
					)				
				));	
			# Sub Menu Wrapper Border

			# Sub Menu Wrapper Border Radius
			
				# allow-sub-menu-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'allow-sub-menu-radius',
					'label'    => __( 'Sub Menu Wrapper Radius?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),					
					)
				));		

				# sub-menu-top-left-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'sub-menu-top-left-radius',
					'label'    => __( 'Top Left Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-top-left-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'allow-sub-menu-radius', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-top-right-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'sub-menu-top-right-radius',
					'label'    => __( 'Top Right Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-top-right-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'allow-sub-menu-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));

				# sub-menu-bottom-right-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'sub-menu-bottom-right-radius',
					'label'    => __( 'Bottom Right Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-bottom-right-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'allow-sub-menu-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));

				# sub-menu-bottom-left-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'sub-menu-bottom-left-radius',
					'label'    => __( 'Bottom Left Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-bottom-left-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'allow-sub-menu-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));
			# Sub Menu Wrapper Border Radius

			# Sub Menu Wrapper Box Shadow	
			
				# allow-sub-menu-box-shadow
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'allow-sub-menu-box-shadow',
					'label'    => __( 'Sub Menu Wrapper Shadow?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
					)				
				));

				# sub-menu-box-h-shadow
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-box-h-shadow',
					'label'    => __( 'H Shadow', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'default'  => begin_defaults('sub-menu-box-h-shadow'),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-box-v-shadow
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-box-v-shadow',
					'label'    => __( 'V Shadow', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),			
					'default'  => begin_defaults('sub-menu-box-v-shadow'),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-box-blur-shadow
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-box-blur-shadow',
					'label'    => __( 'Blur Shadow', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),			
					'default'  => begin_defaults('sub-menu-box-blur-shadow'),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-box-spread-shadow
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'sub-menu-box-spread-shadow',
					'label'    => __( 'Spread Shadow', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),			
					'default'  => begin_defaults('sub-menu-box-spread-shadow'),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-box-shadow-color
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'color',
					'settings' => 'sub-menu-box-shadow-color',
					'label'    => __( 'Shadow Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)
				));

				# sub-menu-box-shadow-inset
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'sub-menu-box-shadow-inset',
					'label'    => __( 'Box Shadow Inset?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-sub-menu-wrapper', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-sub-menu-box-shadow', 'operator' => '==', 'value' => '1' ),
					)			
				));					
			# Sub Menu Wrapper Box Shadow	
		# customize-sub-menu-wrapper

		# customize-sub-menu-links
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'switch',
			'settings' => 'customize-sub-menu-links',
			'label'    => __( 'Customize Sub Menu links ?', 'begin' ),
			'section'  => 'dt_site_sub_menu_section',
			'choices'  => array(
				'on'  => esc_attr__( 'Yes', 'begin' ),
				'off' => esc_attr__( 'No', 'begin' )
			)
		));
		# customize-sub-menu-links		

		# Sub Menu Link BG Settings
			# customize-sub-menu-links
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'customize-sub-menu-link-colors',
				'label'    => __( 'Custom Colors - Sub Menu Links', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' )
				)				
			));

			# sub-menu-a-color
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'sub-menu-a-color',
				'label'    => __( 'Sub Menu Link Color', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'output' => array(
					array( 'element' => '#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a' , 'property' => 'color' )
				),
				'choices' => array( 'alpha' => true ),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'customize-sub-menu-link-colors', 'operator' => '==', 'value' => '1' ),
				)		
			));

			# sub-menu-a-bg-color
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'sub-menu-a-bg-color',
				'label'    => __( 'Sub Menu Link BG Color', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'output' => array(
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a' , 'property' => 'background-color' )
				),
				'choices' => array( 'alpha' => true ),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'customize-sub-menu-link-colors', 'operator' => '==', 'value' => '1' ),
				)		
			));			

			# sub-menu-a-active-color
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'sub-menu-a-active-color',
				'label'    => __( 'Sub Menu Link Active Color', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'output' => array(
					array( 'element' => '#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover, #main-menu ul.menu li.menu-item-simple-parent ul li:hover > a, 

						#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, 
						#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, 
						#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, 
						#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, 

						#main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, 
						#main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, 
						#main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, 
						#main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a' , 'property' => 'color' ),				
				),
				'choices' => array( 'alpha' => true ),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'customize-sub-menu-link-colors', 'operator' => '==', 'value' => '1' ),
				)		
			));

			# sub-menu-a-active-bg-color
			BEGIN_Kirki::add_field( $config, array(
				'type' => 'color',
				'settings' => 'sub-menu-a-active-bg-color',
				'label'    => __( 'Sub Menu Link Active BG Color', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'output' => array(
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover, 
						#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-ancestor > a' , 'property' => 'background-color' )
				),
				'choices' => array( 'alpha' => true ),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'customize-sub-menu-link-colors', 'operator' => '==', 'value' => '1' ),
				)		
			));				 
		# Sub Menu Link BG Settings	
		
		# Sub Menu Link Border Style
			# sub-menu-link-border-style
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'select',
				'settings' => 'sub-menu-link-border-style',
				'label'    => __( 'Sub Menu Link Border', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array(
					'-'	=> esc_html__('None','begin'),
					'with-border'	=> esc_html__('With Border','begin'),
					'with-hover-border'	=> esc_html__('With Hover Border','begin'),
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' )
				)				
			));

				# sub-menu-link-border-style  = with-hover-border
					# sub-menu-h-border-style
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'select',
						'settings' => 'sub-menu-h-border-style',
						'label'    => __( 'Sub Menu Link Hover Border Style', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'default'  => 'solid',
						'choices' => begin_border_styles(),
						'output' => array(
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-style'),
						),				
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' )
						)
					));

					# sub-menu-h-top-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-h-top-border',
						'label'    => __( 'Top Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-top-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' ),
							array( 'setting' => 'sub-menu-h-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-h-right-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-h-right-border',
						'label'    => __( 'Right Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-right-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' ),					
							array( 'setting' => 'sub-menu-h-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-h-bottom-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-h-bottom-border',
						'label'    => __( 'Bottom Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-bottom-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' ),					
							array( 'setting' => 'sub-menu-h-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-h-left-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-h-left-border',
						'label'    => __( 'Left Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-left-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' ),					
							array( 'setting' => 'sub-menu-h-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-h-border-color
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'color',
						'settings' => 'sub-menu-h-color',
						'label'    => __( 'Sub Menu Link Hover Border Color', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices' => array( 'alpha' => true ),
						'output' => array(
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a:hover:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover:after', 'property' => 'border-color'),					
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-hover-border' )
						)
					));

				# sub-menu-link-border-style  = with-border
					# sub-menu-d-border-style
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'select',
						'settings' => 'sub-menu-d-border-style',
						'label'    => __( 'Sub Menu Link Border Style', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'default'  => 'solid',
						'choices' => begin_border_styles(),
						'output' => array(
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-style'),
						),				
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' )
						)
					));

					# sub-menu-d-top-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-d-top-border',
						'label'    => __( 'Top Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-top-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' ),
							array( 'setting' => 'sub-menu-d-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-d-right-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-d-right-border',
						'label'    => __( 'Right Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-right-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' ),					
							array( 'setting' => 'sub-menu-d-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-d-bottom-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-d-bottom-border',
						'label'    => __( 'Bottom Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-bottom-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' ),					
							array( 'setting' => 'sub-menu-d-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));

					# sub-menu-d-left-border
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'slider',
						'settings' => 'sub-menu-d-left-border',
						'label'    => __( 'Left Border', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
						'output' => array( 
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-left-width', 'units' => 'px' )
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' ),					
							array( 'setting' => 'sub-menu-d-border-style', 'operator' => '!==', 'value' => 'none' ),
						)			
					));	

					# sub-menu-d-border-color
					BEGIN_Kirki::add_field( $config, array(
						'type'     => 'color',
						'settings' => 'sub-menu-d-color',
						'label'    => __( 'Sub Menu Link Border Color ', 'begin' ),
						'section'  => 'dt_site_sub_menu_section',
						'choices' => array( 'alpha' => true ),
						'output' => array(
							array( 'element' => '#main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a', 'property' => 'border-color'),					
						),
						'active_callback' => array(
							array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
							array( 'setting' => 'sub-menu-link-border-style', 'operator' => '==', 'value' => 'with-border' )
						)
					));
		# Sub Menu Link Border Style

		# Sub Menu Link Border Radius
			# allow-sub-menu-link-radius
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'allow-sub-menu-link-radius',
				'label'    => __( 'Allow Sub Menu Link Radius?', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' )
				)				
			));		

			# sub-menu-link-top-left-radius
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'dimension',
				'settings' => 'sub-menu-link-top-left-radius',
				'label'    => __( 'Top Left Radius', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
				'output' => array( 
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a', 'property' => 'border-top-left-radius')
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'allow-sub-menu-link-radius', 'operator' => '==', 'value' => '1' ),
				)
			));

			# sub-menu-link-top-right-radius
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'dimension',
				'settings' => 'sub-menu-link-top-right-radius',
				'label'    => __( 'Top Right Radius', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
				'output' => array( 
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a', 'property' => 'border-top-right-radius')
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'allow-sub-menu-link-radius', 'operator' => '==', 'value' => '1' ),
				)						
			));

			# sub-menu-link-bottom-right-radius
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'dimension',
				'settings' => 'sub-menu-link-bottom-right-radius',
				'label'    => __( 'Bottom Right Radius', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
				'output' => array( 
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a', 'property' => 'border-bottom-right-radius')
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'allow-sub-menu-link-radius', 'operator' => '==', 'value' => '1' ),
				)						
			));

			# sub-menu-link-bottom-left-radius
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'dimension',
				'settings' => 'sub-menu-link-bottom-left-radius',
				'label'    => __( 'Bottom Left Radius', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
				'output' => array( 
					array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a', 'property' => 'border-bottom-left-radius')
				),
				'active_callback' => array(
					array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' ),
					array( 'setting' => 'allow-sub-menu-link-radius', 'operator' => '==', 'value' => '1' ),
				)						
			));
		# Sub Menu Link Border Radius

		# Sub Menu Link Icon Style
		BEGIN_Kirki::add_field( $config, array(
			'type'     => 'select',
			'settings' => 'sub-menu-style',
			'label'    => __( 'Sub Menu Link Icon Style', 'begin' ),
			'section'  => 'dt_site_sub_menu_section',
			'default'  => '',
			'choices'  => array(
				''	=> esc_html__('None','begin'),
				' menu-links-with-arrow single'	=> esc_html__('Single','begin'),
				' menu-links-with-arrow double'	=> esc_html__('Double','begin'),
				' menu-links-with-arrow disc'	=> esc_html__('Disc','begin'),
			),
			'active_callback' => array(
				array( 'setting' => 'customize-sub-menu-links', 'operator' => '==', 'value' => '1' )
			)				
		));
		# Sub Menu Link Icon Style

		# Mega Menu	
			# customize-mega-menu-title
			BEGIN_Kirki::add_field( $config, array(
				'type'     => 'switch',
				'settings' => 'customize-mega-menu-title',
				'label'    => __( 'Customize Mega Menu title ?', 'begin' ),
				'section'  => 'dt_site_sub_menu_section',
				'choices'  => array(
					'on'  => esc_attr__( 'Yes', 'begin' ),
					'off' => esc_attr__( 'No', 'begin' )
				)
			));
			# customize-mega-menu-title
			
			# Mega Menu Title Color
				# customize-mega-menu-title-color
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'customize-mega-menu-title-color',
					'label'    => __( 'Custom Colors - Mega Menu Title', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' )
					)				
				));
				# customize-mega-menu-title-color
				
				# mega-menu-title-color 			
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'mega-menu-title-color',
					'label'    => __( 'Mega Menu Title Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'output' => array(
						array( 'element' => '#main-menu .megamenu-child-container > ul.sub-menu > li > a, #main-menu .megamenu-child-container > ul.sub-menu > li > .nolink-menu' , 'property' => 'color' )
					),
					'choices' => array( 'alpha' => true ),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-color', 'operator' => '==', 'value' => '1' ),
					)		
				));
				# mega-menu-title-color 			

				# mega-menu-title-bg-color 			
				BEGIN_Kirki::add_field( $config, array(
					'type' => 'color',
					'settings' => 'mega-menu-title-bg-color',
					'label'    => __( 'Mega Menu Title BG Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'output' => array(
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu' , 'property' => 'background-color' )
					),
					'choices' => array( 'alpha' => true ),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-color', 'operator' => '==', 'value' => '1' ),
					)		
				));
				# mega-menu-title-bg-color
			# Mega Menu Title Color
			
			# Mega Menu Title Radius
				# customize-mega-menu-title-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'customize-mega-menu-title-radius',
					'label'    => __( 'Allow Mega Menu Title Radius?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' )
					)				
				));
				# customize-mega-menu-title-radius

				# mega-menu-title-top-left-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'mega-menu-title-top-left-radius',
					'label'    => __( 'Top Left Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-top-left-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-radius', 'operator' => '==', 'value' => '1' ),
					)
				));

				# mega-menu-title-top-right-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'mega-menu-title-top-right-radius',
					'label'    => __( 'Top Right Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-top-right-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));

				# mega-menu-title-bottom-right-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'mega-menu-title-bottom-right-radius',
					'label'    => __( 'Bottom Right Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-bottom-right-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));

				# mega-menu-title-bottom-left-radius
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'dimension',
					'settings' => 'mega-menu-title-bottom-left-radius',
					'label'    => __( 'Bottom Left Radius', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 100, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-bottom-left-radius')
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'customize-mega-menu-title-radius', 'operator' => '==', 'value' => '1' ),
					)						
				));				
			# Mega Menu Title Radius
			
			# Mega Menu Title Border 
				# allow-mega-menu-title-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'switch',
					'settings' => 'allow-mega-menu-title-border',
					'label'    => __( 'Apply Mega Menu Title Border?', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array(
						'on'  => esc_attr__( 'Yes', 'begin' ),
						'off' => esc_attr__( 'No', 'begin' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' )
					)				
				));
				# allow-mega-menu-title-border

				# mega-menu-title-border-style
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'select',
					'settings' => 'mega-menu-title-border-style',
					'label'    => __( 'Mega Menu Title Border Style', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'default'  => 'solid',
					'choices' => begin_border_styles(),
					'output' => array(
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-style'),
					),				
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' )
					)
				));

				# mega-menu-title-top-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'mega-menu-title-top-border',
					'label'    => __( 'Top Border', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-top-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'mega-menu-title-border-style', 'operator' => '!==', 'value' => 'none' ),
					)			
				));

				# mega-menu-title-right-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'mega-menu-title-right-border',
					'label'    => __( 'Right Border', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-right-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'mega-menu-title-border-style', 'operator' => '!==', 'value' => 'none' ),
					)			
				));

				# mega-menu-title-bottom-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'mega-menu-title-bottom-border',
					'label'    => __( 'Bottom Border', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-bottom-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'mega-menu-title-border-style', 'operator' => '!==', 'value' => 'none' ),
					)			
				));

				# mega-menu-title-left-border
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'slider',
					'settings' => 'mega-menu-title-left-border',
					'label'    => __( 'Left Border', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices'  => array( 'min'  => 1, 'max'  => 50, 'step' => 1 ),
					'output' => array( 
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-left-width', 'units' => 'px' )
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' ),					
						array( 'setting' => 'mega-menu-title-border-style', 'operator' => '!==', 'value' => 'none' ),
					)			
				));			

				# mega-menu-title-border-color
				BEGIN_Kirki::add_field( $config, array(
					'type'     => 'color',
					'settings' => 'mega-menu-title-border-color',
					'label'    => __( 'Mega Menu Title Border Color', 'begin' ),
					'section'  => 'dt_site_sub_menu_section',
					'choices' => array( 'alpha' => true ),
					'output' => array(
						array( 'element' => '#main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu', 'property' => 'border-color'),					
					),
					'active_callback' => array(
						array( 'setting' => 'customize-mega-menu-title', 'operator' => '==', 'value' => '1' ),
						array( 'setting' => 'allow-mega-menu-title-border', 'operator' => '==', 'value' => '1' )
					)
				));					
			# Mega Menu Title Border
		# Mega Menu