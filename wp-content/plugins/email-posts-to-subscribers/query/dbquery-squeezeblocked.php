<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
class elp_cls_dbquerysqueeze
{
	public static function elp_squeeze_check() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$subscriber_ip = elp_cls_common::elp_get_subscriber_ip();
		
		if ( ! empty( $subscriber_ip ) ) {
			$sSql = "SELECT count(*) as count from " . $prefix . "elp_squeezeips";
			$sSql = $sSql . " WHERE elp_ip_value = %s AND ( `elp_ip_created` >= NOW() - INTERVAL 15 SECOND ) AND elp_squeeze_type <> 'Notification'";
			$sSql = $wpdb->prepare($sSql, $subscriber_ip);
			$cnt_last30 = $wpdb->get_var($sSql);
			
			//One entry allowed in 15 second, 2nd entry error.
			if ( $cnt_last30 > 0 ) { 
				return 'squeeze';
			}
			
			$sSql = "SELECT count(*) as count from " . $prefix . "elp_squeezeips";
			$sSql = $sSql . " WHERE elp_ip_value = %s AND ( `elp_ip_created` >= NOW() - INTERVAL 300 SECOND ) AND elp_squeeze_type <> 'Notification'";
			$sSql = $wpdb->prepare($sSql, $subscriber_ip);
			$cnt_last300 = $wpdb->get_var($sSql);
			
			//15 entry allowed in 5 mins, 16th entry error.
			if ( $cnt_last300 > 16 ) {
				elp_cls_dbqueryblocked::elp_blocked_ins('IP', $subscriber_ip);
				return 'blocked';
			}
			
			return 'sus';
		}
		return 'err';
	}
	
	public static function elp_squeeze_del() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = "DELETE FROM " . $prefix . "elp_squeezeips WHERE (`elp_ip_created` < NOW() - INTERVAL 600 SECOND ) AND elp_squeeze_type <> 'Notification'";
		$wpdb->query($sSql);
		return true;
	}
	
	public static function elp_squeeze_ins() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$guid = elp_cls_common::elp_generate_guid(60);
		$subscriber_ip = elp_cls_common::elp_get_subscriber_ip();
		if ( ! empty( $subscriber_ip ) ) {
			$sSql = "INSERT INTO " . $prefix . "elp_squeezeips (`elp_ip_guid`, `elp_ip_value`, `elp_squeeze_type`) VALUES (%s, %s, %s)";
			$sSql = $wpdb->prepare($sSql, $guid, $subscriber_ip, 'IP');
			$wpdb->query($sSql);
		}
		return true;
	}
	
	public static function elp_squeeze_ins_notification($post_id = 0) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$guid = elp_cls_common::elp_generate_guid(60);
		
		if( !is_numeric($post_id) || $post_id == '0' ) { 
			return true;
		}
		
		if ( $post_id > 0 ) {
			$sSql = "SELECT COUNT(*) FROM " . $prefix . "elp_squeezeips where elp_squeeze_value = %s and elp_squeeze_type = 'Notification' and elp_squeeze_status = 'In-Queue'";
			$sSql = $wpdb->prepare($sSql, $post_id);
			$result = $wpdb->get_var($sSql);
			if ( $result > 0) {
				return true;
			}
			$sSql = "INSERT INTO " . $prefix . "elp_squeezeips (`elp_ip_guid`, `elp_ip_value`, `elp_squeeze_type`, `elp_squeeze_value`, `elp_squeeze_status`)";
			$sSql .= " VALUES (%s, %s, %s, %s, %s)";
			$sSql = $wpdb->prepare($sSql, $guid, '0', 'Notification', $post_id, 'In-Queue');
			$wpdb->query($sSql);
		}
		return true;
	}
	
	public static function elp_squeeze_ups_notification($guid = '') {
		global $wpdb;
		$prefix = $wpdb->prefix;
		if ( $guid <> '' ) {
			$currentdate = date('Y-m-d G:i:s');
			$sSql = "UPDATE " . $prefix . "elp_squeezeips SET elp_squeeze_status = %s, elp_ip_created = CURRENT_TIMESTAMP WHERE elp_ip_guid = %s";
			$sSql = $wpdb->prepare($sSql, 'Completed', $guid);
			$wpdb->query($sSql);
		}
		return true;
	}
	
	public static function elp_squeeze_del_notification($guid = '') {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = "DELETE FROM " . $prefix . "elp_squeezeips WHERE elp_squeeze_type = 'Notification'";
		if ( $guid <> '' ) {
			$sSql .= " AND elp_ip_guid = %s";
			$sSql = $wpdb->prepare($sSql, $guid);
		}
		else {
			$sSql .= " AND elp_squeeze_status = 'Completed' AND ( elp_ip_created < NOW() - INTERVAL 1 DAY );";
		}
		$wpdb->query($sSql);
		
		$sSql = "DELETE FROM " . $prefix . "elp_squeezeips WHERE ( elp_ip_created < NOW() - INTERVAL 5 DAY )";
		$wpdb->query($sSql);
		
		return true;
	}
	
	public static function elp_squeeze_sel_notification() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$arrRes = array();
		$sSql = "SELECT * FROM " . $prefix. "elp_squeezeips where elp_squeeze_type = 'Notification' AND elp_squeeze_status = 'In-Queue' LIMIT 1";
		$arrRes = $wpdb->get_results($sSql, ARRAY_A);
		return $arrRes;
	}
	
	public static function elp_squeeze_selall_notification() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$arrRes = array();
		$sSql = "SELECT * FROM " . $prefix. "elp_squeezeips where elp_squeeze_type = 'Notification'";
		$arrRes = $wpdb->get_results($sSql, ARRAY_A);
		return $arrRes;
	}
}

