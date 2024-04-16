<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => constant('BEGIN_THEME_NAME').' '.esc_html__('Options', 'begin'),
  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'cs-framework',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => constant('BEGIN_THEME_NAME') .' '.__('Admin Panel', 'begin'),
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

$options[]      = array(
  'name'        => 'general',
  'title'       => esc_html__('General', 'begin'),
  'icon'        => 'fa fa-gears',

  'fields'      => array(

	array(
	  'type'    => 'subheading',
	  'content' => esc_html__( 'General Options', 'begin' ),
	),

	array(
	  'id'  	 => 'show-pagecomments',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Globally Show Page Comments', 'begin'),
	  'info'	 => esc_html__('YES! to show comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings.', 'begin'),
	  'default'  => true,
	),

	array(
	  'id'  	 => 'showall-pagination',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Show all pages in Pagination', 'begin'),
	  'info'	 => esc_html__('YES! to show all the pages instead of dots near the current page.', 'begin')
	),

	array(
	  'id'  	 => 'enable-stylepicker',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Style Picker', 'begin'),
	  'info'	 => esc_html__('YES! to show the style picker.', 'begin')
	),

	array(
	  'id'  	 => 'use-site-loader',
	  'type'  	 => 'switcher',
	  'title' 	 => esc_html__('Site Loader', 'begin'),
	  'info'	 => esc_html__('YES! to use site loader.', 'begin')
	),

	array(
	  'id'      => 'google-map-key',
	  'type'    => 'text',
	  'title'   => esc_html__('Google Map API Key', 'begin'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put a valid google account api key here', 'begin').'</p>',
	),

	array(
	  'id'      => 'mailchimp-key',
	  'type'    => 'text',
	  'title'   => esc_html__('Mailchimp API Key', 'begin'),
	  'after' 	=> '<p class="cs-text-info">'.esc_html__('Put a valid mailchimp account api key here', 'begin').'</p>',
	),

  ),
);

$options[]      = array(
  'name'        => 'layout_options',
  'title'       => esc_html__('Layout Options', 'begin'),
  'icon'        => 'dashicons dashicons-exerpt-view',
  'sections' => array(

	// -----------------------------------------
	// Header Options
	// -----------------------------------------
	array(
	  'name'      => 'breadcrumb_options',
	  'title'     => esc_html__('Breadcrumb Options', 'begin'),
	  'icon'      => 'fa fa-sitemap',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Breadcrumb Options", 'begin' ),
		  ),

		  array(
			'id'  		 => 'show-breadcrumb',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Breadcrumb', 'begin'),
			'info'		 => esc_html__('YES! to display breadcrumb for all pages.', 'begin'),
			'default' 	 => true,
		  ),

		  array(
			'id'           => 'breadcrumb-delimiter',
			'type'         => 'select',
			'title'        => esc_html__('Breadcrumb Delimiter', 'begin'),
			'options'      => array(
			  'fa default' 					=> esc_html__('Default', 'begin'),
			  'fa fa-angle-double-right'    => esc_html__('Double Angle Right', 'begin'),
			  'fa fa-sort'  				=> esc_html__('Sort', 'begin'),
			  'fa fa-arrow-circle-right'    => esc_html__('Arrow Circle Right', 'begin'),
			  'fa fa-angle-right'     		=> esc_html__('Angle Right', 'begin'),
			  'fa fa-caret-right'  			=> esc_html__('Caret Right', 'begin'),
			  'fa fa-arrow-right'  			=> esc_html__('Arrow Right', 'begin'),
			  'fa fa-chevron-right'  		=> esc_html__('Chevron Right', 'begin'),
			  'fa fa-hand-o-right'  		=> esc_html__('Hand Right', 'begin'),
			  'fa fa-plus'  				=> esc_html__('Plus', 'begin'),
			  'fa fa-remove'  				=> esc_html__('Remove', 'begin'),
			  'fa fa-glass'  				=> esc_html__('Glass', 'begin'),
			),
			'class'        => 'chosen',
			'default'      => 'fa default',
			'info'         => esc_html__('Choose delimiter style to display on breadcrumb section.', 'begin'),
		  ),

		  array(
			'id'           => 'breadcrumb-style',
			'type'         => 'select',
			'title'        => esc_html__('Breadcrumb Style', 'begin'),
			'options'      => array(
			  'default' 							=> esc_html__('Default', 'begin'),
			  'aligncenter'    						=> esc_html__('Align Center', 'begin'),
			  'alignright'  						=> esc_html__('Align Right', 'begin'),
			  'breadcrumb-left'    					=> esc_html__('Left Side Breadcrumb', 'begin'),
			  'breadcrumb-right'     				=> esc_html__('Right Side Breadcrumb', 'begin'),
			  'breadcrumb-top-right-title-center'  	=> esc_html__('Top Right Title Center', 'begin'),
			  'breadcrumb-top-left-title-center'  	=> esc_html__('Top Left Title Center', 'begin'),
			),
			'class'        => 'chosen',
			'default'      => 'default',
			'info'         => esc_html__('Choose alignment style to display on breadcrumb section.', 'begin'),
		  ),

		  array(
			'id'    => 'breadcrumb_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'begin'),
			'desc'  => esc_html__('Choose background options for breadcrumb title section.', 'begin'),
			  'default'      => array(
			    'color'      => "#f1f1f1",
			  ),

		  ),

		),
	),

  ),
);

