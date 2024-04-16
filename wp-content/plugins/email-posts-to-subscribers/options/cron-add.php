<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();

$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
$cron_adminmail = "";

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_add');
	
	$elp_cron_mailcount = isset($_POST['elp_cron_mailcount']) ? wp_filter_post_kses($_POST['elp_cron_mailcount']) : '';
	if($elp_cron_mailcount == "0" || strlen ($elp_cron_mailcount) == 0) {
		$elp_errors[] = __('Please enter valid mail count.', 'email-posts-to-subscribers');
		$elp_error_found = TRUE;
	}
	
	$elp_cron_adminmail = isset($_POST['elp_cron_adminmail']) ? wp_filter_post_kses($_POST['elp_cron_adminmail']) : '';
	$elp_cron_trigger_option = isset($_POST['elp_cron_trigger_option']) ? wp_filter_post_kses($_POST['elp_cron_trigger_option']) : '';

	if ($elp_error_found == FALSE) {
		update_option('elp_cron_mailcount', $elp_cron_mailcount );
		update_option('elp_cron_adminmail', $elp_cron_adminmail );
		update_option('elp_cron_trigger_option', $elp_cron_trigger_option );
		$elp_success = __('Cron details successfully updated.', 'email-posts-to-subscribers');
	}
}

$elp_cron_url = get_option('elp_c_cronurl', 'nocronurl');
if($elp_cron_url == "nocronurl") {
	$guid = elp_cls_common::elp_generate_guid(60);
	$home_url = home_url('/');
	$cronurl = $home_url . "?elp=cron&guid=". $guid;
	add_option('elp_c_cronurl', $cronurl);
	$elp_cron_url = get_option('elp_c_cronurl');
}

$elp_cron_mailcount = get_option('elp_cron_mailcount', '0');
if($elp_cron_mailcount == "0") {
	add_option('elp_cron_mailcount', "75");
	$elp_cron_mailcount = get_option('elp_cron_mailcount');
}

$elp_cron_adminmail = get_option('elp_cron_adminmail', '');
if($elp_cron_adminmail == "") {
	add_option('elp_cron_adminmail', "Hi Admin, \r\n\r\nCron URL has been triggered successfully on ###DATE### for the mail ###SUBJECT###. And the mail has been sent to ###COUNT### recipient. \r\n\r\nThank You");
	$elp_cron_adminmail = get_option('elp_cron_adminmail');
}

