<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
elp_cls_common::elp_check_latest_update();

$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
$elp_success_msg = FALSE;

if (isset($_POST['frm_elp_display']) && $_POST['frm_elp_display'] == 'yes') {
	$did = isset($_GET['did']) ? sanitize_text_field($_GET['did']) : '0';
	if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }
	
	$result = elp_cls_dbqueryblocked::elp_blocked_count($did);
	if ($result != '1') {
		?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'email-posts-to-subscribers'); ?></strong></p></div><?php
	}
	else {
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '') {
			check_admin_referer('elp_form_show');
			elp_cls_dbqueryblocked::elp_blocked_del($did);
			$elp_success_msg = TRUE;
			$elp_success = __('Selected record was successfully deleted.', 'email-posts-to-subscribers');
		}
	}
}

if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes') {
	check_admin_referer('elp_form_add');
	$form['elp_blocked_type'] 	= isset($_POST['elp_blocked_type']) ? sanitize_text_field($_POST['elp_blocked_type']) : '';
	$form['elp_blocked_value'] 	= isset($_POST['elp_blocked_value']) ? sanitize_text_field($_POST['elp_blocked_value']) : '';
	if ($form['elp_blocked_value'] == '') {
		$elp_errors[] = __('Please enter valid input.', 'email-posts-to-subscribers');
		$elp_error_found = TRUE;
	}
	
	if ($elp_error_found == FALSE) {
		elp_cls_dbqueryblocked::elp_blocked_ins($form['elp_blocked_type'], $form['elp_blocked_value']);
		$elp_success = __('Detail was successfully inserted.', 'email-posts-to-subscribers');
	}
}

if ($elp_error_found == TRUE && isset($elp_errors[0]) == TRUE) {
	?><div class="error fade"><p><strong><?php echo $elp_errors[0]; ?></strong></p></div><?php
}
if ($elp_error_found == FALSE && isset($elp_success[0]) == TRUE) {
	?><div class="updated fade"><p><strong><?php echo $elp_success; ?></strong></p></div><?php
}
?>
<style>
.form-table th {
    width: 300px;
}
</style>
<div class="form-wrap">
	<form name="elp_form" method="post" action="#">
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="elp"><strong><?php _e('Blocked Details', 'email-posts-to-subscribers'); ?></strong>
					<p class="description"><?php _e('Seeing spam from particular domains? Enter domains/email/ip names that you want to block here.', 'email-posts-to-subscribers'); ?></p></label>
				</th>
				<td>
					<select name="elp_blocked_type" id="elp_blocked_type">
						<option value='Domain'>Block Domain</option>
						<option value='IP'>Block IP</option>
						<option value='Email'>Block Email</option>
						<option value='BadWord'>Block - Bad Word</option>
						<option value='Others'>Others</option>
					</select>
					<input name="elp_blocked_value" type="text" id="elp_blocked_value" value="" size="45" maxlength="150" />
					<p class="description">Sample input : @example.com (or) 11.101.101.121 (or) test@test.com <br /> Bad Word : Submission rejected if name contain this word.</p>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="elp_form_submit" value="yes"/>
	<p class="submit">
		<input name="submit" id="submit" class="button button-primary" value="<?php _e('Save', 'email-posts-to-subscribers'); ?>" type="submit" />
		<input name="cancel" id="cancel" class="button button-primary" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_cancel('security')" />
		<input name="help" id="help" class="button button-primary" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" onclick="_elp_help()" />
	</p>
	<?php wp_nonce_field('elp_form_add'); ?>
    </form>
</div>
<div class="wrap">
	<?php echo 'Your IP : ' . elp_cls_common::elp_get_subscriber_ip(); ?>
    <div class="tool-box">
	<?php
	$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
	$limit = 30;
	$offset = ($pagenum - 1) * $limit;
	$total = elp_cls_dbqueryblocked::elp_blocked_count(0);
	$fulltotal = $total;
	$total = ceil( $total / $limit );

	$myData = array();
	$myData = elp_cls_dbqueryblocked::elp_blocked_select(0, $offset, $limit);
	?>
	<form name="frm_elp_display" method="post" onsubmit="">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
		  	<th scope="col"><?php _e('No', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Blocked Type', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Blocked Value', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Delete Days', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Created', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
			<th scope="col"><?php _e('No', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Blocked Type', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Blocked Value', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Delete Days', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Created', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0) {
				$i = 1;
				foreach ($myData as $data) {
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td><?php echo $i; ?></td>
						<td><?php echo $data['elp_blocked_type']; ?></td>
						<td><?php echo $data['elp_blocked_value']; ?></td>
						<td>NA</td>
						<td>
						<?php 
						$date_format = get_option( 'date_format' );
						$time_format = get_option( 'time_format' );
						echo date($date_format . ' ' . $time_format, strtotime($data['elp_blocked_created']));  
						?>
						</td>
						<td>
						<a title="Delete" onClick="javascript:_elp_security_delete('<?php echo $data['elp_blocked_id']; ?>')" href="javascript:void(0);">
							<img alt="Delete" src="<?php echo ELP_URL; ?>images/delete.gif" />
						</a>
						</td>
					</tr>
					<?php
					$i = $i+1;
				}
			}
			else {
				?><tr><td colspan="6" align="center"><?php _e('No records available.', 'email-posts-to-subscribers'); ?></td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('elp_form_show'); ?>
		<input type="hidden" name="frm_elp_display" value="yes"/>
		<div style="padding-top:10px;"></div>
		<?php
		$page_links = paginate_links( array(
			'base' => add_query_arg( 'pagenum', '%#%' ),
			'format' => '',
			'prev_text' => __( ' &lt;&lt; ' ),
			'next_text' => __( ' &gt;&gt; ' ),
			'total' => $total,
			'show_all' => False,
			'current' => $pagenum
		) );
		?>
		<style>
		.page-numbers {
			background: none repeat scroll 0 0 rgba(0, 0, 0, 0.05);
    		border-color: #CCCCCC;
			color: #555555;
    		padding: 5px;
			text-decoration:none;
			margin-left:2px;
			margin-right:2px;
		}
		.current {
			background: none repeat scroll 0 0 #BBBBBB;
		}
		</style>
		<div class="tablenav">
			<div class="alignleft"></div>
			<div class="alignright"><?php echo $page_links; ?></div>
		</div>
      </form>
	</div>
</div>