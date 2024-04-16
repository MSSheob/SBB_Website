<?php add_action( 'vc_before_init', 'dt_sc_domain_box_vc_map' );
function dt_sc_domain_box_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Domain item", 'designthemes-core' ),
		"base" => "dt_sc_domain_box",
		"icon" => "dt_sc_domains_wrapper",
		"category" => DT_VC_CATEGORY,
		'as_child' => array( 'only' => 'dt_sc_domains_wrapper' ),
		'description' => esc_html__( 'Add domain item', 'designthemes-core' ),
		"params" => array(

			# Title
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Title', 'designthemes-core' ),
				'description' => esc_html__( 'Enter title', 'designthemes-core' ),
				'admin_label' => true
			),

			# Domain
			array(
				'type' => 'textfield',
				'param_name' => 'domain',
				'heading' => esc_html__( 'Domain', 'designthemes-core' ),
				'description' => esc_html__( 'Enter domain eg: .com / .net', 'designthemes-core' ),
				'admin_label' => true
			),			

			# Icon
			array(
				'type' => 'textfield',
				'param_name' => 'icon',
				'heading' => esc_html__( 'Icon class', 'designthemes-core' ),
				'description' => esc_html__( 'Enter icon class eg: (pe-icon pe-check or fa fa-home)', 'designthemes-core' )
			),

			# Price
			array(
				'type' => 'textfield',
				'param_name' => 'price',
				'heading' => esc_html__( 'Price', 'designthemes-core' ),
				'description' => esc_html__( 'Enter price eg: $12.85', 'designthemes-core' ),
				'admin_label' => true
			),

			// Link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'designthemes-core' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link', 'designthemes-core' ),
			),

          	# Extra class name
          	array(
          		'type' => 'textfield',
          		'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
          		'param_name' => 'class',
          		'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'designthemes-core' )
          	)									
		)
	) );
}?>