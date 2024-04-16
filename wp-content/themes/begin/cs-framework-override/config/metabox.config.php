<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

// -----------------------------------------
// Custom Widgets                    -
// -----------------------------------------
function begin_custom_widgets() {
  $custom_widgets = array();
  $widgets = is_array( cs_get_option( 'widgetarea-custom' ) ) ? cs_get_option( 'widgetarea-custom' ) : array();
  $widgets = array_filter($widgets);

  if( isset( $widgets ) ):
    foreach ( $widgets as $widget ) :
      $id = mb_convert_case($widget['widgetarea-custom-name'], MB_CASE_LOWER, "UTF-8");
      $id = str_replace(" ", "-", $id);
      $custom_widgets[$id] = $widget['widgetarea-custom-name'];
    endforeach;
  endif;

  return $custom_widgets;
}

// -----------------------------------------
// Layer Sliders
// -----------------------------------------
function begin_layersliders() {
  $layerslider = array(  esc_html__('Select a slider','begin') );

  if( begin_is_plugin_active('LayerSlider/layerslider.php') ) {

    $sliders = LS_Sliders::find(array('limit' => 50));

    if(!empty($sliders)) {
      foreach($sliders as $key => $item){
        $layerslider[ $item['id'] ] = $item['name'];
      }
    }
  }

  return $layerslider;
}

// -----------------------------------------
// Revolution Sliders
// -----------------------------------------
function begin_revolutionsliders() {
  $revolutionslider = array( '' => esc_html__('Select a slider','begin') );

  if(begin_is_plugin_active('revslider/revslider.php')) {
    $sld = new RevSlider();
    $sliders = $sld->getArrSliders();
    if(!empty($sliders)){
      foreach($sliders as $key => $item) {
        $revolutionslider[$item->getAlias()] = $item->getTitle();
      }
    }    
  }

  return $revolutionslider;  
}