$options[]      = array(
  'name'        => 'allpage_options',
  'title'       => esc_html__('All Page Options', 'begin'),
  'icon'        => 'fa fa-files-o',
  'sections' => array(

	// -----------------------------------------
	// Post Options
	// -----------------------------------------
	array(
	  'name'      => 'post_options',
	  'title'     => esc_html__('Post Options', 'begin'),
	  'icon'      => 'fa fa-file',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Single Post Options", 'begin' ),
		  ),
		
		  array(
			'id'  		 => 'single-post-authorbox',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Single Author Box', 'begin'),
			'info'		 => esc_html__('YES! to display author box in single blog posts.', 'begin')
		  ),

		  array(
			'id'  		 => 'single-post-related',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Single Related Posts', 'begin'),
			'info'		 => esc_html__('YES! to display related blog posts in single posts.', 'begin')
		  ),

		  array(
			'id'  		 => 'single-post-comments',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Posts Comments', 'begin'),
			'info'		 => esc_html__('YES! to display single blog post comments.', 'begin'),
			'default' 	 => true,
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Post Archives Page Layout", 'begin' ),
		  ),

		  array(
			'id'      	 => 'post-archives-page-layout',
			'type'       => 'image_select',
			'title'      => esc_html__('Page Layout', 'begin'),
			'options'    => array(
			  'content-full-width'   => BEGIN_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => BEGIN_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'post-archives-page-layout',
			),
		  ),

		  array(
			'id'  		 => 'show-standard-left-sidebar-for-post-archives',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Standard Left Sidebar', 'begin'),
			'dependency' => array( 'post-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  		 => 'show-standard-right-sidebar-for-post-archives',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Show Standard Right Sidebar', 'begin'),
			'dependency' => array( 'post-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Post Archives Post Layout", 'begin' ),
		  ),

		  array(
			'id'      	   => 'post-archives-post-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Post Layout', 'begin'),
			'options'      => array(
			  'one-column' 		  => BEGIN_THEME_URI . '/cs-framework-override/images/one-column.png',
			  'one-half-column'   => BEGIN_THEME_URI . '/cs-framework-override/images/one-half-column.png',
			  'one-third-column'  => BEGIN_THEME_URI . '/cs-framework-override/images/one-third-column.png',
			),
			'default'      => 'one-half-column',
		  ),

		  array(
			'id'  		 => 'post-archives-enable-excerpt',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Allow Excerpt', 'begin'),
			'info'		 => esc_html__('YES! to allow excerpt', 'begin'),
			'default'    => true,
		  ),

		  array(
			'id'  		 => 'post-archives-excerpt',
			'type'  	 => 'number',
			'title' 	 => esc_html__('Excerpt Length', 'begin'),
			'after'		 => '<span class="cs-text-desc">&nbsp;'.esc_html__('Put Excerpt Length', 'begin').'</span>',
			'default' 	 => 40,
		  ),

		  array(
			'id'  		 => 'post-archives-enable-readmore',
			'type'  	 => 'switcher',
			'title' 	 => esc_html__('Read More', 'begin'),
			'info'		 => esc_html__('YES! to enable read more button', 'begin'),
			'default'	 => true,
		  ),

		  array(
			'id'  		 => 'post-archives-readmore',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Read More Shortcode', 'begin'),
			'info'		 => esc_html__('Paste any button shortcode here', 'begin'),
			'default'	 => '[dt_sc_button iconclass="fa fa-pencil" class="read-btn" title="" icon_type="fontawesome" target="_blank" /]',
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Single Post & Post Archive options", 'begin' ),
		  ),

		  array(
			'id'           => 'post-style',
			'type'         => 'select',
			'title'        => esc_html__('Post Style', 'begin'),
			'options'      => array(
			  'blog-default-style' 		=> esc_html__('Default', 'begin'),
			  'entry-date-left'      	=> esc_html__('Date Left', 'begin'),
			  'entry-date-author-left'  => esc_html__('Date and Author Left', 'begin'),
			  'blog-medium-style'       => esc_html__('Medium', 'begin'),
			  'blog-medium-style dt-blog-medium-highlight'     					 => esc_html__('Medium Hightlight', 'begin'),
			  'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight'  => esc_html__('Medium Skin Highlight', 'begin'),
			),
			'class'        => 'chosen',
			'default'      => 'blog-default-style',
			'info'         => esc_html__('Choose post style to display single blog posts and archives.', 'begin'),
		  ),
		  
		  array(
			'id'      => 'post-format-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Post Format Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post format meta information', 'begin'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-author-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Author Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post author meta information', 'begin'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-date-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Date Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post date meta information', 'begin'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-comment-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Comment Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post comment meta information', 'begin'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-category-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Category Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post category information', 'begin'),
			'default' => true
		  ),

		  array(
			'id'      => 'post-tag-meta',
			'type'    => 'switcher',
			'title'   => esc_html__('Tag Meta', 'begin' ),
			'info'	  => esc_html__('YES! to show post tag information', 'begin'),
			'default' => true
		  ),

		),
	),

	// -----------------------------------------
	// 404 Options
	// -----------------------------------------
	array(
	  'name'      => '404_options',
	  'title'     => esc_html__('404 Options', 'begin'),
	  'icon'      => 'fa fa-warning',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "404 Message", 'begin' ),
		  ),
		  
		  array(
			'id'      => 'enable-404message',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Message', 'begin' ),
			'info'	  => esc_html__('YES! to enable not-found page message.', 'begin'),
			'default' => true
		  ),

		  array(
			'id'           => 'notfound-style',
			'type'         => 'select',
			'title'        => esc_html__('Template Style', 'begin'),
			'options'      => array(
			  'type1' 	   => esc_html__('Modern', 'begin'),
			  'type2'      => esc_html__('Classic', 'begin'),
			  'type4'  	   => esc_html__('Diamond', 'begin'),
			  'type5'      => esc_html__('Shadow', 'begin'),
			  'type6'      => esc_html__('Diamond Alt', 'begin'),
			  'type7'  	   => esc_html__('Stack', 'begin'),
			  'type8'  	   => esc_html__('Minimal', 'begin'),
			),
			'class'        => 'chosen',
			'default'      => 'type1',
			'info'         => esc_html__('Choose the style of not-found template page.', 'begin')
		  ),

		  array(
			'id'      => 'notfound-darkbg',
			'type'    => 'switcher',
			'title'   => esc_html__('404 Dark BG', 'begin' ),
			'info'	  => esc_html__('YES! to use dark bg notfound page for this site.', 'begin')
		  ),

		  array(
			'id'           => 'notfound-pageid',
			'type'         => 'select',
			'title'        => esc_html__('Custom Page', 'begin'),
			'options'      => 'pages',
			'class'        => 'chosen',
			'default_option' => esc_html__('Choose the page', 'begin'),
			'info'       	 => esc_html__('Choose the page for not-found content.', 'begin')
		  ),
		  
		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Background Options", 'begin' ),
		  ),

		  array(
			'id'    => 'notfound_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'begin')
		  ),

		  array(
			'id'  		 => 'notfound-bg-style',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Custom Styles', 'begin'),
			'info'		 => esc_html__('Paste custom CSS styles for not found page.', 'begin')
		  ),

		),
	),

	// -----------------------------------------
	// Underconstruction Options
	// -----------------------------------------
	array(
	  'name'      => 'comingsoon_options',
	  'title'     => esc_html__('Under Construction Options', 'begin'),
	  'icon'      => 'fa fa-thumbs-down',

		'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Under Construction", 'begin' ),
		  ),
	
		  array(
			'id'      => 'enable-comingsoon',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Coming Soon', 'begin' ),
			'info'	  => esc_html__('YES! to check under construction page of your website.', 'begin')
		  ),
	
		  array(
			'id'           => 'comingsoon-style',
			'type'         => 'select',
			'title'        => esc_html__('Template Style', 'begin'),
			'options'      => array(
			  'type1' 	   => esc_html__('Diamond', 'begin'),
			  'type2'      => esc_html__('Teaser', 'begin'),
			  'type3'  	   => esc_html__('Minimal', 'begin'),
			  'type4'      => esc_html__('Counter Only', 'begin'),
			  'type5'      => esc_html__('Belt', 'begin'),
			  'type6'  	   => esc_html__('Classic', 'begin'),
			  'type7'  	   => esc_html__('Boxed', 'begin')
			),
			'class'        => 'chosen',
			'default'      => 'type1',
			'info'         => esc_html__('Choose the style of coming soon template.', 'begin'),
		  ),

		  array(
			'id'      => 'uc-darkbg',
			'type'    => 'switcher',
			'title'   => esc_html__('Coming Soon Dark BG', 'begin' ),
			'info'	  => esc_html__('YES! to use dark bg coming soon page for this site.', 'begin')
		  ),

		  array(
			'id'           => 'comingsoon-pageid',
			'type'         => 'select',
			'title'        => esc_html__('Custom Page', 'begin'),
			'options'      => 'pages',
			'class'        => 'chosen',
			'default_option' => esc_html__('Choose the page', 'begin'),
			'info'       	 => esc_html__('Choose the page for comingsoon content.', 'begin')
		  ),

		  array(
			'id'      => 'show-launchdate',
			'type'    => 'switcher',
			'title'   => esc_html__('Show Launch Date', 'begin' ),
			'info'	  => esc_html__('YES! to show launch date text.', 'begin'),
		  ),

		  array(
			'id'      => 'comingsoon-launchdate',
			'type'    => 'text',
			'title'   => esc_html__('Launch Date', 'begin'),
			'attributes' => array( 
			  'placeholder' => '10/30/2016 12:00:00'
			),
			'after' 	=> '<p class="cs-text-info">'.esc_html__('Put Format: 12/30/2016 12:00:00 month/day/year hour:minute:second', 'begin').'</p>',
		  ),

		  array(
			'id'           => 'comingsoon-timezone',
			'type'         => 'select',
			'title'        => esc_html__('UTC Timezone', 'begin'),
			'options'      => array(
			  '-12' => '-12', '-11' => '-11', '-10' => '-10', '-9' => '-9', '-8' => '-8', '-7' => '-7', '-6' => '-6', '-5' => '-5', 
			  '-4' => '-4', '-3' => '-3', '-2' => '-2', '-1' => '-1', '0' => '0', '+1' => '+1', '+2' => '+2', '+3' => '+3', '+4' => '+4',
			  '+5' => '+5', '+6' => '+6', '+7' => '+7', '+8' => '+8', '+9' => '+9', '+10' => '+10', '+11' => '+11', '+12' => '+12'
			),
			'class'        => 'chosen',
			'default'      => '0',
			'info'         => esc_html__('Choose utc timezone, by default UTC:00:00', 'begin'),
		  ),

		  array(
			'id'    => 'comingsoon_background',
			'type'  => 'background',
			'title' => esc_html__('Background', 'begin')
		  ),

		  array(
			'id'  		 => 'comingsoon-bg-style',
			'type'  	 => 'textarea',
			'title' 	 => esc_html__('Custom Styles', 'begin'),
			'info'		 => esc_html__('Paste custom CSS styles for under construction page.', 'begin'),
		  ),

		),
	),

  ),
);

