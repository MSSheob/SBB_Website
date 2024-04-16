<?php 
// WooCommerce Theme Support -------------------------------------------------
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Disable WooCommerce Styles ------------------------------------------------
if ( version_compare( get_option('woocommerce_version'), "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

// Product has Gallery -------------------------------------------------------
if(!is_admin())
	add_filter( 'post_class', 'begin_product_has_gallery' );

function begin_product_has_gallery( $classes ) {
	global $product;
	
	if(isset($product) && !empty($product)) {
		$post_type = get_post_type( get_the_ID() );
		if ( $post_type == 'product' ) {
			$attachment_ids = $product->get_gallery_image_ids();
			if ( !empty($attachment_ids) ) {
				$classes[] = 'pif-has-gallery';
			}
		}
	}
	return $classes;
}

// Change Image Sizes --------------------------------------------------------
$pagenow = begin_global_variables('pagenow');
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'begin_woo_image_dimensions', 1 );
function begin_woo_image_dimensions() {
	$catalog 	= 	array('width' => '500', 'height'	=> '500', 'crop' => 1);
    $single 	= 	array('width' => '500', 'height' 	=> '500', 'crop' => 1);
	$thumbnail 	= 	array('width' => '200', 'height'	=> '200', 'crop' => 1);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

// No.of Products per row ----------------------------------------------------
add_filter( 'loop_shop_columns', 'begin_woo_loop_columns' );
if (!function_exists('begin_woo_loop_columns')) {
	function begin_woo_loop_columns() {
		
		$shop_layout = cs_get_option( 'shop-page-product-layout' );
		$columns = "";
		switch($shop_layout) {
			
			case "one-half-column":
				$columns = 2;
			break;
			
			case "one-third-column":
				$columns = 3;
			break;
			
			case "one-fourth-column":
				$columns = 4;
			break;
			
			default:
				$columns = 4;
		}
		return $columns;
	}
}

// No.of Products per page ---------------------------------------------------
add_filter( 'loop_shop_per_page', 'begin_woo_product_count' );
if (!function_exists('begin_woo_product_count')) {
	function begin_woo_product_count() {
		$shop_product_per_page = cs_get_option( 'shop-product-per-page' );
		$shop_product_per_page = !empty( $shop_product_per_page)  ? $shop_product_per_page : 9;
		return $shop_product_per_page;
	}
}

// Add / Remove WooCommerce actions ------------------------------------------
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); // remove rating
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); // remove woo pagination

// Adjust WooCommerce pages markup -------------------------------------------
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); // To remove add to cart in shop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

// Hide page title -----------------------------------------------------------
add_action( 'woocommerce_show_page_title', 'begin_woo_show_page_title', 10);
if( !function_exists('begin_woo_show_page_title') ) {
	function begin_woo_show_page_title() {
		return false;
	}
}