// -----------------------------------------
// Meta Layout Section
// -----------------------------------------
$meta_layout_section =array(
  'name'  => 'layout_section',
  'title' => esc_html__('Layout', 'begin'),
  'icon'  => 'fa fa-columns',
  'fields' =>  array(
    array(
      'id'  => 'layout',
      'type' => 'image_select',
      'title' => esc_html__('Page Layout', 'begin' ),
      'options'      => array(
          'content-full-width'   => BEGIN_THEME_URI . '/cs-framework-override/images/without-sidebar.png',
          'with-left-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/left-sidebar.png',
          'with-right-sidebar'   => BEGIN_THEME_URI . '/cs-framework-override/images/right-sidebar.png',
          'with-both-sidebar'    => BEGIN_THEME_URI . '/cs-framework-override/images/both-sidebar.png',
          'fullwidth'            => BEGIN_THEME_URI . '/cs-framework-override/images/fullwidth.png',
      ),
      'default'      => 'content-full-width',
	  'info'		 => esc_html__('Layout "fullwidth" only apply for portfolio template.', 'begin'),
      'attributes'   => array( 'data-depend-id' => 'page-layout' )
    ),
    array(
      'id'        => 'show-standard-sidebar-left',
      'type'      => 'switcher',
      'title'     => esc_html__('Show Standard Left Sidebar', 'begin' ),
      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'        => 'widget-area-left',
      'type'      => 'select',
      'title'     => esc_html__('Choose Left Widget Areas', 'begin' ),
      'class'     => 'chosen',
      'options'   => begin_custom_widgets(),
      'attributes'  => array( 
        'multiple'  => 'multiple',
        'data-placeholder' => esc_html__('Select Left Widget Areas','begin'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'          => 'show-standard-sidebar-right',
      'type'        => 'switcher',
      'title'       => esc_html__('Show Standard Right Sidebar', 'begin' ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'        => 'widget-area-right',
      'type'      => 'select',
      'title'     => esc_html__('Choose Right Widget Areas', 'begin' ),
      'class'     => 'chosen',
      'options'   => begin_custom_widgets(),
      'attributes'    => array( 
        'multiple' => 'multiple',
        'data-placeholder' => esc_html__('Select Right Widget Areas','begin'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
    )
  )
);

// -----------------------------------------
// Meta Breadcrumb Section
// -----------------------------------------
$meta_breadcrumb_section = array(
  'name'  => 'breadcrumb_section',
  'title' => esc_html__('Breadcrumb', 'begin'),
  'icon'  => 'fa fa-arrows-h',
  'fields' =>  array(
    array(
      'id'      => 'enable-sub-title',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Breadcrumb', 'begin' ),
      'default' => true
    ),
    array(
      'id'    => 'breadcrumb_background',
      'type'  => 'background',
      'title' => esc_html__('Background', 'begin' ),
      'dependency'   => array( 'enable-sub-title', '==', 'true' ),
    ),
  )
);

// -----------------------------------------
// Meta Slider Section
// -----------------------------------------
$meta_slider_section = array(
  'name'  => 'slider_section',
  'title' => esc_html__('Slider', 'begin'),
  'icon'  => 'fa fa-slideshare',
  'fields' =>  array(
    array(
      'id'           => 'slider-notice',
      'type'         => 'notice',
      'class'        => 'danger',
      'content'      => __('Slider tab works only if breadcrumb disabled.','begin'),
      'class'        => 'margin-30 cs-danger',
      'dependency'   => array( 'enable-sub-title', '==', 'true' ),
    ),

    array(
      'id'           => 'show_slider',
      'type'         => 'switcher',
      'title'        => esc_html__('Show Slider', 'begin' ),
      'dependency'   => array( 'enable-sub-title', '==', 'false' ),
    ),

    array(
      'id'                 => 'slider_type',
      'type'               => 'select',
      'title'              => esc_html__('Slider', 'begin' ),
      'options'            => array(
        ''                 => esc_html__('Select a slider','begin'),
        'layerslider'      => esc_html__('Layer slider','begin'),
        'revolutionslider' => esc_html__('Revolution slider','begin'),
        'customslider'     => esc_html__('Custom Slider Shortcode','begin'),
      ),
      'validate' => 'required',
      'dependency'         => array( 'enable-sub-title|show_slider', '==|==', 'false|true' ),
    ),

    array(
      'id'          => 'layerslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Layer Slider', 'begin' ),
      'options'     => begin_layersliders(),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|layerslider' )
    ),

    array(
      'id'          => 'revolutionslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Revolution Slider', 'begin' ),
      'options'     => begin_revolutionsliders(),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|revolutionslider' )
    ),

    array(
      'id'          => 'customslider_sc',
      'type'        => 'textarea',
      'title'       => esc_html__('Custom Slider Code', 'begin' ),
      'validate'    => 'required',
      'dependency'  => array( 'enable-sub-title|show_slider|slider_type', '==|==|==', 'false|true|customslider' )
    ),
  )  
);

// -----------------------------------------
// Blog Template Section
// -----------------------------------------
$blog_template_section = array(
  'name'  => 'blog_template_section',
  'title' => esc_html__('Blog Template', 'begin'),
  'icon'  => 'fa fa-files-o',
  'fields' =>  array(
    array(
      'id'           => 'blog-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => __('Blog Tab Works only if page template set to Blog Template in Page Attributes','begin'),
      'class'        => 'margin-30 cs-success',      
    ),
    array(
      'id'                     => 'blog-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'begin' ),
      'options'                => array(
          'one-column'         => BEGIN_THEME_URI . '/cs-framework-override/images/one-column.png',
          'one-half-column'    => BEGIN_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => BEGIN_THEME_URI . '/cs-framework-override/images/one-third-column.png',
      ),
      'default'                => 'one-half-column'
    ),
    array(
      'id'                     => 'blog-post-style',
      'type'                   => 'select',
      'title'                  => esc_html__('Post Style', 'begin' ),
      'options'                => array(
        'blog-default-style' => esc_html__('Default','begin'),
        'entry-date-left'    => esc_html__('Date Left','begin'),
        'entry-date-author-left' => esc_html__('Date and Author Left','begin'),
        'blog-medium-style'  => esc_html__('Medium','begin'),
        'blog-medium-style dt-blog-medium-highlight' => esc_html__('Medium Highlight','begin'),
        'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight' => esc_html__('Medium Skin Highlight','begin')
      ),
    ),
    array(
      'id'      => 'enable-blog-readmore',
      'type'    => 'switcher',
      'title'   => esc_html__('Read More', 'begin' ),
      'default' => true
    ),
    array(
      'id'           => 'blog-readmore',
      'type'         => 'textarea',
      'title'        => esc_html__('Read More Shortcode', 'begin' ),
      'default'      => '[dt_sc_button iconclass="fa fa-pencil" class="read-btn" title="" icon_type="fontawesome" target="_blank" /]',
      'dependency'   => array( 'enable-blog-readmore', '==', 'true' ),
    ),
    array(
      'id'      => 'blog-post-excerpt',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Excerpt', 'begin' ),
      'default' => true
    ),
    array(
      'id'           => 'blog-post-excerpt-length',
      'type'         => 'number',
      'title'        => esc_html__('Excerpt Length', 'begin' ),
      'default'      => '45',
      'dependency'   => array( 'blog-post-excerpt', '==', 'true' ),
    ),
    array(
      'id'           => 'blog-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'begin' ),
      'default'      => '-1',      
    ),
    array(
      'id'             => 'blog-post-cats',
      'type'           => 'select',
      'title'          => esc_html__('Categories','begin'),
      'options'        => 'categories',
      'default_option' => esc_html__('Select a categories','begin'),
      'class'              => 'chosen',
      'attributes'         => array(
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to exclude from your blog page.','begin'),
    ),
    array(
      'id'      => 'show-postformat-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Format Info', 'begin' ),
      'default' => true
    ),
    array(
      'id'      => 'show-author-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Author Info', 'begin' ),
      'default' => true,
    ),
    array(
      'id'      => 'show-date-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Date Info', 'begin' ),
      'default' => true
    ),
    array(
      'id'      => 'show-comment-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Comment Info', 'begin' ),
      'default' => true
    ),
    array(
      'id'      => 'show-category-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Category Info', 'begin' ),
      'default' => true
    ),
    array(
      'id'      => 'show-tag-info',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Post Tag Info', 'begin' ),
      'default' => true
    )    
  )
);

