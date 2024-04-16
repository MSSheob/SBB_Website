<?php
if (! class_exists ( 'DTCoreVC' )) {

	class DTCoreVC {

		function __construct() {

			add_action( 'vc_before_init', array ( $this, 'dt_vcSetAsTheme') );
			add_action( 'admin_enqueue_scripts', array ( $this, 'dt_vc_admin_scripts') );
			add_filter( 'vc_load_default_templates',  array( $this, 'dt_vc_custom_template_modify_array' ) );
			add_action( 'after_setup_theme', array( $this, 'dt_map_shortcodes') );
			add_action( 'init', array( $this, 'dt_vs_contanct_form_7_fields') );
			
			// Grid Template Variables
			add_filter('vc_gitem_template_attribute_dt_post_format', array( $this, 'vc_gitem_template_attribute_dt_post_format' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_tag', array( $this, 'vc_gitem_template_attribute_dt_post_tag' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_category', array( $this, 'vc_gitem_template_attribute_dt_post_category' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_comment', array( $this, 'vc_gitem_template_attribute_dt_post_comment' ), 10, 2 );
			add_filter('vc_grid_item_shortcodes', array( $this, 'dt_vc_add_grid_shortcodes' ) );
		}

		function dt_vcSetAsTheme() {
			vc_set_as_theme();
		}

		function dt_vc_admin_scripts( $hook ) {

			if($hook == "post.php" || $hook == "post-new.php") {

				wp_enqueue_style( 'dt-vc-admin', plugins_url('designthemes-core-features') .'/visual-composer/admin.css', false, BEGIN_THEME_VERSION, 'all' );
			}
		}

		function dt_vc_custom_template_modify_array( $templates ) {
			return array();
		}

		function dt_map_shortcodes() {

			require_once plugin_dir_path( __FILE__ ).'modules/index.php';
		}

		function dt_vs_contanct_form_7_fields() {
			vc_add_param('contact-form-7',array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
				'param_name' => 'html_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'designthemes-core' ),
			) );
		}

		function vc_gitem_template_attribute_dt_post_format( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_format.php' );
		}

		function vc_gitem_template_attribute_dt_post_tag( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_tag.php' );
		}

		function vc_gitem_template_attribute_dt_post_category( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_category.php' );
		}		

		function vc_gitem_template_attribute_dt_post_comment( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_comment.php' );
		}

		function dt_vc_add_grid_shortcodes( $shortcodes ) {

			# Post Format
			$shortcodes['dt_sc_gitem_post_format'] = array(
				'name' => esc_html__( 'Post Format', 'designthemes-core' ),
				'base' => 'dt_sc_gitem_post_format',
				'category' => esc_html__( 'Post', 'designthemes-core' ),
				'description' => esc_html__( 'Post Format of current post', 'designthemes-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'designthemes-core')
					)
				)
			);

			# Post Tag
			$shortcodes['dt_sc_gitem_post_tag'] = array(
				'name' => esc_html__( 'Post Tag', 'designthemes-core' ),
				'base' => 'dt_sc_gitem_post_tag',
				'category' => esc_html__( 'Post', 'designthemes-core' ),
				'description' => esc_html__( 'Post Tags of current post', 'designthemes-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'designthemes-core')
					)
				)
			);

			# Post Category
			$shortcodes['dt_sc_gitem_post_category'] = array(
				'name' => esc_html__( 'Post Categories', 'designthemes-core' ),
				'base' => 'dt_sc_gitem_post_category',
				'category' => esc_html__( 'Post', 'designthemes-core' ),
				'description' => esc_html__( 'Categories of current post', 'designthemes-core' ),
				'params' => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Add link', 'designthemes-core' ),
						'param_name' => 'link',
						'description' => esc_html__( 'Add link to category?', 'designthemes-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'designthemes-core' ),
						'param_name' => 'category_style',
						'value' => array(
							esc_html__( 'None', 'designthemes-core' ) => ' ',
							esc_html__( 'Comma', 'designthemes-core' ) => ', ',
							esc_html__( 'Rounded', 'designthemes-core' ) => 'filled vc_grid-filter-filled-round-all',
							esc_html__( 'Less Rounded', 'designthemes-core' ) => 'filled vc_grid-filter-filled-rounded-all',
							esc_html__( 'Border', 'designthemes-core' ) => 'bordered',
							esc_html__( 'Rounded Border', 'designthemes-core' ) => 'bordered-rounded vc_grid-filter-filled-round-all',
							esc_html__( 'Less Rounded Border', 'designthemes-core' ) => 'bordered-rounded-less vc_grid-filter-filled-rounded-all',
						),
						'description' => esc_html__( 'Select category display style.', 'designthemes-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Color', 'designthemes-core' ),
						'param_name' => 'category_color',
						'value' => getVcShared( 'colors' ),
						'std' => 'grey',
						'param_holder_class' => 'vc_colored-dropdown',
						'dependency' => array(
							'element' => 'category_style',
							'value_not_equal_to' => array( ' ', ', ' ),
						),
						'description' => esc_html__( 'Select category color.', 'designthemes-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category size', 'designthemes-core' ),
						'param_name' => 'category_size',
						'value' => getVcShared( 'sizes' ),
						'std' => 'md',
						'description' => esc_html__( 'Select category size.', 'designthemes-core' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'designthemes-core' ),
					),
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS box', 'designthemes-core' ),
						'param_name' => 'css',
						'group' => esc_html__( 'Design Options', 'designthemes-core' ),
					),
				),
				'post_type' => Vc_Grid_Item_Editor::postType(),
			);

			# Post Comment
			$shortcodes['dt_sc_gitem_post_comment'] = array(
				'name' => esc_html__( 'Post Comment', 'designthemes-core' ),
				'base' => 'dt_sc_gitem_post_comment',
				'category' => esc_html__( 'Post', 'designthemes-core' ),
				'description' => esc_html__( 'Post Comment Count of current post', 'designthemes-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'designthemes-core')
					)
				)
			);						

			return $shortcodes;
		}
	}
}