<?php
/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
function begin_hook_top() {
	if( cs_get_option( 'enable-top-hook' ) ) :
		echo '<!-- begin_hook_top -->';
			$hook = cs_get_option( 'top-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- begin_hook_top -->';
	endif;	
}
add_action( 'begin_hook_top', 'begin_hook_top' );


/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
function begin_hook_content_before() {
	if( cs_get_option( 'enable-content-before-hook' ) ) :
		echo '<!-- begin_hook_content_before -->';
			$hook = cs_get_option( 'content-before-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- begin_hook_content_before -->';
	endif;
}
add_action( 'begin_hook_content_before', 'begin_hook_content_before' );


/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
function begin_hook_content_after() {
	if( cs_get_option( 'enable-content-after-hook' ) ) :
		echo '<!-- begin_hook_content_after -->';
			$hook = cs_get_option( 'content-after-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- begin_hook_content_after -->';
	endif;
}
add_action( 'begin_hook_content_after', 'begin_hook_content_after' );


/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
function begin_hook_bottom() {
	if( cs_get_option( 'enable-bottom-hook' ) ) :
		echo '<!-- begin_hook_bottom -->';
			$hook = cs_get_option( 'bottom-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- begin_hook_bottom -->';
	endif;
}
add_action( 'begin_hook_bottom', 'begin_hook_bottom' );?>