<?php
$config = begin_kirki_config();

# Menu Typography
BEGIN_Kirki::add_section( 'dt_menu_typo_section', array(
	'title' => __( 'Menu', 'begin' ),
	'panel' => 'dt_site_typography_panel',
	'priority' => 5
) );
	
	# customize-menu-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'customize-menu-typo',
		'label'    => __( 'Customize Menu Typo', 'begin' ),
		'section'  => 'dt_menu_typo_section',
		'default'  => begin_defaults( 'customize-menu-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# menu-typo
	BEGIN_Kirki::add_field( $config ,array(
		'type' => 'typography',
		'settings' => 'menu-typo',
		'label'    => __('Settings', 'begin'),
		'section'  => 'dt_menu_typo_section',
		'output' => array(
			array( 'element' => '#main-menu > ul.menu > li > a' )
		),
		'default' => begin_defaults('menu-typo'),
		'active_callback' => array(
			array( 'setting' => 'customize-menu-typo', 'operator' => '==', 'value' => '1' )
		)
	));

# Body Content
BEGIN_Kirki::add_section( 'dt_body_content_typo_section', array(
	'title' => __( 'Body', 'begin' ),
	'panel' => 'dt_site_typography_panel',
	'priority' => 10
) );
	
	# customize-body-content-typo
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'customize-body-content-typo',
		'label'    => __( 'Customize Content Typo', 'begin' ),
		'section'  => 'dt_body_content_typo_section',
		'default'  => begin_defaults( 'customize-body-content-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# body-content-typo
	BEGIN_Kirki::add_field( $config ,array(
		'type' => 'typography',
		'settings' => 'body-content-typo',
		'label'    => __('Settings', 'begin'),
		'section'  => 'dt_body_content_typo_section',
		'output' => array( 
			array( 'element' => 'body:not(.block-editor-page):not(.wp-core-ui), body:not(.block-editor-page):not(.wp-core-ui) pre' ),
			array(
				'element'  => '.editor-block-list__block, .editor-styles-wrapper .editor-rich-text p[role="textbox"]:not(.has-large-font-size),  .wp-block-code, .wp-block-preformatted pre, pre',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('body-content-typo'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),					
		'active_callback' => array(
			array( 'setting' => 'customize-body-content-typo', 'operator' => '==', 'value' => '1' )
		)
	));

BEGIN_Kirki::add_section( 'dt_headings_typo_section', array(
	'title' => __( 'Headings', 'begin' ),
	'panel' => 'dt_site_typography_panel',
	'priority' => 1
) );

	# H1
	# customize-body-h1-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h1-typo',
		'label'    => __( 'Customize H1 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h1-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h1 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h1',
		'label'    =>__('H1 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h1' ),
			array(
				'element'  => '.wp-block-heading h1, .editor-styles-wrapper .editor-post-title__block .editor-post-title__input',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h1'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),					
		'active_callback' => array(
			array( 'setting' => 'customize-body-h1-typo', 'operator' => '==', 'value' => '1' )
		)
	));

	# H1 Divider
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type'=> 'custom',
		'settings' => 'customize-body-h1-typo-divider',
		'section'  => 'dt_headings_typo_section',
		'default'  => '<div class="customize-control-divider"></div>'
	));

	# H2
	# customize-body-h2-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h2-typo',
		'label'    => __( 'Customize H2 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h2-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h2 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h2',
		'label'    =>__('H2 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h2' ),
			array(
				'element'  => '.wp-block-heading h2',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h2'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),									
		'active_callback' => array(
			array( 'setting' => 'customize-body-h2-typo', 'operator' => '==', 'value' => '1' )
		)
	));

	# H2 Divider
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type'=> 'custom',
		'settings' => 'customize-body-h2-typo-divider',
		'section'  => 'dt_headings_typo_section',
		'default'  => '<div class="customize-control-divider"></div>'
	));

	# H3
	# customize-body-h3-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h3-typo',
		'label'    => __( 'Customize H3 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h3-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h3 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h3',
		'label'    =>__('H3 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h3' ),
			array(
				'element'  => '.wp-block-heading h3',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h3'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),									
		'active_callback' => array(
			array( 'setting' => 'customize-body-h3-typo', 'operator' => '==', 'value' => '1' )
		)
	));

	# H3 Divider
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type'=> 'custom',
		'settings' => 'customize-body-h3-typo-divider',
		'section'  => 'dt_headings_typo_section',
		'default'  => '<div class="customize-control-divider"></div>'
	));

	# H4
	# customize-body-h4-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h4-typo',
		'label'    => __( 'Customize H4 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h4-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h4 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h4',
		'label'    =>__('H4 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h4' ),
			array(
				'element'  => '.wp-block-heading h4',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h4'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),									
		'active_callback' => array(
			array( 'setting' => 'customize-body-h4-typo', 'operator' => '==', 'value' => '1' )
		)
	));

	# H4 Divider
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type'=> 'custom',
		'settings' => 'customize-body-h4-typo-divider',
		'section'  => 'dt_headings_typo_section',
		'default'  => '<div class="customize-control-divider"></div>'
	));

	# H5
	# customize-body-h5-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h5-typo',
		'label'    => __( 'Customize H5 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h5-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h5 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h5',
		'label'    =>__('H5 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h5' ),
			array(
				'element'  => '.wp-block-heading h5',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h5'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),									
		'active_callback' => array(
			array( 'setting' => 'customize-body-h5-typo', 'operator' => '==', 'value' => '1' )
		)
	));

	# H5 Divider
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type'=> 'custom',
		'settings' => 'customize-body-h5-typo-divider',
		'section'  => 'dt_headings_typo_section',
		'default'  => '<div class="customize-control-divider"></div>'
	));

	# H6
	# customize-body-h6-typo
	BEGIN_Kirki::add_field( 'begin_kirki_config', array(
		'type'     => 'switch',
		'settings' => 'customize-body-h6-typo',
		'label'    => __( 'Customize H6 Tag', 'begin' ),
		'section'  => 'dt_headings_typo_section',
		'default'  => begin_defaults( 'customize-body-h6-typo' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# h6 tag typography	
	BEGIN_Kirki::add_field( 'begin_kirki_config' ,array(
		'type' => 'typography',
		'settings' => 'h6',
		'label'    =>__('H6 Tag Settings', 'begin'),
		'section'  => 'dt_headings_typo_section',
		'output' => array( 
			array( 'element' => 'h6' ),
			array(
				'element'  => '.wp-block-heading h6',
				'context'  => array( 'editor' ),
			),
		),
		'default' => begin_defaults('h6'),
		'choices'  => array(
			'variant' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic'
			),
		),									
		'active_callback' => array(
			array( 'setting' => 'customize-body-h6-typo', 'operator' => '==', 'value' => '1' )
		)
	));