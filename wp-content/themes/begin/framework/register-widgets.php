<?php
	$wtstyle = cs_get_option( 'wtitle-style' );

	$before_title = '<h3 class="widgettitle">';
	$after_title = '</h3>';

	if( $wtstyle == 'type17' ) {
		$before_title = ' <div class="mz-title"> <div class="mz-title-content"> <h3 class="widgettitle">';
		$after_title  = '</h3> </div> </div>';
	} elseif( $wtstyle == 'type18' ) {
		$before_title = ' <div class="mz-stripe-title"> <div class="mz-stripe-title-content"> <h3 class="widgettitle">';
		$after_title  = '</h3> </div> </div>';
	}

	// standard left sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Left Sidebar', 'begin'),
		'id'			=>	'standard-sidebar-left',
		'description'	=>	esc_html__("Appears in the Left side of the site, one enabled.",'begin'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	$before_title,
		'after_title' 	=> 	$after_title));

	// standard right sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Right Sidebar', 'begin'),
		'id'			=>	'standard-sidebar-right',
		'description'	=>	esc_html__("Appears in the Right side of the site, one enabled.",'begin'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	$before_title,
		'after_title' 	=> 	$after_title));

	// custom widget area
	$widget_areas = is_array( cs_get_option( 'widgetarea-custom' ) ) ? cs_get_option( 'widgetarea-custom' ) : array();
	$widget_areas = array_filter($widget_areas);

    foreach ($widget_areas as $widget_area ) {
	   	$id = mb_convert_case($widget_area['widgetarea-custom-name'], MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
			'name' 			=>	$widget_area['widgetarea-custom-name'],
			'id'			=>	$id,
			'description'   =>  esc_html__("Custom sidebar created in Designthemes Framework.",'begin'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));
    }

	// post archives sidebar
	$layout = cs_get_option( 'post-archives-page-layout' );
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'begin'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'begin'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;

		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'begin'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'begin'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;

		case 'with-both-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'begin'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'begin'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));

			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'begin'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'begin'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	$before_title,
				'after_title' 	=> 	$after_title));
		break;
	endswitch;

	// events everywhere sidebar
	if( class_exists('Tribe__Events__Main')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Left Sidebar', 'begin'),
			'id'			=>	'events-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the left.",'begin'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Right Sidebar', 'begin'),
			'id'			=>	'events-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the right.",'begin'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));
	endif;

	// portfolio archives sidebar
	if( begin_is_plugin_active('designthemes-core-features/designthemes-core-features.php') ):
		$layout = cs_get_option( 'portfolio-archives-page-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'begin'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'begin'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'begin'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'begin'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif;

	// shop everywhere sidebar
	if( class_exists('woocommerce')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Left Sidebar', 'begin'),
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the left.",'begin'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Right Sidebar', 'begin'),
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the right.",'begin'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	$before_title,
			'after_title' 	=> 	$after_title));

		// custom left sidebars for product
		$layout = cs_get_option( 'product-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Left Sidebar", 'begin'),
					'id'			=>	"product-detail-sidebar-left",
					'description'	=>  esc_html__("Appears in the Left side of Product details Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Right Sidebar", 'begin'),
					'id'			=>	"product-detail-sidebar-right",
					'description'	=>  esc_html__("Appears in the Right side of Product details Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Left Sidebar", 'begin'),
					'id'			=>	"product-detail-sidebar-left",
					'description'	=>  esc_html__("Appears in the Left side of Product details Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Detail | Right Sidebar", 'begin'),
					'id'			=>	"product-detail-sidebar-right",
					'description'	=>  esc_html__("Appears in the Right side of Product details Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;

		// custom left sidebars for product category
		$layout = cs_get_option( 'product-category-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Left Sidebar", 'begin'),
					'id'			=>	"product-category-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Category Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Right Sidebar", 'begin'),
					'id'			=>	"product-category-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Category Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Left Sidebar", 'begin'),
					'id'			=>	"product-category-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Category Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Category | Right Sidebar", 'begin'),
					'id'			=>	"product-category-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Category Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;

		// custom left sidebars for product tag
		$layout = cs_get_option( 'product-tag-layout' );
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Left Sidebar", 'begin'),
					'id'			=>	"product-tag-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Tag Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Right Sidebar", 'begin'),
					'id'			=>	"product-tag-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Tag Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Left Sidebar", 'begin'),
					'id'			=>	"product-tag-sidebar-left",
					'description'	=>  esc_html__("Appears on Left side of Product Tag Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));

				register_sidebar(array(
					'name' 			=>	esc_html__("Product Tag | Right Sidebar", 'begin'),
					'id'			=>	"product-tag-sidebar-right",
					'description'	=>  esc_html__("Appears on Right side of Product Tag Page.",'begin'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	$before_title,
					'after_title' 	=> 	$after_title));
			break;
		endswitch;
	endif;

	// footer columnns		
	$footer_columns = get_theme_mod( 'footer-columns', begin_defaults('footer-columns') );
	begin_footer_widgetarea($footer_columns, $before_title , $after_title);

	/* ---------------------------------------------------------------------------
	 * Registering Footer Widget Areas
	 * --------------------------------------------------------------------------- */
	function begin_footer_widgetarea($count) {
		$name = esc_html__ ( "Footer Column", 'begin' );
		if ($count <= 6) :
			for($i = 1; $i <= $count; $i ++) :
				register_sidebar ( array (
					'name' => $name . "-{$i}",
					'id' => "footer-sidebar-{$i}",
					'description' => esc_html__('Appears in the footer section of the site.', 'begin'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
				) );
			endfor;
		 elseif ($count == 12 || $count == 13) :
			$a = array ("1-4", "1-4", "1-2" );
			$a = ($count == 12) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => esc_html__('Appears in the footer section of the site.', 'begin'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
				) );
			endforeach;
		 elseif ($count == 7 || $count == 8) :
			$a = array ("1-4", "3-4");
			$a = ($count == 7) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => esc_html__('Appears in the footer section of the site.', 'begin'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
				) );
			endforeach;
		 elseif ($count == 9 || $count == 10) :
			$a = array ("1-3", "2-3");
			$a = ($count == 9) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => esc_html__('Appears in the footer section of the site.', 'begin'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
				) );
			endforeach;
		elseif( $count == 11 ):
			$a = array ("1-4", "1-2", "1-4" );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => esc_html__('Appears in the footer section of the site.', 'begin'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>'
				) );
			endforeach;			
		endif;
	} ?>