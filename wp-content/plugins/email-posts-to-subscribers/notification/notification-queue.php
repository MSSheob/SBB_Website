<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();
if (isset($_POST['frm_elp_display']) && $_POST['frm_elp_display'] == 'yes')
{
	$guid = isset($_GET['guid']) ? sanitize_text_field($_GET['guid']) : '0';
	check_admin_referer('elp_form_show');
	$elp_success = '';
	
	if (isset($_POST['frm_elp_bulkaction']) && $_POST['frm_elp_bulkaction'] == 'delete') {
		$chk_delete = isset($_POST['chk_delete']) ? $_POST['chk_delete'] : '';
		if(!empty($chk_delete)) {			
			$count = count($chk_delete);
			for($i=0; $i<$count; $i++) {
				$del_id = $chk_delete[$i];
				elp_cls_dbquerysqueeze::elp_squeeze_del_notification($del_id);
			}
			$elp_success_msg = TRUE;
			$elp_success = __('Selected record was successfully deleted.', 'email-posts-to-subscribers');
		}
		else {
			?><div class="error fade"><p><strong><?php _e('Oops, No record was selected.', 'email-posts-to-subscribers'); ?></strong></p></div><?php
		}
	}
		
	if (isset($_GET['submitted']) && $_GET['submitted'] == 'del' && isset($_GET['guid']) && $_GET['guid'] != '') {
		elp_cls_dbquerysqueeze::elp_squeeze_del_notification($guid);
		$elp_success = __('Selected record was successfully deleted.', 'email-posts-to-subscribers');
	}
	
	if (isset($_GET['submitted']) && $_GET['submitted'] == 'rel' && isset($_GET['guid']) && $_GET['guid'] != '') {
		$post_id = isset($_GET['pid']) ? sanitize_text_field($_GET['pid']) : '';
		$elp_ip_guid = isset($_GET['guid']) ? sanitize_text_field($_GET['guid']) : '';
		
		if($post_id <> '' && $elp_ip_guid <> '') {
			elp_cls_dbquerynote::elp_send_notification_final($post_id, $elp_ip_guid);
		}
		$elp_success = __('Selected record was successfully released.', 'email-posts-to-subscribers');
	}
	
	if($elp_success <> '') {
		?><div class="updated fade"><p><strong><?php echo $elp_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
    <h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<h3><?php _e('Notification Queue', 'email-posts-to-subscribers'); ?></h3>
    <div class="tool-box">
	<?php
	$myData = array();
	$myData = elp_cls_dbquerysqueeze::elp_squeeze_selall_notification();
	?>
	<form name="frm_elp_display" method="post" onsubmit="return _elp_bulkaction()">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
		  	<th class="check-column" scope="col" style="padding: 8px 2px;">
			<input type="checkbox" name="elp_checkall" id="elp_checkall" onClick="_elp_checkall('frm_elp_display', 'chk_delete[]', this.checked);" /></th>
            <th scope="col"><?php _e('Sno', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Post Title', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Notification Triggered', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Notification Status', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
		  	<th class="check-column" scope="col" style="padding: 8px 2px;">
			<input type="checkbox" name="elp_checkall" id="elp_checkall" onClick="_elp_checkall('frm_elp_display', 'chk_delete[]', this.checked);" /></th>
            <th scope="col"><?php _e('Sno', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Post Title', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Notification Triggered', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Notification Status', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0)
			{
				$i = 1;
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input name="chk_delete[]" id="chk_delete[]" type="checkbox" value="<?php echo $data['elp_ip_guid'] ?>" /></td>
						<td align="left"><?php echo $i; ?></td>
					  	<td><?php echo get_the_title( $data['elp_squeeze_value'] ); ?></td>
						<td>
						<?php 
						$date_format = get_option( 'date_format' );
						$time_format = get_option( 'time_format' );
						echo date($date_format . ' ' . $time_format, strtotime($data['elp_ip_created'])); 
						?>
						</td>
						<td><?php echo elp_cls_common::elp_disp_status($data['elp_squeeze_status']); ?></td>
						<td>
						<a title="Delete" onClick="javascript:_elp_delete_queue('<?php echo $data['elp_ip_guid']; ?>')" href="javascript:void(0);">
							<img alt="Delete" src="<?php echo ELP_URL; ?>images/delete.gif" />
						</a>
						<a title="Release queue" onClick="javascript:_elp_release_queue('<?php echo $data['elp_squeeze_value']; ?>', '<?php echo $data['elp_ip_guid']; ?>')" href="javascript:void(0);">
							<img alt="Release queue" src="<?php echo ELP_URL; ?>images/mail.png" />
						</a>
						</td>
					</tr>
					<?php
					$i = $i+1;
				}
			}
			else
			{
				?><tr><td colspan="9" align="center"><?php _e('No records available.', 'email-posts-to-subscribers'); ?></td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('elp_form_show'); ?>
		<input type="hidden" name="frm_elp_bulkaction" id="frm_elp_bulkaction" value=""/>
		<input type="hidden" name="frm_elp_display" value="yes"/>
		<div style="padding-top:10px;"></div>
		<div class="tablenav">
			<div class="alignleft">
				<input type="submit" value="<?php _e('Delete', 'email-posts-to-subscribers'); ?>" class="button action" id="doaction" name="doaction">
				<a href="<?php echo ELP_ADMINURL; ?>?page=elp-postnotification"><input class="button button-primary" type="button" value="<?php _e('Back', 'email-posts-to-subscribers'); ?>" /></a>
				<a target="_blank" href="<?php echo ELP_FAV; ?>"><input class="button button-primary" type="button" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" /></a> 
			</div>
		</div>
      </form>
	</div>
</div>