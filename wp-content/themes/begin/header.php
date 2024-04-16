<?php
$conn = mysqli_connect("localhost","root","Sbb_2024_Ind","SBB-2024");
	//("db5000855026.hosting-data.io","dbu982835","SBBwebsite@123","dbs753255");	
error_reporting(0);
session_start();
$quick = $_SESSION['quickcva'];
$detailed = $_SESSION['detailed'];
$id = $_SESSION['id'];
//echo $id;
if($quick == 'quick'){
	//echo "<script>alert(0);</script>";
	//$id = $_GET["id"];
  $sql = "UPDATE quick_cv SET Savings_Full_Time_Hire='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE id='$id'";
	if ($conn->query($sql) === TRUE) {
 // header("Location: https://skillbeyondboundaries.com/quickcva/");
}
	//session_destroy();
}elseif($detailed == 'detailed'){
	//echo "<script>alert(1);</script>";
	$sql = "UPDATE detailed_cva SET Savings_Full_Time_Hire='NA', Savings_Contract_Consulting_PartTIme='NA', Savings_Reassignmetn_Retrenchment='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE id='$id'";
	if ($conn->query($sql) === TRUE) {
	// echo "Record updated successfully";
  ///header("Location: https://skillbeyondboundaries.com/detailedcva/");
}
//session_destroy();	
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<script>

</script>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
  <?php
  $conn = mysqli_connect("localhost","root","Sbb_2024_Ind","SBB-2024");
	  //("db5000855026.hosting-data.io","dbu982835","SBBwebsite@13","dbs753255");
   
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
		if(get_cookie('UserStatus'))
		document.cookie = "UserStatus=Inactive";
		
		$("#myModal").modal('show');
		
	});

	function getHostName(url) {
	  const match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
	  if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
		return match[2];
	  } else {
		return null;
	  }
	}

	function getDomain(url) {
	  const hostName = getHostName(url);
	  let domain = hostName;

	  if (hostName != null) {
		const parts = hostName.split('.').reverse();

		if (parts != null && parts.length > 1) {
		  domain = parts[1] + '.' + parts[0];

		  if (hostName.toLowerCase().indexOf('.co.uk') !== -1 && parts.length > 2) {
			domain = parts[2] + '.' + domain;
		  }
		}
	  }

	  return domain;
	}
	
	var _hostName = getDomain(document.location.href) === '183.82.4.93:81' ? '183.82.4.93:81' : `.${getDomain(document.location.href)}`;
	var environment = 'DEV';
	var appHost = 'https://app-dev.skillbeyondboundaries.com';
	if (document.location.host === 'dev.skillbeyondboundaries.com') {
		environment = 'DEV';
		appHost = 'https://app-dev.skillbeyondboundaries.com';
	} else if (document.location.host === 'stg.skillbeyondboundaries.com') {
		environment = 'STG';
		appHost = 'https://app-stg.skillbeyondboundaries.com';
	} else if (document.location.host === 'skillbeyondboundaries.com') {
		environment = 'PRD';
		appHost = 'https://app.skillbeyondboundaries.com';
	}
	var _cookieName = `${environment}__CLIENT_CURRENT_USER`;
	var _cookieRole = `${environment}__CLIENT_CURRENT_USER_ROLE`;
	//`.${getDomain(document.location.href)}`; // 183.82.4.93:81
	// ${environment.name.toUpperCase()}
	function set_cookie(token, role) {
	  document.cookie = `${_cookieName}=${token};domain=${_hostName};path=/`;
	  if (role) {
		document.cookie = `${_cookieName}_ROLE=${role};domain=${_hostName};path=/`;
	  }
	}

	function get_cookie(name) {
	  const value = `; ${document.cookie}`;
	  const parts = value.split(`; ${name}=`);
	  if (parts.length === 2) {
		return parts.pop().split(';').shift();
	  }
	}
	
	var  current_user = null;
	var _cookie = null;
	var intervalId = null;
	// document.getElementById("demos").innerHTML = get_cookie('DEV__CLIENT_CURRENT_USER');
	function delete_current_user_information() {
		current_user = null;
		$('[title="Navigate to Dashboard"]').parent().css('display', 'none');
		$('[title="Navigate to Reports"]').parent().css('display', 'none');
		$('.dropdown').hide();
		$('.menu-sign').show();
	}
	function delete_cookie(name) {
		console.log(name, _hostName, document.cookie);
	  document.cookie = name + `=; domain=${_hostName}; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;`;
	  _cookie = null;
	  if (intervalId) {
		  clearInterval(intervalId);
		  delete_current_user_information();
		  //setTimeout(function() {
			//  interval_for_cookie();
		 // }, 3000);
	  }
	}
	function get_current_user_info() {
		var settings = {
		  "url": "https://app.skillbeyondboundaries.com/api/v1/me",
		  "method": "GET",
		  "timeout": 0,
		  "headers": {
			"Authorization": _cookie
		  }
		};
		$.ajax(settings).done(function (response) {
		  console.log(response);
		  // DROPWODN DISPLAY BLOCK
		  if (response && response.data && response.data.current_user) {
			var _user = response.data.current_user;
			current_user = response;
			  console.log(current_user, _user);
			$('.dropdown').show();
			$('.menu-sign').hide();
			  if (_user.media__image) {
				  $('#current_user_img').attr('src', `${appHost}/${_user.media__image}`);
			  } else {
				  $('#current_user_img').attr("src", "/wp-content/uploads/2020/08/userimage.png");
			  }
			var _settingsEle = $('#current_user_settings');
			_settingsEle.attr('href', _settingsEle.attr('href') + '=' + _cookie);
			$('#current_user_name').text(_user.first_name);
			//  $('#current_user_name').text(_user.first_name + ' ' + _user.sur_name);
		  }
		});
	}
	
	function check_with_current_user_role() {
		var _current_user_role = get_cookie(_cookieRole);
		$('[title="Navigate to Reports"]').parent().css('display', _current_user_role && _current_user_role === 'sbb_client_super_admin' ? 'inline' : 'none');
		$('[title="Navigate to Dashboard"]').parent().css('display', _cookie ? 'inline' : 'none');
		$('[title="Navigate to Dashboard"]').attr('href', `${appHost}/redirect/dashboard?token="${_cookie}"`);
		$('[title="Navigate to Reports"]').attr('href', `${appHost}/redirect/reports?token="${_cookie}"`);
	}
	check_with_current_user_role();

	/** Listen for Cookie Changes */
    function interval_for_cookie() {
		intervalId = setInterval(function(){ // ENV name => DEV, STG, PRD
		  _cookie = get_cookie(_cookieName);
		  check_with_current_user_role();
		  var dropdown = document.getElementsByClassName(".dropdowm");
			var menu = document.getElementsByClassName(".menu-sign");
		  if (!_cookie) {
			// LOGOUT THE APPLICATION, DON'T SHOW CURRENT USER, REMOVE ALL INFORMATION.
			// alert(1);
			// document.cookie = "UserStatus=Inactive";
			delete_current_user_information();
		  }
		  else {
			  // HERE YOU HAVE COOKIE
			  // jUST SHOW LOGGED IN USER
			  // alert();
			  if(!current_user){
				get_current_user_info();
			  }
			check_with_current_user_role();
			$('#demos').text(_cookie);
		  }
		  console.log(get_cookie('UserStatus'));
		   //if(IsStateChanged != get_cookie('UserStatus')) //cookie state changed
			 //  location.reload();
		}, 500);
	}
	interval_for_cookie();