// -----------------------------------------
// Widget area Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'widgetarea_options',
  'title'       => esc_html__('Widget Area', 'begin'),
  'icon'        => 'fa fa-trello',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Custom Widget Area for Sidebar", 'begin' ),
	  ),

	  array(
		'id'           => 'wtitle-style',
		'type'         => 'select',
		'title'        => esc_html__('Sidebar widget Title Style', 'begin'),
		'options'      => array(
		  'type1' 	   => esc_html__('Double Border', 'begin'),
		  'type2'      => esc_html__('Tooltip', 'begin'),
		  'type3'  	   => esc_html__('Title Top Border', 'begin'),
		  'type4'      => esc_html__('Left Border & Pattren', 'begin'),
		  'type5'      => esc_html__('Bottom Border', 'begin'),
		  'type6'  	   => esc_html__('Tooltip Border', 'begin'),
		  'type7'  	   => esc_html__('Boxed Modern', 'begin'),
		  'type8'  	   => esc_html__('Elegant Border', 'begin'),
		  'type9' 	   => esc_html__('Needle', 'begin'),
		  'type10' 	   => esc_html__('Ribbon', 'begin'),
		  'type11' 	   => esc_html__('Content Background', 'begin'),
		  'type12' 	   => esc_html__('Classic BG', 'begin'),
		  'type13' 	   => esc_html__('Tiny Boders', 'begin'),
		  'type14' 	   => esc_html__('BG & Border', 'begin'),
		  'type15' 	   => esc_html__('Classic BG Alt', 'begin'),
		  'type16' 	   => esc_html__('Left Border & BG', 'begin'),
		  'type17' 	   => esc_html__('Basic', 'begin'),
		  'type18' 	   => esc_html__('BG & Pattern', 'begin'),
		),
		'class'          => 'chosen',
		'default_option' => esc_html__('Choose any type', 'begin'),
		'info'           => esc_html__('Choose the style of sidebar widget title.', 'begin')
	  ),

	  array(
		'id'              => 'widgetarea-custom',
		'type'            => 'group',
		'title'           => esc_html__('Custom Widget Area', 'begin'),
		'button_title'    => esc_html__('Add New', 'begin'),
		'accordion_title' => esc_html__('Add New Widget Area', 'begin'),
		'fields'          => array(

		  array(
			'id'          => 'widgetarea-custom-name',
			'type'        => 'text',
			'title'       => esc_html__('Name', 'begin'),
		  ),

		)
	  ),

	),
);

