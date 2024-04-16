<?php
//class elp_cls_widget
//{
//	public static function elp_widget_int( $atts )
//	{
//		echo elp_shortcode( $atts );
//	}
//}

//////////////////////////////Not in Use//////////////////////////////////////////////////
function elp_shortcode( $atts ) 
{
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	
	//[email-posts-subscribers namefield="YES" desc="" group="Public"]
	$elp_name 	= isset($atts['namefield']) ? $atts['namefield'] : 'YES';
	$elp_desc 	= isset($atts['desc']) ? $atts['desc'] : '';
	$elp_group 	= isset($atts['group']) ? $atts['group'] : '';
	
	$elp_type 	= isset($atts['type']) ? $atts['type'] : '';
	if($elp_type == "")
	{
		$elp_type  = "shortcode";
	}
	
	$elp_name 	= trim($elp_name);
	$elp_desc 	= trim($elp_desc);
	$elp_group 	= trim($elp_group);
	
	if($elp_group == "")
	{
		$elp_group = "Public";
	}
	
	$elp 		= "";
	$elp_alt_nm = '';
	$elp_alt_em = '';
	
	$elp_error 		= false;
	$elp_txt_name 	= "";
	$elp_txt_email 	= "";
	$elp_txt_group 	= "";
	$elp_alt_success = "";
	$elp_alt_error 	= "";

	wp_enqueue_style( 'elp_widget.js', ELP_URL.'widget/widget.css', '', '', '' );
	
	//////////////////////////////Robot verification//////////////////////////////////////////////////
	$elp_captcha_widget = get_option('elp_captcha_widget', '');
	//////////////////////////////Robot verification//////////////////////////////////////////////////
	
	if ( isset( $_POST['elp_btn_'.$elp_type] ) ) 
	{
		//$homeurl = home_url();
		//$samedomain = strpos($_SERVER['HTTP_REFERER'], $homeurl);
		
		//if (($samedomain !== false) && $samedomain < 5) 
		//{
			//check_admin_referer('elp_form_subscribers');
			
			if( $elp_name == "YES" )
			{
				$elp_txt_name = isset($_POST['elp_txt_name']) ? sanitize_text_field($_POST['elp_txt_name']) : '';
			}
			
			$elp_txt_email = isset($_POST['elp_txt_email']) ? sanitize_text_field($_POST['elp_txt_email']) : '';
			$elp_txt_group = isset($_POST['elp_txt_group']) ? sanitize_text_field($_POST['elp_txt_group']) : '';
					
			if($elp_txt_name == "" && $elp_name == "YES")
			{
				$elp_alt_nm = __('Please fill in the required field.', 'email-posts-to-subscribers');
				$elp_error = true;
			}
			
			if($elp_txt_email == "")
			{
				$elp_alt_em = __('Please fill in the required field.', 'email-posts-to-subscribers');
				$elp_error = true;
			}
			
			if(!is_email($elp_txt_email) && $elp_txt_email <> "")
			{
				$elp_alt_em = __('Email address seems invalid.', 'email-posts-to-subscribers');
				$elp_error = true;
			}
			
			//////////////////////////////Robot verification//////////////////////////////////////////////////
			if(!$elp_error)
			{
				if($elp_captcha_widget == 'YES')
				{
					$elp_captcha_secret = get_option('elp_captcha_secret', '');
					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$elp_captcha_secret.'&response='.$_POST['g-recaptcha-response']);
					$responseData = json_decode($verifyResponse);
					if(!$responseData->success)
					{
						$elp_alt_em = __('Robot verification failed, please try again.', 'email-posts-to-subscribers');
						$elp_error = true;
					}
				}
			}
			//////////////////////////////Robot verification//////////////////////////////////////////////////
			
			
			if(!$elp_error)
			{
				$data = elp_cls_pluginconfig::elp_setting_select(1);
				if( $data['elp_c_optinoption'] == "Double Opt In" )
				{
					$inputdata = array($elp_txt_name, $elp_txt_email, "Unconfirmed", $elp_txt_group);
				}
				else
				{
					$inputdata = array($elp_txt_name, $elp_txt_email, "Single Opt In", $elp_txt_group);
				}
				
				$action = elp_cls_dbquery::elp_view_subscriber_widget($inputdata);
				if($action == "sus")
				{
					$subscribers = array();
					$subscribers = elp_cls_dbquery::elp_view_subscriber_one($elp_txt_email);
					if( $data['elp_c_optinoption'] == "Double Opt In" )
					{
						elp_cls_sendmail::elp_sendmail("optin", $subject = "", $content = "", $subscribers);
						$elp_alt_success = __('You have successfully subscribed to the newsletter. You will receive a confirmation email in few minutes. Please follow the link in it to confirm your subscription. If the email takes more than 15 minutes to appear in your mailbox, please check your spam folder.', 'email-posts-to-subscribers');
					}
					else
					{
						if( $data['elp_c_usermailoption'] == "YES" )
						{
							elp_cls_sendmail::elp_sendmail("welcome", $subject = "", $content = "", $subscribers);
						}
						$elp_alt_success = __('Subscribed successfully.', 'email-posts-to-subscribers');
					}
				}
				elseif($action == "ext")
				{
					$elp_alt_error = __('Email already exist.', 'email-posts-to-subscribers');
					$elp_error = true;
				}
			}
		//}
	}
	
	//////////////////////////////Robot verification//////////////////////////////////////////////////
	if($elp_captcha_widget == 'YES')
	{
		$elp = $elp  . '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
	}
	//////////////////////////////Robot verification//////////////////////////////////////////////////
	
	$elp = $elp  . '<form method="post" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '">';
	
	if($elp_desc <> "")
	{
		$elp = $elp . '<p>';
			$elp = $elp . '<span class="elp_caption">';
				$elp = $elp . $elp_desc;
			$elp = $elp . '</span>';
		$elp = $elp . '</p>';
	}
	
	if( $elp_name == "YES" )
	{
		$elp = $elp . '<p>';
		$elp = $elp . __('Name *', 'email-posts-to-subscribers');
		$elp = $elp . '<br>';
		$elp = $elp . '<span class="elp_textbox">';
			$elp = $elp . '<input class="elp_textbox_class" name="elp_txt_name" id="elp_txt_name" value="" maxlength="225" type="text">';
		$elp = $elp . '</span>';
		$elp = $elp . '<span class="elp_msg" style="color:#CC0000;">'.$elp_alt_nm.'</span>';
		$elp = $elp . '</p>';
	}
	
	
	$elp = $elp . '<p>';
	$elp = $elp . __('Email *', 'email-posts-to-subscribers');
	$elp = $elp . '<br>';
	$elp = $elp . '<span class="elp_textbox">';
		$elp = $elp . '<input class="elp_textbox_class" name="elp_txt_email" id="elp_txt_email" value="" maxlength="225" type="text">';
	$elp = $elp . '</span>';
	$elp = $elp . '<span class="elp_msg" style="color:#CC0000;">'.$elp_alt_em.'</span>';
	$elp = $elp . '</p>';
	
	//////////////////////////////Robot verification//////////////////////////////////////////////////
	if($elp_captcha_widget == 'YES')
	{
		$elp_captcha_sitekey = get_option('elp_captcha_sitekey', '');
		$elp = $elp . '<p>';
			$elp = $elp . '<div class="g-recaptcha" data-sitekey="'.$elp_captcha_sitekey.'"></div>';	
		$elp = $elp . '</p>';
	}
	//////////////////////////////Robot verification//////////////////////////////////////////////////

	$elp = $elp . '<p>';
		$elp = $elp . '<input class="elp_textbox_button" name="elp_btn_'.$elp_type.'" id="elp_btn_'.$elp_type.'" value="'.__('Submit', 'email-posts-to-subscribers').'" type="submit">';
		$elp = $elp . '<input name="elp_txt_group" id="elp_txt_group" value="'.$elp_group.'" type="hidden">';
	$elp = $elp . '</p>';
	
	if($elp_error)
	{
		$elp = $elp . '<span class="elp_msg" style="color:#CC0000;">'.$elp_alt_error.'</span>';
	}
	else
	{
		$elp = $elp . '<span class="elp_msg" style="color:#009900;">'.$elp_alt_success.'</span>';
	}
		
	//$elp = $elp . wp_nonce_field('elp_form_subscribers');
		
	$elp = $elp . '</form>';
	
	return $elp;
}
//////////////////////////////Not in Use//////////////////////////////////////////////////

