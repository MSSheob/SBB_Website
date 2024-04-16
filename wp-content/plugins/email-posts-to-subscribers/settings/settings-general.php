<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
	
$result = elp_cls_pluginconfig::elp_setting_count(1);
if ($result != '1') {
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'email-posts-to-subscribers'); ?></strong></p></div><?php
	$form = array(
		'elp_c_fromname' => '',
		'elp_c_fromemail' => '',
		'elp_c_mailtype' => '',
		'elp_c_optinoption' => ''
	);
}
else {
	$data = array();
	$data = elp_cls_pluginconfig::elp_setting_select(1);
	
	$form = array(
		'elp_c_fromname' => $data['elp_c_fromname'],
		'elp_c_fromemail' => $data['elp_c_fromemail'],
		'elp_c_mailtype' => $data['elp_c_mailtype'],
		'elp_c_optinoption' => $data['elp_c_optinoption']
	);
}

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_edit');
	
	$form['elp_c_id'] = 1;
	$form['elp_c_fromname'] = isset($_POST['elp_c_fromname']) ? wp_filter_post_kses($_POST['elp_c_fromname']) : '';
	if ($form['elp_c_fromname'] == '') {
		$elp_errors[] = __('Please enter sender of notifications from name.', 'email-posts-to-subscribers');
		$elp_error_found = TRUE;
	}
	
	$form['elp_c_fromemail'] = isset($_POST['elp_c_fromemail']) ? wp_filter_post_kses($_POST['elp_c_fromemail']) : '';
	if ($form['elp_c_fromemail'] == '') {
		$elp_errors[] = __('Please enter sender of notifications from email.', 'email-posts-to-subscribers');
		$elp_error_found = TRUE;
	}
	
	$form['elp_c_mailtype'] = isset($_POST['elp_c_mailtype']) ? wp_filter_post_kses($_POST['elp_c_mailtype']) : '';
	$form['elp_c_optinoption'] = isset($_POST['elp_c_optinoption']) ? wp_filter_post_kses($_POST['elp_c_optinoption']) : '';
	
	if ($elp_error_found == FALSE) {	
		$action = elp_cls_pluginconfig::elp_setting_update_generalgettings($form);
		if($action == "sus") {
			$elp_success = __('Details was successfully updated.', 'email-posts-to-subscribers');
		}
		else {
			$elp_error_found == TRUE;
			$elp_errors[] = __('Oops.. Unexpected error occurred.', 'email-posts-to-subscribers');
		}
	}
}

if ($elp_error_found == TRUE && isset($elp_errors[0]) == TRUE) {
	?>
		<div class="error fade">
			<p><strong><?php echo $elp_errors[0]; ?></strong></p>
		</div>
	<?php
}

if ($elp_error_found == FALSE && strlen($elp_success) > 0) {
	?>
		<div class="updated fade">
			<p><strong><?php echo $elp_success; ?></strong></p>
		</div>
	<?php
}
?>
<style>
.form-table th {
    width: 350px;
}
</style>
<div class="form-wrap">
	<form name="elp_form" method="post" action="#">
	<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="elp"><strong><?php _e('Sender of notifications', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Choose a FROM name and FROM email address for all notifications emails from this plugin.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td>
				<input name="elp_c_fromname" type="text" id="elp_c_fromname" value="<?php echo $form['elp_c_fromname']; ?>" maxlength="225" />
				<input name="elp_c_fromemail" type="text" id="elp_c_fromemail" value="<?php echo $form['elp_c_fromemail']; ?>" size="45" maxlength="225" />
			</td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Mail type', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Option 1 & 2 is to send mails with default Wordpress method wp_mail(). Option 3 & 4 is to send mails with PHP method mail()', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td>
				<select name="elp_c_mailtype" id="elp_c_mailtype">
					<option value='WP HTML MAIL' <?php if($form['elp_c_mailtype'] == 'WP HTML MAIL') { echo 'selected' ; } ?>>1. WP HTML MAIL</option>
					<option value='WP PLAINTEXT MAIL' <?php if($form['elp_c_mailtype'] == 'WP PLAINTEXT MAIL') { echo 'selected' ; } ?>>2. WP PLAINTEXT MAIL</option>
					<option value='PHP HTML MAIL' <?php if($form['elp_c_mailtype'] == 'PHP HTML MAIL') { echo 'selected' ; } ?>>3. PHP HTML MAIL</option>
					<option value='PHP PLAINTEXT MAIL' <?php if($form['elp_c_mailtype'] == 'PHP PLAINTEXT MAIL') { echo 'selected' ; } ?>>4. PHP PLAINTEXT MAIL</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Opt-in option', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Double Opt In, means subscribers need to confirm their email address by an activation link sent them on a confirmation mmail. Single Opt In, means subscribers do not need to confirm their email address.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td>			
				<select name="elp_c_optinoption" id="elp_c_optinoption">
					<option value='Double Opt In' <?php if($form['elp_c_optinoption'] == 'Double Opt In') { echo 'selected' ; } ?>>Double Opt In</option>
					<option value='Single Opt In' <?php if($form['elp_c_optinoption'] == 'Single Opt In') { echo 'selected' ; } ?>>Single Opt In</option>
				</select>
			</td>
		</tr>
	</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" id="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('GeneralSettings')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_edit'); ?>
    </form>
</div>