// -----------------------------------------
// Woocommerce Options
// -----------------------------------------
if( function_exists( 'is_woocommerce' ) ){

	$options[]      = array(
	  'name'        => 'woocommerce_options',
	  'title'       => esc_html__('Woocommerce', 'begin'),
	  'icon'        => 'fa fa-shopping-cart',

	  'fields'      => array(

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Woocommerce Shop Page Options", 'begin' ),
		  ),

		  array(
			'id'  		 => 'shop-product-per-page',
			'type'  	 => 'number',
			'title' 	 => esc_html__('Products Per Page', 'begin'),
			'after'		 => '<span class="cs-text-desc">&nbsp;'.esc_html__('Number of products to show in catalog / shop page', 'begin').'</span>',
			'default' 	 => 12,
		  ),

		  array(
			'id'           => 'product-style',
			'type'         => 'select',
			'title'        => esc_html__('Product Style', 'begin'),
			'options'      => array(
			  'type1' 	   => esc_html__('Thick Border', 'begin'),
			  'type2'      => esc_html__('Pattern Overlay', 'begin'),
			  'type3'  	   => esc_html__('Thin Border', 'begin'),
			  'type4'      => esc_html__('Diamond Icons', 'begin'),
			  'type5'      => esc_html__('Girly', 'begin'),
			  'type6'  	   => esc_html__('Push Animation', 'begin'),
			  'type7' 	   => esc_html__('Dual Color BG', 'begin'),
			  'type8' 	   => esc_html__('Modern', 'begin'),
			  'type9' 	   => esc_html__('Diamond & Border', 'begin'),
			  'type10' 	   => esc_html__('Easing', 'begin'),
			  'type11' 	   => esc_html__('Boxed', 'begin'),
			  'type12' 	   => esc_html__('Easing Alt', 'begin'),
			  'type13' 	   => esc_html__('Parallel', 'begin'),
			  'type14' 	   => esc_html__('Pointer', 'begin'),
			  'type15' 	   => esc_html__('Diamond Flip', 'begin'),
			  'type16' 	   => esc_html__('Stack', 'begin'),
			  'type17' 	   => esc_html__('Bouncy', 'begin'),
			  'type18' 	   => esc_html__('Hexagon', 'begin'),
			  'type19' 	   => esc_html__('Masked Diamond', 'begin'),
			  'type20' 	   => esc_html__('Masked Circle', 'begin'),
			  'type21' 	   => esc_html__('Classic', 'begin'),
			),
			'class'        => 'chosen',
			'default' 	   => 'type1',
			'info'         => esc_html__('Choose products style to display shop & archive pages.', 'begin')
		  ),

		  array(
			'id'      	 => 'shop-page-product-layout',
			'type'       => 'image_select',
			'title'      => esc_html__('Product Layout', 'begin'),
			'options'    => array(
			  'one-half-column'     => BEGIN_THEME_URI . '/cs-framework-override/images/one-half-column.png',
			  'one-third-column'    => BEGIN_THEME_URI . '/cs-framework-override/images/one-third-column.png',
			  'one-fourth-column'   => BEGIN_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
			),
			'default'      => 'one-third-column',
			'attributes'   => array(
			  'data-depend-id' => 'shop-page-product-layout',
			),
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Detail Page Options", 'begin' ),
		  ),

		  array(
			'id'      	   => 'product-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'begin'),
			'options'      => array(
			  'content-full-width'   => BEGIN_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => BEGIN_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'begin'),
			'dependency'   	 => array( 'product-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'begin'),
			'dependency' 	 => array( 'product-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  		 	 => 'enable-related',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Related Products', 'begin'),
			'info'	  		 => esc_html__("YES! to display related products on single product's page.", 'begin')
		  ),

		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Category Page Options", 'begin' ),
		  ),

		  array(
			'id'      	   => 'product-category-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'begin'),
			'options'      => array(
			  'content-full-width'   => BEGIN_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => BEGIN_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-category-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-category-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'begin'),
			'dependency'   	 => array( 'product-category-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-category-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'begin'),
			'dependency' 	 => array( 'product-category-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),
		  
		  array(
			'type'    => 'subheading',
			'content' => esc_html__( "Product Tag Page Options", 'begin' ),
		  ),

		  array(
			'id'      	   => 'product-tag-layout',
			'type'         => 'image_select',
			'title'        => esc_html__('Layout', 'begin'),
			'options'      => array(
			  'content-full-width'   => BEGIN_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
			  'with-left-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
			  'with-right-sidebar'   => BEGIN_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
			  'with-both-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
			),
			'default'      => 'content-full-width',
			'attributes'   => array(
			  'data-depend-id' => 'product-tag-layout',
			),
		  ),

		  array(
			'id'  		 	 => 'show-shop-standard-left-sidebar-for-product-tag-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Left Sidebar', 'begin'),
			'dependency'   	 => array( 'product-tag-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
		  ),

		  array(
			'id'  			 => 'show-shop-standard-right-sidebar-for-product-tag-layout',
			'type'  		 => 'switcher',
			'title' 		 => esc_html__('Show Shop Standard Right Sidebar', 'begin'),
			'dependency' 	 => array( 'product-tag-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
		  ),

	  ),
	);
}

// -----------------------------------------
// Sociable Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'sociable_options',
  'title'       => esc_html__('Sociable', 'begin'),
  'icon'        => 'fa fa-chrome',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Sociable", 'begin' ),
	  ),

	  array(
		'id'              => 'sociable_fields',
		'type'            => 'group',
		'title'           => esc_html__('Sociable', 'begin'),
		'info'            => esc_html__('Click button to add type of social & url.', 'begin'),
		'button_title'    => esc_html__('Add New Social', 'begin'),
		'accordion_title' => esc_html__('Adding New Social Field', 'begin'),
		'fields'          => array(
		  array(
			'id'          => 'sociable_fields_type',
			'type'        => 'select',
			'title'       => esc_html__('Select Social', 'begin'),
			'options'      => array(
			  'delicious' 	 => esc_html__('Delicious', 'begin'),
			  'deviantart' 	 => esc_html__('Deviantart', 'begin'),
			  'digg' 	  	 => esc_html__('Digg', 'begin'),
			  'dribbble' 	 => esc_html__('Dribbble', 'begin'),
			  'envelope' 	 => esc_html__('Envelope', 'begin'),
			  'facebook' 	 => esc_html__('Facebook', 'begin'),
			  'flickr' 		 => esc_html__('Flickr', 'begin'),
			  'google-plus'  => esc_html__('Google Plus', 'begin'),
			  'gtalk'  		 => esc_html__('GTalk', 'begin'),
			  'instagram'	 => esc_html__('Instagram', 'begin'),
			  'lastfm'	 	 => esc_html__('Lastfm', 'begin'),
			  'linkedin'	 => esc_html__('Linkedin', 'begin'),
			  'myspace'		 => esc_html__('Myspace', 'begin'),
			  'picasa'		 => esc_html__('Picasa', 'begin'),
			  'pinterest'	 => esc_html__('Pinterest', 'begin'),
			  'reddit'		 => esc_html__('Reddit', 'begin'),
			  'rss'		 	 => esc_html__('RSS', 'begin'),
			  'skype'		 => esc_html__('Skype', 'begin'),
			  'stumbleupon'	 => esc_html__('Stumbleupon', 'begin'),
			  'technorati'	 => esc_html__('Technorati', 'begin'),
			  'tumblr'		 => esc_html__('Tumblr', 'begin'),
			  'twitter'		 => esc_html__('Twitter', 'begin'),
			  'viadeo'		 => esc_html__('Viadeo', 'begin'),
			  'vimeo'		 => esc_html__('Vimeo', 'begin'),
			  'yahoo'		 => esc_html__('Yahoo', 'begin'),
			  'youtube'		 => esc_html__('Youtube', 'begin'),
			),
			'class'        => 'chosen',
		  ),

		  array(
			'id'          => 'sociable_fields_url',
			'type'        => 'text',
			'title'       => esc_html__('Enter URL', 'begin')
		  ),
		)
	  ),

   ),
);

