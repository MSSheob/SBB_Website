<?php
class elp_cls_optimize
{
	public static function elp_optimize_setdetails() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$total = elp_cls_dbquery2::elp_sentmail_count($id = 0);
		if ($total > 20) {
			$delete = $total - 20;
			$sSql = "DELETE FROM `".$prefix."elp_sentdetails` ORDER BY elp_sent_id ASC LIMIT ".$delete;
			$wpdb->query($sSql);
		}
		
		$sSql = "DELETE FROM `".$prefix."elp_deliverreport` WHERE elp_deliver_sentguid NOT IN";
		$sSql = $sSql . " (SELECT elp_sent_guid FROM `".$prefix."elp_sentdetails`)";
		$wpdb->query($sSql);
		return true;
	}
	
	public static function elp_housekeep_deliverreport() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$sSql = "SELECT COUNT(*) FROM " . $prefix . "elp_deliverreport where ( elp_deliver_sentdate < NOW() - INTERVAL 31 DAY )";
		$result = $wpdb->get_var($sSql);
		if ( $result > 0) {
			$sSql = "DELETE FROM " . $prefix . "elp_deliverreport WHERE ( elp_deliver_sentdate < NOW() - INTERVAL 31 DAY )";
			$wpdb->query($sSql);
		}

		return true;
	}
	
	public static function elp_housekeep_sentdetails() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$sSql = "SELECT COUNT(*) FROM " . $prefix . "elp_sentdetails WHERE elp_sent_status = 'No Post' AND ( elp_sent_starttime < NOW() - INTERVAL 3 DAY )";
		$result = $wpdb->get_var($sSql);
		if ( $result > 0) {
			$sSql = "DELETE FROM " . $prefix . "elp_sentdetails WHERE  elp_sent_status = 'No Post' AND ( elp_sent_starttime < NOW() - INTERVAL 3 DAY )";
			$wpdb->query($sSql);
		}
		
		$sSql = "SELECT COUNT(*) FROM " . $prefix . "elp_sentdetails WHERE ( elp_sent_starttime < NOW() - INTERVAL 31 DAY )";
		$result = $wpdb->get_var($sSql);
		if ( $result > 0) {
			$sSql = "DELETE FROM " . $prefix . "elp_sentdetails WHERE  ( elp_sent_starttime < NOW() - INTERVAL 31 DAY )";
			$wpdb->query($sSql);
		}
		
		return true;
	}
}
?>