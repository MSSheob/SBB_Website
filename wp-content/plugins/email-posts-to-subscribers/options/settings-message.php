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
		'elp_c_id' => '',
		'elp_c_unsubtext' => '',
		'elp_c_unsubhtml' => '',
		'elp_c_subhtml'  => '',
		'elp_c_message1' => '',
		'elp_c_message2' => '',
		'elp_c_message3' => '',
		'elp_c_message4' => '',
		'elp_c_message5' => '',
		'elp_c_message6' => '',
		'elp_c_message7' => '',
		'elp_c_message8' => '',
		'elp_c_message9' => ''
	);
}
else {
	$elp_errors = array();
	$elp_success = '';
	$elp_error_found = FALSE;
	
	$data = array();
	$data = elp_cls_pluginconfig::elp_setting_select(1);
		
	// Preset the form fields
	$form = array(
		'elp_c_id' => $data['elp_c_id'],
		'elp_c_unsubtext' => $data['elp_c_unsubtext'],
		'elp_c_unsubhtml' => $data['elp_c_unsubhtml'],
		'elp_c_subhtml' => $data['elp_c_subhtml'],
		'elp_c_message1' => $data['elp_c_message1'],
		'elp_c_message2' => $data['elp_c_message2'],
		'elp_c_message3' => $data['elp_c_message3'],
		'elp_c_message4' => $data['elp_c_message4'],
		'elp_c_message5' => $data['elp_c_message5'],
		'elp_c_message6' => $data['elp_c_message6'],
		'elp_c_message7' => $data['elp_c_message7'],
		'elp_c_message8' => $data['elp_c_message8'],
		'elp_c_message9' => $data['elp_c_message9']
	);
}

	
// Form submitted, check the data
if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	//	Just security thingy that wordpress offers us
	check_admin_referer('elp_form_edit');
	
	$form['elp_c_unsubtext'] = isset($_POST['elp_c_unsubtext']) ? wp_filter_post_kses($_POST['elp_c_unsubtext']) : '';
	$form['elp_c_unsubhtml'] = isset($_POST['elp_c_unsubhtml']) ? wp_filter_post_kses($_POST['elp_c_unsubhtml']) : '';
	$form['elp_c_subhtml'] = isset($_POST['elp_c_subhtml']) ? wp_filter_post_kses($_POST['elp_c_subhtml']) : '';
	$form['elp_c_message1'] = isset($_POST['elp_c_message1']) ? wp_filter_post_kses($_POST['elp_c_message1']) : '';
	$form['elp_c_message2'] = isset($_POST['elp_c_message2']) ? wp_filter_post_kses($_POST['elp_c_message2']) : '';
	$form['elp_c_message3'] = isset($_POST['elp_c_message3']) ? wp_filter_post_kses($_POST['elp_c_message3']) : '';
	$form['elp_c_message4'] = isset($_POST['elp_c_message4']) ? wp_filter_post_kses($_POST['elp_c_message4']) : '';
	$form['elp_c_message5'] = isset($_POST['elp_c_message5']) ? wp_filter_post_kses($_POST['elp_c_message5']) : '';
	$form['elp_c_message6'] = isset($_POST['elp_c_message6']) ? wp_filter_post_kses($_POST['elp_c_message6']) : '';
	$form['elp_c_message7'] = isset($_POST['elp_c_message7']) ? wp_filter_post_kses($_POST['elp_c_message7']) : '';
	$form['elp_c_message8'] = isset($_POST['elp_c_message8']) ? wp_filter_post_kses($_POST['elp_c_message8']) : '';
	$form['elp_c_message9'] = isset($_POST['elp_c_message9']) ? wp_filter_post_kses($_POST['elp_c_message9']) : '';

	$inputdata = array(1, 
		$form['elp_c_unsubtext'], 
		$form['elp_c_unsubhtml'],
		$form['elp_c_subhtml'], 
		$form['elp_c_message1'], 
		$form['elp_c_message2'],
		$form['elp_c_message3'],
		$form['elp_c_message4'],
		$form['elp_c_message5'],
		$form['elp_c_message6'],
		$form['elp_c_message7'],
		$form['elp_c_message8'],
		$form['elp_c_message9']);
	
	$action = "";
	//$action = elp_cls_pluginconfig::elp_setting_update($inputdata);
	if($action == "sus") {
		$elp_success = __('Details was successfully updated.', 'email-posts-to-subscribers');
	}
	else {
		$elp_error_found == TRUE;
		$elp_errors[] = __('Oops, details not update.', 'email-posts-to-subscribers');
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
	<div id="icon-plugins" class="icon32"></div>
	<h3><?php _e('Settings', 'email-posts-to-subscribers'); ?></h3>
	<form name="elp_form" method="post" action="#" onsubmit="return _elp_submit()"  >
	<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"> 
				<label>
					<strong><?php _e('Text to display after subscriber form submitted successfully', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display after subscriber form submitted successfully, i.e. after clicked submit button on the front end subscriber form.', 'email-posts-to-subscribers'); ?></p>
				</label>
			</th>
			<td><textarea size="100" id="elp_c_message3" rows="4" cols="65" name="elp_c_message3"><?php echo esc_html(stripslashes($form['elp_c_message3'])); ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"> 
				<label>
					<strong><?php _e('Text to display after email subscribed successfully', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('This text will display once user clicked email confirmation link from opt-in (confirmation) email content.', 'email-posts-to-subscribers'); ?></p>
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
	</tbody>
	</table>
	<div style="padding-top:10px;"></div>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Save Settings', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button add-new-h2" onclick="_elp_redirect_settings()" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="_elp_help()" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" />
	</p>
	<?php wp_nonce_field('elp_form_edit'); ?>
    </form>
</div>