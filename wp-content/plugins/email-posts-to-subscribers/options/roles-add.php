<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
$elp_errors 		= array();
$elp_success 		= '';
$elp_error_found 	= FALSE;

$elp_role_subscriber 	= "";
$elp_role_templates 	= "";
$elp_role_mailconfig 	= "";
$elp_role_postnotify 	= "";
$elp_role_compose 		= "";
$elp_role_sendemail 	= "";
$elp_role_sentmail 		= "";
$elp_role_options 		= "";
$elp_role_setting 		= "";

$form = array(
	'elp_role_subscriber' 	=> '',
	'elp_role_templates' 	=> '',
	'elp_role_mailconfig' 	=> '',
	'elp_role_postnotify' 	=> '',
	'elp_role_compose' 		=> '',
	'elp_role_sendemail'	=> '',
	'elp_role_sentmail' 	=> '',
	'elp_role_options'		=> '',
	'elp_role_setting'		=> ''
);

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_rolelp_add');
	$form['elp_role_subscriber'] 	= isset($_POST['elp_role_subscriber']) ? $_POST['elp_role_subscriber'] : '';
	$form['elp_role_templates'] 	= isset($_POST['elp_role_templates']) ? $_POST['elp_role_templates'] : '';
	$form['elp_role_mailconfig'] 	= isset($_POST['elp_role_mailconfig']) ? $_POST['elp_role_mailconfig'] : '';
	$form['elp_role_postnotify'] 	= isset($_POST['elp_role_postnotify']) ? $_POST['elp_role_postnotify'] : '';
	$form['elp_role_compose'] 		= isset($_POST['elp_role_compose']) ? $_POST['elp_role_compose'] : '';
	$form['elp_role_sendemail'] 	= isset($_POST['elp_role_sendemail']) ? $_POST['elp_role_sendemail'] : '';
	$form['elp_role_sentmail'] 		= isset($_POST['elp_role_sentmail']) ? $_POST['elp_role_sentmail'] : '';
	$form['elp_role_options'] 		= isset($_POST['elp_role_options']) ? $_POST['elp_role_options'] : '';
	$form['elp_role_setting'] 		= isset($_POST['elp_role_setting']) ? $_POST['elp_role_setting'] : '';
		
	if ($elp_error_found == FALSE) {
		update_option('elp_c_rolesandcapabilities', $form );		
		$form = array(
			'elp_role_subscriber' 	=> '',
			'elp_role_templates' 	=> '',
			'elp_role_mailconfig' 	=> '',
			'elp_role_postnotify' 	=> '',
			'elp_role_compose' 		=> '',
			'elp_role_sendemail'	=> '',
			'elp_role_sentmail' 	=> '',
			'elp_role_options'		=> '',
			'elp_role_setting'		=> ''
		);
		$elp_success = __('Roles was successfully updated.', 'email-posts-to-subscribers');
	}
}

$elp_roles = get_option('elp_c_rolesandcapabilities', 'norecord');
if($elp_roles <> 'norecord' && $elp_roles <> "") {
	$elp_role_subscriber 	= isset( $elp_roles['elp_role_subscriber'] ) ? $elp_roles['elp_role_subscriber'] : 'manage_options';
	$elp_role_templates 	= isset( $elp_roles['elp_role_templates'] ) ? $elp_roles['elp_role_templates'] : 'manage_options';
	$elp_role_mailconfig 	= isset( $elp_roles['elp_role_mailconfig'] ) ? $elp_roles['elp_role_mailconfig'] : 'manage_options';
	$elp_role_postnotify 	= isset( $elp_roles['elp_role_postnotify'] ) ? $elp_roles['elp_role_postnotify'] : 'manage_options';
	$elp_role_compose 		= isset( $elp_roles['elp_role_compose'] ) ? $elp_roles['elp_role_compose'] : 'manage_options';
	$elp_role_sendemail 	= isset( $elp_roles['elp_role_sendemail'] ) ? $elp_roles['elp_role_sendemail'] : 'manage_options';
	$elp_role_sentmail 		= isset( $elp_roles['elp_role_sentmail'] ) ? $elp_roles['elp_role_sentmail'] : 'manage_options';
	$elp_role_options 		= isset( $elp_roles['elp_role_options'] ) ? $elp_roles['elp_role_options'] : 'manage_options';
	$elp_role_setting 		= isset( $elp_roles['elp_role_setting'] ) ? $elp_roles['elp_role_setting'] : 'manage_options';
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
	<form name="form_roles" method="post" action="#">
      	<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Subscribers Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Subscribers Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_subscriber" id="elp_role_subscriber">
						<option value='manage_options' <?php if($elp_role_subscriber == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_subscriber == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_subscriber == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Templates Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Templates Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_templates" id="elp_role_templates">
						<option value='manage_options' <?php if($elp_role_templates == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_templates == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_templates == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					 </select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Mail Configuration Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Mail Configuration Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_mailconfig" id="elp_role_mailconfig">
						<option value='manage_options' <?php if($elp_role_mailconfig == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_mailconfig == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_mailconfig == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					 </select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Post Notification Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Post Notification Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_postnotify" id="elp_role_postnotify">
						<option value='manage_options' <?php if($elp_role_postnotify == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_postnotify == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_postnotify == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Compose Newsletter Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Compose Newsletter Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_compose" id="elp_role_compose">
						<option value='manage_options' <?php if($elp_role_compose == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_compose == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_compose == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Send Email Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Send Email Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_sendemail" id="elp_role_sendemail">
						<option value='manage_options' <?php if($elp_role_sendemail == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_sendemail == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_sendemail == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Sent Mail Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Sent Mail Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_sentmail" id="elp_role_sentmail">
						<option value='manage_options' <?php if($elp_role_sentmail == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_sentmail == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_sentmail == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Option Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Option Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_options" id="elp_role_options">
						<option value='manage_options' <?php if($elp_role_options == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row"> 
						<label>
							<strong><?php _e('Settings Menu', 'email-posts-to-subscribers'); ?></strong>
							<p class="description"><?php _e('Select user role to access plugin Settings Menu. Only Admin user can change this value.', 'email-posts-to-subscribers'); ?></p>
						</label>
					</th>
					<td>
					<select name="elp_role_setting" id="elp_role_setting">
						<option value='manage_options' <?php if($elp_role_setting == 'manage_options') { echo "selected='selected'" ; } ?>>Administrator Only</option>
						<option value='edit_others_pages' <?php if($elp_role_setting == 'edit_others_pages') { echo "selected='selected'" ; } ?>>Administrator/Editor</option>
						<option value='edit_posts' <?php if($elp_role_setting == 'edit_posts') { echo "selected='selected'" ; } ?>>Administrator/Editor/Author/Contributor</option>
					</select>
					</td>
				</tr>
			</tbody>
		</table>
      <input type="hidden" name="elp_form_submit" value="yes"/>
      <p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('roles')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	  <?php wp_nonce_field('elp_rolelp_add'); ?>
    </form>
</div>