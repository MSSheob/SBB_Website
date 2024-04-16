<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
  <?php
  $conn = mysqli_connect("localhost","root","","skillbeyondboundaries");
?>
	


<!--  popup -->
	 
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<?php
   if( $_GET["success"] == 'ok' ) {
      //echo "Welcome ". $_GET['name']. "<br />";
     /// echo "You are ". $_GET['age']. " years old.";
      
    

?>
<body>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
				<?php
	                 $sql = 'SELECT * FROM quick_cv ORDER BY  id DESC LIMIT 1';
                     $result = mysqli_query($conn, $sql);
	   				if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
				?>
				<table id="example2" class="table table-bordered table-hover">
					<tr>
						<th>Planned recruitments for a year through third parties (number of hires)</th>
						 <td><?php echo $row['recruitments_third_parties']; ?></td>
				      </tr>
					<tr>
					<th>Planned recruitments for a year through employee referrals (number of hires)</th>
					<td><?php echo $row['QuickCVA_planned_recruitments']; ?></td>
				</tr>
				<tr>
					  <th>Average Cost-To-Company (CTC) per hire per annum in reporting currency</th>
				      <td><?php echo $row['QuickCVA_Average_cost']; ?></td>
				</tr>
				
				<tr>
					 <th>Average recruitment charges (as % of CTC)</th>
			        <td><?php echo $row['QuickCVA_Average_recruitment']; ?></td>
				</tr>
				<tr>
					  <th>Average referral fees paid to employees per hire in reporting currency</th>
			           <td><?php echo $row['QuickCVA_average_referral_fees_paid']; ?></td>
				</tr>
				
					<tr>
					   <th>Annual average bench (from within the total employees) in numbers</th>
			           <td><?php echo $row['QuickCVA_Annual_bench_employees']; ?></td>
				</tr>
				<tr>
						<th>Average overheads (equipment, rent, utilities etc.) per employee in reporting currency</th>
					   <td><?php echo $row['QuickCVA_Average_overheads']; ?></td>
				</tr>
				<tr>
					<th>Your desired mark-up (%) on employees that you would lend out</th>
			          <td><?php echo $row['QuickCVA_desired_markup']; ?></td>
				</tr>
				<tr>
					 <th>Current Cost Of Above In Reporting Currency</th>
			         <td><?php echo $row['QuickCVA_Annual_bench']; ?></td>
				</tr>	
				</table>
				
				
				<?php
			     }
					}
	           ?>
            </div>
            <div class="modal-body">
				
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
</html>
<?php
  }
?>
<?php
// loading
$loader = cs_get_option( 'use-site-loader' );
if( !empty($loader) )
echo '<div class="loader"><div class="loader-inner"><span class="dot"></span><span class="dot dot1"></span><span class="dot dot2"></span><span class="dot dot3"></span><span class="dot dot4"></span></div></div>';
// top hook
do_action( 'begin_hook_top' ); ?>

