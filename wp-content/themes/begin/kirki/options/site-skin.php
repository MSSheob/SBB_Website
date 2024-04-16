<?php
$config = begin_kirki_config();

BEGIN_Kirki::add_section( 'dt_site_skin_section', array(
	'title' => __( 'Site Skin', 'begin' ),
	'priority' => 23
) );

	# use-predefined-skin
	BEGIN_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'use-predefined-skin',
		'label'    => __( 'Predefined Skin ?', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'priority' => 1,
		'default'  => begin_defaults('use-predefined-skin' ),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'begin' ),
			'off' => esc_attr__( 'No', 'begin' )
		)
	));

	# predefined-skin
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'predefined-skin',
		'label'    => __( 'Skin', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'default' => begin_defaults('predefined-skin' ),
		'multiple' => 1,
		'priority' => 2,
		'active_callback' => array(
			array( 'setting' => 'use-predefined-skin', 'operator' => '==', 'value' => '1' )
		),
		'choices' => array(
			'blue'		=>	esc_attr__('Blue','begin'),
		)
	));

	# primary-color
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'primary-color',
		'label'    => __( 'Primary Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'priority' => 3,
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('primary-color'),
		'active_callback' => array(
			array( 'setting' => 'use-predefined-skin', 'operator' => '==', 'value' => '0' )
		),
		'output' => array(

			# Primary Color - Base	
			array( 'element' => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover', 'property' => 'color' ),

			# Primary Color - Header
			array( 'element' => '.top-bar a:hover, .menu-icons-wrapper .search a:hover, .menu-icons-wrapper .cart a:hover, .main-header .menu-icons-wrapper .overlay-search #searchform:before', 'property' => 'color' ),

			# Primary Color - Menu
			array( 'element' => '
				#main-menu ul.menu li a:hover, #main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a, 

				#main-menu ul.menu li.menu-item-simple-parent ul li a:hover, #main-menu ul.menu > li.menu-item-simple-parent:hover > a, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu li.menu-item-simple-parent ul li:hover > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul li a:hover,

				#main-menu .megamenu-child-container ul.sub-menu > li.current_page_item > a, #main-menu .megamenu-child-container ul.sub-menu > li.current_page_ancestor > a, #main-menu .megamenu-child-container ul.sub-menu > li.current-menu-item > a, #main-menu .megamenu-child-container ul.sub-menu > li.current-menu-ancestor > a, #main-menu .megamenu-child-container ul.sub-menu > li.current_page_item > span, #main-menu .megamenu-child-container ul.sub-menu > li.current_page_ancestor > span, #main-menu .megamenu-child-container ul.sub-menu > li.current-menu-item > span, #main-menu .megamenu-child-container ul.sub-menu > li.current-menu-ancestor > span, 

				#main-menu .megamenu-child-container.dt-sc-dark-bg > ul.sub-menu > li > a:hover, #main-menu .megamenu-child-container.dt-sc-dark-bg ul.sub-menu > li > ul li a:hover, #main-menu .megamenu-child-container.dt-sc-dark-bg ul.sub-menu > li > ul li a:hover .fa', 'property' => 'color' ),

			# Primary Color - Menu - Left Header
			array( 'element' => '.left-header .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a, .left-header .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a, .left-header .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a, .left-header .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a', 'property' => 'color' ),

			# Primary Color - Blog
			array( 'element' => '.blog-entry .entry-meta a:hover, .blog-entry.entry-date-left .entry-date a:hover, .blog-entry.entry-date-author-left .entry-date-author .comments:hover, .blog-entry.entry-date-author-left .entry-date-author .comments:hover i, .entry-meta-data p a:hover, .blog-entry.entry-date-author-left .entry-date-author .entry-author a:hover, .blog-entry.entry-date-author-left .entry-date-author .comments a:hover, .dt-sc-dark-bg .blog-medium-style.white-highlight .dt-sc-button.fully-rounded-border, .blog-entry.blog-thumb-style .entry-title h4 a:hover, .blog-entry.blog-thumb-style a.read-more:hover', 'property' => 'color' ),

			# Primary Color - Widgets	
			array( 'element' => '
				.widget #wp-calendar td a:hover, .dt-sc-dark-bg .widget #wp-calendar td a:hover, .secondary-sidebar .widget ul li > a:hover, .dt-sc-practices-list li:before, .secondary-sidebar .type15 .widget.widget_recent_reviews ul li .reviewer, .secondary-sidebar .type15 .widget.widget_top_rated_products ul li .amount.amount, 

				#main-menu .menu-item-widget-area-container .widget ul li > a:hover, #main-menu .dt-sc-dark-bg .menu-item-widget-area-container .widget ul li > a:hover, #main-menu .dt-sc-dark-bg .menu-item-widget-area-container .widget_recent_posts .entry-title h4 a:hover, #main-menu ul li.menu-item-simple-parent.dt-sc-dark-bg ul li a:hover, #main-menu .menu-item-widget-area-container .widget li:hover:before', 'property' => 'color' ),

			# Primary Color - Footer	
			array( 'element' => '#footer .footer-copyright .menu-links li a:hover, #footer .footer-copyright .copyright-left a:hover, #footer .dt-sc-dark-bg .recent-posts-widget li .entry-meta a:hover, #footer .dt-sc-dark-bg .entry-title h4 a:hover, #footer .dt-sc-dark-bg a:hover, .left-header-footer .dt-sc-sociable.filled li a, /* New */ #footer .dt-sc-button.fully-rounded-border, .footer-widgets a:hover, #footer a:hover', 'property' => 'color' ),

			# Primary Color - Portfolio	
			array( 'element' => '.portfolio .image-overlay .links a:hover, .portfolio.type7 .image-overlay .links a, .project-details li a:hover, .portfolio-categories a:hover, .dt-portfolio-single-slider-wrapper #bx-pager a.active:hover:before, .dt-portfolio-single-slider-wrapper #bx-pager a, .portfolio.type8 .image-overlay .links a', 'property' => 'color' ),

			# Primary Color - Miscellaneous/Shortcodes	
			array( 'element' => 'ul.side-nav li a:hover, .available-domains li span, .dt-sc-popular-procedures .details .duration, .dt-sc-popular-procedures .details .price, .dt-sc-text-with-icon span, blockquote.type4 > cite, .dt-sc-contact-info.type3 span, .dt-sc-pr-tb-col.type2 .dt-sc-buy-now a, .dt-sc-events-list .dt-sc-event-title h5 a, .woocommerce-MyAccount-navigation ul > li.is-active > a, /* New */ .dt-sc-contact-info.type1:hover span, .dt-sc-icon-box.type2:hover .icon-wrapper span, .dt-sc-icon-box.type2:hover .icon-content h4, .dt-sc-icon-box.type2:hover .icon-content h4 a, .dt-sc-icon-box.type5 .icon-content h4, .dt-sc-icon-box.type5 .icon-content h4 a, .dt-sc-title.script-with-sub-title span, .dt-sc-contact-info.type1:hover span, .top-bar .dt-sc-contact-info.type1 strong, .top-bar .dt-sc-contact-info.type1 span', 'property' => 'color' ),

			# Primary Color - Buttons	
			array( 'element' => '.dt-sc-button.fully-rounded-border, .dt-sc-button.rounded-border, .dt-sc-button.bordered, .dt-sc-button.with-shadow.white, .dt-sc-skin-highlight .dt-sc-button.rounded-border:hover, .dt-sc-skin-highlight .dt-sc-button.bordered:hover, .dt-sc-dark-bg.skin-color .dt-sc-button.fully-rounded-border:hover', 'property' => 'color' ),

			# Primary Color - Icon Boxes	
			array( 'element' => '.dt-sc-icon-box.type1 .icon-wrapper .icon, .dt-sc-icon-box.type2 .icon-wrapper .icon, .dt-sc-icon-box.type4 .icon-wrapper span, .dt-sc-icon-box.type5:hover .icon-content h4 a, .dt-sc-icon-box.type5.no-icon-bg .icon-wrapper span, .dt-sc-icon-box.type5.no-icon-bg:hover .icon-wrapper span, .dt-sc-icon-box.type10 .icon-wrapper span, .dt-sc-icon-box.type10:hover .icon-content h4, .dt-sc-icon-box.type13 .icon-content h4, .dt-sc-icon-box.type14 .icon-content h4, /* New */ .dt-sc-icon-box.type3:hover .icon-content h4, .dt-sc-icon-box.type3:hover .icon-content h4 a, .dt-sc-icon-box.type6:hover .icon-content h4, .dt-sc-icon-box.type6:hover .icon-content h4 a', 'property' => 'color' ),

			# Primary Color - Testimonials	
			array( 'element' => '.dt-sc-testimonial.type4 .dt-sc-testimonial-author cite, .dt-sc-testimonial.type5 .dt-sc-testimonial-author cite, .dt-sc-testimonial.type7 .dt-sc-testimonial-quote blockquote cite, .dt-sc-testimonial.type8 .dt-sc-testimonial-quote blockquote q:before, .dt-sc-testimonial.type8 .dt-sc-testimonial-quote blockquote q:after, .dt-sc-testimonial-special-wrapper:after, .dt-sc-special-testimonial-images-holder .dt-sc-testimonial-image.slick-current .dt-sc-testimonial-author cite, .dt-sc-team-carousel-wrapper .dt-sc-team-details .dt-sc-team-social li a:hover', 'property' => 'color' ),

			# Primary Color - Horizontal Tabs	
			array( 'element' => 'ul.dt-sc-tabs-horizontal-frame > li > a.current, ul.dt-sc-tabs-horizontal > li > a.current, ul.dt-sc-tabs-horizontal > li > a:hover, ul.dt-sc-tabs-horizontal-frame > li > a:hover, .type7 ul.dt-sc-tabs-horizontal-frame > li > a.current', 'property' => 'color' ),

			# Primary Color - Vertical Tabs	
			array( 'element' => 'ul.dt-sc-tabs-vertical-frame > li > a:hover, ul.dt-sc-tabs-vertical-frame > li.current a, ul.dt-sc-tabs-vertical > li > a.current, .dt-sc-tabs-vertical-frame-container.type2 ul.dt-sc-tabs-vertical-frame > li > a.current:before, ul.dt-sc-tabs-vertical > li > a:hover', 'property' => 'color' ),

			# Primary Color - Toggles	
			array( 'element' => '.dt-sc-toggle-frame-set > .dt-sc-toggle-accordion.active > a, .dt-sc-toggle-group-set .dt-sc-toggle.active > a, .dt-sc-toggle-frame h5.dt-sc-toggle-accordion.active a, .dt-sc-toggle-frame h5.dt-sc-toggle.active a, .dt-sc-toggle-panel h2 span', 'property' => 'color' ),

			# Primary Color - Headings/Titles	
			array( 'element' => '.dt-sc-title.with-sub-title h3, .dt-sc-title.with-two-color-stripe h2, .dt-sc-hexagon-title h2 span', 'property' => 'color' ),

			# Primary Color - Image Caption	
			array( 'element' => '.dt-sc-image-with-caption h3 a, .dt-sc-image-caption.type3 .dt-sc-image-content h3, .dt-sc-event-image-caption .dt-sc-image-content h3, .dt-sc-image-caption.type8:hover .dt-sc-image-content h3 a:hover, .dt-sc-image-caption.type3 .dt-sc-image-wrapper .icon-wrapper span', 'property' => 'color' ),

			# Primary Color - Team	
			array( 'element' => '.dt-sc-team.hide-social-role-show-on-hover .dt-sc-team-social.rounded-square li a, .dt-sc-team.rounded .dt-sc-team-details .dt-sc-team-social li a:hover, .dt-sc-team.rounded.team_rounded_border:hover .dt-sc-team-details h4, .dt-sc-team.type2 .dt-sc-team-social.rounded-border li a:hover, .dt-sc-team.type2 .dt-sc-team-social.rounded-square li a:hover, .dt-sc-team.type2 .dt-sc-team-social.square-border li a:hover, .dt-sc-team.type2 .dt-sc-team-social.hexagon-border li a:hover, .dt-sc-team.type2 .dt-sc-team-social.diamond-square-border li a:hover, /* New */ .dt-sc-team.type1 .dt-sc-team-details .dt-sc-team-social li a:hover', 'property' => 'color' ),

			# Primary Color - Timeline	
			array( 'element' => '.dt-sc-timeline .dt-sc-timeline-content h2 span, .dt-sc-hr-timeline-section.type2 .dt-sc-hr-timeline-content:hover h3, .dt-sc-timeline-section.type4 .dt-sc-timeline:hover .dt-sc-timeline-content h2, /* New */ .dt-sc-timeline-item.slick-current h4', 'property' => 'color' ),

			# Primary Color - Sociables	
			array( 'element' => '.dt-sc-sociable.diamond-square-border li:hover a, .dt-sc-sociable.hexagon-border li:hover a, .dt-sc-sociable.hexagon-with-border li:hover a, .dt-sc-sociable.no-margin li a', 'property' => 'color' ),

			# Primary Color - Counters	
			array( 'element' => '.dt-sc-counter.type3.diamond-square h4, .dt-sc-counter.type6:hover h4, /* New */ .dt-sc-counter.type1:hover .dt-sc-counter-number', 'property' => 'color' ),

			# Primary Color - Add-ons/Custom Modules	
			array( 'element' => '.dt-sc-menu-sorting a:hover, .dt-sc-menu-sorting a.active-sort, .dt-sc-training-details h6, .dt-sc-fitness-diet:hover .dt-sc-fitness-diet-details h5, table.fit-Diet-table th strong, .dt-sc-hotel-room-single-metadata ul li, .dt-sc-hotel-room .dt-sc-hotel-room-details ul li, ul.dt-sc-vertical-nav > li > a:hover, .university-contact-info p a:hover', 'property' => 'color' ),


			# Primary BG Color - Base
			array( 'element' => 'th, input[type="submit"], button, input[type="reset"], .loader', 'property' => 'background-color' ),

			# Primary BG Color - Header
			array( 'element' => '.left-header #toggle-sidebar, .left-header-footer, .overlay-header #trigger-overlay, .overlay .overlay-close, 
.menu-icons-wrapper.rounded-icons .search a span:hover, .menu-icons-wrapper.rounded-icons .cart a span:hover, .menu-icons-wrapper .cart sup, .two-color-header .main-header-wrapper', 'property' => 'background-color' ),

			# Primary BG Color - Menu
			array( 'element' => '.dt-menu-toggle, .two-color-header .main-header-wrapper:before', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active Highlight
			array( 'element' => '.menu-active-highlight #main-menu > ul.menu > li.current_page_item, .menu-active-highlight #main-menu > ul.menu > li.current_page_ancestor, .menu-active-highlight #main-menu > ul.menu > li.current-menu-item, .menu-active-highlight #main-menu > ul.menu > li.current-menu-ancestor', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active Highlight Grey
			array( 'element' => '.menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a:before', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active Highlight With Arrow
			array( 'element' => '.menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active Highlight With Icon
			array( 'element' => '.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:before, .menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:after', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active Border With Arrow
			array( 'element' => '.menu-active-border-with-arrow  #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current-menu-ancestor > a:after', 'property' => 'background-color' ),

			# Primary BG Color - Menu	Active With Two Border
			array( 'element' => '.menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:after', 'property' => 'background-color' ),

			# Primary BG Color - Left Header
			array( 'element' => '.left-header .menu-active-highlight #main-menu > ul.menu > li.current_page_item > a, .left-header .menu-active-highlight #main-menu > ul.menu > li.current_page_ancestor > a, .left-header .menu-active-highlight #main-menu > ul.menu > li.current-menu-item > a, .left-header .menu-active-highlight #main-menu > ul.menu > li.current-menu-ancestor > a', 'property' => 'background-color' ),

			# Primary BG Color - Blog
			array( 'element' => '
				.entry-format a, .blog-entry.blog-medium-style:hover .entry-format a,  .blog-entry.blog-medium-style.dt-blog-medium-highlight.dt-sc-skin-highlight, .blog-entry.blog-medium-style.dt-blog-medium-highlight.dt-sc-skin-highlight .entry-format a, ul.commentlist li .reply a:hover, .dt-sc-dark-bg .blog-medium-style.white-highlight .dt-sc-button.fully-rounded-border:hover, 

				.post-nav-container .post-next-link a:hover, .post-nav-container .post-prev-link a:hover, .page-link > span, .page-link a:hover, .post-edit-link:hover, .vc_inline-link:hover, .pagination ul li a:hover, .pagination ul li span, /* New */ .blog-entry .entry-details .dt-sc-button.read-btn:hover span, .blog-entry .entry-details .dt-sc-button.read-btn:hover:after', 'property' => 'background-color' ),			

			# Primary BG Color - Widgets
			array( 'element' => '
				.widget .dt-sc-newsletter-section.boxed .dt-sc-subscribe-frm input[type="submit"]:hover, .tagcloud a:hover, .widgettitle:before, .widget.widget_categories ul li > a:hover span, .widget.widget_archive ul li > a:hover span, 

				.dt-sc-dark-bg .tagcloud a:hover, .dt-sc-dark-bg .widget.widget_categories ul li > a:hover span, #footer .dt-sc-dark-bg .widget.widget_categories ul li > a:hover span, #footer .dt-sc-dark-bg .widget.widget_archive ul li > a:hover span', 'property' => 'background-color' ),	

			# Primary BG Color - Portfolio
			array( 'element' => '.dt-sc-portfolio-sorting a.active-sort, .dt-sc-portfolio-sorting a:hover, .dt-sc-portfolio-sorting a:hover:before, .dt-sc-portfolio-sorting a:hover:after, .dt-sc-portfolio-sorting a.active-sort:before, .dt-sc-portfolio-sorting a.active-sort:after, .portfolio.type2 .image-overlay-details, .portfolio.type2 .image-overlay .links a:hover, .dt-sc-portfolio-sorting.type2, .dt-sc-portfolio-sorting.type2:before, .portfolio.type6 .image-overlay .links a:hover, .portfolio.type7 .image-overlay-details .categories a:before, .portfolio.type7 .image-overlay .links a:hover:before', 'property' => 'background-color' ),		

			# Primary BG Color - Miscellaneous/Shortcodes	
			array( 'element' => 'ul.side-nav li a:hover:before, ul.side-nav > li.current_page_item > a:before, ul.side-nav > li > ul > li.current_page_item > a:before, ul.side-nav > li > ul > li > ul > li.current_page_item > a:before, .dt-sc-small-separator, .dt-sc-diamond-separator, .dt-sc-titled-box h6.dt-sc-titled-box-title, .carousel-arrows a:hover, .dt-sc-images-wrapper .carousel-arrows a:hover, .diamond-narrow-square-border li:hover:before, .dt-sc-sociable.hexagon-with-border li, .dt-sc-skin-highlight, .dt-sc-skin-highlight.extend-bg-fullwidth-left:after, .dt-sc-skin-highlight.extend-bg-fullwidth-right:after, .two-color-section:before, .dt-sc-readmore-plus-icon:hover:before, .dt-sc-readmore-plus-icon:hover:after, .dt-sc-contact-details-on-map .map-switch-icon, .dt-sc-content-with-hexagon-shape, .dt-sc-hexagons li .dt-sc-hexagon-overlay, .available-domains li .tdl:before, .available-domains li:hover .dt-sc-button, .domain-search-container .domain-search-form, .dt-sc-newsletter-section.type1 h2:before, .dt-sc-newsletter-section.type1 h2:after, /* New */ .dt-carousel-navigation a:hover, .dt-carousel-pagination a:hover, .dt-carousel-pagination a.selected, .wpcf7-form-control-wrap:before, .dt-sc-timeline-item:hover span', 'property' => 'background-color' ),

			# Primary BG Color - Buttons
			array( 'element' => '.dt-sc-button.filled, .dt-sc-button:hover, .dt-sc-button.rounded-border:hover, .dt-sc-button.bordered:hover, .dt-sc-button.fully-rounded-border:hover, .dt-sc-colored-big-buttons:hover, .dt-sc-colored-big-buttons span, /* New */ .dt-sc-button.white.fully-rounded-border.filled:hover, .dt-sc-icon-box.type10 .view_details_btn .dt-sc-button.fully-rounded-border:hover', 'property' => 'background-color' ),

			# Primary BG Color - Contact Info
			array( 'element' => '.dt-sc-contact-info.type2:hover span, .dt-sc-contact-info.type3, .dt-sc-contact-info.type4 span:after, .dt-sc-contact-info.type4:before, .dt-sc-contact-info.type5 .dt-sc-contact-icon, .dt-sc-contact-info.type5:hover, .dt-sc-contact-info.type6, .dt-sc-contact-info.type7 span:after, .dt-sc-contact-info.type4:after, .university-contact-form .button-field i', 'property' => 'background-color' ),	

			# Primary BG - Counters
			array( 'element' => '.dt-sc-counter.type1 .icon-wrapper:before, .dt-sc-counter.type2 .dt-sc-couter-icon-holder, .dt-sc-counter.type3:hover .icon-wrapper, .dt-sc-counter.type3.diamond-square .dt-sc-couter-icon-holder .icon-wrapper:before, .dt-sc-counter.type4:hover .dt-sc-couter-icon-holder, .dt-sc-counter.type5:hover:after, .dt-sc-counter.type6 h4:before, .dt-sc-counter.type6:hover .dt-sc-couter-icon-holder:before', 'property' => 'background-color' ),	

			# Primary BG Color - Icon Boxes
			array( 'element' => '.dt-sc-icon-box.type1 .icon-content h4:before, .dt-sc-icon-box.type3.dt-sc-diamond:hover .icon-wrapper:after, .dt-sc-icon-box.type5.rounded-skin .icon-wrapper, .dt-sc-icon-box.type5.rounded:hover .icon-wrapper, .dt-sc-icon-box.type5:hover .icon-wrapper:before, .dt-sc-icon-box.type5.alter .icon-wrapper:before, .dt-sc-icon-box.type7 .icon-wrapper span, .dt-sc-contact-info.type8:hover span, .dt-sc-icon-box.type10:hover .icon-wrapper:before, .dt-sc-icon-box.type10 .icon-content h4:before, .dt-sc-icon-box.type11:before, .dt-sc-icon-box.type12, .dt-sc-icon-box.type13:hover, .dt-sc-icon-box.type14:hover', 'property' => 'background-color' ),

			# Primary BG Color - Testimonials
			array( 'element' => '.dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a:hover, .dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a.active', 'property' => 'background-color' ),

			# Primary BG Color - Headings/Titles
			array( 'element' => '.dt-sc-title.with-two-color-bg:after, .dt-sc-triangle-title:after, .dt-sc-title.with-right-border-decor:after, .dt-sc-title.with-right-border-decor:before, .dt-sc-title.with-boxed, .mz-title .mz-title-content h2, .mz-title-content h3.widgettitle, .mz-title .mz-title-content:before, .mz-blog .comments a, .mz-blog div.vc_gitem-post-category-name, .mz-blog .ico-format', 'property' => 'background-color' ),	

			# Primary BG Color - Team
			array( 'element' => '.dt-sc-team-social.hexagon-border li:hover, .dt-sc-team .dt-sc-team-social.diamond-square-border li:hover, .dt-sc-team.hide-social-role-show-on-hover .dt-sc-team-social.rounded-square li:hover a, .dt-sc-infinite-portfolio-load-more, .dt-sc-single-hexagon .dt-sc-single-hexagon-overlay, .dt-sc-team-social.rounded-border li a:hover, .dt-sc-team-social.rounded-square li a, .dt-sc-team.hide-social-show-on-hover:hover .dt-sc-team-details, .dt-sc-team-social.square-border li a:hover, .dt-sc-team.rounded:hover .dt-sc-team-thumb:after, .dt-sc-team.hide-social-role-show-on-hover:hover .dt-sc-team-details, .dt-sc-team.hide-social-role-show-on-hover .dt-sc-team-social li:hover, .dt-sc-team.style2 .dt-sc-sociable li a, .dt-sc-team.style2 .dt-sc-team-details .view-details:hover', 'property' => 'background-color' ),

			# Primary BG Color - Pricing Tables
			array( 'element' => '.dt-sc-pr-tb-col.minimal:hover .dt-sc-price, .dt-sc-pr-tb-col.minimal.selected .dt-sc-price, .dt-sc-pr-tb-col:hover .dt-sc-buy-now a, .dt-sc-pr-tb-col.selected .dt-sc-buy-now a, .dt-sc-pr-tb-col.minimal:hover .icon-wrapper:before, .dt-sc-pr-tb-col.minimal.selected .icon-wrapper:before, .dt-sc-pr-tb-col.type1:hover .dt-sc-tb-header, .dt-sc-pr-tb-col.type1.selected .dt-sc-tb-header, .dt-sc-pr-tb-col.type2 .dt-sc-tb-header .dt-sc-tb-title:before, .dt-sc-pr-tb-col.type2 .dt-sc-tb-content:before, .dt-sc-pr-tb-col.type2 .dt-sc-tb-content li .highlight, .dt-sc-pr-tb-col.type2:hover .dt-sc-price:before, .dt-sc-pr-tb-col.type2.selected .dt-sc-price:before, .dt-sc-pr-tb-col.type2:hover .dt-sc-buy-now a', 'property' => 'background-color' ),

			# Primary BG Color - HR Timeline
			array( 'element' => '.dt-sc-hr-timeline-section.type1:before, .dt-sc-hr-timeline-section.type1 .dt-sc-hr-timeline .dt-sc-hr-timeline-content:after, .dt-sc-hr-timeline-section.type1 .dt-sc-hr-timeline-wrapper:before, .dt-sc-hr-timeline-section.type1 .dt-sc-hr-timeline-wrapper:after, .dt-sc-hr-timeline-section.type2 .dt-sc-hr-timeline-content h3:before, .dt-sc-hr-timeline-section.type2 .dt-sc-hr-timeline:hover .dt-sc-hr-timeline-thumb:before', 'property' => 'background-color' ),

			# Primary BG Color - Vertical Timeline
			array( 'element' => '.dt-sc-timeline-section.type2:before, .dt-sc-timeline-section.type3 .dt-sc-timeline .dt-sc-timeline-content h2:before, .dt-sc-timeline-section.type4 .dt-sc-timeline .dt-sc-timeline-content h2:before, .dt-sc-timeline-section.type4 .dt-sc-timeline:hover .dt-sc-timeline-thumb:before', 'property' => 'background-color' ),	

			# Primary BG Color - Image Caption
			array( 'element' => '.dt-sc-image-caption.type4:hover .dt-sc-button, .dt-sc-image-caption.type8 .dt-sc-image-content:before, .dt-sc-event-image-caption:hover', 'property' => 'background-color' ),	

			# Primary BG Color - Horizontal Tabs
			array( 'element' => '.dt-sc-tabs-horizontal-frame-container.type4 ul.dt-sc-tabs-horizontal-frame > li > a.current > span:after, .dt-sc-tabs-horizontal-frame-container.type5 ul.dt-sc-tabs-horizontal-frame > li > a.current, .dt-sc-tabs-horizontal-frame-container.type6 ul.dt-sc-tabs-horizontal-frame > li > a, .type8 ul.dt-sc-tabs-horizontal-frame > li > a.current, .type8 ul.dt-sc-tabs-horizontal-frame > li > a:hover', 'property' => 'background-color' ),

			# Primary BG Color - Vertical Tabs
			array( 'element' => '.dt-sc-tabs-vertical-frame-container.type3 ul.dt-sc-tabs-vertical-frame > li > a:hover, .dt-sc-tabs-vertical-frame-container.type3 ul.dt-sc-tabs-vertical-frame > li > a.current, .dt-sc-tabs-vertical-frame-container.type4 ul.dt-sc-tabs-vertical-frame > li > a:before, .dt-sc-tabs-vertical-frame-container.type4 ul.dt-sc-tabs-vertical-frame > li > a:after', 'property' => 'background-color' ),

			# Primary BG Color - Toggles
			array( 'element' => '.dt-sc-toggle-frame h5.dt-sc-toggle-accordion.active a:before, h5.dt-sc-toggle-accordion.active a:before, .dt-sc-toggle-frame h5.dt-sc-toggle.active a:before, h5.dt-sc-toggle.active a:before, .type2 .dt-sc-toggle-frame h5.dt-sc-toggle-accordion.active, .type2 .dt-sc-toggle-frame h5.dt-sc-toggle.active, .dt-sc-toggle-frame-set.type2 > h5.dt-sc-toggle-accordion.active:after, .dt-sc-toggle-icon', 'property' => 'background-color' ),

			# Primary BG Color - Video Manager
			array( 'element' => '.dt-sc-video-wrapper .video-overlay-inner a, .dt-sc-video-item:hover .dt-sc-vitem-detail, .dt-sc-video-item.active .dt-sc-vitem-detail, .type2 .dt-sc-video-item:hover, .type2 .dt-sc-video-item.active, .nicescroll-rails.dt-sc-skin', 'property' => 'background-color' ),

			# Primary BG Color - Add-ons/Custom Modules
			array( 'element' => '.live-chat a, .dt-bmi-inner-content tbody th, .dt-bmi-inner-content tbody tr:nth-child(2n+1) th, .dt-sc-menu .menu-categories a:before, .hotel-search-container form input[type="submit"]:hover, .hotel-search-container .selection-box:after, .dt-sc-training-details-overlay, .custom-navigation .vc_images_carousel .vc_carousel-indicators li, .dt-sc-doctors.style1 .dt-sc-doctors-thumb-wrapper .dt-sc-button, .dt-sc-doctors-single .dt-sc-doctors.style1 .dt-sc-doctors-details ul.dt-sc-sociable li a, .dt-sc-procedure-item:hover, .dt-sc-fitness-procedure-sorting a, ul.dt-sc-vertical-nav > li.active > a, ul.time-table > li, ul.time-slots > li a:hover, .dt-sc-available-times ul.time-slots, #wpsl-search-btn, #wpsl-stores li > p span, #wpsl-stores li > p, #wpsl-stores li > p ~ .wpsl-directions, .dt-sc-toggle-advanced-options span', 'property' => 'background-color' ),


			# Primary Border Color - Menu
			array( 'element' => '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container', 'property' => 'border-botom-color' ),

			# Primary Border Color - Menu Active With Double Border
			array( 'element' => '.menu-active-with-double-border #main-menu > ul.menu > li.current_page_item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-ancestor > a', 'property' => 'border-color' ),

			# Primary Border Color - Menu Active Border With Arrow
			array( 'element' => '.menu-active-border-with-arrow  #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-border-with-arrow  #main-menu > ul.menu > li.current-menu-ancestor > a:before, .main-header .menu-icons-wrapper .overlay-search #searchform', 'property' => 'border-bottom-color' ),

			# Primary Border Color - Menu Active Highlight With Arrow
			array( 'element' => '.menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li:nth-child(odd):hover > a:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li:nth-child(odd):hover > .nolink-menu:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor:nth-child(odd) > a:after, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor:nth-child(odd) > .nolink-menu:after', 'property' => 'border-top-color' ),

			# Primary Border Color - Blog
			array( 'element' => '.blog-entry.entry-date-left .entry-date span, .blog-entry.blog-medium-style:hover .entry-format a, ul.commentlist li .reply a:hover, .dt-sc-dark-bg .blog-medium-style.white-highlight .dt-sc-button.fully-rounded-border, .pagination ul li a:hover, .pagination ul li span, .post-nav-container .post-next-link a:hover, .post-nav-container .post-prev-link a:hover, .page-link > span, .page-link a:hover', 'property' => 'border-color' ),

			# Primary Border Color - Widgets
			array( 'element' => '.widget .dt-sc-newsletter-section.boxed, .widget .dt-sc-newsletter-section.boxed .dt-sc-subscribe-frm input[type="submit"], .tagcloud a:hover, .dt-sc-dark-bg .tagcloud a:hover, .secondary-sidebar .type3 .widgettitle, .secondary-sidebar .type6 .widgettitle, .secondary-sidebar .type13 .widgettitle:before, .secondary-sidebar .type14 .widgettitle, .secondary-sidebar .type16 .widgettitle', 'property' => 'border-color' ),

			# Primary Border Color - Portfolios
			array( 'element' => '.dt-sc-portfolio-sorting a.active-sort, .dt-sc-portfolio-sorting a:hover, .portfolio.type7 .image-overlay .links a:before', 'property' => 'border-color' ),

			# Primary Border Color - Buttons
			array( 'element' => '.dt-sc-colored-big-buttons, .dt-sc-button.fully-rounded-border, .dt-sc-button.fully-rounded-border:hover, .dt-sc-button.rounded-border.black:hover, .dt-sc-button.bordered.black:hover, .dt-sc-button.bordered:hover, .dt-sc-button.rounded-border:hover', 'property' => 'border-color' ),

			# Primary Border Color - Sociables
			array( 'element' => '.dt-sc-sociable.rounded-border li a:hover, .dt-sc-dark-bg .dt-sc-sociable.rounded-border li a:hover, .dt-sc-dark-bg .dt-sc-sociable.square-border li a:hover, .dt-sc-sociable.diamond-square-border li:hover, .diamond-narrow-square-border li:before', 'property' => 'border-color' ),

			# Primary Border Color - Team
			array( 'element' => '.dt-sc-team .dt-sc-team-social.diamond-square-border li:hover, .dt-sc-team-social.hexagon-border li:hover, .dt-sc-team-social.hexagon-border li:hover:before, .dt-sc-team-social.hexagon-border li:hover:after, .dt-sc-team-social.rounded-border li a:hover, .dt-sc-team-social.square-border li a:hover, .dt-sc-team.team_rounded_border.rounded:hover .dt-sc-team-thumb:before', 'property' => 'border-color' ),

			# Primary Border Color - Testimonials
			array( 'element' => '.dt-sc-testimonial.type5 .dt-sc-testimonial-quote, .dt-sc-testimonial-images li.selected div, .dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a:hover, .dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a.active, .dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a.active:before, .dt-sc-testimonial-wrapper .dt-sc-testimonial-bullets a.active:hover:before, .dt-sc-testimonial.type5 .dt-sc-testimonial-author img', 'property' => 'border-color' ),

			# Primary Border Color - Tabs
			array( 'element' => '
				ul.dt-sc-tabs-horizontal > li > a.current, ul.dt-sc-tabs-vertical > li > a.current, 
				.dt-sc-tabs-vertical-frame-container.type3 ul.dt-sc-tabs-vertical-frame > li > a:hover, .dt-sc-tabs-vertical-frame-container.type3 ul.dt-sc-tabs-vertical-frame > li > a.current', 'property' => 'border-color' ),

			# Primary Border Color - Toggles
			array( 'element' => '.type2 .dt-sc-toggle-frame h5.dt-sc-toggle-accordion.active, .type2 .dt-sc-toggle-frame h5.dt-sc-toggle.active', 'property' => 'border-color' ),

			# Primary Border Color - Timeline
			array( 'element' => '
				.dt-sc-hr-timeline-section.type1 .dt-sc-hr-timeline .dt-sc-hr-timeline-content:before, 
				.dt-sc-timeline-section.type2 .dt-sc-timeline-image-wrapper, .dt-sc-timeline-section.type2 .dt-sc-timeline .dt-sc-timeline-content:after, .dt-sc-timeline-section.type2:after', 'property' => 'border-color' ),

			# Primary Border Color - Counters
			array( 'element' => '.dt-sc-counter.type3 .icon-wrapper:before, .dt-sc-counter.type3.diamond-square, .dt-sc-counter.type5:hover:before, .dt-sc-counter.type5:hover:after, .dt-sc-counter.type6, .dt-sc-counter.type6 .dt-sc-couter-icon-holder:before', 'property' => 'border-color' ),

			# Primary Border Color - Contact Info
			array( 'element' => '.dt-sc-contact-info.type2:hover, .dt-sc-contact-info.type4, .last .dt-sc-contact-info.type4', 'property' => 'border-color' ),

			# Primary Border Color - Icon Boxes
			array( 'element' => '.dt-sc-icon-box.type5.no-icon .icon-content h4, .dt-sc-icon-box.type5.no-icon, .dt-sc-icon-box.type10:hover, .dt-sc-icon-box.type10 .icon-wrapper:before, .dt-sc-icon-box.type3.dt-sc-diamond:hover .icon-wrapper:after, .dt-sc-icon-box.type11:before, /* New */ .dt-sc-title.script-with-sub-title:hover:after', 'property' => 'border-color' ),

			# Primary Border Color - Image Caption
			array( 'element' => '.dt-sc-image-caption.type2 .dt-sc-image-content, .dt-sc-image-caption.type4, .dt-sc-image-caption.type4:hover .dt-sc-button, .dt-sc-icon-box.type10:hover .icon-wrapper:before, /* New */ .dt-sc-button.white.fully-rounded-border.filled:hover', 'property' => 'border-color' ),

			# Primary Border Color - Miscellaneous/Shortcodes
			array( 'element' => '.dt-sc-title.with-right-border-decor h2:before, .dt-sc-pr-tb-col.type2 .dt-sc-tb-header:before, .dt-sc-newsletter-section.type2 .dt-sc-subscribe-frm input[type="text"], .dt-sc-newsletter-section.type2 .dt-sc-subscribe-frm input[type="email"], .dt-sc-text-with-icon.border-bottom, .dt-sc-text-with-icon.border-right, .dt-sc-hexagons li:hover, .dt-sc-hexagons li:hover:before, .dt-sc-hexagons li:hover:after, .dt-sc-hexagons li, .dt-sc-hexagons li:before, .dt-sc-hexagons li .dt-sc-hexagon-overlay:before, .dt-sc-hexagons li:after, .dt-sc-hexagons li .dt-sc-hexagon-overlay:after, .dt-sc-single-hexagon, .dt-sc-single-hexagon:before, .dt-sc-single-hexagon .dt-sc-single-hexagon-overlay:before, .dt-sc-single-hexagon:after, .dt-sc-single-hexagon .dt-sc-single-hexagon-overlay:after, .dt-sc-single-hexagon:hover, .dt-sc-single-hexagon:hover:before, .dt-sc-single-hexagon:hover:after, .carousel-arrows a:hover, .vc_custom_carousel .slick-slider .slick-dots, .vc_custom_carousel .slick-slider:before, .dt-sc-team-navigation .dt-sc-team-pager-prev:before, .dt-sc-team-navigation .dt-sc-team-pager-next:before, ul.dt-sc-vertical-nav, ul.dt-sc-vertical-nav > li:first-child > a, .dt-sc-loading:before, /* New */ .dt-carousel-navigation a:hover', 'property' => 'border-color' ),

			# Primary Border Top Color - Miscellaneous/Shortcodes
			array( 'element' => '.dt-sc-triangle-wrapper:hover .dt-sc-triangle-content:before, .dt-sc-pr-tb-col.type2 .dt-sc-tb-content:after, .dt-sc-content-with-hexagon-shape:after, .type7 ul.dt-sc-tabs-horizontal-frame > li > a.current:before, .type7 ul.dt-sc-tabs-horizontal-frame > li > a.current:after, .skin-highlight .dt-sc-tabs-horizontal-frame-container.type6 ul.dt-sc-tabs-horizontal-frame > li > a:before, .dt-sc-doctors-filter .selection-box:before', 'property' => 'border-top-color' ),

			# Primary Border Bottom Color - Miscellaneous/Shortcodes
			array( 'element' => '.dt-sc-up-arrow:before, .dt-sc-image-caption .dt-sc-image-wrapper .icon-wrapper:before, .dt-sc-triangle-wrapper.alter:hover .dt-sc-triangle-content:before, .dt-sc-content-with-hexagon-shape:before, .dt-sc-tabs-horizontal-frame-container.type3 ul.dt-sc-tabs-horizontal-frame > li > a.current, .dt-sc-tabs-horizontal-frame-container.type4 ul.dt-sc-tabs-horizontal-frame > li > a.current', 'property' => 'border-bottom-color' ),

			# Primary Border Left Color - Miscellaneous/Shortcodes
			array( 'element' => '.type3 .dt-sc-toggle-frame .dt-sc-toggle-content, .dt-sc-tabs-vertical-frame-container.type3 ul.dt-sc-tabs-vertical-frame > li > a.current:before, .dt-sc-event-image-caption:hover .dt-sc-image-content:before', 'property' => 'border-left-color' ),

			# Primary Border Color - Add-ons/Custom Modules
			array( 'element' => '.dt-sc-attorney-sorting, .dt-sc-menu-sorting a.active-sort, .dt-sc-menu .image-overlay .price, .hotel-search-container form input[type="submit"]', 'property' => 'border-color' ),


			# Primary BG Color - 404/Not-Found
			array( 'element' => '.error404 .type2 a.dt-sc-back, .error404 .type4 .error-box, .error404 .type4 .dt-sc-newsletter-section input[type="submit"], .error404 .type8 .dt-go-back', 'property' => 'background-color' ),

			# Primary Color - 404/Not-Found
			array( 'element' => '.error404 .type2 h2, .error404 .type8 h2, .error404 .type8 .dt-go-back:hover i', 'property' => 'color' ),


			# Primary BG Color - Coming Soon
			array( 'element' => '.under-construction.type4 .dt-sc-counter-wrapper, .under-construction.type1 .dt-sc-newsletter-section form input[type="submit"], .under-construction.type1 .dt-sc-counter-wrapper .counter-icon-wrapper:before, .under-construction.type2 .dt-sc-sociable > li:hover a, .under-construction.type7 .dt-sc-sociable > li:hover a, .under-construction.type3 .dt-sc-newsletter-section form input[type="submit"], .under-construction.type3 .dt-sc-sociable > li:hover a, .under-construction.type7 .dt-sc-counter-wrapper, .under-construction.type7 .dt-sc-newsletter-section form input[type="submit"]', 'property' => 'background-color' ),

			# Primary Border Color - Coming Soon
			array( 'element' => '.under-construction.type3 .dt-sc-sociable > li:hover a', 'property' => 'border-color' ),

			# Primary Color - Coming Soon
			array( 'element' => '.under-construction.type4 .wpb_wrapper > h2 span, .under-construction.type4 .read-more i, .under-construction.type4  .wpb_wrapper >  h4:after, .under-construction.type4 .wpb_wrapper > h4:before, .under-construction.type1 .read-more span.fa, .under-construction.type1 .read-more a:hover, .under-construction.type2 .counter-icon-wrapper .dt-sc-counter-number, .under-construction.type2 h2, .under-construction.type2 .dt-sc-counter-wrapper h3, .under-construction.type2 .mailchimp-newsletter h3,  .under-construction.type7 h2, .under-construction.type7 .mailchimp-newsletter h3, .under-construction.type3 p, .under-construction.type5 h2 span, .under-construction.type5 .dt-sc-counter-number, .under-construction.type5 footer .dt-sc-team-social li:hover a, .under-construction.type5 input[type="email"], .under-construction.type7 .aligncenter .wpb_text_column h2', 'property' => 'color' ),


			# Primary BG Color - BuddyPress
			array( 'element' => '#buddypress div.pagination .pagination-links span, #buddypress div.pagination .pagination-links a:hover, #buddypress #group-create-body #group-creation-previous, #item-header-content #item-meta > #item-buttons .group-button, #buddypress div#subnav.item-list-tabs ul li.feed a:hover, #buddypress div.activity-meta a:hover, #buddypress div.item-list-tabs ul li.selected a span, #buddypress .activity-list li.load-more a, #buddypress .activity-list li.load-newest a', 'property' => 'background-color' ),

			# Primary Border Color - BuddyPress
			array( 'element' => '#buddypress div.pagination .pagination-links span, #buddypress div.pagination .pagination-links a:hover, #buddypress #members-dir-list ul li:hover', 'property' => 'border-color' ),

			# Primary Color - BuddyPress
			array( 'element' => '
				#members-list.item-list.single-line li h5 span.small a.button, #buddypress div.item-list-tabs ul li.current a, #buddypress #group-create-tabs ul li.current a, #buddypress a.bp-primary-action:hover span, #buddypress div.item-list-tabs ul li.selected a, 
				.widget.buddypress div.item-options a:hover, .widget.buddypress div.item-options a.selected, #footer .footer-widgets.dt-sc-dark-bg .widget.buddypress div.item-options a.selected, .widget.widget_bp_core_members_widget div.item .item-title a:hover, .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a:hover', 'property' => 'color' ),


			# Primary BG Color - BbPress
			array( 'element' => '#bbpress-forums li.bbp-header, .bbp-submit-wrapper #bbp_topic_submit, .bbp-reply-form #bbp_reply_submit, .bbp-pagination-links a:hover, .bbp-pagination-links span.current, #bbpress-forums #subscription-toggle a.subscription-toggle', 'property' => 'background-color' ),

			# Primary Border Color - BbPress
			array( 'element' => '.bbp-pagination-links a:hover, .bbp-pagination-links span.current', 'property' => 'border-color' ),

			# Primary Color - BbPress
			array( 'element' => '.bbp-forums .bbp-body .bbp-forum-info::before', 'property' => 'color' ),


			# Primary BG Color - Events
			array( 'element' => '#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover, #tribe-bar-form .tribe-bar-submit input[type="submit"], #tribe-bar-views .tribe-bar-views-list li.tribe-bar-active a, .tribe-events-calendar thead th, #tribe-events-content .tribe-events-tooltip h4, .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], .tribe-events-read-more, #tribe-events .tribe-events-button, .tribe-events-button, .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a, .tribe-events-back > a, #tribe_events_filters_toggle', 'property' => 'background-color' ),

			# Primary Border Color - Events
			array( 'element' => '.tribe-events-list .tribe-events-event-cost span', 'property' => 'border-color' ),

			# Primary BG Color - Events Pro
			array( 'element' => '.tribe-grid-header, .tribe-grid-allday .tribe-events-week-allday-single, .tribe-grid-body .tribe-events-week-hourly-single', 'property' => 'background-color' ),


			# Primary BG Color - Event Detail
			array( 'element' => '.type1.tribe_events .event-image-wrapper .event-datetime > span, .type3.tribe_events .event-date, .event-meta-tab ul.dt-sc-tabs-horizontal-frame > li > a', 'property' => 'background-color' ),

			# Primary Color - Event Detail
			array( 'element' => '.type1 .event-schedule, .type1.tribe_events .nav-top-links a:hover, .type1.tribe_events .event-image-wrapper .event-datetime > i, .type1.tribe_events .event-image-wrapper .event-venue > i, .type1.tribe_events h4 a, .type2.tribe_events .date-wrapper p span, .type2.tribe_events h4 a, .type3.tribe_events .right-calc a:hover, .type3.tribe_events .tribe-events-sub-nav li a:hover, .type3.tribe_events .tribe-events-sub-nav li a span, .type4.tribe_events .data-wrapper p span, .type4.tribe_events .data-wrapper p i, .type4.tribe_events .event-organize h4 a, .type4.tribe_events .event-venue h4 a, .type5.tribe_events .event-details h3, .type5.tribe_events .event-organize h3, .type5.tribe_events .event-venue h3, .type5.tribe_events .data-wrapper p span, .data-wrapper p i, .type5.tribe_events .event-organize h4 a, .type5.tribe_events .event-venue h4 a', 'property' => 'color' ),


			# Primary BG Color - Event Listing Shortcode
			array( 'element' => '.dt-sc-event.type1 .dt-sc-event-thumb p, .dt-sc-event.type1 .dt-sc-event-meta:before, .dt-sc-event.type2:hover .dt-sc-event-meta, .dt-sc-event.type3 .dt-sc-event-date, .dt-sc-event.type3:hover .dt-sc-event-meta', 'property' => 'background-color' ),

			# Primary Border Bottom Color - Event Listing Shortcode
			array( 'element' => '.dt-sc-event.type4 .dt-sc-event-date:after', 'property' => 'border-bottom-color' ),

			# Primary Color - Event Listing Shortcode
			array( 'element' => '.dt-sc-event.type1 .dt-sc-event-meta p span, .dt-sc-event.type1:hover h2.entry-title a, .dt-sc-event.type3:hover h2.entry-title a, .dt-sc-event.type4 .dt-sc-event-date span', 'property' => 'color' ),


			# Primary BG Color - Event Widgets
			array( 'element' => '
				.widget.tribe_mini_calendar_widget .tribe-mini-calendar thead.tribe-mini-calendar-nav td, 

				.widget.tribe_mini_calendar_widget .tribe-mini-calendar .tribe-events-present, .widget.tribe_mini_calendar_widget .tribe-mini-calendar .tribe-events-has-events.tribe-mini-calendar-today, .tribe-mini-calendar .tribe-events-has-events.tribe-events-present a:hover, .widget.tribe_mini_calendar_widget .tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a:hover, 

				.dt-sc-dark-bg .widget.tribe_mini_calendar_widget .tribe-mini-calendar .tribe-events-present, .dt-sc-dark-bg .widget.tribe_mini_calendar_widget .tribe-mini-calendar .tribe-events-has-events.tribe-mini-calendar-today, .dt-sc-dark-bg .tribe-mini-calendar .tribe-events-has-events.tribe-events-present a:hover, .dt-sc-dark-bg .widget.tribe_mini_calendar_widget .tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a:hover', 'property' => 'background-color' ),

			# Primary Border Color - Event Widgets
			array( 'element' => '.widget.tribe_mini_calendar_widget .tribe-mini-calendar thead.tribe-mini-calendar-nav td', 'property' => 'border-color' ),		

			# Primary Color - Event Widgets
			array( 'element' => '.widget.tribe-events-countdown-widget .tribe-countdown-text a:hover', 'property' => 'color' ),			


			# Primary BG Color - WooCommerce Defaults
			array( 'element' => '.woocommerce a.button, .woocommerce button.button, .woocommerce button, .woocommerce input.button, .woocommerce input[type=button], .woocommerce input[type=submit], .woocommerce #respond input#submit, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce .product .summary .add_to_wishlist, .woocommerce .wishlist_table .add_to_cart.button, .woocommerce .yith-wcwl-add-button a.add_to_wishlist, .woocommerce .yith-wcwl-popup-button a.add_to_wishlist, .woocommerce .wishlist_table a.ask-an-estimate-button, .woocommerce .wishlist-title a.show-title-form, .woocommerce .hidden-title-form a.hide-title-form, .woocommerce .yith-wcwl-wishlist-new button, .woocommerce .wishlist_manage_table a.create-new-wishlist, .woocommerce .wishlist_manage_table button.submit-wishlist-changes, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce .cart input.button, .woocommerce .shop_table th, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page button, .woocommerce-page input.button, .woocommerce-page input[type=button], .woocommerce-page input[type=submit], .woocommerce-page #respond input#submit, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page .product .summary .add_to_wishlist, .woocommerce-page .wishlist_table .add_to_cart.button, .woocommerce-page .yith-wcwl-add-button a.add_to_wishlist, .woocommerce-page .yith-wcwl-popup-button a.add_to_wishlist, .woocommerce-page .wishlist_table a.ask-an-estimate-button, .woocommerce-page .wishlist-title a.show-title-form, .woocommerce-page .hidden-title-form a.hide-title-form, .woocommerce-page .yith-wcwl-wishlist-new button, .woocommerce-page .wishlist_manage_table a.create-new-wishlist, .woocommerce-page .wishlist_manage_table button.submit-wishlist-changes, .woocommerce-page .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce-page .cart input.button, .woocommerce-page .shop_table th, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:after, .woocommerce ul.products li.product .featured-tag, .woocommerce ul.products li.product:hover .featured-tag, .woocommerce.single-product .featured-tag, .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content', 'property' => 'background-color' ),

			# Primary Border Color - WooCommerce Defaults
			array( 'element' => '.woocommerce ul.products li.product .featured-tag:after, .woocommerce ul.products li.product:hover .featured-tag:after, .woocommerce.single-product .featured-tag:after', 'property' => 'border-color' ),

			# Primary Color - WooCommerce Defaults
			array( 'element' => '.woocommerce-checkout #payment ul.payment_methods li a:hover', 'property' => 'color' ),


			# Primary BG Color - Woo Type1/Fashion Theme
			array( 'element' => '.woo-type1 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type1 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type1 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type1 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type1 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type1 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type1 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover', 'property' => 'background-color' ),

			# Primary Color - Woo Type1/Fashion Theme
			array( 'element' => '.woo-type1 ul.products li.product-category:hover .product-details h5, .woo-type1 ul.products li.product-category:hover .product-details h5 .count, .woo-type1 ul.products li.product .product-details .product-price .amount, .woo-type1 ul.products li.product .product-details span.price, .woo-type1 ul.products li.product .product-details span.price del, .woo-type1 ul.products li.product .product-details span.price del .amount, .woo-type1 ul.products li.product .product-details span.price ins, .woo-type1 ul.products li.product .product-details span.price ins .amount, .woo-type1.woocommerce.single-product .product .summary .product_meta a:hover, .woo-type1.woocommerce div.product .woocommerce-tabs ul.tabs li.active a', 'property' => 'color' ),


			# Primary BG Color - Woo Type2/Jewel Theme
			array( 'element' => '.woo-type2 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type2 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type2 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type2 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type2 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type2 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type2 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type2.woocommerce ul.products li.product .onsale, .woo-type2.woocommerce ul.products li.product:hover .onsale, .woo-type2 .woocommerce ul.products li.product .onsale, .woo-type2 .woocommerce ul.products li.product:hover .onsale, .woo-type2.woocommerce ul.products li.product .out-of-stock, .woo-type2.woocommerce ul.products li.product:hover .out-of-stock, .woo-type2 .woocommerce ul.products li.product .out-of-stock, .woo-type2 .woocommerce ul.products li.product:hover .out-of-stock, .woo-type2.woocommerce span.onsale, .woo-type2.woocommerce span.out-of-stock, .woo-type2 .woocommerce span.onsale, .woo-type2 .woocommerce span.out-of-stock, .woo-type2 div.product .woocommerce-tabs ul.tabs li.active a', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type3/Business Theme
			array( 'element' => '.woo-type3 ul.products li.product .product-details h5:after', 'property' => 'background-color' ),

			# Primary Color - Woo Type3/Business Theme
			array( 'element' => '.woo-type3 ul.products li.product-category:hover .product-details h5, .woo-type3 ul.products li.product-category:hover .product-details h5 .count', 'property' => 'color' ),


			# Primary BG Color - Woo Type4/Hosting Theme
			array( 'element' => '.woo-type4 ul.products li.product .product-thumb a.add_to_cart_button:after, .woo-type4 ul.products li.product .product-thumb a.button.product_type_simple:after, .woo-type4 ul.products li.product .product-thumb a.button.product_type_variable:after, .woo-type4 ul.products li.product .product-thumb a.added_to_cart.wc-forward:after, .woo-type4 ul.products li.product .product-thumb a.add_to_wishlist:after, .woo-type4 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:after, .woo-type4 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:after, .woo-type4 ul.products li.product .product-details h5:after', 'property' => 'background-color' ),

			# Primary Color - Woo Type4/Hosting Theme
			array( 'element' => '.woo-type4 ul.products li.product-category:hover .product-details h5, .woo-type4 ul.products li.product-category:hover .product-details h5 .count', 'property' => 'color' ),


			# Primary BG Color - Woo Type5/Spa Theme
			array( 'element' => '.woo-type5 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type5 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type5 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type5 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type5 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type5 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type5 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type5 ul.products li.product .product-details h5:after', 'property' => 'background-color' ),

			# Primary Color - Woo Type5/Spa Theme
			array( 'element' => '.woo-type5 ul.products li.product-category:hover .product-details h5, .woo-type5 ul.products li.product-category:hover .product-details h5 .count', 'property' => 'color' ),


			# Primary BG Color - Woo Type6/Wedding Theme
			array( 'element' => '.woo-type6 ul.products li.product .price', 'property' => 'background-color' ),

			# Primary Color - Woo Type6/Wedding Theme
			array( 'element' => '.woo-type6 ul.products li.product .product-thumb a.add_to_cart_button:hover:before, .woo-type6 ul.products li.product .product-thumb a.button.product_type_simple:hover:before, .woo-type6 ul.products li.product .product-thumb a.button.product_type_variable:hover:before, .woo-type6 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:before, .woo-type6 ul.products li.product .product-thumb a.add_to_wishlist:hover:before, .woo-type6 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:before, .woo-type6 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:before, .woo-type6 ul.products li.product-category:hover .product-details h5, .woo-type6 ul.products li.product-category:hover .product-details h5 .count', 'property' => 'color' ),	


			# Primary BG Color - Woo Type7/University Theme
			array( 'element' => '.woo-type7 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type7 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type7 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type7 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type7 ul.products li.product .product-details, .woo-type7 ul.products li.product:hover .product-details h5', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type8/Insurance Theme
			array( 'element' => '.woo-type8 ul.products li.product .product-details, .woo-type8 ul.products li.product:hover .product-details h5:before', 'property' => 'background-color' ),

			# Primary Color - Woo Type8/Insurance Theme
			array( 'element' => '.woo-type8 ul.products li.product .product-thumb a.add_to_cart_button:hover:before, .woo-type8 ul.products li.product .product-thumb a.button.product_type_simple:hover:before, .woo-type8 ul.products li.product .product-thumb a.button.product_type_variable:hover:before, .woo-type8 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:before, .woo-type8 ul.products li.product .product-thumb a.add_to_wishlist:hover:before, .woo-type8 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:before, .woo-type8 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:before, .woo-type8 ul.products li.product:hover .product-details h5 a:hover', 'property' => 'color' ),

			# Primary BG Color - Woo Type9/Plumber Theme
			array( 'element' => '.woo-type9 ul.products li.product .product-thumb a.add_to_cart_button:hover:after, .woo-type9 ul.products li.product .product-thumb a.button.product_type_simple:hover:after, .woo-type9 ul.products li.product .product-thumb a.button.product_type_variable:hover:after, .woo-type9 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:after, .woo-type9 ul.products li.product .product-thumb a.add_to_wishlist:hover:after, .woo-type9 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:after, .woo-type9 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:after, .woo-type9 ul.products li.product .product-details', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type10/Medical Theme
			array( 'element' => '.woo-type10 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type10 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type10 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type10 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type10 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type10 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type10 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type10 ul.products li.product:hover .product-details', 'property' => 'background-color' ),

			# Primary Border Color - Woo Type10/Medical Theme
			array( 'element' => '.woo-type10 ul.products li.product:hover .product-wrapper', 'property' => 'border-color' ),
				
			# Primary Border Bottom Color - Woo Type10/Medical Theme
			array( 'element' => '.woo-type10 ul.products li.product:hover .product-details:before, .woo-type10 ul.products li.product:hover .product-details:after', 'property' => 'border-color' ),


			# Primary BG Color - Woo Type11/Model Theme
			array( 'element' => '.woo-type11 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type11 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type11 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type11 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type11 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, .woo-type11.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after, .woo-type11 ul.products li.product .product-details', 'property' => 'background-color' ),

			# Primary Color - Woo Type11/Model Theme
			array( 'element' => '.woo-type11 ul.products li.product .product-thumb a.add_to_cart_button:before, .woo-type11 ul.products li.product .product-thumb a.button.product_type_simple:before, .woo-type11 ul.products li.product .product-thumb a.button.product_type_variable:before, .woo-type11 ul.products li.product .product-thumb a.added_to_cart.wc-forward:before, .woo-type11 ul.products li.product .product-thumb a.add_to_wishlist:before, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:before, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:before', 'property' => 'color' ),


			# Primary BG Color - Woo Type12/Attorney Theme
			array( 'element' => '.woo-type12 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type12 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type12 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type12 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type12 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type12 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type12 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type12 ul.products li.product:hover .product-details, .woo-type12 ul.products li.product .product-details h5:after', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type13/Architecture Theme
			array( 'element' => '.woo-type13 ul.products li.product .product-details h5:before', 'property' => 'background-color' ),

			# Primary Color - Woo Type13/Architecture Theme
			array( 'element' => '.woo-type13 ul.products li.product .product-thumb a.add_to_cart_button:hover:before, .woo-type13 ul.products li.product .product-thumb a.button.product_type_simple:hover:before, .woo-type13 ul.products li.product .product-thumb a.button.product_type_variable:hover:before, .woo-type13 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:before, .woo-type13 ul.products li.product .product-thumb a.add_to_wishlist:hover:before, .woo-type13 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:before, .woo-type13 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:before, .woo-type13 ul.products li.product:hover .product-details h5 a, .woo-type13 ul.products li.product-category:hover .product-details h5, .woo-type13 ul.products li.product-category:hover .product-details h5 .count', 'property' => 'color' ),


			# Primary BG Color - Woo Type14/Fitness Theme
			array( 'element' => '.woo-type14 ul.products li.product:hover .product-details, .woo-type14 ul.products li.product .product-details h5:before, .woo-type14 ul.products li.product:hover .product-details h5:after', 'property' => 'background-color' ),

			# Primary Border Color - Woo Type14/Fitness Theme
			array( 'element' => '.woo-type14 ul.products li.product:hover .product-details h5:after', 'property' => 'border-color' ),


			# Primary BG Color - Woo Type15/Hotel Theme
			array( 'element' => '.woo-type15 ul.products li.product .product-thumb a.add_to_cart_button:after, .woo-type15 ul.products li.product .product-thumb a.button.product_type_simple:after, .woo-type15 ul.products li.product .product-thumb a.button.product_type_variable:after, .woo-type15 ul.products li.product .product-thumb a.added_to_cart.wc-forward:after, .woo-type15 ul.products li.product .product-thumb a.add_to_wishlist:after, .woo-type15 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:after, .woo-type15 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:after, .woo-type15 ul.products li.product .price:after', 'property' => 'background-color' ),

			# Primary Border Color - Woo Type15/Hotel Theme
			array( 'element' => '.woo-type15 ul.products li.product:hover .product-wrapper', 'property' => 'border-color' ),


			# Primary BG Color - Woo Type16/Photography Theme
			array( 'element' => '.woo-type16 ul.products li.product .product-wrapper, .woo-type16 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type16 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type16 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type16 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type16 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type16 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type16 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, .woo-type16.woocommerce .shop_table th, .woo-type16 .woocommerce .shop_table th, .woo-type16.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type17/Restaurant Theme
			array( 'element' => '.woo-type17 ul.products li.product .product-thumb a.add_to_cart_button:hover:after, .woo-type17 ul.products li.product .product-thumb a.button.product_type_simple:hover:after, .woo-type17 ul.products li.product .product-thumb a.button.product_type_variable:hover:after, .woo-type17 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:after, .woo-type17 ul.products li.product .product-thumb a.add_to_wishlist:hover:after, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:after, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:after, .woo-type17 ul.products li.product:hover .product-details', 'property' => 'background-color' ),

			# Primary Border Color - Woo Type17/Restaurant Theme
			array( 'element' => '.woo-type17 ul.products li.product:hover .product-wrapper, .woo-type17 ul.products li.product:hover .product-thumb a.add_to_cart_button:after, .woo-type17 ul.products li.product:hover .product-thumb a.button.product_type_simple:after, .woo-type17 ul.products li.product:hover .product-thumb a.button.product_type_variable:after, .woo-type17 ul.products li.product:hover .product-thumb a.added_to_cart.wc-forward:after, .woo-type17 ul.products li.product:hover .product-thumb a.add_to_wishlist:after, .woo-type17 ul.products li.product:hover .product-thumb .yith-wcwl-wishlistaddedbrowse a:after, .woo-type17 ul.products li.product:hover .product-thumb .yith-wcwl-wishlistexistsbrowse a:after, .woo-type17 ul.products li.product .product-details h5 a:after, .woo-type17 ul.products li.product-category .product-details h5:after, .woo-type17 ul.products li.product .price', 'property' => 'border-color' ),

			# Primary Color - Woo Type17/Restaurant Theme
			array( 'element' => '.woo-type17 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type17 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type17 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type17 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type17 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type17 ul.products li.product .product-thumb a.add_to_cart_button:before, .woo-type17 ul.products li.product .product-thumb a.button.product_type_simple:before, .woo-type17 ul.products li.product .product-thumb a.button.product_type_variable:before, .woo-type17 ul.products li.product .product-thumb a.added_to_cart.wc-forward:before, .woo-type17 ul.products li.product .product-thumb a.add_to_wishlist:before, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:before, .woo-type17 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:before, .woo-type17 ul.products li.product .product-details h5 a, .woo-type17 ul.products li.product-category .product-details h5, .woo-type17 ul.products li.product-category .product-details h5 .count, .woo-type17 ul.products li.product .product-details .product-price .amount, .woo-type17 ul.products li.product .product-details span.price, .woo-type17 ul.products li.product .product-details span.price del, .woo-type17 ul.products li.product .product-details span.price del .amount, .woo-type17 ul.products li.product .product-details span.price ins, .woo-type17 ul.products li.product .product-details span.price ins .amount, .woo-type17 .widget.woocommerce ul li:hover:before', 'property' => 'color' ),


			# Primary BG Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type18 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type18 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type18 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type18 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type18 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type18 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a', 'property' => 'background-color' ),


			# Primary BG Color - Woo Type19/NightClub Theme
			array( 'element' => '.woo-type19 ul.products li.product:hover .product-wrapper, .woo-type19 ul.products li.product:hover .product-details', 'property' => 'background-color' ),

			# Primary Color - Woo Type19/NightClub Theme
			array( 'element' => '.woo-type19 ul.products li.product .product-thumb a.add_to_cart_button:hover:before, .woo-type19 ul.products li.product .product-thumb a.button.product_type_simple:hover:before, .woo-type19 ul.products li.product .product-thumb a.button.product_type_variable:hover:before, .woo-type19 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:before, .woo-type19 ul.products li.product .product-thumb a.add_to_wishlist:hover:before, .woo-type19 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:before, .woo-type19 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:before', 'property' => 'color' ),


			# Primary Border Color - Woo Type20/Yoga Theme
			array( 'element' => '.woo-type20 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type20 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type20 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type20 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type20 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type20 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type20 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type20 ul.products li.product .product-wrapper:after, .woo-type20.woocommerce ul.products li.product .product-details h5, .woo-type20 .woocommerce ul.products li.product .product-details h5, .woo-type20 ul.products li.product-category .product-wrapper h3', 'property' => 'border-color' ),

			# Primary Color - Woo Type20/Yoga Theme
			array( 'element' => '.woo-type20 ul.products li.product .product-thumb a.add_to_cart_button:before, .woo-type20 ul.products li.product .product-thumb a.button.product_type_simple:before, .woo-type20 ul.products li.product .product-thumb a.button.product_type_variable:before, .woo-type20 ul.products li.product .product-thumb a.added_to_cart.wc-forward:before, .woo-type20 ul.products li.product .product-thumb a.add_to_wishlist:before, .woo-type20 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:before, .woo-type20 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:before, .woo-type20 ul.products li.product .product-details h5 a, .woo-type20 ul.products li.product-category .product-details h5, .woo-type20 ul.products li.product-category .product-details h5 .count, .woo-type20 ul.products li.product .product-details .product-price .amount, .woo-type20 ul.products li.product .product-details span.price, .woo-type20 ul.products li.product .product-details span.price del, .woo-type20 ul.products li.product .product-details span.price del .amount, .woo-type20 ul.products li.product .product-details span.price ins, .woo-type20 ul.products li.product .product-details span.price ins .amount, .woo-type20 ul.products li.product .product-details .product-rating-wrapper .star-rating:before, .woo-type20 ul.products li.product .product-details .product-rating-wrapper .star-rating span:before', 'property' => 'color' ),


			# Primary BG Color - Woo Type21/StyleShop Theme
			array( 'element' => '
				.woo-type21 .woocommerce ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type21 .woocommerce ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, 

				.woo-type21.woocommerce ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type21.woocommerce ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type21.woocommerce ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type21.woocommerce ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type21.woocommerce ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type21.woocommerce ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type21.woocommerce ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, 

				.woo-type21 .woocommerce a.button:hover, .woo-type21 .woocommerce button.button:hover, .woo-type21 .woocommerce button:hover, .woo-type21 .woocommerce input.button:hover, .woo-type21 .woocommerce input[type=button]:hover, .woo-type21 .woocommerce input[type=submit]:hover, .woo-type21 .woocommerce #respond input#submit:hover, .woo-type21 .woocommerce a.button.alt:hover, .woo-type21 .woocommerce button.button.alt:hover, .woo-type21 .woocommerce input.button.alt:hover, .woo-type21 .woocommerce #respond input#submit.alt:hover, .woo-type21 .woocommerce .product .summary .add_to_wishlist:hover, .woo-type21 .woocommerce .wishlist_table .add_to_cart.button:hover, .woo-type21 .woocommerce .yith-wcwl-add-button a.add_to_wishlist:hover, .woo-type21 .woocommerce .yith-wcwl-popup-button a.add_to_wishlist:hover, .woo-type21 .woocommerce .wishlist_table a.ask-an-estimate-button:hover, .woo-type21 .woocommerce .wishlist-title a.show-title-form:hover, .woo-type21 .woocommerce .hidden-title-form a.hide-title-form:hover, .woo-type21 .woocommerce .yith-wcwl-wishlist-new button:hover, .woo-type21 .woocommerce .wishlist_manage_table a.create-new-wishlist:hover, .woo-type21 .woocommerce .wishlist_manage_table button.submit-wishlist-changes:hover, .woo-type21 .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woo-type21 .woocommerce .cart input.button:hover, 

				.woo-type21.woocommerce a.button:hover, .woo-type21.woocommerce button.button:hover, .woo-type21.woocommerce button:hover, .woo-type21.woocommerce input.button:hover, .woo-type21.woocommerce input[type=button]:hover, .woo-type21.woocommerce input[type=submit]:hover, .woo-type21.woocommerce #respond input#submit:hover, .woo-type21.woocommerce a.button.alt:hover, .woo-type21.woocommerce button.button.alt:hover, .woo-type21.woocommerce input.button.alt:hover, .woo-type21.woocommerce #respond input#submit.alt:hover, .woo-type21.woocommerce .product .summary .add_to_wishlist:hover, .woo-type21.woocommerce .wishlist_table .add_to_cart.button:hover, .woo-type21.woocommerce .yith-wcwl-add-button a.add_to_wishlist:hover, .woo-type21.woocommerce .yith-wcwl-popup-button a.add_to_wishlist:hover, .woo-type21.woocommerce .wishlist_table a.ask-an-estimate-button:hover, .woo-type21.woocommerce .wishlist-title a.show-title-form:hover, .woo-type21.woocommerce .hidden-title-form a.hide-title-form:hover, .woo-type21.woocommerce .yith-wcwl-wishlist-new button:hover, .woo-type21.woocommerce .wishlist_manage_table a.create-new-wishlist:hover, .woo-type21.woocommerce .wishlist_manage_table button.submit-wishlist-changes:hover, .woo-type21.woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woo-type21.woocommerce .cart input.button:hover, 

				.woo-type21 .woocommerce .product .summary .add_to_wishlist:hover:before, .woo-type21.woocommerce .product .summary .add_to_wishlist:hover:before ', 'property' => 'background-color' ),

			# Primary Color - Woo Type21/StyleShop Theme
			array( 'element' => '.woo-type21 .woocommerce .product .summary .add_to_wishlist:hover, .woo-type21.woocommerce .product .summary .add_to_wishlist:hover', 'property' => 'color' ),


			# Primary BG Color - Attorney Add-on/Custom Module
			array( 'element' => '.dt-sc-attorney-sorting a.active-sort, .dt-sc-attorneys-single h5.dt-sc-attorney-role:before, .dt-sc-attorneys-single h5.dt-sc-attorney-role:after, .dt-sc-attorney .dt-sc-attorney-details h5:before, .dt-sc-attorney .dt-sc-attorney-details h5:after, .widget.widget_attroney .widgettitle:before, .attorney-contact-form-widget input[type="submit"]:hover, .dt-sc-practices-list li a:hover, .dt-sc-attorney-location-overlay p:last-child a', 'property' => 'background-color' ),

			# Primary Border Top Color - Attorney Add-on/Custom Module
			array( 'element' => '.dt-sc-attorney-location-overlay:before', 'property' => 'border-top-color' ),

			# Primary Color - Attorney Add-on/Custom Module
			array( 'element' => '.dt-sc-attorney-sorting a:hover, .dt-sc-attorneys-single h6, .dt-sc-attorney .dt-sc-attorney-details h6, .dt-sc-attorneys-single a.read-more:hover, .dt-sc-attorney .dt-sc-attorney-details a.read-more:hover, .widget.widget_attroney .widgettitle, .widget.widget_attorney_practice .attorney-practice-widget ul li a:hover, .attorney-contact-form-widget input[type="submit"], .dt-sc-attorney-location-overlay p a:hover, .dt-sc-loading:before', 'property' => 'color' ),


			# Primary BG Color - Restaurant Add-on/Custom Module
			array( 'element' => '.dt-sc-chef-single-image-overlay .dt-sc-sociable li a, .dt-sc-chef-single-image-overlay .dt-sc-chef-single-special p a:before, .dt-sc-menu .menu-categories a:before', 'property' => 'background-color' ),

			# Primary Border Color - Restaurant Add-on/Custom Module
			array( 'element' => '.dt-sc-menu-sorting a.active-sort, .dt-sc-menu .image-overlay .price', 'property' => 'border-color' ),

			# Primary Color - Restaurant Add-on/Custom Module
			array( 'element' => '.dt-sc-chef .dt-sc-chef-details p, .dt-sc-chef .dt-sc-chef-details h6, .dt-sc-chef .dt-sc-chef-details .dt-sc-chef-category a:hover, .dt-sc-chef .dt-sc-chef-details .dt-sc-button:hover, .dt-sc-chef-single-details .dt-sc-chef-single-likes p a:hover, .dt-sc-chef-single-image-overlay .dt-sc-chef-single-special h6, .dt-sc-chef-single-image-overlay .dt-sc-sociable li a:hover, .dt-sc-chef-single-image-overlay .dt-sc-chef-single-special p a:hover, .dt-sc-menu .image-overlay .price, .dt-sc-menu .image-overlay h6 a:hover, .dt-sc-menu .menu-categories a:hover, .dt-sc-menu-sorting a:hover, .dt-sc-menu-sorting a.active-sort, .dt-sc-menu .dt-sc-menu-details .dt-sc-menu-price, .dt-sc-restaurant-events-list .dt-sc-restaurant-event-details p', 'property' => 'color' ),


			# Primary BG Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-video .dt-sc-yoga-video-meta, .dt-sc-yoga-classes:hover .dt-sc-yoga-classes-details, .dt-sc-yoga-classes-sorting a, .dt-sc-yoga-pose:hover .dt-sc-yoga-pose-details, .dt-sc-yoga-teacher:hover .dt-sc-yoga-teacher-details', 'property' => 'background-color' ),

			# Primary Border Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-people-single .dt-sc-single-line-dashed-separator, .dt-sc-yoga-program-single:hover, .dt-sc-yoga-pose-single .entry-thumb:hover, .dt-sc-yoga-style-single .entry-thumb:hover', 'property' => 'border-color' ),

			# Primary Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-classes .dt-sc-yoga-classes-image-overlay a, .dt-sc-yoga-pose .dt-sc-yoga-pose-overlay a, .dt-sc-yoga-teacher .dt-sc-yoga-teacher-overlay a, .dt-sc-yoga-courses-sorting a:hover, .dt-sc-yoga-course .dt-sc-yoga-course-details h5 a:hover, .dt-sc-yoga-course .dt-sc-yoga-course-details h6 a:hover, .dt-sc-yoga-course .dt-sc-yoga-course-details .price, .dt-sc-yoga-course .dt-sc-yoga-course-thumb-overlay a, .dt-sc-yoga-program .dt-sc-yoga-program-details h5 a:hover, .dt-sc-yoga-program .dt-sc-yoga-program-details h6 a:hover, .dt-sc-yoga-program .dt-sc-yoga-program-thumb-overlay a, .dt-sc-yoga-people-info h4', 'property' => 'color' ),


			# Primary BG Color - Medical Add-on/Custom Module
			array( 'element' => '.dt-sc-doctors-sorting a.active-sort, .dt-sc-doctors .dt-sc-doctors-details ul.dt-sc-sociable li a', 'property' => 'background-color' ),

			# Primary Border Color - Medical Add-on/Custom Module
			array( 'element' => '.dt-sc-doctors-sorting a.active-sort', 'property' => 'border-color' ),

			# Primary Color - Medical Add-on/Custom Module
			array( 'element' => '.dt-sc-doctors-sorting a:hover, .dt-sc-doctors .dt-sc-doctors-details h5 a, .dt-sc-doctors .dt-sc-doctors-details ul.dt-sc-doctors-meta li span, .dt-sc-doctors .dt-sc-doctors-details ul.dt-sc-doctors-meta li a:hover, .dt-sc-doctors-single-meta li span', 'property' => 'color' ),


			# Primary BG Color - Event Add-on/Custom Module
			array( 'element' => '.dt-sc-event-addon-detail > a.buy-now', 'property' => 'background-color' ),

			# Primary Border Color - Event Add-on/Custom Module
			array( 'element' => '.dt-sc-dj-club h2', 'property' => 'border-color' ),

			# Primary Color - Event Add-on/Custom Module
			array( 'element' => '.dt-sc-event-sorting a.active-sort, .dt-sc-event-sorting a:hover, .dt-sc-event-addon-detail ul li span, .dt-sc-event-month:hover h2 a, .dt-sc-dj-profile .dt-sc-dj-profile-details h3, .dt-sc-dj-profile .dt-sc-dj-profile-details .dt-sc-dj-profile-meta p, .dt-sc-dj-club h4', 'property' => 'color' ),


			# Primary BG Color - Model Add-on/Custom Module
			array( 'element' => '.model-nav-container .model-next-link a:hover, .model-nav-container .model-prev-link a:hover', 'property' => 'background-color' ),

			# Primary Border Color - Model Add-on/Custom Module
			array( 'element' => '.model-nav-container .model-next-link a:hover, .model-nav-container .model-prev-link a:hover', 'property' => 'border-color' ),

			# Primary Color - Model Add-on/Custom Module
			array( 'element' => '.dt-sc-model figcaption h3 a:hover, .dt-sc-model-sorting a:hover, .dt-sc-model-sorting a.active-sort, .dt-sc-model-details li span, .dt-sc-model-single-slider-wrapper .bx-controls a:hover:before', 'property' => 'color' ),


			# Primary BG Color - Hotel Add-on/Custom Module
			array( 'element' => '.dt-sc-hotel-room-sorting a:before, .dt-sc-hotel-room-sorting a.active-sort:before, .dt-sc-hotel-room-single-metadata form input[type="submit"]:hover, .dt-sc-hotel-room-single-metadata form p:before', 'property' => 'background-color' ),

			# Primary Border Color - Hotel Add-on/Custom Module
			array( 'element' => '.dt-sc-hotel-room-single-metadata form, .dt-sc-hotel-room-single-metadata form input[type="submit"]', 'property' => 'border-color' ),

			# Primary Border Top Color - Hotel Add-on/Custom Module
			array( 'element' => '.dt-sc-hotel-room .dt-sc-hotel-room-thumb', 'property' => 'border-top-color' ),			

			# Primary Color - Hotel Add-on/Custom Module
			array( 'element' => '.dt-sc-hotel-room .dt-sc-hotel-room-thumb-overlay p .price, .dt-sc-hotel-room .dt-sc-hotel-room-buttons a:hover, .dt-sc-hotel-room .dt-sc-hotel-room-details .dt-sc-hotel-room-content h4, .dt-sc-hotel-room-single-details h3, .dt-sc-hotel-room-single-details ul li:before, .dt-sc-hotel-room-single-metadata .price-wrapper p .price, .dt-sc-hotel-room-single-metadata ul.dt-sc-sociable li a:hover', 'property' => 'color' ),


			# Primary BG Color - Fitness Add-on/Custom Module
			array( 'element' => '.dt-sc-training-details-overlay, .dt-sc-trainers .dt-sc-sociable, .dt-sc-workouts .dt-sc-workouts-details a span, .dt-sc-workouts .dt-sc-workouts-details a:hover, .dt-sc-fitness-program figure figcaption, .dt-sc-fitness-program-nav li a:before, .dt-sc-fitness-program-nav li.current_page_item a, .dt-sc-fitness-program-nav li a:after, .dt-sc-fitness-program-details h4:before, .dt-sc-fitness-program-details .dt-sc-pr-tb-col .dt-sc-buy-now a', 'property' => 'background-color' ),

			# Primary Border Color - Fitness Add-on/Custom Module
			array( 'element' => '.dt-sc-trainers:hover, .dt-sc-trainers:hover .dt-sc-trainers-title, .dt-sc-process-steps .dt-sc-process-thumb img', 'property' => 'border-color' ),

			# Primary Color - Fitness Add-on/Custom Module
			array( 'element' => '.dt-sc-training-details h6, .dt-sc-trainers .dt-sc-trainers-title h6, .dt-sc-workouts .dt-sc-workouts-details h4, .dt-sc-fitness-program-sorting a:hover, .dt-sc-fitness-program-sorting a.active-sort, .dt-sc-fitness-program .dt-sc-fitness-program-price sup, .dt-sc-fitness-program .dt-sc-fitness-program-price sub, .dt-sc-fitness-program-nav li a:hover, .dt-sc-fitness-program-details .dt-sc-pr-tb-col .dt-sc-price h6 sup, .dt-sc-fitness-diet-result p', 'property' => 'color' ),

		)
	));

	# secondary-color
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'secondary-color',
		'label'    => __( 'Secondary Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'priority' => 4,
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('secondary-color'),
		'active_callback' => array(
			array( 'setting' => 'use-predefined-skin', 'operator' => '==', 'value' => '0' )
		),
		'output' => array(
			# Secondary BG Color - Miscellaneous/Shortcodes
			array( 'element' => '
				input[type="submit"]:hover, button:hover, input[type="reset"]:hover, .mz-blog .comments a:hover, .mz-blog div.vc_gitem-post-category-name:hover,  .dt-sc-infinite-portfolio-load-more:hover, 

				.dt-sc-button.filled:hover, .dt-sc-button.with-icon.icon-right.type1:hover, .dt-sc-counter.type2:hover .dt-sc-couter-icon-holder, .dt-sc-newsletter-section.type2 .dt-sc-subscribe-frm input[type="submit"]:hover, .skin-highlight .dt-sc-testimonial.type6 .dt-sc-testimonial-author:before, .skin-highlight .dt-sc-testimonial.type6:after, .dt-sc-team-social.rounded-square li a:hover, .dt-sc-video-wrapper .video-overlay-inner a:hover', 'property' => 'background-color' ),

			# Secondary Border Color - Miscellaneous/Shortcodes
			array( 'element' => '.dt-sc-contact-info.type5 .dt-sc-contact-icon, .dt-sc-contact-info.type5 .dt-sc-contact-icon:before, .dt-sc-contact-info.type5 .dt-sc-contact-icon:after, .dt-sc-image-caption.type2:hover .dt-sc-image-content, .dt-sc-newsletter-section.type2 .dt-sc-subscribe-frm input[type="email"], .dt-sc-sociable.hexagon-with-border li, .dt-sc-sociable.hexagon-with-border li:before, .dt-sc-sociable.hexagon-with-border li:after', 'property' => 'border-color' ),	


			# Secondary BG Color - 404/Not-Found
			array( 'element' => '.error404 .type2 a.dt-sc-back:hover, .error404 .type4 .dt-sc-newsletter-section input[type="submit"]:hover', 'property' => 'background-color' ),


			# Secondary BG Color - BuddyPress
			array( 'element' => '#item-header-content #item-meta > #item-buttons .group-button:hover, #buddypress .activity-list li.load-more a:hover, #buddypress .activity-list li.load-newest a:hover', 'property' => 'background-color' ),

			# Secondary BG Color - BbPress
			array( 'element' => '#bbpress-forums #subscription-toggle a.subscription-toggle:hover, .bbp-submit-wrapper #bbp_topic_submit:hover', 'property' => 'background-color' ),

			# Secondary BG Color - Events
			array( 'element' => '#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover, .tribe-events-read-more:hover, #tribe-events .tribe-events-button:hover, .tribe-events-button:hover, .tribe-events-back > a:hover, .datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover, #tribe_events_filters_toggle:hover', 'property' => 'background-color' ),

			# Secondary BG Color - Events Pro
			array( 'element' => '.tribe-grid-header .tribe-week-today', 'property' => 'background-color' ),

			# Secondary BG Color - WooCommerce Defaults
			array( 'element' => '.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce button:hover, .woocommerce input.button:hover, .woocommerce input[type=button]:hover, .woocommerce input[type=submit]:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce .product .summary .add_to_wishlist:hover, .woocommerce .wishlist_table .add_to_cart.button:hover, .woocommerce .yith-wcwl-add-button a.add_to_wishlist:hover, .woocommerce .yith-wcwl-popup-button a.add_to_wishlist:hover, .woocommerce .wishlist_table a.ask-an-estimate-button:hover, .woocommerce .wishlist-title a.show-title-form:hover, .woocommerce .hidden-title-form a.hide-title-form:hover, .woocommerce .yith-wcwl-wishlist-new button:hover, .woocommerce .wishlist_manage_table a.create-new-wishlist:hover, .woocommerce .wishlist_manage_table button.submit-wishlist-changes:hover, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woocommerce .cart input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page button:hover, .woocommerce-page input.button:hover, .woocommerce-page input[type=button]:hover, .woocommerce-page input[type=submit]:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page .product .summary .add_to_wishlist:hover, .woocommerce-page .wishlist_table .add_to_cart.button:hover, .woocommerce-page .yith-wcwl-add-button a.add_to_wishlist:hover, .woocommerce-page .yith-wcwl-popup-button a.add_to_wishlist:hover, .woocommerce-page .wishlist_table a.ask-an-estimate-button:hover, .woocommerce-page .wishlist-title a.show-title-form:hover, .woocommerce-page .hidden-title-form a.hide-title-form:hover, .woocommerce-page .yith-wcwl-wishlist-new button:hover, .woocommerce-page .wishlist_manage_table a.create-new-wishlist:hover, .woocommerce-page .wishlist_manage_table button.submit-wishlist-changes:hover, .woocommerce-page .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woocommerce-page .cart input.button:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt[disabled]:disabled, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt[disabled]:disabled, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt[disabled]:disabled, .woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled:hover, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover', 'property' => 'background-color' ),


			# Secondary BG Color - Woo Type3/Business Theme
			array( 'element' => '.woo-type3 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type3 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type3 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type3 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type3 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type3 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type3 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover', 'property' => 'background-color' ),


			# Secondary BG Color - Woo Type4/Hosting Theme
			array( 'element' => '.woo-type4 ul.products li.product .product-thumb a.add_to_cart_button:hover:after, .woo-type4 ul.products li.product .product-thumb a.button.product_type_simple:hover:after, .woo-type4 ul.products li.product .product-thumb a.button.product_type_variable:hover:after, .woo-type4 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:after, .woo-type4 ul.products li.product .product-thumb a.add_to_wishlist:hover:after, .woo-type4 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:after, .woo-type4 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:after', 'property' => 'background-color' ),


			# Secondary BG Color - Woo Type5/Spa Theme
			array( 'element' => '.woo-type5 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type5 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type5 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type5 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type5 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type5 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type5 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover', 'property' => 'background-color' ),


			# Secondary BG Color - Woo Type7/University Theme
			array( 'element' => '.woo-type7 ul.products li.product .product-details h5', 'property' => 'background-color' ),


			# Secondary Border Color - Woo Type8/Insurance Theme
			array( 'element' => '.woo-type8 ul.products li.product:hover .product-wrapper', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type9/Plumber Theme
			array( 'element' => '.woo-type9 ul.products li.product .product-thumb a.add_to_cart_button:after, .woo-type9 ul.products li.product .product-thumb a.button.product_type_simple:after, .woo-type9 ul.products li.product .product-thumb a.button.product_type_variable:after, .woo-type9 ul.products li.product .product-thumb a.added_to_cart.wc-forward:after, .woo-type9 ul.products li.product .product-thumb a.add_to_wishlist:after, .woo-type9 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:after, .woo-type9 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:after, .woo-type9 ul.products li.product:hover .product-details', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type9/Plumber Theme
			array( 'element' => '.woo-type9 ul.products li.product:hover .product-details h5:after', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type10/Medical Theme
			array( 'element' => '.woo-type10 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type10 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type10 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type10 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type10 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type10 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type10 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, .woo-type10.woocommerce ul.products li.product .featured-tag, .woo-type10 .woocommerce ul.products li.product .featured-tag, .woo-type10.woocommerce.single-product .featured-tag', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type10/Medical Theme
			array( 'element' => '.woo-type10 ul.products li.product .featured-tag:after, .woo-type10 ul.products li.product:hover .featured-tag:after, .woo-type10.woocommerce.single-product .featured-tag:after', 'property' => 'border-color' ),


			# Secondary Border Color - Woo Type11/Model Theme
			array( 'element' => '.woo-type11 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type11 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type11 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type11 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type11 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type11 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type11 ul.products li.product:hover .product-wrapper:before, .woo-type11 ul.products li.product:hover .product-wrapper:after, .woo-type11.woocommerce ul.products li.product .product-thumb, .woo-type11 .woocommerce ul.products li.product .product-thumb, .woo-type11 ul.products li.product-category a img', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type12/Attorney Theme
			array( 'element' => '.woo-type12 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type12 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type12 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type12 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type12 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type12 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type12 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover, .woo-type12 ul.products li.product:hover .product-details h5:after', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type12/Attorney Theme
			array( 'element' => '.woo-type12 ul.products li.product:hover .product-wrapper', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type14/Fitness Theme
			array( 'element' => '.woo-type14 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type14 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type14 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type14 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type14 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type14 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type14 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover', 'property' => 'background-color' ),


			# Secondary BG Color - Woo Type15/Hotel Theme
			array( 'element' => '.woo-type15 ul.products li.product .product-thumb a.add_to_cart_button:hover:after, .woo-type15 ul.products li.product .product-thumb a.button.product_type_simple:hover:after, .woo-type15 ul.products li.product .product-thumb a.button.product_type_variable:hover:after, .woo-type15 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover:after, .woo-type15 ul.products li.product .product-thumb a.add_to_wishlist:hover:after, .woo-type15 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover:after, .woo-type15 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover:after, .woo-type15.woocommerce ul.products li.product .featured-tag, .woo-type15 .woocommerce ul.products li.product .featured-tag, .woo-type15.woocommerce.single-product .featured-tag', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type15/Hotel Theme
			array( 'element' => '.woo-type15.woocommerce ul.products li.product .featured-tag:after, .woo-type15.woocommerce ul.products li.product:hover .featured-tag:after, .woo-type15 .woocommerce ul.products li.product .featured-tag:after, .woo-type15 .woocommerce ul.products li.product:hover .featured-tag:after, .woo-type15.woocommerce.single-product .featured-tag:after', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type17/Restaurant Theme
			array( 'element' => '.woo-type17.woocommerce ul.products li.product .featured-tag, .woo-type17 .woocommerce ul.products li.product .featured-tag, .woo-type17.woocommerce.single-product .featured-tag', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type17/Restaurant Theme
			array( 'element' => '.woo-type17 ul.products li.product .featured-tag:after, .woo-type17 ul.products li.product:hover .featured-tag:after, .woo-type17.woocommerce.single-product .featured-tag:after', 'property' => 'border-color' ),


			# Secondary BG Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product .product-thumb a.add_to_cart_button:hover, .woo-type18 ul.products li.product .product-thumb a.button.product_type_simple:hover, .woo-type18 ul.products li.product .product-thumb a.button.product_type_variable:hover, .woo-type18 ul.products li.product .product-thumb a.added_to_cart.wc-forward:hover, .woo-type18 ul.products li.product .product-thumb a.add_to_wishlist:hover, .woo-type18 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a:hover, .woo-type18 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a:hover', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product:hover .product-details h5', 'property' => 'border-color' ),	

			# Secondary Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product:hover .product-details h5 a, .woo-type18 ul.products li.product-category:hover .product-details h5, .woo-type18 ul.products li.product-category:hover .product-details h5 .count, .woo-type18 ul.products li.product:hover .product-details .product-price .amount, .woo-type18 ul.products li.product:hover .product-details span.price, .woo-type18 ul.products li.product:hover .product-details span.price del, .woo-type18 ul.products li.product:hover .product-details span.price del .amount, .woo-type18 ul.products li.product:hover .product-details span.price ins, .woo-type18 ul.products li.product:hover .product-details span.price ins .amount, .woo-type18 ul.products li.product .product-details .product-rating-wrapper .star-rating:before, .woo-type18 ul.products li.product .product-details .product-rating-wrapper .star-rating span:before', 'property' => 'color' ),

			
			# Secondary BG Color - Woo Type20/Yoga Theme
			array( 'element' => '.woo-type20.woocommerce .shop_table th, .woo-type20 .woocommerce .shop_table th, .woo-type20.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after', 'property' => 'background-color' ),

			# Secondary Border Color - Woo Type20/Yoga Theme
			array( 'element' => '.woo-type20 ul.products li.product:hover .product-wrapper:after, .woo-type20 div.product div.images img', 'property' => 'border-color' ),

			# Secondary Color - Woo Type20/Yoga Theme
			array( 'element' => '.woo-type20.woocommerce-checkout #payment ul.payment_methods li a:hover', 'property' => 'color' ),


			# Secondary BG Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-classes-sorting a:hover, .dt-sc-yoga-classes-sorting a.active-sort', 'property' => 'background-color' ),

			# Secondary Color - Yoga Add-on/Custom Module
			array( 'element' => '.yoga-single-meta li span', 'property' => 'color' ),


			# Secondary BG Color - Medical Add-on/Custom Module
			array( 'element' => '.dt-sc-doctors .dt-sc-doctors-details ul.dt-sc-sociable li a:hover', 'property' => 'background-color' ),


			# Secondary Color - Event Add-on/Custom Module
			array( 'element' => '.dt-sc-event-sorting a, .dt-sc-event-month-meta li', 'property' => 'color' ),


			# Secondary BG Color - Model Add-on/Custom Module
			array( 'element' => '.dt-sc-model-sorting a:before', 'property' => 'background-color' ),

			# Secondary Color - Model Add-on/Custom Module
			array( 'element' => '.dt-sc-model-sorting a', 'property' => 'color' ),				

		),
	));

	# tertiary-color
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'tertiary-color',
		'label'    => __( 'Tertiary Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'priority' => 5,
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('tertiary-color'),
		'active_callback' => array(
			array( 'setting' => 'use-predefined-skin', 'operator' => '==', 'value' => '0' )
		),
		'output' => array(
			# Tertiary BG Color - Miscellaneous/Shortcodes
			array( 'element' => '.dt-sc-triangle-title:before, .dt-sc-icon-box.type10 .icon-wrapper:after', 'property' => 'background-color' ),	


			# Tertiary BG Color - Woo Type2/Jewel Theme
			array( 'element' => '.woo-type2 ul.products li.product .product-thumb a.add_to_cart_button, .woo-type2 ul.products li.product .product-thumb a.button.product_type_simple, .woo-type2 ul.products li.product .product-thumb a.button.product_type_variable, .woo-type2 ul.products li.product .product-thumb a.added_to_cart.wc-forward, .woo-type2 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type2 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type2 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type2.woocommerce ul.products li.product .onsale, .woo-type2.woocommerce ul.products li.product:hover .onsale, .woo-type2 .woocommerce ul.products li.product .onsale, .woo-type2 .woocommerce ul.products li.product:hover .onsale, .woo-type2.woocommerce ul.products li.product .out-of-stock, .woo-type2.woocommerce ul.products li.product:hover .out-of-stock, .woo-type2 .woocommerce ul.products li.product .out-of-stock, .woo-type2 .woocommerce ul.products li.product:hover .out-of-stock, .woo-type2.woocommerce span.onsale, .woo-type2.woocommerce span.out-of-stock, .woo-type2 .woocommerce span.onsale, .woo-type2 .woocommerce span.out-of-stock, .woo-type2 div.product .woocommerce-tabs ul.tabs li.active a', 'property' => 'background-color' ),

			# Tertiary Color - Woo Type2/Jewel Theme
			array( 'element' => '.woo-type2 div.product .summary a, .woo-type2 .shipping-calculator-button, .woo-type2.woocommerce-checkout #payment ul.payment_methods li a:hover', 'property' => 'color' ),


			# Tertiary BG Color - Woo Type7/University Theme
			array( 'element' => '.woo-type7 ul.products li.product .product-thumb a.add_to_wishlist, .woo-type7 ul.products li.product .product-thumb .yith-wcwl-wishlistaddedbrowse a, .woo-type7 ul.products li.product .product-thumb .yith-wcwl-wishlistexistsbrowse a, .woo-type7 ul.products li.product:hover .product-details', 'property' => 'background-color' ),


			# Tertiary Border Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product:hover .product-wrapper:after', 'property' => 'border-color' ),	

			# Tertiary Color - Woo Type18/Event Theme
			array( 'element' => '.woo-type18 ul.products li.product:hover .product-details h5 a:hover, .woo-type18.woocommerce-checkout #payment ul.payment_methods li a:hover', 'property' => 'color' ),


			# Tertiary BG Color - Yoga Add-on/Custom Module
			array( 'element' => '.yoga-video-sorting input[type="submit"], .dt-sc-yoga-classes .dt-sc-yoga-classes-image-overlay a:hover, .dt-sc-yoga-courses-sorting a.active-sort, .dt-sc-yoga-courses-sorting a:before, .dt-sc-yoga-course .dt-sc-yoga-course-thumb-overlay a:hover, .dt-sc-yoga-pose .dt-sc-yoga-pose-overlay a:hover, .dt-sc-yoga-teacher .dt-sc-yoga-teacher-overlay a:hover, .dt-sc-yoga-program .dt-sc-yoga-program-thumb-overlay a:hover', 'property' => 'background-color' ),

			# Tertiary Border Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-video .dt-sc-yoga-video-overlay p a', 'property' => 'border-color' ),

			# Tertiary Color - Yoga Add-on/Custom Module
			array( 'element' => '.dt-sc-yoga-video .dt-sc-yoga-video-overlay p a, .dt-sc-yoga-video .dt-sc-yoga-video-overlay h6 a:hover, .dt-sc-yoga-courses-sorting a, .dt-sc-yoga-course .dt-sc-yoga-course-meta p, .dt-sc-yoga-course .dt-sc-yoga-course-details h6 a, .dt-sc-yoga-program .dt-sc-yoga-program-meta p, .dt-sc-yoga-program .dt-sc-yoga-program-details h6 a', 'property' => 'color' ),

			# Tertiary BG Color - Event Add-on/Custom Module
			array( 'element' => '.dt-sc-event-month-thumb .dt-sc-event-month-date-wrapper', 'property' => 'background-color' ),


			# Tertiary BG Color - University Add-on/Custom Module
			array( 'element' => '.dt-sc-course .dt-sc-course-overlay a', 'property' => 'background-color' ),

			# Tertiary Color - University Add-on/Custom Module
			array( 'element' => '.dt-sc-faculty-sorting a:hover, .dt-sc-faculty-sorting a.active-sort, .dt-sc-course .dt-sc-course-details .dt-sc-course-meta p span, .dt-sc-course.no-course-thumb .dt-sc-course-details h5 a', 'property' => 'color' ),


			# Tertiary Color - Fitness Add-on/Custom Module
			array( 'element' => '.dt-sc-training-details-overlay h6, .dt-sc-training-details-overlay .price, .dt-sc-training-details .dt-sc-training-details-overlay h6', 'property' => 'color' ),


		),
	));

	# Divider
	BEGIN_Kirki::add_field( $config ,array(
		'type'=> 'custom',
		'settings' => 'custom-skin-divider',
		'section'  => 'dt_site_skin_section',
		'default'  => '<div class="customize-control-divider"></div>',
		'active_callback' => array(
			array( 'setting' => 'use-predefined-skin', 'operator' => '==', 'value' => '0' )
		)			
	));

	# body-bg-color
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'body-bg-color',
		'label'    => __( 'Site BG Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'output' => array(
			array( 'element' => '
				body, .layout-boxed .inner-wrapper, 
				.secondary-sidebar .type8 .widgettitle, .secondary-sidebar .type10 .widgettitle:after, 
				.dt-sc-contact-info.type3::after, .dt-sc-image-caption .dt-sc-image-wrapper .icon-wrapper::after, 
				ul.products li .product-wrapper, .woocommerce-tabs .panel, .select2-results, .woocommerce .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce .woocommerce-error, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woo-type13 ul.products li.product:hover .product-details h5 a,
				.tribe-events-list-separator-month span' , 'property' => 'background-color' ),
			array( 'element' => '.dt-sc-image-caption.type8 .dt-sc-image-content::before' , 'property' => 'border-color' ),
			array( 'element' => '.secondary-sidebar .type14 .widgettitle:before, .widget.buddypress div.item-options a.selected' , 'property' => 'border-bottom-color' ),
			array( 'element' => '.dt-sc-testimonial.type2 blockquote::before' , 'property' => 'border-top-color' ),

		),
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('body-bg-color'),
	));

	# body-content-color 			
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'body-content-color',
		'label'    => __( 'Site Content Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'color' )
		),
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('body-content-color'),
	));

	# body-a-color 			
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'body-a-color',
		'label'    => __( 'Site Link Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'output' => array(
			array( 'element' => 'a' , 'property' => 'color' )
		),
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('body-a-color'),
	));

	# body-a-hover-color 			
	BEGIN_Kirki::add_field( $config, array(
		'type' => 'color',
		'settings' => 'body-a-hover-color',
		'label'    => __( 'Site Link Hover Color', 'begin' ),
		'section'  => 'dt_site_skin_section',
		'output' => array(
			array( 'element' => 'a:hover' , 'property' => 'color' )
		),
		'choices' => array( 'alpha' => true ),
		'default'  => begin_defaults('body-a-hover-color'),
	));					