// -----------------------------------------
// One Page Template Section
// -----------------------------------------
$one_page_template_section = array(
  'name'  => 'one_page_template_section',
  'title' => esc_html__('One Page Template', 'begin'),
  'icon'  => 'fa fa-file-o',
  'fields' =>  array(
    array(
      'id'           => 'one-page-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => __('One Page Tab Works only if page template set to One Page Template in Page Attributes','begin'),
      'class'        => 'margin-30 cs-success',      
    ),
    array(
      'id'            => 'onepage_menu',
      'type'          => 'select',
      'title'         => esc_html__('Menu', 'begin' ),
      'options'       => 'categories',
      'query_args'  => array(
        'post_type' => 'nav_menu_item',
        'taxonomy'  => 'nav_menu',
      ),
      'default_option' => esc_html__('Select a Menu','begin'),
    ),
  )
);

// -----------------------------------------
// Portfolio Template Section
// -----------------------------------------
$portfolio_template_section = array(
  'name'  => 'portfolio_template_section',
  'title' => esc_html__('Portfolio Template', 'begin'),
  'icon'  => 'fa fa-picture-o',
  'fields' =>  array(

    array(
      'id'           => 'portfolio-tpl-notice',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => __('Portfolio Tab Works only if page template set to Portfolio Template in Page Attributes','begin'),
      'class'        => 'margin-30 cs-success',      
    ),

    array(
      'id'                     => 'portfolio-post-layout',
      'type'                   => 'image_select',
      'title'                  => esc_html__('Post Layout', 'begin' ),
      'options'                => array(
          'one-half-column'    => BEGIN_THEME_URI . '/cs-framework-override/images/one-half-column.png',
          'one-third-column'   => BEGIN_THEME_URI . '/cs-framework-override/images/one-third-column.png',
          'one-fourth-column'  => BEGIN_THEME_URI . '/cs-framework-override/images/one-fourth-column.png',
      ),
      'default'                => 'one-half-column'
    ),

    array(
      'id'      => 'portfolio-post-style',
      'type'    => 'select',
      'title'   => esc_html__('Post Style', 'begin' ),
      'options' => array(
        'type1' => esc_html__('Modern Title','begin'),
        'type2' => esc_html__('Title & Icons Overlay','begin'),
        'type3' => esc_html__('Title Overlay','begin'),
        'type4' => esc_html__('Icons Only','begin'),
        'type5' => esc_html__('Classic','begin'),
        'type6' => esc_html__('Minimal Icons','begin'),
        'type7' => esc_html__('Presentation','begin'),
        'type8' => esc_html__('Girly','begin'),
        'type9' => esc_html__('Art','begin'),
      ),
    ),

    array(
      'id'      => 'portfolio-grid-space',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Grid Space', 'begin' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow grid space in between portfolio item','begin')
    ),

    array(
      'id'      => 'filter',
      'type'    => 'switcher',
      'title'   => esc_html__('Allow Filters', 'begin' ),
      'default' => true,
      'info'    => esc_html__('YES! to allow filter options for portfolio items','begin')
    ),

    array(
      'id'           => 'portfolio-post-per-page',
      'type'         => 'number',
      'title'        => esc_html__('Post Per Page', 'begin' ),
      'default'      => '-1',      
    ),

    array(
      'id'             => 'portfolio-categories',
      'type'           => 'select',
      'title'          => esc_html__('Categories','begin'),
      'options'        => 'categories',
      'class'          => 'chosen',
      'query_args'     => array(
        'type'         => 'dt_portfolios',
        'taxonomy'     => 'portfolio_entries',
        'orderby'      => 'post_date',
        'order'        => 'DESC',
      ),
      'attributes'         => array(
        'data-placeholder' => esc_html__('Select a categories','begin'),
        'multiple'         => 'only-key',
        'style'            => 'width: 200px;'
      ),
      'info'           => esc_html__('Select categories to show in portfolio items.','begin'),
    ),   
  )
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
array_push( $meta_layout_section['fields'], array(
  'id'        => 'enable-sticky-sidebar',
  'type'      => 'switcher',
  'title'     => esc_html__('Enable Sticky Sidebar', 'begin' ),
  'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-right-sidebar,with-both-sidebar' )
) );