class elp_cls_dbqueryblocked
{
	public static function elp_blocked_ins($type = '', $value = '') {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$guid = elp_cls_common::elp_generate_guid(60);
		if($value <> '') {
			$value = strtoupper($value);
		}		
		$sSql = "INSERT INTO " . $prefix . "elp_blockedemails (`elp_blocked_guid`, `elp_blocked_type`, `elp_blocked_value`) VALUES (%s, %s, %s)";
		$sSql = $wpdb->prepare($sSql, $guid, trim($type), trim($value));
		$wpdb->query($sSql);
		return true;
	}
	
	public static function elp_blocked_del($id = '') {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("DELETE FROM ".$prefix."elp_blockedemails WHERE elp_blocked_id = %d LIMIT 1", $id);
		$wpdb->query($sSql);
		return true;
	}
	
	public static function elp_blocked_count($id = 0) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$result = '0';
		if($id > 0) {
			$sSql = $wpdb->prepare("SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE elp_blocked_id = %d", array($id));
		}
		else {
			$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails";
		}
		$result = $wpdb->get_var($sSql);
		return $result;
	}
	
	public static function elp_blocked_select($id = 0, $offset = 0, $limit = 0) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$arrRes = array();
		$sSql = "SELECT * FROM " . $prefix . "elp_blockedemails where 1=1";
		if($id > 0) {
			$sSql = $sSql . " and elp_blocked_id = ".$id;
			$arrRes = $wpdb->get_row($sSql, ARRAY_A);
		}
		else {
			$sSql = $sSql . " order by elp_blocked_created desc limit $offset, $limit";
			$arrRes = $wpdb->get_results($sSql, ARRAY_A);
		}
		return $arrRes;
	}
	
	public static function elp_blocked($value = '') {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$result = 0;
		
		// security - reject entry if it contain double ==.
		if(strpos($value, '==') !== false) {
    		return true; 
		}
		
		// Block by ALL
		$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE";
		$sSql = $sSql . " elp_blocked_value = %s";
		$sSql = $wpdb->prepare($sSql, trim($value));
		$result = $wpdb->get_var($sSql);
		if($result > 0) {
			return true;
		}
		
		// Block by IP
		$subscriber_ip = elp_cls_common::elp_get_subscriber_ip();
		$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE";
		$sSql = $sSql . " elp_blocked_type = 'IP' and elp_blocked_value = %s";
		$sSql = $wpdb->prepare($sSql, trim($subscriber_ip));
		$result = $wpdb->get_var($sSql);
		if($result > 0) {
			return true;
		}
		
		// Block by Email
		if($value <> '') {
			$value = strtoupper($value);
		}
		$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE";
		$sSql = $sSql . " elp_blocked_type = 'Email' and elp_blocked_value = %s";
		$sSql = $wpdb->prepare($sSql, trim($value));
		$result = $wpdb->get_var($sSql);
		if($result > 0) {
			return true;
		}
		
		// Block by Domain
		$domain = '';
		if($value <> '') {
			if ( filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
				$domain = substr(strrchr($value, "@"), 1);
			}
			$domain = '@'.strtoupper($domain);
		}
		$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE";
		$sSql = $sSql . " elp_blocked_type = 'Domain' and elp_blocked_value = %s";
		$sSql = $wpdb->prepare($sSql, trim($domain));
		$result = $wpdb->get_var($sSql);
		if($result > 0) {
			return true;
		}
		
		//Block by LIKE
		//$sSql = "SELECT COUNT(*) AS count FROM " . $prefix . "elp_blockedemails WHERE";
		//$sSql = $sSql . " elp_blocked_value like %s ";
		//$sSql = $wpdb->prepare($sSql, '%' . trim($value) . '%' );
		//$result = $wpdb->get_var($sSql);
		//echo $sSql;
		//echo '<br>';
		//echo $result;
		//if($result > 0) {
		//	return true;
		//}
		
		return false;
	}
	
	public static function elp_security_block($name = '', $email = '') {
				
		if($name == '') {
			return false;
		}
		
		// security - reject entry if it contain 5 digit number.
		if(preg_match('/\d{4}/', $name)) {
			return true; 
		}
		
		// security - reject entry if it contain double ==.
		if(strpos($name, '==') !== false) {
    		return true; 
		}
		
		// security - reject entry if it contain bad word
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = "SELECT * FROM " . $prefix . "elp_blockedemails WHERE ";
		$sSql = $sSql . " elp_blocked_type = 'BadWord'";
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		if(count($myData) > 0) {
			foreach ($myData as $data) {
				if($data['elp_blocked_value'] <> '') {
					if(strpos(strtoupper($name), strtoupper($data['elp_blocked_value'])) !== false) {
						return true; 
					}
				}
			}
		}

		return false; 
	}
}
?>