// Before main content -------------------------------------------------------
add_action( 'woocommerce_before_main_content', 'begin_woo_before_main_content', 10);
if( !function_exists('begin_woo_before_main_content') ) {
	function begin_woo_before_main_content() {

		if( is_shop() ):
			// Page Settings
			$tpl_default_settings = get_post_meta( get_option('woocommerce_shop_page_id') ,'_tpl_default_settings',TRUE);
			$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
		
			$page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";

		elseif( is_product() ):
			$page_layout = cs_get_option( 'product-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_category() ):
			$page_layout = cs_get_option( 'product-category-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_tag() ):
			$page_layout = cs_get_option( 'product-tag-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
		endif;

		if($page_layout == 'with-left-sidebar'):
		  echo '<section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left">';
			get_sidebar('left');
		  echo '</section>';
		elseif($page_layout == 'with-both-sidebar'):
		  echo '<section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left">';
			get_sidebar('left');
		  echo '</section>';
		endif;
	
		if($page_layout != 'content-full-width'):
			echo '<section id="primary" class="page-with-sidebar '.$page_layout.'">';
		else:
			echo '<section id="primary" class="content-full-width">';
		endif;
	}
}

// After main content -------------------------------------------------------
add_action( 'woocommerce_after_main_content', 'begin_woo_after_main_content', 20);
if( !function_exists('begin_woo_after_main_content') ) {
	function begin_woo_after_main_content() {

		echo "</section>";

		if( is_shop() ):
			// Page Settings
			$tpl_default_settings = get_post_meta( get_option('woocommerce_shop_page_id') ,'_tpl_default_settings',TRUE);
			$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
			
			$page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";

		elseif( is_product() ):
			$page_layout = cs_get_option( 'product-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_category() ):
			$page_layout = cs_get_option( 'product-category-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_tag() ):
			$page_layout = cs_get_option( 'product-tag-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
		endif;

		if($page_layout == 'with-right-sidebar'):
			echo '<section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right">';
				get_sidebar('right');
			echo '</section>';
		elseif($page_layout == 'with-both-sidebar'):
			echo '<section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right">';
				get_sidebar('right');
			echo '</section>';
		endif;
	}
}

/* ---------------------------------------------------------------------------
 * wrap the product categories with column class
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_before_subcategory', 'begin_woo_before_subcategory', 5);
function begin_woo_before_subcategory() {
	global $woocommerce_loop;

	$class = $out = "";

	if( is_shop() ):
		$column = cs_get_option( 'shop-page-product-layout' );
		switch($column) {
			case "one-half-column":
				$class .= " dt-sc-one-half column ";
			break;

			case "one-third-column":
				$class .= " dt-sc-one-third column ";
			break;

			case "one-fourth-column":
				$class .= " dt-sc-one-fourth column ";
			break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
			break;	
		}	
	else:
		$column = $woocommerce_loop['columns'];		
		switch($column) {
			case 2:
				$class .= " dt-sc-one-half column ";
			break;

			case 3:
				$class .= " dt-sc-one-third column ";
			break;

			case 4:
				$class .= " dt-sc-one-fourth column ";
			break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
			break;
		}
	endif;

	$out .= "<div class='{$class}'>";
	$out .= "<div class='product-wrapper'>";
	echo ($out);
}



add_action( 'woocommerce_before_subcategory_title', 'begin_woocommerce_before_subcategory_title', 5);
function begin_woocommerce_before_subcategory_title() {
	echo '<div class="product-thumb"><span class="image">';
}

remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action( 'woocommerce_after_subcategory_title', 'begin_woocommerce_after_subcategory_title', 10);
function begin_woocommerce_after_subcategory_title( $category ) {
	echo '</span></div>';
	echo '<div class="product-details"><h5>'.$category->name;
		if ( $category->count > 0 ) {
			echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
		}
	echo '</h5></div>';
}

// End loop of product category ---------------------------------------------
add_action( 'woocommerce_after_subcategory', 'begin_woo_after_subcategory', 10);
function begin_woo_after_subcategory() {
	echo '</div></div>';
}

/* ---------------------------------------------------------------------------
 * Prodcut Loop
 * wrap products on overview pages into an extra div for improved styling options. adds "product_on_sale" class if prodct is on sale
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_before_shop_loop_item', 'begin_woo_shop_overview_extra_div', 5);
function begin_woo_shop_overview_extra_div() {
	global $product, $woocommerce_loop;
	
	$class = $out = "";
	
	if( is_shop() ):
		$column = cs_get_option( 'shop-page-product-layout' );
		switch($column) {
			case "one-half-column":
				$class .= " dt-sc-one-half column ";
			break;

			case "one-third-column":
				$class .= " dt-sc-one-third column ";
			break;

			case "one-fourth-column":
				$class .= " dt-sc-one-fourth column ";
			break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
			break;	
		}	
	else:
		$column = $woocommerce_loop['columns'];		
		switch($column) {
			case 2:
				$class .= " dt-sc-one-half column ";
			break;

			case 3:
				$class .= " dt-sc-one-third column ";
			break;

			case 4:
				$class .= " dt-sc-one-fourth column ";
			break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
			break;	
		}
	endif;		
	
	if( $product->is_featured() )
		$class .= " featured-product ";
		
	if( $product->is_on_sale() )
		$class .= " on-sale-product ";

	if( $product->is_in_stock() )
		$class .= " in-stock-product ";
	else	
		$class .= " out-of-stock-product ";
	
	$out .= "<div class='{$class}'>";
	$out .= "<div class='product-wrapper'>";
	echo ($out);
}

/* ---------------------------------------------------------------------------
 * Before products title markups (featured, on sale, out of stock etc...)
 * --------------------------------------------------------------------------- */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'begin_woo_show_product_loop_sale_flash', 10 );
function begin_woo_show_product_loop_sale_flash() {
	global $product;
	$out = "";
	if( $product->is_on_sale() and $product->is_in_stock() )
		$out = '<span class="onsale"><span>'.esc_html__('Sale','begin').'</span></span>';

	elseif(!$product->is_in_stock())
		$out = '<span class="out-of-stock"><span>'.esc_html__('Out of Stock','begin').'</span></span>';

	if( $product->is_featured())
		$out .= '<div class="featured-tag"><div><i class="fa fa-thumb-tack"></i><span>'.esc_html__('Featured','begin').'</span></div></div>';

	echo ($out);
}

/* ---------------------------------------------------------------------------
 * Products loop thumbnail markup
 * --------------------------------------------------------------------------- */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_after_shop_loop_item', 'begin_woo_shop_overview_show_price', 10);
function begin_woo_shop_overview_show_price() {

	$out = "";
	global $product;
	
	$out .= "<div class='product-thumb'>";

		$out .= '<a class="image" href="'.get_permalink().'" title="'.get_the_title().'">';
		$id = $product->get_id();
			$image =  get_the_post_thumbnail( $id, 'shop_catalog' );
			$image = !empty( $image ) ? $image : "<img src='http://placehold.it/500' alt='product-thumb' />";
			$attachment_ids = $product->get_gallery_image_ids();
			$secondary_image_id = !empty( $attachment_ids ) ? $attachment_ids['0'] : '';
			$image1 = wp_get_attachment_image( $secondary_image_id, 'full', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
			$out .= $image.$image1;
		$out .= '</a>';

		$out .= '<div class="product-buttons-wrapper">';
		
				$out .= '<div class="wc_inline_buttons">';
				
						ob_start();
						woocommerce_template_loop_add_to_cart();
						$add_to_cart = ob_get_clean();
		
						if( !empty($add_to_cart) ) {
							$add_to_cart = str_replace(' class="',' class="dt-sc-button too-small ',$add_to_cart);
							$out .= '<div class="wc_cart_btn_wrapper wc_btn_inline">'.$add_to_cart.'</div>';
						}

						if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
							$out.= '<div class="wcwl_btn_wrapper wc_btn_inline">'.do_shortcode('[yith_wcwl_add_to_wishlist]').'</div>';
						}
						
				$out .= '</div>';						
				
		$out .= '</div>';

		$out .= '<a class="product-content" href="'.get_permalink().'" title="'.get_the_title().'"> </a>';

	$out .= "</div>";

	ob_start();
	woocommerce_template_loop_price();
	$price = ob_get_clean();

	$out .= "<div class='product-details'>";
		$out .= '<h5><a href="'.get_permalink($product->get_id()).'">'.$product->get_name().'</a></h5>';
		$out .= '<span class="product-price">'.$price.'</span>';
		$out .= '<div class="product-rating-wrapper">'.wc_get_rating_html( $product->get_average_rating() ).'</div>';
	$out .= '</div>';
	echo ($out);
}

add_action( 'woocommerce_after_shop_loop_item', 'begin_woo_shop_overview_extra_div_close', 10);
function begin_woo_shop_overview_extra_div_close() {

	$out = "";
	$out .= '</div>';
	$out .= '</div>';
	echo ($out);
}

// Pagination hook ----------------------------------------------------------
add_action( 'woocommerce_after_shop_loop', 'begin_woo_after_shop_loop', 10);
function begin_woo_after_shop_loop() { ?>
    <div class="pagination">
        <?php if(function_exists("begin_pagination")) echo begin_pagination(); ?>
    </div><?php
}

/* ---------------------------------------------------------------------------
 * SingleProduct
 * Showing Releated Products
 * --------------------------------------------------------------------------- */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'begin_woo_output_related_products', 20);
function begin_woo_output_related_products() {
	
	$sow_related = cs_get_option( 'enable-related' );
	$output = '';

	if($sow_related):

		$page_layout = cs_get_option( 'product-layout' );
		$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
		
		$related_products = ( $page_layout === "content-full-width" ) ? 4 : 3;
		
		ob_start();
		woocommerce_related_products(array('posts_per_page' => $related_products, 'columns' => $related_products)); // X products, X columns
		$content = ob_get_clean();
		if($content):
			$content =  str_replace('<h2>','<h2 class="border-title"><span>', $content);
			$output .= "<div class='related-products-container'>{$content}</div>";
		endif;

	endif;

	echo ($output);
}

// Showing Upsell Products( You may also like) ------------------------------
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'begin_woo_output_upsells', 21); // needs to be called after the "related product" function to inherit columns and product count
function begin_woo_output_upsells() {

	$page_layout = cs_get_option( 'product-layout' );
	$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

	$upsell_products = ( $page_layout === "content-full-width" ) ? 4 : 3;

	$output = "";
	ob_start();
	woocommerce_upsell_display($upsell_products,$upsell_products); // X products, X columns
	$content = ob_get_clean();
	if($content):
		$content =  str_replace('<h2>','<h2 class="border-title"><span>', $content);
		$output .= "<div class='upsell-products-container'>{$content}</div>";
	endif;
	echo ($output);
}

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action('woocommerce_before_single_product_summary','begin_woo_show_product_sale_flash',10);
function begin_woo_show_product_sale_flash() {
	global $product;
	$out = "";
	
	$out .= '<div class="product-thumb-wrapper">';

	echo ($out);
}

add_action('woocommerce_after_single_product_summary','begin_woo_close_product_wrapper',10);
function begin_woo_close_product_wrapper() {
	$out = '</div>';
	echo ($out);
}

add_action( 'woocommerce_product_thumbnails', 'begin_woo_show_product_thumbnails', 30 );
function begin_woo_show_product_thumbnails() {
	
	global $product;
	
	$out = '<div class="product-status-labels">';
	if( $product->is_on_sale() and $product->is_in_stock() )
		$out .= '<span class="onsale"><span>'.esc_html__('Sale!','begin').'</span></span>';
		
	elseif(!$product->is_in_stock())
		$out .= '<span class="out-of-stock">'.esc_html__('Out of Stock','begin').'</span>';
	
	if($product->is_featured())
		$out .= '<div class="featured-tag"><div><i class="fa fa-thumb-tack"></i><span>'.esc_html__('Featured','begin').'</span></div></div>';
	
	$out .= '</div>';
	
	echo ($out);	
}?>