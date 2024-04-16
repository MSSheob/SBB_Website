<?php
/**
 * Gutenberg Editor CSS
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Begin
 * @author      Begin
 * @copyright   Copyright (c) 2019, Begin
 * @link        http://wedesignthemes.com/
 * @since       Begin 1.0
 */

if ( ! class_exists( 'Gutenberg_Editor_CSS' ) ) :

	/**
	 * Admin Helper
	 */
	class Gutenberg_Editor_CSS {

		function __construct() {

			add_action( 'admin_enqueue_scripts', array( $this, 'begin_backend_editor_fonts' ) );
			add_action( 'current_screen', array( $this,  'begin_current_screen_hook' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'begin_backend_editor_styles' ) );
			#add_filter( 'tiny_mce_before_init', array( $this, 'begin_theme_editor_dynamic_styles' ) );
		}

		function begin_backend_editor_fonts() {

			if ( !class_exists( 'Kirki' ) ) {
				BEGIN_Kirki::admin_enqueue_fonts();
			}
		}

		function begin_current_screen_hook( $current_screen ) {

			if ( 'post' == $current_screen->base ) {

				$urls = BEGIN_Kirki::admin_editor_fonts_url();
				add_editor_style( $urls );
				add_editor_style( 'css/editor-style.css' );
			}
		}


		function begin_backend_editor_styles() {

			$styles = '';
			
			if ( !class_exists( 'Kirki' ) ) {
				BEGIN_Kirki::admin_enqueue_fonts();
			}

			//Body tag typography from customizer
			$status_of_body_content_typo = get_theme_mod( 'customize-body-content-typo', begin_defaults('customize-body-content-typo') );

			if( $status_of_body_content_typo == '1'){
				$font = get_theme_mod('body-content-typo',begin_defaults('body-content-typo'));
					$font_family 	= isset($font['font-family']) ? $font['font-family'] : '';
					$font_size   	= isset($font['font-size']) ? $font['font-size'] : '';
					$font_weight   	= isset($font['variant']) ? $font['variant'] : '';
					$line_height 	= isset($font['line-height']) ? $font['line-height'] : '';
					$letter_spacing = isset($font['letter-spacing']) ? $font['letter-spacing'] : '';
					$font_color  	= isset($font['color']) ? $font['color'] : '';
					$text_transform = isset($font['text-transform']) ? $font['text-transform'] : '';

					$styles .= ".editor-block-list__block, .editor-styles-wrapper .editor-rich-text p[role='textbox']:not(.has-large-font-size),  .wp-block-code, .wp-block-preformatted pre, pre {";
						if (!empty($font_family)) 	{	$styles .= "font-family:'{$font_family}' !important; ";		}
						if (!empty($font_size)) 	{ 	$styles .= "font-size:{$font_size} !important; "; 			}
						if (!empty($font_weight)) 	{	$styles .= "font-weight:{$font_weight} !important; ";		}
						if (!empty($line_height)) 	{ 	$styles .= "line-height:{$line_height} !important; "; 		}
						if (!empty($letter_spacing)){ 	$styles .= "letter-spacing:{$letter_spacing} !important; "; }	
						if (!empty($font_color)) 	{	$styles .= "color:{$font_color} !important; ";				}
						if (!empty($text_transform)){	$styles .= "text-transform:{$text_transform} !important; ";	}
				$styles .= "}";
			}

			//Body tag bg from customizer
			$body_bg_color = get_theme_mod('body-bg-color',begin_defaults('body-bg-color'));
			$body_content_color = get_theme_mod('body-content-color',begin_defaults('body-content-color'));
			$body_a_color = get_theme_mod('body-a-color',begin_defaults('body-a-color'));
			$body_a_hover_color = get_theme_mod('body-a-hover-color',begin_defaults('body-a-hover-color'));
			
			$styles .= "body.block-editor-page {";
				if (!empty($body_bg_color))			{	$styles .= "background-color:{$body_bg_color} !important; ";	}
				if (!empty($body_content_color)) 	{	$styles .= "color:{$body_content_color} !important; ";	}
			$styles .= "}";

			$styles .= ".editor-styles-wrapper a {";
				if (!empty($body_a_color)) 			{	$styles .= "color:{$body_a_color} !important; ";	}
			$styles .= "}";

			$styles .= ".editor-styles-wrapper a:hover {";
				if (!empty($body_a_hover_color)) 	{	$styles .= "color:{$body_a_hover_color} !important; ";	}
			$styles .= "}";
			

			// h1 to h6 tag typography from customizer
			for ($i = 1; $i <= 6; $i++) :
				$status_of_h_typo = get_theme_mod( 'customize-body-h'.$i.'-typo', begin_defaults('customize-body-h'.$i.'-typo') );
					
				if($status_of_h_typo == 1){
					$font = get_theme_mod('h'.$i.'',begin_defaults('h'.$i.''));
					$font_family 	= isset($font['font-family']) ? $font['font-family'] : '';
					$font_size   	= isset($font['font-size']) ? $font['font-size'] : '';
					$font_weight   	= isset($font['variant']) ? $font['variant'] : '';
					$line_height 	= isset($font['line-height']) ? $font['line-height'] : '';
					$letter_spacing = isset($font['letter-spacing']) ? $font['letter-spacing'] : '';
					$font_color  	= isset($font['color']) ? $font['color'] : '';
					$text_align  	= isset($font['text-align']) ? $font['text-align'] : '';
					$text_transform = isset($font['text-transform']) ? $font['text-transform'] : '';
					if($i == 1) {
						$styles .= ".wp-block-heading H$i, .editor-styles-wrapper .editor-post-title__block .editor-post-title__input {";
					} else{
						$styles .= ".wp-block-heading H$i {";
					}
						if (!empty($font_family)) 	{	$styles .= "font-family:'{$font_family}' !important; ";		}
						if (!empty($font_size)) 			{ 	$styles .= "font-size:{$font_size} !important; "; 			}
						if (!empty($font_weight)) 	{	$styles .= "font-weight:{$font_weight} !important; ";		}
						if (!empty($line_height)) 	{ 	$styles .= "line-height:{$line_height} !important; "; 		}
						if (!empty($letter_spacing)){ 	$styles .= "letter-spacing:{$letter_spacing} !important; "; }	
						if (!empty($font_color)) 	{	$styles .= "color:{$font_color} !important; ";				}
						if (!empty($text_align)) 	{	$styles .= "text-align:{$text_align} !important; ";			}
						if (!empty($text_transform)){	$styles .= "text-transform:{$text_transform} !important; ";	}

					$styles .= "}";
				}
			endfor;
			

			wp_enqueue_style( 'begin-gutenberg', get_theme_file_uri('/css/admin-gutenberg.css'), false, BEGIN_THEME_VERSION, 'all' );

			wp_add_inline_style( 'begin-gutenberg', $styles );
		}
	}

	new Gutenberg_Editor_CSS();

endif;