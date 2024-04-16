<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();

$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes')
{
	check_admin_referer('elp_form_add');
	
	$elp_captcha_widget 		= isset($_POST['elp_captcha_widget']) ? wp_filter_post_kses($_POST['elp_captcha_widget']) : '';
	$elp_captcha_sitekey 		= isset($_POST['elp_captcha_sitekey']) ? wp_filter_post_kses($_POST['elp_captcha_sitekey']) : '';
	$elp_captcha_secret 		= isset($_POST['elp_captcha_secret']) ? wp_filter_post_kses($_POST['elp_captcha_secret']) : '';

	if ($elp_error_found == FALSE) {
		update_option('elp_captcha_widget', $elp_captcha_widget );
		update_option('elp_captcha_sitekey', $elp_captcha_sitekey );
		update_option('elp_captcha_secret', $elp_captcha_secret );
		$elp_success = __('Captcha details successfully updated.', 'email-posts-to-subscribers');
	}
}

$elp_captcha_widget = get_option('elp_captcha_widget', '');
if($elp_captcha_widget == "") {
	add_option('elp_captcha_widget', "NO");
}

$elp_captcha_sitekey = get_option('elp_captcha_sitekey', '');
if($elp_captcha_sitekey == "") {
	add_option('elp_captcha_sitekey', "NA");
	$elp_captcha_sitekey = get_option('elp_captcha_sitekey');
}

$elp_captcha_secret = get_option('elp_captcha_secret', '');
if($elp_captcha_secret == "") {
	add_option('elp_captcha_secret', "NA");
	$elp_captcha_secret = get_option('elp_captcha_secret');
}

if ($elp_captcha_sitekey == "NA") {
	$elp_captcha_sitekey = "";
}

if ($elp_captcha_secret == "NA") {
	$elp_captcha_secret = "";
}

if ($elp_error_found == TRUE && isset($elp_errors[0]) == TRUE) {
	?><div class="error fade"><p><strong><?php echo $elp_errors[0]; ?></strong></p></div><?php
}
if ($elp_error_found == FALSE && strlen($elp_success) > 0) {
	?><div class="updated fade"><p><strong><?php echo $elp_success; ?></strong></p></div><?php
}
?>
<style>
.form-table th {
    width: 300px;
}
</style>
<div class="form-wrap">
	<form name="elp_form" method="post" action="#" onsubmit="return _elp_submit_recaptcha()"  >
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('reCaptcha option', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Add reCaptcha in the subscriber form.', 'email-posts-to-subscribers'); ?></p>
					</label>
				</th>
				<td>
				<select name="elp_captcha_widget" id="elp_captcha_widget">
					<option value='NO' <?php if($elp_captcha_widget == 'NO') { echo 'selected="selected"' ; } ?>>NO (Do not display captcha)</option>
					<option value='YES' <?php if($elp_captcha_widget == 'YES') { echo 'selected="selected"' ; } ?>>YES (Display captcha)</option>
				</select>
				</td>
			</tr>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('reCaptcha Site key', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Please enter your site key for reCaptcha.', 'email-posts-to-subscribers'); ?></p>
					</label>
				</th>
				<td>
					<input name="elp_captcha_sitekey" type="text" id="elp_captcha_sitekey" value="<?php echo $elp_captcha_sitekey; ?>" maxlength="225" size="75"  />
				</td>
			</tr>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('reCaptcha Secret key', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Please enter your secret key for reCaptcha.', 'email-posts-to-subscribers'); ?></p>
					</label>
				</th>
				<td>
					<input name="elp_captcha_secret" type="text" id="elp_captcha_secret" value="<?php echo $elp_captcha_secret; ?>" maxlength="225" size="75"  />
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('recaptcha')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_add'); ?>
    </form>
</div>