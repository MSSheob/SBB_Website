<?php add_action( 'vc_before_init', 'dt_sc_hr_timeline_slider_vc_map' );
function dt_sc_hr_timeline_slider_vc_map() {

	class WPBakeryShortCode_dt_sc_hr_timeline_slider extends WPBakeryShortCodesContainer {
	}

	vc_map( array(
		"name" => esc_html__( "Horizontal Timeline Slider", 'designthemes-core' ),
		"base" => "dt_sc_hr_timeline_slider",
		"icon" => "dt_sc_hr_timeline_slider",
		"category" => DT_VC_CATEGORY,
		"content_element" => true,
		"js_view" => 'VcColumnView',
		'as_parent' => array( 'only' => 'dt_sc_hr_timeline_entry' ),
		'description' => esc_html__( 'Horizontal Timeline Slider', 'designthemes-core' ),
		"params" => array(

			# Number Of Items
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Number Of Items To show', 'designthemes-core' ),
      			'param_name' => 'items_to_show',
      			'value' => array( 
      				esc_html__('1','designthemes-core') => '1',	
      				esc_html__('2','designthemes-core') => '3',		
      				esc_html__('5','designthemes-core') => '5',
      				esc_html__('7','designthemes-core') => '7'
      			),
      			'description' => esc_html__( 'Number of timeline items to show', 'designthemes-core' ),
      			'std' => '5',
      			'admin_label' => true
      		),

			# Enable Dotted Navigation
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Enable Dotted Navigation', 'designthemes-core' ),
      			'param_name' => 'enable_dots',
      			'value' => array( 
      				esc_html__('False','designthemes-core') => 'false',	
      				esc_html__('True','designthemes-core') => 'true',		
      			),
      			'description' => esc_html__( 'If you wish you can enable dotted navigation here.', 'designthemes-core' ),
      			'std' => 'false',
      			'admin_label' => true
      		),

			# Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'designthemes-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS','designthemes-core')
      		)			

		)
	) );
}