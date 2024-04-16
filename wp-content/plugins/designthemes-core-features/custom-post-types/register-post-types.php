<?php
if (! class_exists ( 'DTCoreCustomPostTypes' )) {

	/**
	 *
	 * @author iamdesigning11
	 *        
	 */
	class DTCoreCustomPostTypes {
		
		function __construct() {

			// Portfolio custom post type
			require_once plugin_dir_path ( __FILE__ ) . '/dt-portfolio-post-type.php';
			if (class_exists ( 'DTPortfolioPostType' )) {
				new DTPortfolioPostType();
			}
		}
	}
}
?>