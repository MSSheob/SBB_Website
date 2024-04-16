<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
class elp_cls_dbinsert
{
	public static function elp_template_default()
	{
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$result = elp_cls_dbquery::elp_template_count(0);
		if ($result == 0)
		{
			$blogname = get_option('blogname');
			
			$elp_templ_heading 	= 'Template 1 (Template with banner)';
			$elp_templ_header 	= '<img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/header.jpg" width="699" height="113" alt="" />';
			$elp_templ_body 	= '<div style="width:690px;margin-bottom:15px;font-family: Verdana;font-size: 13px"><h3>###POSTTITLE###</h3><span style="float:left;margin-right: 15px">###POSTIMAGE###</span>###POSTDESC###</div>';
			$elp_templ_footer 	= '<div style="padding:5px;font-family: Verdana;font-size: 11px;color: #FFFFFF;background-color:#669999;text-align:center;width:690px;border-radius: 8px;margin-top:20px;">Copyright 2013 - 2019 www.yourwebsite.com. All Rights Reserved.</div>';
				
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading 	= 'Template 2 (Classic template 1)';
			$elp_templ_header 	= '<div style="background-color:#E6E6E6;padding:20px;width:700px;text-align:center"><div style="text-align:left;text-align:center;font-size:24px;color:#000000;font-weight:bold;background-color:#ffe900;padding:35px 0px 35px 0px">' . strtoupper($blogname) . '</div><div style="text-align:left;text-align:center;font-size:15px;color:#ffffff;font-weight:bold;background-color:#1f201e;padding:10px 0px 10px 0px">This is demo for email posts to subscribers plugin</div>';
			$elp_templ_body 	= '<div style="clear:both;background-color:#FFFFFF;padding:10px;text-align:left;clear:both"><div style="clear:both;background-color:#FFFFFF;font-family:Verdana;font-size:15px;font-weight:bold;color:#222222;padding-bottom:10px"><a style="text-decoration: none;color:#000000" href="###POSTLINKONLY###">###POSTTITLEONLY###</a></div><br><span style="float:left;margin-right: 15px">###POSTIMAGE###</span> ###POSTDESC###<div style="clear: both"></div></div>';
			$elp_templ_footer 	= '<div style="padding:10px;border-top: 10px solid #1f201e;background-color:#d6d2d1"></div><div style="padding:10px;background-color:#FFFFFF">This email was intended for ###NAME### (###EMAIL###) <br>&copy; 2009 - 2019, www.gopiplus.com 2029 ABCD St. Mountain View, CA 111111, USA </div></div>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading = "Template 3 (Classic template 2)";
			$elp_templ_header = '<div style="background-color:#E6E6E6;padding:20px;width:700px;text-align:center;"><div style="padding-bottom:5px;text-align:left;border-bottom: 10px solid #222222;"><img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/gopiplus.png"></div>';
			$elp_templ_body = '<div style="background-color:#FFFFFF;padding:10px;text-align:left;"><div style="font-family:Verdana;font-size:15px;font-weight:bold;color:#222222;">###POSTTITLE###</div><br>###POSTDESC###</div>';
			$elp_templ_footer = '<div style="padding:10px;">This email was intended for ###NAME### (###EMAIL###) <br> &copy; 2009 - 2019, www.gopiplus.com 2029 ABCD St. Mountain View, CA 111111, USA </div></div>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading = "Template 4 (Classic template 3)";
			$elp_templ_header = '<div style="background-color:#E6E6E6;padding:20px;width:700px;text-align:center;"><div style="padding-bottom:5px;text-align:left;border-bottom: 10px solid #222222;"><img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/gopiplus.png"></div>';
			$elp_templ_body = '<div style="background-color:#FFFFFF;padding:10px;text-align:left;"><div style="font-family:Verdana;font-size:15px;font-weight:bold;color:#222222;">###POSTTITLE###</div><br>###POSTFULL###</div>';
			$elp_templ_footer = '<div style="padding:10px;">This email was intended for ###NAME### (###EMAIL###) <br> &copy; 2009 - 2019, www.gopiplus.com 2029 ABCD St. Mountain View, CA 111111, USA </div></div>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
					
			$elp_templ_heading = "Template 5 (Classic template 4)";
			$elp_templ_header = '<table style="background-color:#e3e3e3;border-collapse:collapse;border-collapse:collapse" width="100%" cellspacing="0" cellpadding="0" border="0"> <tbody> <tr> <td style="height:25px"></td></tr><tr> <td><table style="border-collapse:collapse;border-collapse:collapse" width="640" cellspacing="0" cellpadding="0" border="0" align="center"> <tbody> <tr> <td colspan="3" height="5" style="height:5px!important;max-height:5px!important" width="100%" bgcolor="#ff9900" align="center"></td></tr><tr> <td colspan="3" height="15" style="height:15px!important;max-height:15px!important" width="100%" bgcolor="#FFFFFF"></td></tr><tr> <td align="left" width="50%" bgcolor="#FFFFFF"><img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/gopiplus.png"> </td><td align="center" width="25%" bgcolor="#FFFFFF"><a href="#" style="text-decoration: none">Todays Deals</a> </td><td align="center" width="25%" bgcolor="#FFFFFF"><a href="#" style="text-decoration: none">Get Android App</a> </td></tr><tr> <td colspan="3" height="15" style="height:15px!important;max-height:15px!important" width="100%" bgcolor="#FFFFFF"></td></tr></tbody> </table></td></tr><tr> <td style="background-color:#e3e3e3" height="1"></td></tr><tr> <td><table style="background-color:#FFFFFF;border-collapse:collapse;border-collapse:collapse" width="640" cellspacing="0" cellpadding="0" border="0" align="center"> <tbody> <tr> <td style="background-color:#FFFFFF">';
			$elp_templ_body = '<div style="clear:both;background-color:#FFFFFF;padding:10px;text-align:left;clear:both"><div style="clear:both;background-color:#FFFFFF;font-family:Verdana;font-size:15px;font-weight:bold;color:#222222;padding-bottom:10px"><a style="text-decoration: none" href="###POSTLINKONLY###">###POSTTITLEONLY###</a></div><br>###POSTDESC###<div style="clear: both"></div></div>';
			$elp_templ_footer = '</td></tr><tr> <td style="background-color:#FFFFFF" height="10"></td></tr></tbody> </table></td></tr><tr> <td><table style="border-collapse:collapse;border-collapse:collapse" width="640" cellspacing="0" cellpadding="10" border="0" align="center"> <tbody> <tr> <td align="center" width="100%" bgcolor="#FFFFFF"><a href="#"><img border="0" src="http://www.gopiplus.com/work/wp-content/themes/GTheme/images/ico-social-facebook.png"></a> <a href="#"><img border="0" src="http://www.gopiplus.com/work/wp-content/themes/GTheme/images/ico-social-twitter.png"></a> <a href="#"><img border="0" src="http://www.gopiplus.com/work/wp-content/themes/GTheme/images/ico-social-youtube.png"></a> </td></tr><tr> <td height="20" style="height:20px!important;max-height:5px!important" width="100%" bgcolor="#FFFFFF" align="center">This email was intended for ###NAME### (###EMAIL###) <br> &copy; 2009 - 2019, www.gopiplus.com 2029 ABCD St. Mountain View, CA 111111, USA </td></tr></tbody> </table></td></tr><tr> <td style="height:25px"></td></tr></tbody></table>';

			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading = "Template 6 (White background with logo)";
			$elp_templ_header = '<div style="border:1px #CCCCCC solid;background-color:#FFFFFF;padding:20px;"><img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/gopiplus.png"></div>';
			$elp_templ_body = '<div style="border-left: 1px solid #CCCCCC;border-right: 1px solid #CCCCCC;padding-left:10px;padding-bottom:10px"><br><div style="font-family:Verdana;font-size:15px;font-weight:bold;color:#CCCCCC;padding-top:10px;padding-bottom:10px">###POSTTITLE###</div><br>###POSTDESC###</div>';
			$elp_templ_footer = '<div style="border:1px #CCCCCC solid;background-color:#FFFFFF;padding:10px;"><font color="#222222">Copyright 2013 - 2019 www.gopiplus.com. All Rights Reserved.</font></div>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading = "Template 7 (Plan Mail)";
			$elp_templ_header = 'TEMPLATE HEADER <br /><br />Hi ###NAME###,';
			$elp_templ_body = '<br />###POSTTITLE### <br /> ###POSTDESC###<br />';
			$elp_templ_footer = '<br /><br />Copyright 2013 - 2019 www.gopiplus.com. All Rights Reserved.';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);

			$elp_templ_heading = "Template 8 (Simple FB color)";
			$elp_templ_header = '<table width="100%" border="0" bgcolor="#425499" cellspacing="0" cellpadding="16" style="border-bottom:1px #0c204e solid;background-color:#425499"><tbody><tr><td width="608" align="left"><font color="#FFFFFF" style="font-family:Verdana;font-size:19px;font-weight:bold">'.$blogname.'</font></td></tr></tbody></table>';
			$elp_templ_body = '<div style="padding-left:5px;padding-right:5px"><h3>###POSTTITLE###</h3>###POSTDESC###</div>';
			$elp_templ_footer = '<br /><div style="padding-left:5px;padding-right:5px">This email was intended for ###EMAIL###</div><br /><table width="100%" border="0" bgcolor="#425499" cellspacing="0" cellpadding="16" style="border-bottom:1px #0c204e solid;background-color:#425499"><tbody><tr><td align="left"><font color="#FFFFFF">Copyright 2013 - 2019 www.gopiplus.com. All Rights Reserved.</font></td></tr></tbody></table>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);
			
			$elp_templ_heading = "Template 9 (With bg fixed image)";
			$elp_templ_header = '<div style="background:url(http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/bg-3.jpg);width:960px"><div style="border:1px #222222 solid;padding:20px"><img src="http://www.gopiplus.com/work/wp-content/uploads/email-posts-to-subscribers/template/gopiplus.png"></div>';
			$elp_templ_body = '<div style="padding-top:10px;padding-bottom:10px;border-left: 1px solid #222222;border-right: 1px solid #222222;padding-left:10px;padding-bottom:10px;background-color:#FFFFFF"><br><div style="font-family:Verdana;font-size:15px;font-weight:bold;color:#222222">###POSTTITLE###</div><br>###POSTDESC###</div>';
			$elp_templ_footer = '<div style="border:1px #222222 solid;padding:10px;font-weight:bold;color:#FFFFFF;text-align:center">Copyright 2013 - 2019 www.gopiplus.com. All Rights Reserved.</div></div>';
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_templatetable` (`elp_templ_heading`,`elp_templ_header`, `elp_templ_body`, `elp_templ_footer`, `elp_templ_status`)
					VALUES(%s, %s, %s, %s, %s)", array($elp_templ_heading, $elp_templ_header, $elp_templ_body, $elp_templ_footer, 'Ready'));
			$wpdb->query($sSql);

		}
		return true;
	}
	
	public static function elp_pluginconfig_default()
	{
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$result = elp_cls_pluginconfig::elp_setting_count(0);
		if ($result == 0)
		{
			$admin_email = get_option('admin_email');
			$blogname = get_option('blogname');
			
			if($admin_email == "")
			{
				$admin_email = "admin@gmail.com";
			}
			
			$home_url = home_url('/');
			$optinlink = $home_url . "?elp=optin&db=###DBID###&email=###EMAIL###&guid=###GUID###";
			$unsublink = $home_url . "?elp=unsubscribe&db=###DBID###&email=###EMAIL###&guid=###GUID###"; 
			
			$elp_c_fromname = "Admin";
			$elp_c_fromemail = $admin_email; 
			$elp_c_mailtype = "WP HTML MAIL"; 
			$elp_c_adminmailoption = "YES"; 
			$elp_c_adminemail = $admin_email; 
			$elp_c_adminmailsubject = $blogname . " - New email subscription";
			$elp_c_adminmailcontant = "Hi Admin, \r\n\r\nWe have received a request to subscribe new email address to receive emails from our website. \r\n\r\nEmail: ###EMAIL### \r\nName : ###NAME### \r\n\r\nThank You\r\n".$blogname;
			$elp_c_usermailoption = "YES"; 
			$elp_c_usermailsubject = $blogname . " - Welcome to our newsletter";
			$elp_c_usermailcontant = "Hi ###NAME###, \r\n\r\nWe have received a request to subscribe this email address to receive newsletter from our website. \r\n\r\nThank You\r\n".$blogname; 
			$elp_c_optinoption = "Double Opt In"; 
			$elp_c_optinsubject = $blogname . " - Confirm subscription";
			$elp_c_optincontent = "Hi ###NAME###, \r\n\r\nA newsletter subscription request for this email address was received. Please confirm it by <a href='###LINK###'>clicking here</a>. If you cannot click the link, please use the following link. \r\n\r\n ###LINK### \r\n\r\nThank You\r\n".$blogname;
			$elp_c_optinlink = $optinlink; 
			$elp_c_unsublink = $unsublink;
			$elp_c_unsubtext = "No longer interested email from ".$blogname."?. Please <a href='###LINK###'>click here</a> to unsubscribe";
			$elp_c_unsubhtml = "Thank You, You have been successfully unsubscribed. You will no longer hear from us."; 
			$elp_c_subhtml = "Thank You, You have been successfully subscribed to our newsletter."; 
			$elp_c_message1 = "Oops.. This subscription cant be completed, sorry. The email address is blocked or already subscribed. Thank you."; 
			$elp_c_message2 = "Oops.. We are getting some technical error. Please try again or contact admin.";		
			$elp_c_message3 = "You have successfully subscribed. You will receive a confirmation email in few minutes. Please follow the link in it to confirm your subscription. If the email takes more than 15 minutes to appear in your mailbox, please check your spam folder.";
			$elp_c_rptsubject = "[Email Posts WP Plugin] Newsletter Report";
			
			$report = "";
			$report = $report. "Hi Admin,\n\n";
			$report = $report. "Newsletter has been sent successfully to ###COUNT### email(s).\n\n";
			$report = $report. "Subject : ###SUBJECT### \n";
			//$report = $report. "Unique ID : ###UNIQUE### \n";
			$report = $report. "Start : ###STARTTIME### \n";
			$report = $report. "End : ###ENDTIME### \n\n";
			$report = $report. "For more information, Login to your Dashboard and go to Sent Mail menu in Email Posts plugin. \n\n";
			$report = $report. "Thank You \n";
		
			$elp_c_rptcontent = $report;
			$elp_c_message6 = "Thank You, You have been successfully subscribed.";
			$elp_c_message7 = "NA";
			$elp_c_message8 = "NA";
			$elp_c_message9 = "NA";
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_pluginconfig` 
					(`elp_c_fromname`,`elp_c_fromemail`, `elp_c_mailtype`, `elp_c_adminmailoption`, `elp_c_adminemail`, `elp_c_adminmailsubject`,
					`elp_c_adminmailcontant`,`elp_c_usermailoption`, `elp_c_usermailsubject`, `elp_c_usermailcontant`, `elp_c_optinoption`, `elp_c_optinsubject`,
					`elp_c_optincontent`,`elp_c_optinlink`, `elp_c_unsublink`, `elp_c_unsubtext`, `elp_c_unsubhtml`, `elp_c_subhtml`, `elp_c_message1`, `elp_c_message2`, 
					`elp_c_message3`, `elp_c_rptsubject`, `elp_c_rptcontent`, `elp_c_message6`, `elp_c_message7`, `elp_c_message8`, `elp_c_message9`)
					VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
					array($elp_c_fromname,$elp_c_fromemail, $elp_c_mailtype, $elp_c_adminmailoption, $elp_c_adminemail, $elp_c_adminmailsubject,
					$elp_c_adminmailcontant,$elp_c_usermailoption, $elp_c_usermailsubject, $elp_c_usermailcontant, $elp_c_optinoption, $elp_c_optinsubject,
					$elp_c_optincontent,$elp_c_optinlink, $elp_c_unsublink, $elp_c_unsubtext, $elp_c_unsubhtml, $elp_c_subhtml, $elp_c_message1, $elp_c_message2, 
					$elp_c_message3, $elp_c_rptsubject, $elp_c_rptcontent, $elp_c_message6, $elp_c_message7, $elp_c_message8, $elp_c_message9));
			$wpdb->query($sSql);
		}
		return true;
	}
	
	public static function elp_sendsetting_default()
	{
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$result = elp_cls_dbquery::elp_configuration_count(0);
		if ($result == 0)
		{
			$elp_set_guid = elp_cls_common::elp_generate_guid(60);
			$elp_set_name = "Send Latest 5 Post with Template 1";
			$elp_set_templid = 2;
			$elp_set_totalsent = "200";
			$elp_set_unsubscribelink = "YES";
			$elp_set_viewstatus = "YES";
			$elp_set_postcount = 5;
			$elp_set_postcategory = "";
			$elp_set_postorderby = "ID";
			$elp_set_postorder = "DESC";
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_sendsetting` 
						(`elp_set_guid`,`elp_set_name`, `elp_set_templid`, `elp_set_totalsent`, `elp_set_unsubscribelink`, `elp_set_viewstatus`, 
						`elp_set_postcount`, `elp_set_postcategory`, `elp_set_postorderby`, `elp_set_postorder`, `elp_set_status`)
						VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
						array($elp_set_guid, $elp_set_name, $elp_set_templid, $elp_set_totalsent, 
						$elp_set_unsubscribelink, $elp_set_viewstatus, $elp_set_postcount, $elp_set_postcategory, $elp_set_postorderby, $elp_set_postorder, "On"));
			
			$wpdb->query($sSql);
						
			$elp_set_guid = elp_cls_common::elp_generate_guid(60);
			$elp_set_name = "Send Latest 1 Post (Full Post) with Template 9";
			$elp_set_templid = 3;
			$elp_set_totalsent = "25";
			$elp_set_postcount = 1;
			$elp_set_postcategory = "";
			
			$sSql = $wpdb->prepare("INSERT INTO `".$prefix."elp_sendsetting` 
					(`elp_set_guid`,`elp_set_name`, `elp_set_templid`, `elp_set_totalsent`, `elp_set_unsubscribelink`, `elp_set_viewstatus`, 
					`elp_set_postcount`, `elp_set_postcategory`, `elp_set_postorderby`, `elp_set_postorder`, `elp_set_status`)
					VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
					array($elp_set_guid, $elp_set_name, $elp_set_templid, $elp_set_totalsent, 
					$elp_set_unsubscribelink, $elp_set_viewstatus, $elp_set_postcount, $elp_set_postcategory, $elp_set_postorderby, $elp_set_postorder, "Off"));
		
			$wpdb->query($sSql);
		}
		return true;
	}
	
	public static function elp_subscriber_default()
	{
		$result = elp_cls_dbquery::elp_view_subscriber_count(0);
		if ($result == 0)
		{
			$admin_email = get_option('admin_email');
			$inputdata = array("Admin", $admin_email, "Confirmed", "Public");
			elp_cls_dbquery::elp_view_subscriber_ins($inputdata);
		}
		return true;
	}
	
	public static function elp_security_default()
	{
		$result = elp_cls_dbqueryblocked::elp_blocked_count(0);
		if ($result == 0)
		{
			elp_cls_dbqueryblocked::elp_blocked_ins('BadWord', 'Shit');
			elp_cls_dbqueryblocked::elp_blocked_ins('BadWord', 'Ass');
			elp_cls_dbqueryblocked::elp_blocked_ins('Domain', '@test.com');
			elp_cls_dbqueryblocked::elp_blocked_ins('Domain', '@123.com');
		}
		return true;
	}
	
	public static function elp_default_add_option()
	{
		add_option('elp_cron_trigger_option', "YES");
		add_option('elp_cron_mailcount', "75");
		add_option('elp_cron_adminmail', "Hi Admin, \r\n\r\nCron URL has been triggered successfully on ###DATE### for the mail ###SUBJECT###. And the mail has been sent to ###COUNT### recipient. \r\n\r\nThank You");
		
		add_option('elp_c_rolesandcapabilities', 'norecord');
		
		add_option('elp_captcha_widget', "NO");
		add_option('elp_captcha_sitekey', "NA");
		add_option('elp_captcha_secret', "NA");
		
		$guid = elp_cls_common::elp_generate_guid(60);
		$home_url = home_url('/');
		$cronurl = $home_url . "?elp=cron&guid=". $guid;
		add_option('elp_c_cronurl', $cronurl);

		return true;
	}
	
	public static function elp_db_value_sync()
	{
		global $wpdb;
		$prefix = $wpdb->prefix;
		
		$sSql = $wpdb->prepare("UPDATE `".$prefix."elp_sendsetting` SET 
				`elp_set_scheduleday` = %s, 
				`elp_set_scheduletime` = %s,
				`elp_set_scheduletype` = %s,
				`elp_set_status` = %s,
				`elp_set_emaillistgroup` = %s", array("#0# -- #1# -- #2# -- #3# -- #4# -- #5# -- #6#", "12:00:00", "Cron", "On", "Public") );
				
		$wpdb->query($sSql);

	}
}
?>