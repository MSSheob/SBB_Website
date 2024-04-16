<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
// Form submitted, check the data
if (isset($_POST['es_form_submit']) && $_POST['es_form_submit'] == 'yes')
{
	check_admin_referer('elp_form_sync');
	$es_success = __('Table sync completed successfully.', 'email-posts-to-subscribers');
	//elp_cls_registerhook::elp_synctables_3_4();
	elp_cls_registerhook::elp_synctables_all_versions();
	elp_cron_activation_halfhourly();
	?>
	<div class="updated fade">
		<p><strong><?php echo $es_success; ?></strong></p>
	</div>
	<?php
}
?>
<div class="form-wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<form name="form_addemail" method="post" action="#" onsubmit="return _es_addemail()"  >
      <h3 class="title"><?php _e('Database Update Required', 'email-posts-to-subscribers'); ?></h3>
      <input type="hidden" name="es_form_submit" value="yes"/>
	  <div style="padding-top:5px;"></div>
	  <div>Plugin has been updated! Before we send you on your way, we have to update your database to the newest version.</div>
	  <div style="padding-top:20px;"></div>
	  <div>The database update process may take a little while, so please be patient.</div>
	  <div style="padding-top:20px;"></div>
      <p>
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Update plugin table', 'email-posts-to-subscribers'); ?>" type="submit" />
      </p>
	  <?php wp_nonce_field('elp_form_sync'); ?>
    </form>
</div>
<div style="padding-top:10px;"></div>
<p class="description"><?php echo ELP_OFFICIAL; ?></p>
</div>