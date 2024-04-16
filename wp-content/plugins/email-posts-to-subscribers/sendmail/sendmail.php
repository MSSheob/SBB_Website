<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<?php settings_errors(); ?>
	<?php
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'SendMail';
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=elp-sendemail&tab=SendMail" class="nav-tab <?php echo $active_tab == 'SendMail' ? 'nav-tab-active' : ''; ?>">Send Template Mail</a>
		<a href="?page=elp-sendemail&tab=SendNewsletter" class="nav-tab <?php echo $active_tab == 'SendNewsletter' ? 'nav-tab-active' : ''; ?>">Send Newsletter Mail</a>
		<a href="<?php echo ELP_FAV; ?>" target="_blank" class="nav-tab">FAQ & Help</a>
	</h2>

	<?php
	if( $active_tab == 'SendMail' ) {
		require_once(ELP_DIR.'sendmail'.DIRECTORY_SEPARATOR.'sendmail-subscriber.php');
	} elseif( $active_tab == 'SendNewsletter' ) {
		require_once(ELP_DIR.'sendmail'.DIRECTORY_SEPARATOR.'sendmail-newsletter.php');
	}
	else {
		require_once(ELP_DIR.'sendmail'.DIRECTORY_SEPARATOR.'sendmail-subscriber.php');
	}
	?>
	</form>
</div>