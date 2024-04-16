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
		'elp_c_optinsubject' => '',
		'elp_c_optincontent' => '',
		'elp_c_optinlink' => ''
	);
}
else
{
	$data = array();
	$data = elp_cls_pluginconfig::elp_setting_select(1);
	
	$form = array(
		'elp_c_optinsubject' => $data['elp_c_optinsubject'],
		'elp_c_optincontent' => $data['elp_c_optincontent'],
		'elp_c_optinlink' => $data['elp_c_optinlink']
	);
}

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_edit');
	$form['elp_c_id'] = 1;
	$form['elp_c_optinsubject'] = isset($_POST['elp_c_optinsubject']) ? wp_filter_post_kses($_POST['elp_c_optinsubject']) : '';
	$form['elp_c_optincontent'] = isset($_POST['elp_c_optincontent']) ? wp_filter_post_kses($_POST['elp_c_optincontent']) : '';
	
	$home_url = home_url('/');
	$optinlink = $home_url . "?elp=optin&db=###DBID###&email=###EMAIL###&guid=###GUID###";
	$form['elp_c_optinlink'] = $optinlink;

	if ($elp_error_found == FALSE) {	
		$action = elp_cls_pluginconfig::elp_setting_update_confirmationmail($form);
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
				<label for="elp"><strong><?php _e('Opt-in mail subject (Confirmation mail)', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Enter the subject for Double Opt In mail. This will send whenever subscriber added email into our database.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td><input name="elp_c_optinsubject" type="text" id="elp_c_optinsubject" value="<?php echo esc_html(stripslashes($form['elp_c_optinsubject'])); ?>" size="70" maxlength="225" /></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Opt-in mail content (Confirmation mail)', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Enter the content for Double Opt In mail. This will send whenever subscriber added email into our database.', 'email-posts-to-subscribers'); ?> (Keyword: ##NAME##)</p></label>
			</th>
			<td><textarea size="100" id="elp_c_optincontent" rows="10" cols="67" name="elp_c_optincontent"><?php echo esc_html(stripslashes($form['elp_c_optincontent'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp"><strong><?php _e('Opt-in link (Confirmation link)', 'email-posts-to-subscribers'); ?></strong>
				<p class="description"><?php _e('Double Opt In confirmation link. You no need to change this value.', 'email-posts-to-subscribers'); ?></p></label>
			</th>
			<td><input name="elp_c_optinlink" type="text" id="elp_c_optinlink" value="<?php echo esc_html(stripslashes($form['elp_c_optinlink'])); ?>" size="70" maxlength="225" /></td>
		</tr>
	</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('ConfirmationMail')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_edit'); ?>
    </form>
</div>