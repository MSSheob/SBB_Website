<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php elp_cls_common::elp_check_latest_update(); ?>
<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<?php settings_errors(); ?>
	<?php
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'roles';
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=elp-options&tab=roles" class="nav-tab <?php echo $active_tab == 'roles' ? 'nav-tab-active' : ''; ?>"><?php _e('Roles and Capabilities', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-options&tab=cron" class="nav-tab <?php echo $active_tab == 'cron' ? 'nav-tab-active' : ''; ?>"><?php _e('Cron Details', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-options&tab=recaptcha" class="nav-tab <?php echo $active_tab == 'recaptcha' ? 'nav-tab-active' : ''; ?>"><?php _e('reCaptcha', 'email-posts-to-subscribers'); ?></a>
		<a href="?page=elp-options&tab=security" class="nav-tab <?php echo $active_tab == 'security' ? 'nav-tab-active' : ''; ?>"><?php _e('Security', 'email-posts-to-subscribers'); ?></a>
		<a href="http://www.gopiplus.com/work/2014/03/30/email-subscription-box-for-email-posts-to-subscribers-plugin/" target="_blank" class="nav-tab"><?php _e('Short Code', 'email-posts-to-subscribers'); ?></a>
		<a href="<?php echo ELP_FAV; ?>" target="_blank" class="nav-tab"><?php _e('FAQ & Help', 'email-posts-to-subscribers'); ?></a>
	</h2>

	<?php
	if( $active_tab == 'settings' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'settings-edit.php');
	} elseif( $active_tab == 'roles' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'roles-add.php');
	} elseif( $active_tab == 'cron' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'cron-add.php');
	} elseif( $active_tab == 'recaptcha' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'recaptcha-add.php');
	} elseif( $active_tab == 'security' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'security-show.php');
	} elseif( $active_tab == 'message' ) {
		require_once(ELP_DIR.'options'.DIRECTORY_SEPARATOR.'settings-message.php');
	}
	else {
		
	}
	?>
	</form>
	<div class="clear"></div>
</div>