// -----------------------------------------
// Hook Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'hook_options',
  'title'       => esc_html__('Hooks', 'begin'),
  'icon'        => 'fa fa-paperclip',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Top Hook", 'begin' ),
	  ),

	  array(
		'id'  	=> 'enable-top-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Top Hook', 'begin'),
		'info'	=> esc_html__("YES! to enable top hook.", 'begin')
	  ),

	  array(
		'id'  		 => 'top-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Top Hook', 'begin'),
		'info'		 => esc_html__('Paste your top hook, Executes after the opening &lt;body&gt; tag.', 'begin')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Content Before Hook", 'begin' ),
	  ),

	  array(
		'id'  	=> 'enable-content-before-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Content Before Hook', 'begin'),
		'info'	=> esc_html__("YES! to enable content before hook.", 'begin')
	  ),

	  array(
		'id'  		 => 'content-before-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Content Before Hook', 'begin'),
		'info'		 => esc_html__('Paste your content before hook, Executes before the opening &lt;#primary&gt; tag.', 'begin')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Content After Hook", 'begin' ),
	  ),

	  array(
		'id'  	=> 'enable-content-after-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Content After Hook', 'begin'),
		'info'	=> esc_html__("YES! to enable content after hook.", 'begin')
	  ),

	  array(
		'id'  		 => 'content-after-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Content After Hook', 'begin'),
		'info'		 => esc_html__('Paste your content after hook, Executes after the closing &lt;/#main&gt; tag.', 'begin')
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Bottom Hook", 'begin' ),
	  ),

	  array(
		'id'  	=> 'enable-bottom-hook',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Bottom Hook', 'begin'),
		'info'	=> esc_html__("YES! to enable bottom hook.", 'begin')
	  ),

	  array(
		'id'  		 => 'bottom-hook',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Bottom Hook', 'begin'),
		'info'		 => esc_html__('Paste your bottom hook, Executes after the closing &lt;/body&gt; tag.', 'begin')
	  ),

   array(
		'id'  	=> 'enable-analytics-code',
		'type'  => 'switcher',
		'title' => esc_html__('Enable Tracking Code', 'begin'),
		'info'	=> esc_html__("YES! to enable site tracking code.", 'begin')
	  ),

	  array(
		'id'  		 => 'analytics-code',
		'type'  	 => 'textarea',
		'title' 	 => esc_html__('Google Analytics Tracking Code', 'begin'),
		'info'		 => esc_html__('Either enter your Google tracking id (UA-XXXXX-X) or your full Google Analytics tracking Code here. If you want to offer your visitors the option to stop being tracked you can place the shortcode [dt_sc_privacy_google_tracking] somewhere on your site', 'begin')
	  ),

   ),
);

