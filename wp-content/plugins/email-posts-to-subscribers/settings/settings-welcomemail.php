<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();

$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
	
$result = elp_cls_pluginconfig::elp_setting_count(1);
if ($result != '1')
{
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'email-posts-to-subscribers'); ?></strong></p></div><?php
	$form = array(
		'elp_c_usermailoption' => '',
		'elp_c_usermailsubject' => '',
		'elp_c_usermailcontant' => ''
	);
}
else
{
	$data = array();
	$data = elp_cls_pluginconfig::elp_setting_select(1);
	
	$form = array(
		'elp_c_usermailoption' => $data['elp_c_usermailoption'],
		'elp_c_usermailsubject' => $data['elp_c_usermailsubject'],
		'elp_c_usermailcontant' => $data['elp_c_usermailcontant']
	);
}

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_edit');
	
	$form['elp_c_id'] = 1;
	$form['elp_c_usermailoption'] = isset($_POST['elp_c_usermailoption']) ? wp_filter_post_kses($_POST['elp_c_usermailoption']) : '';
	$form['elp_c_usermailsubject'] = isset($_POST['elp_c_usermailsubject']) ? wp_filter_post_kses($_POST['elp_c_usermailsubject']) : '';
	$form['elp_c_usermailcontant'] = isset($_POST['elp_c_usermailcontant']) ? wp_filter_post_kses($_POST['elp_c_usermailcontant']) : '';

	if ($elp_error_found == FALSE) {	
		$action = elp_cls_pluginconfig::elp_setting_update_welcomemail($form);
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
				<label for="elp"><strong><?php _e('Subscriber welcome email', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('To send welcome mail to subscriber, This option must be set to YES.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td>			
			<select name="elp_c_usermailoption" id="elp_c_usermailoption">
				<option value='YES' <?php if($form['elp_c_usermailoption'] == 'YES') { echo 'selected' ; } ?>>YES</option>
				<option value='NO' <?php if($form['elp_c_usermailoption'] == 'NO') { echo 'selected' ; } ?>>NO</option>
			</select>
			</td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Welcome mail subject', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Enter the subject for subscriber welcome mail. This will send whenever email subscribed (confirmed) successfully.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td><input name="elp_c_usermailsubject" type="text" id="elp_c_usermailsubject" value="<?php echo esc_html(stripslashes($form['elp_c_usermailsubject'])); ?>" size="70" maxlength="225" /></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Subscriber welcome mail content', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Enter the content for subscriber welcome mail. This will send whenever email subscribed (confirmed) successfully.', 'email-posts-to-subscribers'); ?> (Keyword: ###NAME###)</p>
			</label>
			</th>
			<td><textarea size="100" id="elp_c_usermailcontant" rows="10" cols="67" name="elp_c_usermailcontant"><?php echo esc_html(stripslashes($form['elp_c_usermailcontant'])); ?></textarea></td>
		</tr>
	</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('WelcomeMail')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_edit'); ?>
    </form>
</div>