</script>


</head>

<?php
   if( $_GET["success"] == 'okdasasa' ) {
      //echo "Welcome ". $_GET['name']. "<br />";
     /// echo "You are ". $_GET['age']. " years old.";
      
    

?>

<body>
<input type="hidden" id="UserStatus" />
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<a href="https://skillbeyondboundaries.com/"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></a>
				
				<?php
	                 $sql = 'SELECT * FROM quick_cv ORDER BY  id DESC LIMIT 1';
                     $result = mysqli_query($conn, $sql);
	   				if (mysqli_num_rows($result) > 0) {
                 while($row = mysqli_fetch_assoc($result)) {
				?>
				<table id="example2" class="table table-bordered table-hover">
					<tr>
						<th>Savings in full-time hiring through collaboration</th>
						 <td><?php echo $row['Savings_Full_Time_Hire']; ?></td>
				      </tr>
					<tr>
					<th>Revenue from placement of bench/ under-utilised resource through collaboration</th>
					<td><?php echo $row['Revenue_Placement_Of_Bench']; ?></td>
				</tr>
				<tr>
					  <th>Total Value In Collaboration (Savings & Earnings) in reporting currency</th>
				      <td><?php echo $row['Total_Value']; ?></td>
				</tr>
				
				<tr>
					 <th>Increase in <?php echo $row['company_name']; ?>'s Net Profit (%)</th>
			        <td><?php echo $row['Net_Profit_Percentage']; ?></td>
				</tr>
				
				</table>
				
				
				<?php
			     }
					}
	           ?>
				<form method="post" action="https://skillbeyondboundaries.com/wp-content/themes/begin/cv-information/QuickCVA-Export.php">
                     <input type="submit" name="export" class="btn btn-primary" value="Download" style="
    width: 124px!important;
    background: #fba942!important;
    border-radius: 3px!important;
    cursor: pointer;
    padding: 5px!important;
    float: right;" />
                 </form>
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
		debugger;
		//alert(1);
		var token = localStorage.getItem(current_user);
		var _cookie= document.cookie;
    });
</script>
</html>
<?php
  }