// -----------------------------------------
// Privacy & Cookie Options
// -----------------------------------------
$options[]      = array(
  'name'        => 'privacy_options',
  'title'       => esc_html__('Privacy and Cookies', 'begin'),
  'icon'        => 'fa fa-low-vision',

  'fields'      => array(

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Privacy Policy", 'begin' ),
	  ),

	  array(
		'type'    => 'notice',
		'class'   => 'warning',
		'content' => esc_html__('In case you deal with any EU customers/visitors these options allow you to make your site GDPR compliant.', 'begin')
	  ),

	  array(
		'id'      => 'privacy-commentform',
		'type'    => 'checkbox',
		'title'   => esc_html__('Append a privacy policy message to your comment form?', 'begin'),
		'label'   => esc_html__('Check to append a message to the comment form for unregistered users. Commenting without consent is no longer possible', 'begin')
	  ),

	  array(
		'id'  	  => 'privacy-commentform-msg',
		'type'    => 'textarea',
		'title'   => esc_html__('Message below comment form', 'begin'),
		'info'	  => esc_html__('A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'begin'),
		'default' => esc_html__('I agree to the terms and conditions laid out in the [dt_sc_privacy_link]Privacy Policy[/dt_sc_privacy_link]', 'begin'),
		'dependency' => array( 'privacy-commentform', '==', 'true' )
	  ),

	  array(
		'id'      => 'privacy-subscribeform',
		'type'    => 'checkbox',
		'title'   => esc_html__('Append a privacy policy message to mailchimp contact forms?', 'begin'),
		'label'   => esc_html__('Check to append a message to all of your mailchimp forms.', 'begin')
	  ),

	  array(
		'id'  	  => 'privacy-subscribeform-msg',
		'type'    => 'textarea',
		'title'   => esc_html__('Message below mailchimp subscription forms', 'begin'),
		'info'	  => esc_html__('A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'begin'),
		'default' => esc_html__('I agree to the terms and conditions laid out in the [dt_sc_privacy_link]Privacy Policy[/dt_sc_privacy_link]', 'begin'),
		'dependency' => array( 'privacy-subscribeform', '==', 'true' )
	  ),

	  array(
		'id'      => 'privacy-loginform',
		'type'    => 'checkbox',
		'title'   => esc_html__('Append a privacy policy message to your login forms?', 'begin'),
		'label'   => esc_html__('Check to append a message to the default login and registrations forms.', 'begin')
	  ),

	  array(
		'id'  	  => 'privacy-loginform-msg',
		'type'    => 'textarea',
		'title'   => esc_html__('Message below login forms', 'begin'),
		'info'	  => esc_html__('A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'begin'),
		'default' => esc_html__('I agree to the terms and conditions laid out in the [dt_sc_privacy_link]Privacy Policy[/dt_sc_privacy_link]', 'begin'),
		'dependency' => array( 'privacy-loginform', '==', 'true' )
	  ),

	  array(
		'type'    => 'subheading',
		'content' => esc_html__( "Cookie Consent Message", 'begin' ),
	  ),

	  array(

		'type'    => 'notice',
		'class'   => 'warning',
		'content' => __("Make your site comply with the <a target='_blank' href='http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm'>EU cookie law</a> by informing users that your site uses cookies. <br><br> You can also use the field to display a one time message not related to cookies if you are using a plugin for this purpose or do not need to inform your customers about the use of cookies.",'begin'),
	  ),

	  array(
		'id'      => 'enable-cookie-consent',
		'type'    => 'checkbox',
		'title'   => esc_html__('Cookie Message Bar', 'begin'),
		'label'   => esc_html__('Enable cookie consent message bar', 'begin'),
	  ),

	  array(
		'id'  	  => 'cookie-consent-msg',
		'type'    => 'textarea',
		'title'   => esc_html__('Message', 'begin'),
		'info'	  => esc_html__('Provide a message which indicates that your site uses cookies.', 'begin'),
		'default' => esc_html__('This site uses cookies. By continuing to browse the site, you are agreeing to our use of cookies.', 'begin'),
		'dependency' => array( 'enable-cookie-consent', '==', 'true' )
	  ),

	  array(
		'id'           => 'cookie-bar-position',
		'type'         => 'select',
		'title'        => esc_html__('Message Bar Position', 'begin'),
		'options'      => array(
		  'top' 	     => esc_html__('Top', 'begin'),
		  'bottom'       => esc_html__('Bottom', 'begin'),
		  'top-left' 	 => esc_html__('Top Left Corner', 'begin'),
		  'top-right' 	 => esc_html__('Top Right Corner', 'begin'),
		  'bottom-left'	 => esc_html__('Bottom Left Corner', 'begin'),
		  'bottom-right' => esc_html__('Bottom Right Corner', 'begin'),
		),
		'class'        => 'chosen',
		'default' 	   => 'bottom',
		'dependency'   => array( 'enable-cookie-consent', '==', 'true' ),
		'info'         => esc_html__('Where on the page should the message bar appear?', 'begin')
	  ),

	  array(
		'type'         => 'subheading',
		'content'      => esc_html__( "Buttons", 'begin' ),
		'dependency'   => array( 'enable-cookie-consent', '==', 'true' ),
	  ),

	  array(
		'id'              => 'cookie-bar-buttons',
		'type'            => 'group',
		'title'           => esc_html__('Buttons', 'begin'),
		'desc'            => esc_html__('You can create any number of buttons/links for your message bar here:', 'begin'),
		'button_title'    => esc_html__('Add New Button', 'begin'),
		'accordion_title' => esc_html__('Adding New Button', 'begin'),
		'dependency'      => array( 'enable-cookie-consent', '==', 'true' ),
		'fields'          => array(
		  array(
			'id'          => 'cookie-bar-button-label',
			'type'        => 'text',
			'title'       => esc_html__('Button Label', 'begin')
		  ),
		  array(
			'id'           => 'cookie-button-action',
			'type'         => 'select',
			'title'        => esc_html__('Button Action', 'begin'),
			'options'      => array(
			  '' 	       => esc_html__('Dismiss the notification', 'begin'),
			  'link'       => esc_html__('Link to another page', 'begin'),
			  'info_modal' => esc_html__('Open info modal on privacy and cookies', 'begin')
			),
			'class'        => 'chosen',
			'default' 	   => ''
		  ),
		  array(
			'id'         => 'cookie-bar-button-link',
			'type'       => 'text',
			'title'      => esc_html__('Button Link', 'begin'),
			'dependency' => array( 'cookie-button-action', '==', 'link' )
		  ),
		)
	  ),

	  array(
		'type'       => 'subheading',
		'content'    => esc_html__( "Modal Window with privacy and cookie info", 'begin' ),
		'dependency' => array( 'enable-cookie-consent', '==', 'true' ),
	  ),

	  array(
		'id'         => 'enable-custom-model-content',
		'type'       => 'checkbox',
		'title'		 => esc_html__('Model Window Custom Content', 'begin'),
		'label'      => esc_html__('Instead of displaying the default content set custom content yourself', 'begin'),
		'dependency' => array( 'enable-cookie-consent', '==', 'true' )
	  ),

	  array(
		'id'         => 'custom-model-heading',
		'type'       => 'text',
		'title'      => esc_html__('Main Heading', 'begin'),
		'default'    => esc_html__('Cookie and Privacy Settings', 'begin'),
		'dependency' => array( 'enable-custom-model-content', '==', 'true' )
	  ),

	  array(
		'id'              => 'custom-model-tabs',
		'type'            => 'group',
		'title'           => esc_html__('Model Window Tabs', 'begin'),
		'desc'            => esc_html__('You can create any number of tabs for your model window here:', 'begin'),
		'button_title'    => esc_html__('Add New Tab', 'begin'),
		'accordion_title' => esc_html__('Adding New Tab', 'begin'),
		'dependency'      => array( 'enable-custom-model-content', '==', 'true' ),
		'fields'          => array(
		  array(
			'id'          => 'label',
			'type'        => 'text',
			'title'       => esc_html__('Tab Label', 'begin')
		  ),
		  array(
			'id'  	 	  => 'content',
			'type'    	  => 'textarea',
			'title'  	  => esc_html__('Tab Content', 'begin'),
		  ),
		)
	  ),

   ),
);


// ------------------------------
// backup                       
// ------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => esc_html__('Backup', 'begin'),
  'icon'     => 'fa fa-shield',
  'fields'   => array(

    array(
      'type'    => 'notice',
      'class'   => 'warning',
      'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'begin')
    ),

    array(
      'type'    => 'backup',
    ),

  )
);

// ------------------------------
// license
// ------------------------------
$options[]   = array(
  'name'     => 'theme_version',
  'title'    => constant('BEGIN_THEME_NAME').esc_html__(' Log', 'begin'),
  'icon'     => 'fa fa-info-circle',
  'fields'   => array(

    array(
      'type'    => 'heading',
      'content' => constant('BEGIN_THEME_NAME').esc_html__(' Theme Change Log', 'begin')
    ),
    array(
      'type'    => 'content',
      'content' => '<pre>

2019.02.05 - version 1.6

 * Gutenberg compatible
 * Latest WordPress version 5.0.3 compatible
 * Updated latest version of all third party plugins
 * Some design tweaks
       
2018.11.10 - version 1.5
 * Gutenberg plugin compatible
 * Latest wordpress version 4.9.8 compatible
 * Updated latest version of all third party plugins
 * Updated documentation

2018.07.31 - version 1.4
 * GDPR Compliant update in comment form, mailchimp form etc.
 * Packed with - Layer Slider 6.7.6
 * Packed with - Revolution Slider 5.4.8
 * Packed with - WPBakery Page Builder 5.5.2
 * Packed with - Ultimate Addons for Visual Composer 3.16.24
 * Packed with - Envato Market 2.0.0
 * Fix - Option for change the site title color
 * Fix - Woocommerce outdated files
 * Fix - Nav Menu Role Plugin compatible
 * Fix - Woocommerce custom sidebar issue
 * Fix - Add target attribute for social media
 * Fix - Bulk plugins install issue
 * Fix - Unyson Page Builder Conflict
 * Fix - Twitter feeds links issue
 * Fix - Iphone sidebar issue
 * Fix - Buddypress issue
 * Fix - Youtube and Vimeo video issue in https
 * Updated designthemes core features plugin
 * Updated language files

2017.09.21 - version 1.3
 * Bug Fixes

2017.09.16 - version 1.2
 * Dummy data updated with latest home pages

2017.09.11 - version 1.1
 * Updated dummy data

2017.09.08 - version 1.0
 * First release!  </pre>',
    ),

  )
);

// ------------------------------
// Seperator
// ------------------------------
$options[] = array(
  'name'   => 'seperator_1',
  'title'  => esc_html__('Plugin Options', 'begin'),
  'icon'   => 'fa fa-plug'
);


CSFramework::instance( $settings, $options );