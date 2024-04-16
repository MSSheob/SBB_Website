<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
class elp_cls_pluginconfig {
	public static function elp_setting_select($id = 1) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$arrRes = array();
		$sSql = "SELECT * FROM `".$prefix."elp_pluginconfig` where 1=1";
		$sSql = $sSql . " and elp_c_id=".$id;
		$arrRes = $wpdb->get_row($sSql, ARRAY_A);
		return $arrRes;
	}
	
	public static function elp_setting_count($id = "") {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$result = '0';
		if($id > 0) {
			$sSql = $wpdb->prepare("SELECT COUNT(*) AS `count` FROM `".$prefix."elp_pluginconfig` WHERE `elp_c_id` = %s", array($id));
		}
		else {
			$sSql = "SELECT COUNT(*) AS `count` FROM `".$prefix."elp_pluginconfig`";
		}
		$result = $wpdb->get_var($sSql);
		return $result;
	}
	
	public static function elp_setting_update($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE `".$prefix."elp_pluginconfig` SET 
								`elp_c_fromname` = %s, `elp_c_fromemail` = %s, `elp_c_mailtype` = %s,
								`elp_c_adminmailoption` = %s, `elp_c_adminemail` = %s, `elp_c_adminmailsubject` = %s,
								`elp_c_adminmailcontant` = %s, `elp_c_usermailoption` = %s, `elp_c_usermailsubject` = %s,
								`elp_c_usermailcontant` = %s, `elp_c_optinoption` = %s, `elp_c_optinsubject` = %s, `elp_c_optincontent` = %s,
								`elp_c_optinlink` = %s, `elp_c_unsublink` = %s, `elp_c_unsubtext` = %s, `elp_c_unsubhtml` = %s,
								`elp_c_subhtml` = %s, `elp_c_message1` = %s, `elp_c_message2` = %s
								WHERE elp_c_id = %d	LIMIT 1", 
								array($data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8],$data[9], $data[10], 
										$data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19], $data[20], $data[0]));
		//echo $sSql;
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_generalgettings($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
		elp_c_fromname = %s, elp_c_fromemail = %s, elp_c_mailtype = %s, elp_c_optinoption = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_fromname"], $data["elp_c_fromemail"], $data["elp_c_mailtype"], $data["elp_c_optinoption"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_confirmationmail($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
		elp_c_optinsubject = %s, elp_c_optincontent = %s, elp_c_optinlink = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_optinsubject"], $data["elp_c_optincontent"], $data["elp_c_optinlink"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_welcomemail($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
		elp_c_usermailoption = %s, elp_c_usermailsubject = %s, elp_c_usermailcontant = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_usermailoption"], $data["elp_c_usermailsubject"], $data["elp_c_usermailcontant"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_adminmail($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
		elp_c_adminmailoption = %s, elp_c_adminemail = %s, elp_c_adminmailsubject = %s, elp_c_adminmailcontant = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_adminmailoption"], $data["elp_c_adminemail"], $data["elp_c_adminmailsubject"], $data["elp_c_adminmailcontant"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_reportmail($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
		elp_c_rptsubject = %s, elp_c_rptcontent = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_rptsubject"], $data["elp_c_rptcontent"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
	public static function elp_setting_update_message($data = array()) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sSql = $wpdb->prepare("UPDATE ".$prefix."elp_pluginconfig SET 
			  elp_c_unsubtext = %s, elp_c_unsubhtml = %s, elp_c_subhtml = %s, elp_c_message1 = %s, 
			elp_c_message2 = %s, elp_c_message3 = %s, elp_c_message6 = %s, elp_c_message7 = %s, 
			elp_c_message8 = %s, elp_c_message9 = %s WHERE elp_c_id = %d LIMIT 1", 
		array($data["elp_c_unsubtext"], $data["elp_c_unsubhtml"], $data["elp_c_subhtml"], $data["elp_c_message1"], 
			$data["elp_c_message2"], $data["elp_c_message3"], $data["elp_c_message6"], $data["elp_c_message7"], 
			$data["elp_c_message8"], $data["elp_c_message9"], $data["elp_c_id"]));
		$wpdb->query($sSql);
		return "sus";
	}
	
}
?>