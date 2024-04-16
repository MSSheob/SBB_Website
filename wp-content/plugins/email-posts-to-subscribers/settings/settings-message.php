<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();

$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
	
$result = elp_cls_pluginconfig::elp_setting_count(1);
if ($result != '1') {
	?>
	<div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'email-posts-to-subscribers'); ?></strong></p></div>
	<?php
	$form = array(
		'elp_c_unsubtext' => '',
		'elp_c_unsubhtml' => '',
		'elp_c_subhtml'  => '',
		'elp_c_message1' => '',
		'elp_c_message2' => '',
		'elp_c_message3' => '',
		'elp_c_rptsubject' => '',
		'elp_c_message5' => '',
		'elp_c_message6' => '',
		'elp_c_message7' => '',
		'elp_c_message8' => '',
		'elp_c_message9' => ''
	);
}
else {
	$data = array();
	$data = elp_cls_pluginconfig::elp_setting_select(1);
		
	$form = array(
		'elp_c_unsubtext' => $data['elp_c_unsubtext'],
		'elp_c_unsubhtml' => $data['elp_c_unsubhtml'],
		'elp_c_subhtml' => $data['elp_c_subhtml'],
		'elp_c_message1' => $data['elp_c_message1'],
		'elp_c_message2' => $data['elp_c_message2'],
		'elp_c_message3' => $data['elp_c_message3'],
		'elp_c_message6' => $data['elp_c_message6'],
		'elp_c_message7' => $data['elp_c_message7'],
		'elp_c_message8' => $data['elp_c_message8'],
		'elp_c_message9' => $data['elp_c_message9']
	);
}

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_edit');
	$form['elp_c_id'] = 1;
	$form['elp_c_unsubtext'] = isset($_POST['elp_c_unsubtext']) ? wp_filter_post_kses($_POST['elp_c_unsubtext']) : '';
	$form['elp_c_unsubhtml'] = isset($_POST['elp_c_unsubhtml']) ? wp_filter_post_kses($_POST['elp_c_unsubhtml']) : '';
	$form['elp_c_subhtml'] = isset($_POST['elp_c_subhtml']) ? wp_filter_post_kses($_POST['elp_c_subhtml']) : '';
	$form['elp_c_message1'] = isset($_POST['elp_c_message1']) ? wp_filter_post_kses($_POST['elp_c_message1']) : '';
	$form['elp_c_message2'] = isset($_POST['elp_c_message2']) ? wp_filter_post_kses($_POST['elp_c_message2']) : '';
	$form['elp_c_message3'] = isset($_POST['elp_c_message3']) ? wp_filter_post_kses($_POST['elp_c_message3']) : '';
	$form['elp_c_message6'] = isset($_POST['elp_c_message6']) ? wp_filter_post_kses($_POST['elp_c_message6']) : '';
	$form['elp_c_message7'] = isset($_POST['elp_c_message7']) ? wp_filter_post_kses($_POST['elp_c_message7']) : '';
	$form['elp_c_message8'] = isset($_POST['elp_c_message8']) ? wp_filter_post_kses($_POST['elp_c_message8']) : '';
	$form['elp_c_message9'] = isset($_POST['elp_c_message9']) ? wp_filter_post_kses($_POST['elp_c_message9']) : '';

	if ($elp_error_found == FALSE) {
		$action = elp_cls_pluginconfig::elp_setting_update_message($form);
		if($action == "sus") {
			$elp_success = __('Details was successfully updated.', 'email-posts-to-subscribers');
		}
		else {
			$elp_error_found == TRUE;
			$elp_errors[] = __('Oops, details not update.', 'email-posts-to-subscribers');
		}
	}
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
    width: 350px;
}
</style>
<div class="form-wrap">
	<form name="elp_form" method="post" action="#">
	<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"> 
				<label>
					<strong><?php _e('Text to display after subscriber form submitted successfully', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display after subscriber form submitted successfully, i.e. after clicked submit button on the front end subscriber form. (Double Opt In)', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message3" rows="4" cols="65" name="elp_c_message3"><?php echo esc_html(stripslashes($form['elp_c_message3'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Text to display after subscriber form submitted successfully', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display after subscriber form submitted successfully, i.e. after clicked submit button on the front end subscriber form. (Single Opt In)', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message6" rows="4" cols="65" name="elp_c_message6"><?php echo esc_html(stripslashes($form['elp_c_message6'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label>
					<strong><?php _e('Text to display after email subscribed successfully', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display once user clicked email confirmation link from Double Opt In (confirmation) email content.', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_subhtml" rows="4" cols="65" name="elp_c_subhtml"><?php echo esc_html(stripslashes($form['elp_c_subhtml'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label>
					<strong><?php _e('Unsubscribe text in mail', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Enter the text for unsubscribe link. This text is to add unsubscribe link with newsletter.', 'email-posts-to-subscribers'); ?> (Keyword: ###LINK###)</p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_unsubtext" rows="4" cols="65" name="elp_c_unsubtext"><?php echo esc_html(stripslashes($form['elp_c_unsubtext'])); ?></textarea></td>
		</tr>	
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Text to display after email unsubscribed', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display once user clicked unsubscribed link from our newsletter.', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_unsubhtml" rows="4" cols="65" name="elp_c_unsubhtml"><?php echo esc_html(stripslashes($form['elp_c_unsubhtml'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Error confirmation link', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Default message to display if any issue on confirmation link.', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message1" rows="4" cols="65" name="elp_c_message1"><?php echo esc_html(stripslashes($form['elp_c_message1'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Error unsubscribe link', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Default message to display if any issue on unsubscribe link.', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message2" rows="4" cols="65" name="elp_c_message2"><?php echo esc_html(stripslashes($form['elp_c_message2'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Message 7', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Dummy message', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message7" rows="4" cols="65" name="elp_c_message7"><?php echo esc_html(stripslashes($form['elp_c_message7'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Message 8', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Dummy message', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message8" rows="4" cols="65" name="elp_c_message8"><?php echo esc_html(stripslashes($form['elp_c_message8'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label for="elp">
					<strong><?php _e('Message 9', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Dummy message', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message9" rows="4" cols="65" name="elp_c_message9"><?php echo esc_html(stripslashes($form['elp_c_message9'])); ?></textarea></td>
		</tr>
	</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('Message')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_edit'); ?>
    </form>
</div>