function elp_subbox( $elp_name = "YES", $elp_desc = "" )
{
	$atts = array();
	$atts["namefield"] 	= $elp_name;
	$atts["desc"] 		= $elp_desc;
	$atts["group"] 		= "Public";	
	//$atts["type"] 		= "subbox";	
	//echo elp_shortcode( $atts );
	elp_cls_shortcode::elp_shortcode_prepare($atts);
}

class elp_cls_shortcode {

	public function __construct() {
	}
	
	public static function elp_shortcode_prepare( $atts ) {
		ob_start();
		
		if ( ! is_array( $atts ) )
		{
			return '';
		}
		
		//[email-posts-subscribers namefield="YES" desc=""]
		//[email-posts-subscribers namefield="YES" desc="" group="Public"]
		$atts = shortcode_atts( array(
			'namefield' => '',
			'desc'      => '',
			'group'     => ''
		), $atts, 'email-posts-subscribers' );

		$namefield 	= isset($atts['namefield']) ? $atts['namefield'] : '';
		$desc 		= isset($atts['desc']) ? $atts['desc'] : '';
		$group 		= isset($atts['group']) ? $atts['group'] : '';
		
		$data = array(
			'namefield' => $namefield,
			'desc' 		=> $desc,
			'group' 	=> $group,
		);

		self::elp_shortcode_render( $data );

		return ob_get_clean();
	}
	