?>
	<?php
	///////////////////////quick Cv information ////////////
	
   if( $_GET["success"] == 'oksssssssssa' ) {
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
	                 $sql = 'SELECT * FROM detailed_cva ORDER BY  id DESC LIMIT 1';
                     $result = mysqli_query($conn, $sql);
	   				if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
				?>
				<table id="example2" class="table table-bordered table-hover">
					<tr>
						<th>Savings in full-time hiring through collaboration</th>
						 <td><?php echo $row['Savings_Full_Time_Hire']; ?></td>
				      </tr>
					<tr>
					<th>Savings in contractual, consulting & part-time hiring through collaboration</th>
					<td><?php echo $row['Savings_Contract_Consulting_PartTIme']; ?></td>
				</tr>
				<tr>
					  <th>Savings in reassignment / retrenchment costs through collaboration</th>
				      <td><?php echo $row['Savings_Reassignmetn_Retrenchment']; ?></td>
				</tr>	
				<tr>
					  <th>Revenue from placement of bench / under-utilised resource through collaboration</th>
			           <td><?php echo $row['Revenue_Placement_Of_Bench']; ?></td>
				</tr>
				
					<tr>
					   <th>Total Value In Collaboration (Savings & Earnings) in reporting currency</th>
			           <td><?php echo $row['Total_Value']; ?></td>
				</tr>
				 <tr>
					 <th>Increase in <?php echo $row['company_name']; ?>'s Net Profit (%)</th>
			        <td><?php echo $row['Net_Profit_Percentage']; ?></td>
				</tr>
				</table>
				
				
				<?php
			     }
					}
	           ?>
				<form method="post" action="https://skillbeyondboundaries.com/wp-content/themes/begin/cv-information/DetailedCVA-Export.php">
                     <input type="submit" name="export" class="btn btn-primary" value="Download" style="
    width: 124px!important;
    background: #fba942!important;
    border-radius: 3px!important;
    cursor: pointer;
    padding: 5px!important;
    float: right;" />
                 </form>
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
            	        <div class="container-fluid container-fluid-navabr p-0"><?php
							$content = do_shortcode( stripslashes($topcontent) );
							echo begin_wp_kses( $content );?>	
                        </div>
                    </div><?php
				endif; ?>

            	<!-- **Main Header Wrapper** -->
            	<div id="main-header-wrapper" class="main-header-wrapper">

            		<div class="container-fluid container-fluid-navabr p-0">

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
   
					<script>
$(document).ready(function(){
    $('#show').click(function() {
      $('.menus').toggle();
    });
});
</script>
</head>
<body>
<div class="dropdown">
<div id="show"><img src="https://skillbeyondboundaries.com/wp-content/uploads/2020/08/userimage.png" id="current_user_img" width="32px" height="32px"><span id="current_user_name"  style="font-family: PT Sans;font-size: 17px;font-weight: 300;letter-spacing: 0.02em;text-transform: none;color: #0a0a0a;margin-left:5px;"></span></div>
 <div class="menus" style="display: none;">
    <ul class="dropdown-contents">
<li><a href="https://app.skillbeyondboundaries.com/account/settings?token" id="current_user_settings" style="font-family: PT SANS;font-size: 17px;font-weight: 300;letter-spacing: 0.02em;text-transform: none;color: #0a0a0a;"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a> </li>
<li><a onclick="delete_cookie(_cookieName)"  style="font-family: PT Sans;font-size: 17px;font-weight: 300;letter-spacing: 0.02em;text-transform: none;color: #0a0a0a;important!"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
    
    
    </ul>
 </div>	</div>		
<!-- 
<div class="dropdown">
  <span onclick="myFunctions()" class="dropbtns" >
  
 <img src="https://app.skillbeyondboundaries.com/" id="current_user_img" width="35px" height="35px"><span id="current_user_name"></span></span>
  <div id="myDropdown" class="dropdown-content">
 <a href="https://app.skillbeyondboundaries.com/account/settings?token" id="current_user_settings"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a> 
	
    <a onclick="delete_cookie(_cookieName)"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
  </div>
</div> -->
								


										 <div class="menu-sign"><a href="#"></a><a href="https://app.skillbeyondboundaries.com/auth/register">Sign Up</a><span class="divide"> / </span> <a href="https://app.skillbeyondboundaries.com/auth/login">Login</a><a href="#"></a></div>
										
								
            				</div><?php
							// left header
                            if( isset($htype) && ( $htype == 'left-header' || $htype == 'left-header-boxed' || $htype == 'creative-header') ): ?>
                                <div class="left-header-footer"><?php
									$content = get_theme_mod( 'header-left-content', begin_defaults('header-left-content') );
									$content = do_shortcode( stripcslashes( $content ) );
									echo begin_wp_kses($content);?></div><?php
							endif; ?>
            			</div>	
<!-- 					<div class="title" style="font-family: Copperplate Gothic Light;font-size:15px; text-transform: capitalize; font-variant:small-caps; font-weight:400;color: #e64c00!important">
Skill Beyond Boundaries</div>	 -->
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
