<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<?php
$type = cs_get_option( 'notfound-style' );
$darkbg = cs_get_option( 'notfound-darkbg' );
$type .= !empty( $darkbg ) ? ' dt-sc-dark-bg' : '';

$bgoptions = cs_get_option('notfound_background');

$bg 		= !empty( $bgoptions['image'] ) ? $bgoptions['image'] : '';
$attach 	= !empty( $bgoptions['attachment'] ) ? $bgoptions['attachment'] :'scroll';
$position 	= !empty( $bgoptions['position'] ) ? $bgoptions['position'] :'center center';
$size   	= !empty( $bgoptions['size'] ) ? $bgoptions['size'] :'auto';
$repeat		= !empty( $bgoptions['repeat'] ) ? $bgoptions['repeat'] :'no-repeat';
$color 		= !empty( $bgoptions['color'] ) ? $bgoptions['color'] : '#ffffff';

$estyle = cs_get_option( 'notfound-bg-style' );

$style  = !empty($bg) ? "background:url($bg) $position / $size $repeat $attach;" : '';
$style .= " background-color:$color;";
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class(); ?>>

<div class="wrapper <?php echo esc_attr($type); ?>" style="<?php echo esc_attr($style); ?>">
	<div class="container">
        <div class="center-content-wrapper">
            <div class="center-content"><?php
                $pageid = cs_get_option( 'notfound-pageid' );
                if( cs_get_option( 'enable-404message' ) && !empty($pageid) ):
                    $page = get_post( $pageid, ARRAY_A );
                    echo begin_wp_kses(DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) ));
                elseif( cs_get_option( 'enable-404message' ) ):
					echo '<div class="error-box square"><div class="error-box-inner"><h3>'.esc_html__('Oops!', 'begin').'</h3><h2>404</h2><h4>'.esc_html__('Page Not Found', 'begin').'</h4></div></div>';
					echo '<div class="dt-sc-hr-invisible-xsmall"></div>';
					echo '<p>'.esc_html__("It seems you've venured too far.", 'begin').'</p><p>'.esc_html__('Click here to go to home page.', 'begin').'</p>';
					echo '<div class="dt-sc-hr-invisible-xsmall"></div>';
                    echo '<a class="dt-sc-button filled small" target="_blank" href="'.esc_url(home_url('/')).'">'.esc_html__('Back to Home','begin').'</a>';
                endif; ?>
            </div>
        </div>
    </div>    
</div>
<?php wp_footer(); ?>
</body>
</html>