	public static function elp_shortcode_render( $data = array() ) {		
		
		if(count($data) == 0) {
			return '';
		}

		$elp_name	= $data['namefield'];
		$elp_desc	= $data['desc'];
		$elp_group	= $data['group'];
		
		$elp_desc_html = "";	
		$elp_name_html = "";	
		$elp_email_html = "";
		
		if($elp_desc <> "") {
			$elp_desc_html = '<p>';
			$elp_desc_html .= $elp_desc;
			$elp_desc_html .= '</p>';
		}
		
		if($elp_name == "YES") {
			$elp_name_html = '<p>';
			$elp_name_html .= '<span class="name">';
			$elp_name_html .=  __('Name', 'email-download-link');
			$elp_name_html .= '</span>';
			$elp_name_html .= '<br />';
			$elp_name_html .= '<input type="text" name="name" id="name" placeholder="' . __('Name', 'email-download-link') . '" value="" maxlength="50" required/>';
			$elp_name_html .= '</p>';
		}
		
		$elp_email_html = '<p>';
		$elp_email_html .= '<span class="email">';
		$elp_email_html .= __('Email', 'email-download-link');
		$elp_email_html .= '</span>';
		$elp_email_html .= '<br />';
		$elp_email_html .= '<input type="email" id="email" name="email" value="" placeholder="' . __('Email', 'email-download-link') . '"  maxlength="225" required/>';
		$elp_email_html .= '</p>';
		
		$loading_image_path = ELP_URL . 'inc/ajax-loader.gif';
		$elp_nonce = wp_create_nonce( 'elp-nonce' );
		$unique_no = time();
		
		//////////////////////////////Robot verification//////////////////////////////////////////////////
		$elp_recaptcha_js = '';
		$elp_recaptcha_html = '';
		$elp_captcha_widget = get_option('elp_captcha_widget', '');
		if($elp_captcha_widget == 'YES')
		{
			$elp_recaptcha_js = '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
			$elp_captcha_sitekey = get_option('elp_captcha_sitekey');
			$elp_recaptcha_html = '<p>';
			$elp_recaptcha_html .= '<div class="g-recaptcha" data-sitekey="'.$elp_captcha_sitekey.'"></div>';
			$elp_recaptcha_html .= '</p>';
		}
		//////////////////////////////Robot verification//////////////////////////////////////////////////
		
		?>
		<?php echo $elp_recaptcha_js; ?>
		<div class="email_posts_subscribers">
			<?php echo $elp_desc_html; ?>
			<form action="#" method="post" class="elp_form" id="elp_form_<?php echo $unique_no; ?>">
				<?php echo $elp_name_html; ?>
				<?php echo $elp_email_html; ?>
				<?php echo $elp_recaptcha_html; ?>
				<input name="submit" id="elp_form_submit_<?php echo $unique_no; ?>" value="<?php _e('Submit', 'email-posts-to-subscribers'); ?>" type="submit" />
				<span class="elp_form_spinner" id="elp-loading-image" style="display:none;">
					<img src="<?php echo $loading_image_path; ?>" />
				</span>
				<input name="nonce" id="nonce" value="<?php echo $elp_nonce; ?>" type="hidden"/>
				<input name="group" id="group" value="<?php echo $elp_group; ?>" type="hidden"/>
				<input type="text" style="display:none;" id="email_name" name="email_name" value="" type="hidden"/>
			</form>	
			<span class="elp_form_message" id="elp_form_message_<?php echo $unique_no; ?>"></span>
		</div>
		<br />
	<?php
	}
}
?>