$options[] = array(
	'id'        => '_tpl_default_settings',
    'title'     => esc_html__('Page Settings','begin'),
    'post_type' => 'page',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
		$meta_layout_section,
		$meta_breadcrumb_section,
		$meta_slider_section,

		$blog_template_section,
		$one_page_template_section,
		$portfolio_template_section,
		array(
		  'name'  => 'sidenav_template_section',
		  'title' => esc_html__('Side Navigation Template', 'begin'),
		  'icon'  => 'fa fa-th-list',
		  'fields' =>  array(

			array(
			  'id'           => 'sidenav-tpl-notice',
			  'type'         => 'notice',
			  'class'        => 'success',
			  'content'      => esc_html__('Side Navigation Tab Works only if page template set to Side Navigation Template in Page Attributes','begin'),
			  'class'        => 'margin-30 cs-success',      
			),

			array(
			  'id'    		 => 'sidenav-align',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Align Right', 'begin' ),
			  'info'    	 => esc_html__('YES! to align right of side navigation.','begin')
			),

			array(
			  'id'    		 => 'sidenav-sticky',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Sticky Side Navigation', 'begin' ),
			  'info'    	 => esc_html__('YES! to sticky side navigation content.','begin')
			),

			array(
			  'id'    		 => 'enable-sidenav-content',
			  'type'    	 => 'switcher',
			  'title'   	 => esc_html__('Show Content', 'begin' ),
			  'info'    	 => esc_html__('YES! to show content in below side navigation.','begin')
			),

			array(
			  'id'	    	 => 'sidenav-content',
			  'type'	     => 'textarea',
			  'title'  		 => esc_html__('Side Navigation Content', 'begin' ),
			  'info'    	 => esc_html__('Paste any shortcode content here','begin'),
			  'attributes' 	 => array(
				  'rows'     => 6,
			  ),
			),

		  )
		),
    )
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$post_meta_layout_section = $meta_layout_section;
$fields = $post_meta_layout_section['fields'];

	$fields[0]['title'] =  esc_html__('Post Layout', 'begin' );
	unset( $fields[0]['options']['with-both-sidebar'] );
	unset( $fields[0]['info'] );
	unset( $fields[0]['options']['fullwidth'] );
	unset( $post_meta_layout_section['fields'] );
	$post_meta_layout_section['fields']  = $fields;  
	
	$post_format_section = array(
		'name'  => 'post_format_data_section',
		'title' => esc_html__('Post Format', 'begin'),
		'icon'  => 'fa fa-cog',
		'fields' =>  array(

			array(
				'id' => 'post-format-type',
				'title'   => esc_html__('Type', 'begin' ),
				'type' => 'select',
				'default' => 'standard',
				'options' => array(
					'standard'  => esc_html__('Standard', 'begin'),
					'status'	=> esc_html__('Status','begin'),
					'quote'		=> esc_html__('Quote','begin'),
					'gallery'	=> esc_html__('Gallery','begin'),
					'image'		=> esc_html__('Image','begin'),
					'video'		=> esc_html__('Video','begin'),
					'audio'		=> esc_html__('Audio','begin'),
					'link'		=> esc_html__('Link','begin'),
					'aside'		=> esc_html__('Aside','begin'),
					'chat'		=> esc_html__('Chat','begin')
				)
			),

			array(
				'id'      => 'show-featured-image',
				'type'    => 'switcher',
				'title'   => esc_html__('Show Featured Image', 'begin' ),
				'default' => true,
				'info'    => esc_html__('YES! to show featured image','begin')
			),

			array(
				'id' 	  => 'post-gallery-items',
				'type'	  => 'gallery',
				'title'   => esc_html__('Add Images', 'begin' ),
				'add_title'   => esc_html__('Add Images', 'begin' ),
				'edit_title'  => esc_html__('Edit Images', 'begin' ),
				'clear_title' => esc_html__('Remove Images', 'begin' ),
				'dependency' => array( 'post-format-type', '==', 'gallery' ),
			),

			array(
				'id' 	  => 'media-type',
				'type'	  => 'select',
				'title'   => esc_html__('Select Type', 'begin' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
		      	'options'	=> array(
					'oembed' => esc_html__('Oembed','begin'),
					'self' => esc_html__('Self Hosted','begin'),
				)
			),

			array(
				'id' 	  => 'media-url',
				'type'	  => 'textarea',
				'title'   => esc_html__('Media URL', 'begin' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
			),
		)
	);

	$options[] = array(
		'id'        => '_dt_post_settings',
		'title'     => esc_html__('Post Settings','begin'),
		'post_type' => 'post',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			$post_meta_layout_section,
			$meta_breadcrumb_section,
			$post_format_section			
		)
	);

// -----------------------------------------
// Tribe Events Post Metabox Options
// -----------------------------------------
  array_push( $post_meta_layout_section['fields'], array(
    'id' => 'event-post-style',
    'title'   => esc_html__('Post Style', 'begin' ),
    'type' => 'select',
    'default' => 'type1',
    'options' => array(
      'type1'  => esc_html__('Classic', 'begin'),
      'type2'  => esc_html__('Full Width','begin'),
      'type3'  => esc_html__('Minimal Tab','begin'),
      'type4'  => esc_html__('Clean','begin'),
      'type5'  => esc_html__('Modern','begin'),
    ),
	'class'    => 'chosen',
	'info'     => esc_html__('Your event post page show at most selected style.', 'begin')
  ) );

  $options[] = array(
    'id'        => '_custom_settings',
    'title'     => esc_html__('Settings','begin'),
    'post_type' => 'tribe_events',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
      $post_meta_layout_section,
      $meta_breadcrumb_section
    )
  );

	
CSFramework_Metabox::instance( $options );