$elp_cron_trigger_option = get_option('elp_cron_trigger_option', '0');
if($elp_cron_trigger_option == "0") {
	add_option('elp_cron_trigger_option', "YES");
	$elp_cron_trigger_option = get_option('elp_cron_trigger_option');
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
	<form name="elp_form" method="post" action="#" onsubmit="return _elp_submit_cron()"  >
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('WordPress Cron', 'email-posts-to-subscribers'); ?></strong>
						<p class="description">
						<?php _e('YES : Plugin will use WP CRON option to send emails. No manual configuration is required.', 'email-posts-to-subscribers'); ?><br />
						<?php _e('NO : Plugin will not use WP CRON option to send emails instead you have to configure CRON JOB in your server using below Cron job URL.', 'email-posts-to-subscribers'); ?>
						</p>
					</label>
				</th>
				<td>
					<select name="elp_cron_trigger_option" id="elp_cron_trigger_option">
        <option value='YES' <?php if($elp_cron_trigger_option == 'YES') { echo 'selected="selected"' ; } ?>>YES (Use WP CRON)</option>
		<option value='NO' <?php if($elp_cron_trigger_option == 'NO') { echo 'selected="selected"' ; } ?>>NO (Do not use WP CRON)</option>
      </select>
				</td>
			</tr>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('Cron job URL', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Please find your cron job URL. This is read only field not able to modify from admin.', 'email-posts-to-subscribers'); ?></p>
					</label>
				</th>
				<td>
					<input name="elp_cron_url" type="text" id="elp_cron_url" value="<?php echo $elp_cron_url; ?>" maxlength="225" size="75"  />
				</td>
			</tr>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('Mail Count', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Enter number of mails you want to send per hour/trigger.', 'email-posts-to-subscribers'); ?></p>
					</label>
				</th>
				<td>
					<input name="elp_cron_mailcount" type="text" id="elp_cron_mailcount" value="<?php echo $elp_cron_mailcount; ?>" maxlength="3" />
				</td>
			</tr>
			<tr>
				<th scope="row"> 
					<label for="elp">
						<strong><?php _e('Admin Report', 'email-posts-to-subscribers'); ?></strong>
						<p class="description"><?php _e('Send above mail to admin whenever cron URL triggered in your server.', 'email-posts-to-subscribers'); ?><br />(Keywords: ###DATE###, ###SUBJECT###, ###COUNT###)</p>
					</label>
				</th>
				<td>
					<textarea size="100" id="elp_cron_adminmail" rows="6" cols="73" name="elp_cron_adminmail"><?php echo esc_html(stripslashes($elp_cron_adminmail)); ?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('cron')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_add'); ?>
    </form>
</div>
<?php
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
							
$timestamp = wp_next_scheduled('elp_cron_hourly_event');
$elp_wp_next_scheduled = "NA";
$elp_wp_last_scheduled = "NA";
if($timestamp <> "" and $elp_cron_trigger_option == "YES") {
	$elp_wp_next_scheduled = date_i18n($date_format . ' ' . $time_format, $timestamp, false);
	$elp_wp_last_scheduled = date_i18n($date_format . ' ' . $time_format, $timestamp - 3600, false);
}

$timestamp1 = wp_next_scheduled('elp_cron_halfhourly_event');
$elp_wp_next_scheduled1 = "NA";
$elp_wp_last_scheduled1 = "NA";
if($timestamp1 <> "") {
	$elp_wp_next_scheduled1 = date_i18n($date_format . ' ' . $time_format, $timestamp1, false);
	$elp_wp_last_scheduled1 = date_i18n($date_format . ' ' . $time_format, $timestamp1 - 1800, false);
}

$timestamp2 = wp_next_scheduled('elp_cron_monthly_event');
$elp_wp_next_scheduled2 = "NA";
$elp_wp_last_scheduled2 = "NA";
if($timestamp2 <> "") {
	$elp_wp_next_scheduled2 = date_i18n($date_format . ' ' . $time_format, $timestamp2, false);
	$elp_wp_last_scheduled2 = date_i18n($date_format . ' ' . $time_format, $timestamp2 - 2635200, false);
}
?>
<table class="widefat striped">
	<thead>
		<tr>
			<th scope="col"><?php _e('WordPress Cron', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Hook Name', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Actions', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Last Run', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Next Run', 'email-posts-to-subscribers'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $elp_cron_trigger_option; ?></td>
			<td>elp_cron_hourly_event</td>
			<td><code>elp_cron_trigger_hourly()</code></td>
			<td><?php echo $elp_wp_last_scheduled; ?></td>
			<td><?php echo $elp_wp_next_scheduled; ?></td>
		</tr>
		<tr>
			<td>YES</td>
			<td>elp_cron_halfhourly_event</td>
			<td><code>elp_cron_trigger_halfhourly()</code></td>
			<td><?php echo $elp_wp_last_scheduled1; ?></td>
			<td><?php echo $elp_wp_next_scheduled1; ?></td>
		</tr>
		<tr>
			<td>YES</td>
			<td>elp_cron_monthly_event</td>
			<td><code>elp_cron_trigger_monthly()</code></td>
			<td><?php echo $elp_wp_last_scheduled2; ?></td>
			<td><?php echo $elp_wp_next_scheduled2; ?></td>
		</tr>
	</tbody>
	<tfoot>
		<td colspan="5">Current Date : <?php echo date($date_format . ' ' . $time_format); ?></td>
	</tfoot> 
</table>

<div class="tool-box">
	<h3><?php _e('How to setup auto emails?', 'email-posts-to-subscribers'); ?></h3>
	<p><?php _e('There are two options available in this plugin to schedule your CRON jobs. First option is let wordpress handle your scheduler (Set YES for wordpress CRON). And second option is configure the scheduler (Set NO for wordpress CRON) in your server.'); ?></p>
	<p><?php _e('1. First option (Let wordpress handle your scheduler) : This is new option introduced in plugin version 3.9. this is very easy option and no server knowledge is required. In this page just set WordPress Cron to YES, wordpress automatically trigger the CRON job once every hour and based on your mail configuration newsletter go to your subscriber automatically. For More info', 'email-posts-to-subscribers'); ?> <a target="_blank" href="http://www.gopiplus.com/work/2014/03/31/schedule-auto-mails-cron-jobs-for-email-posts-to-subscribers-plugin/">click here</a> </p>
	<p><?php _e('2. Second option (Configure CRON in your server) : CRON URL is available in this page. You have to trigger/schedule this URL from your server once every hour (Once every hour is recommended for this plugin). Plugin will send/schedule the newsletter whenever your URL is triggered. For more info ', 'email-posts-to-subscribers'); ?>  <a target="_blank" href="http://www.gopiplus.com/work/2014/03/31/schedule-auto-mails-cron-jobs-for-email-posts-to-subscribers-plugin/">click here</a></p>
</div>