<!-- **Wrapper** -->
<div class="wrapper">
	<div class="inner-wrapper">

		<!-- **Header Wrapper** -->
        <?php 
		// header types
		$htype = get_theme_mod( 'header-type', begin_defaults('header-type') );

		$hdarkbg = get_theme_mod( 'enable-header-darkbg', begin_defaults('enable-header-darkbg') ); 
		$class = ( $hdarkbg ) ? 'dt-sc-dark-bg' : ''; ?>
		<div id="header-wrapper" class="<?php echo esc_attr( $class );?>">
            <!-- **Header** -->
            <header id="header"><?php
				// check header type
				if( $htype != "left-header" && $htype != "left-header-boxed" && $htype != "creative-header" && $htype != "overlay-header" ):
					// header position
					$headerpos = get_theme_mod( 'header-position', begin_defaults('header-position') );
					
					if( isset($headerpos) && $headerpos == 'below slider' ):
						echo begin_slider();
					endif;
				endif;

				//top bar
				$topbar 	=  (int) get_theme_mod( 'enable-top-bar-content', begin_defaults('enable-top-bar-content') );
				$topcontent =  get_theme_mod( 'top-bar-content', '');
				if( ($topbar) && isset($topcontent) && $topcontent != '' ):?>
        	        <div class="top-bar">
            	        <div class="container"><?php
							$content = do_shortcode( stripslashes($topcontent) );
							echo begin_wp_kses( $content );?>	
                        </div>
                    </div><?php
				endif; ?>

            	<!-- **Main Header Wrapper** -->
            	<div id="main-header-wrapper" class="main-header-wrapper">

            		<div class="container">

            			<!-- **Main Header** -->
            			<div class="main-header"><?php
							if( isset($htype) && ($htype == 'fullwidth-header header-align-center fullwidth-menu-header') ):
								$header_left = (int) get_theme_mod( 'enable-header-left-content', begin_defaults('enable-header-left-content') );
								if( !empty( $header_left ) ): ?>
									<div class="header-left"><?php									
									$leftcontent = get_theme_mod( 'header-left-content', begin_defaults('header-left-content') );
									if( isset($leftcontent) && $leftcontent != '') :
										$content = do_shortcode( stripcslashes( $leftcontent ) );
										echo begin_wp_kses( $content );
									endif; ?></div><?php
								endif;
							endif;

							begin_header_logo();
							
                            
							if( isset($htype) && (($htype == 'fullwidth-header header-align-center fullwidth-menu-header') || 
								($htype == 'fullwidth-header header-align-left fullwidth-menu-header')) ):
								$header_right = (int) get_theme_mod( 'enable-header-right-content', begin_defaults('enable-header-right-content') );
								if( !empty( $header_right ) ):?>
									<div class="header-right"><?php
										$rightcontent = get_theme_mod( 'header-right-content', begin_defaults('header-right-content') );
										if( isset($rightcontent) && $rightcontent != '') :
											$content = do_shortcode( stripcslashes( $rightcontent ) );
											echo begin_wp_kses( $content );
										endif; ?></div><?php
								endif;
							endif; ?>

            				<div id="menu-wrapper" class="menu-wrapper <?php echo get_theme_mod( 'menu-active-style', begin_defaults('menu-active-style') );?>">
                            	<div class="dt-menu-toggle" id="dt-menu-toggle">
                                	<?php esc_html_e('Menu','begin');?>
                                    <span class="dt-menu-toggle-icon"></span>
                                </div><?php
								if( isset($htype) ):
									switch($htype):
										case 'split-header fullwidth-header':
										case 'split-header boxed-header':
												echo '<nav id="main-menu">';
												begin_wp_split_menu();
												echo '</nav>';
										break;
										
										case 'overlay-header':
												echo '<div class="overlay overlay-hugeinc">';
													echo '<div class="overlay-close"></div>';
													begin_wp_nav_menu(1);
												echo '</div>';
												echo '<div id="trigger-overlay"></div>';
										break;

										case 'fullwidth-header':
										case 'boxed-header':
										case 'two-color-header':
										default:
											begin_wp_nav_menu();
											require_once( BEGIN_THEME_DIR .'/headers/default.php' );
										break;
									endswitch;
								endif; ?>
            				</div><?php
							// left header
                            if( isset($htype) && ( $htype == 'left-header' || $htype == 'left-header-boxed' || $htype == 'creative-header') ): ?>
                                <div class="left-header-footer"><?php
									$content = get_theme_mod( 'header-left-content', begin_defaults('header-left-content') );
									$content = do_shortcode( stripcslashes( $content ) );
									echo begin_wp_kses($content);?></div><?php
							endif; ?>
            			</div><div class="title" style="font-family: Roboto;font-size:13px;color:#e64c00;">Blurring Boundaries</div>
            		</div>
            	</div><!-- **Main Header** --><?php
				if( $htype != "left-header" && $htype != "left-header-boxed" && $htype != "creative-header" && $htype != "overlay-header" ):
					// header position
					if( isset($headerpos) && $headerpos != 'below slider' ):
						echo begin_slider();
					endif;
				endif;?>

			</header><!-- **Header - End** -->
		</div><!-- **Header Wrapper - End** -->

		<?php if( $htype == "creative-header" ) echo '<div id="toggle-sidebar"></div>'; ?>

        <!-- **Main** -->
        <div id="main"><?php

			if( $htype == "left-header" || $htype == "left-header-boxed" || $htype == "creative-header" || $htype == "overlay-header" ):
				echo begin_slider();
			endif;

			// subtitle & breadcrumb section
			if( is_page() ) :

				$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

				if(empty($tpl_default_settings)) $tpl_default_settings['enable-sub-title'] = 'true';

				if($tpl_default_settings['enable-sub-title'] == 'true' ):
					require_once( BEGIN_THEME_DIR .'/headers/breadcrumb.php' );
				endif;

			elseif( function_exists( 'is_woocommerce' ) && is_shop() ):

				$pageid = get_option('woocommerce_shop_page_id');

				$tpl_default_settings = get_post_meta($pageid,'_tpl_default_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
			
				if(empty($tpl_default_settings)) $tpl_default_settings['enable-sub-title'] = 'true';

				if(isset($tpl_default_settings['enable-sub-title']) ):
					require_once( BEGIN_THEME_DIR .'/headers/breadcrumb.php' );
				endif;	
				
			elseif( is_singular('post') ):

				$dt_post_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
				$dt_post_settings = is_array( $dt_post_settings ) ? $dt_post_settings  : array();

				if(empty($dt_post_settings)) $dt_post_settings['enable-sub-title'] = 'true';

				if($dt_post_settings['enable-sub-title'] == 'true' ):
					require_once( BEGIN_THEME_DIR .'/headers/breadcrumb.php' );
				endif;

			else:
				require_once( BEGIN_THEME_DIR .'/headers/breadcrumb.php' );
			endif;

			$class = "container";
			if( is_page_template('tpl-portfolio.php') ) {
				$class = ( $tpl_default_settings['layout'] == 'fullwidth' ) ? "portfolio-fullwidth-container" : "container";
            }

			if( is_singular('tribe_events') ) {
				$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$post_style = array_key_exists( "event-post-style", $tpl_default_settings ) ? $tpl_default_settings['event-post-style'] : "type1";
				switch( $post_style ):
					case 'type2':
						$class = "event-type2-fullwidth";
						break;
					case 'type5':
						$class = "event-type5-fullwidth";
						break;
					default:
						$class = "container";
						break;
				endswitch;
			}

			if( is_singular() ) {
				$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$class =  ( isset( $tpl_default_settings['layout'] ) ) && ( $tpl_default_settings['layout'] == 'fullwidth-container') ? "show-in-fullwidth" : $class;
			} 

			if( is_archive() ) {
				$post_type = get_post_type();
				if($post_type == 'dt_portfolios') {
					$allow_fullwidth = cs_get_option( 'portfolio-allow-full-width' );
					if($allow_fullwidth) {
						$class =  'show-in-fullwidth';
					}
				}
			}

			if( is_page_template('tpl-wpsl_stores.php') ) {
				$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$class =  ( $tpl_default_settings['layout'] == 'content-full-width' ) ? "wpsl-stores-fullwidth-container" : "container"; 
            }

			if( is_singular('wpsl_stores') ) {
				$class =  "wpsl-stores-fullwidth-container"; 
            } ?>
            <!-- ** Container ** -->
            <div class="<?php echo esc_attr($class);?>"><?php
			do_action( 'begin_hook_content_before' ); ?>