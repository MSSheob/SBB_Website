<?php add_action( 'vc_before_init', 'dt_sc_hexagon_item_vc_map' );
function dt_sc_hexagon_item_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Hexagon item", 'designthemes-core' ),
		"base" => "dt_sc_hexagon_item",
		"icon" => "dt_sc_single_hexagon",
		"category" => DT_VC_CATEGORY,
		'as_child' => array( 'only' => 'dt_sc_hexagon_wrapper' ),
		'description' => esc_html__( 'Hexagon item', 'designthemes-core' ),
		"params" => array(

			# Title
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Title', 'designthemes-core' ),
				'description' => esc_html__( 'Enter title', 'designthemes-core' ),
				'admin_label' => true
			),

			# Icon
			array(
				'type' => 'textfield',
				'param_name' => 'icon',
				'heading' => esc_html__( 'Icon class', 'designthemes-core' ),
				'description' => esc_html__( 'Enter icon class eg: (icon icon-speedometter or fa fa-home)', 'designthemes-core' )
			),
		)
	) );
}?>