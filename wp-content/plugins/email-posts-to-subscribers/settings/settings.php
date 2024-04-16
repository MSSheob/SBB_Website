<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php elp_cls_common::elp_check_latest_update(); ?>
<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<?php settings_errors(); ?>
	<?php
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'GeneralSettings';
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=elp-settings&tab=GeneralSettings" class="nav-tab <?php echo $active_tab == 'GeneralSettings' ? 'nav-tab-active' : ''; ?>"><?php _e('General Settings', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-settings&tab=ConfirmationMail" class="nav-tab <?php echo $active_tab == 'ConfirmationMail' ? 'nav-tab-active' : ''; ?>"><?php _e('Confirmation Mail', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-settings&tab=WelcomeMail" class="nav-tab <?php echo $active_tab == 'WelcomeMail' ? 'nav-tab-active' : ''; ?>"><?php _e('Welcome Mail', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-settings&tab=AdminMail" class="nav-tab <?php echo $active_tab == 'AdminMail' ? 'nav-tab-active' : ''; ?>"><?php _e('Admin Mail', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-settings&tab=ReportMail" class="nav-tab <?php echo $active_tab == 'ReportMail' ? 'nav-tab-active' : ''; ?>"><?php _e('Report Mail', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-settings&tab=Message" class="nav-tab <?php echo $active_tab == 'Message' ? 'nav-tab-active' : ''; ?>"><?php _e('Messages', 'email-posts-to-subscribers'); ?></a>
		<a href="http://www.gopiplus.com/work/2014/03/28/wordpress-plugin-email-posts-to-subscribers/" target="_blank" class="nav-tab"><?php _e('FAQ & Help', 'email-posts-to-subscribers'); ?></a>
	</h2>

	<?php
	if( $active_tab == 'GeneralSettings' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-general.php');
	} 
	elseif( $active_tab == 'ConfirmationMail' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-confirmation.php');
	} 
	elseif( $active_tab == 'WelcomeMail' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-welcomemail.php');
	} 
	elseif( $active_tab == 'AdminMail' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-adminmail.php');
	} 
	elseif( $active_tab == 'ReportMail' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-reportmail.php');
	}
	elseif( $active_tab == 'Message' ) {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-message.php');
	}
	else {
		require_once(ELP_DIR.'settings'.DIRECTORY_SEPARATOR.'settings-general.php');
	}
	?>
	</form>
	<div class="clear"></div>
</div>