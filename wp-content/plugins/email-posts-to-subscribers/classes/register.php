<?php
class elp_cls_registerhook
{
	public static function elp_activation()
	{
		global $wpdb;
		
		$charset_collate = '';
		$charset_collate = $wpdb->get_charset_collate();
		
		add_option('email-posts-to-subscribers', "5.4");
		
		$elp_default_tables = "CREATE TABLE {$wpdb->prefix}elp_templatetable (
								  elp_templ_id INT unsigned NOT NULL AUTO_INCREMENT,
								  elp_templ_heading VARCHAR(255) NOT NULL,
								  elp_templ_header TEXT NULL,
								  elp_templ_body TEXT NULL,
								  elp_templ_footer TEXT NULL,
								  elp_templ_status VARCHAR(25) NOT NULL default 'Dynamic',
								  elp_email_type VARCHAR(100) NOT NULL default 'System',
								  PRIMARY KEY  (elp_templ_id)
								) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_emaillist (
							  elp_email_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_email_name VARCHAR(255) NOT NULL,
							  elp_email_mail VARCHAR(255) NOT NULL,
							  elp_email_status VARCHAR(25) NOT NULL default 'Unconfirmed',
							  elp_email_created datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_email_viewcount VARCHAR(100) NOT NULL,
							  elp_email_group VARCHAR(100) NOT NULL default 'Public',
							  elp_email_guid VARCHAR(255) NOT NULL,
							  elp_email_ip VARCHAR(100) NOT NULL default '',
							  elp_email_source VARCHAR(255) NOT NULL default '',
							  PRIMARY KEY  (elp_email_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_sendsetting (
							  elp_set_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_set_guid VARCHAR(255) NOT NULL,
							  elp_set_name VARCHAR(255) NOT NULL,
							  elp_set_templid VARCHAR(255) NOT NULL,
							  elp_set_totalsent INT unsigned NOT NULL,
							  elp_set_unsubscribelink VARCHAR(10) NOT NULL,
							  elp_set_viewstatus VARCHAR(10) NOT NULL,
							  elp_set_postcount INT unsigned NOT NULL,
							  elp_set_postcategory VARCHAR(225) NOT NULL,
							  elp_set_postorderby VARCHAR(10) NOT NULL,
							  elp_set_postorder VARCHAR(10) NOT NULL,
							  elp_set_scheduleday VARCHAR(50) NOT NULL default '#0# -- #1# -- #2# -- #3# -- #4# -- #5# -- #6#',
							  elp_set_scheduletime time NOT NULL default '00:00:00',
							  elp_set_scheduletype VARCHAR(20) NOT NULL default 'Cron',
							  elp_set_lastschedulerun datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_set_status VARCHAR(10) NOT NULL default 'On',
							  elp_set_emaillistgroup VARCHAR(225) NOT NULL default 'Public',
							  elp_set_scheduletimeint INT unsigned NOT NULL default 0,
							  elp_set_posttype VARCHAR(225) NOT NULL default '#Post#',
							  PRIMARY KEY  (elp_set_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_sentdetails (
							  elp_sent_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_sent_guid VARCHAR(255) NOT NULL,
							  elp_sent_qstring VARCHAR(255) NOT NULL,
							  elp_sent_source VARCHAR(255) NOT NULL,
							  elp_sent_starttime datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_sent_endtime datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_sent_count INT unsigned NOT NULL,
							  elp_sent_preview TEXT NULL,
							  elp_sent_status VARCHAR(25) NOT NULL default 'Sent',
							  elp_sent_type VARCHAR(25) NOT NULL default 'Instant Mail',
							  elp_sent_subject VARCHAR(255) NOT NULL,
							  PRIMARY KEY  (elp_sent_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_deliverreport (
							  elp_deliver_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_deliver_sentguid VARCHAR(255) NOT NULL,
							  elp_deliver_emailid INT unsigned NOT NULL,
							  elp_deliver_emailmail VARCHAR(255) NOT NULL,
							  elp_deliver_sentdate datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_deliver_status VARCHAR(25) NOT NULL,
							  elp_deliver_viewdate datetime NOT NULL default '0000-00-00 00:00:00',
							  elp_deliver_sentstatus VARCHAR(25) NOT NULL default 'Sent',
							  elp_deliver_senttype VARCHAR(25) NOT NULL default 'Instant Mail',
							  PRIMARY KEY  (elp_deliver_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_pluginconfig (
							  elp_c_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_c_fromname VARCHAR(255) NOT NULL,
							  elp_c_fromemail VARCHAR(255) NOT NULL,
							  elp_c_mailtype VARCHAR(255) NOT NULL,
							  elp_c_adminmailoption VARCHAR(255) NOT NULL,
							  elp_c_adminemail VARCHAR(255) NOT NULL,
							  elp_c_adminmailsubject VARCHAR(255) NOT NULL,
							  elp_c_adminmailcontant TEXT NULL,
							  elp_c_usermailoption VARCHAR(255) NOT NULL,
							  elp_c_usermailsubject VARCHAR(255) NOT NULL,
							  elp_c_usermailcontant TEXT NULL,
							  elp_c_optinoption VARCHAR(255) NOT NULL,
							  elp_c_optinsubject VARCHAR(255) NOT NULL,
							  elp_c_optincontent TEXT NULL,
							  elp_c_optinlink VARCHAR(255) NOT NULL,
							  elp_c_unsublink VARCHAR(255) NOT NULL,
							  elp_c_unsubtext TEXT NULL,
							  elp_c_unsubhtml TEXT NULL,
							  elp_c_subhtml TEXT NULL,
							  elp_c_message1 VARCHAR(255) NOT NULL default 'Oops.. This subscription cant be completed, sorry. The email address is blocked or already subscribed. Thank you.',
							  elp_c_message2 VARCHAR(255) NOT NULL default 'Oops.. We are getting some technical error. Please try again or contact admin.',
							  elp_c_message3 VARCHAR(255) NOT NULL default 'You have successfully subscribed. You will receive a confirmation email in few minutes.',
							  elp_c_rptsubject VARCHAR(255) NOT NULL default 'Report',
							  elp_c_rptcontent VARCHAR(255) NOT NULL default 'Hi Admin, Newsletter has been sent successfully to ###COUNT### email(s). For more information, Login to your Dashboard and go to Sent Mail menu in Email Posts plugin.  Subject : ###SUBJECT###',
							  elp_c_message6 VARCHAR(255) NOT NULL default 'Thank You, You have been successfully subscribed.',
							  elp_c_message7 VARCHAR(255) NOT NULL default 'Dummy message 7',
							  elp_c_message8 VARCHAR(255) NOT NULL default 'Dummy message 8',
							  elp_c_message9 VARCHAR(255) NOT NULL default 'Dummy message 9',
							  PRIMARY KEY  (elp_c_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_postnotification (
							  elp_note_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_note_guid VARCHAR(255) NOT NULL,
							  elp_note_postcat TEXT NULL,
							  elp_note_emailgroup VARCHAR(255) NOT NULL,
							  elp_note_mailsubject VARCHAR(255) NOT NULL,
							  elp_note_mailcontent TEXT NULL,
							  elp_note_status VARCHAR(100) NOT NULL default 'Enable',
							  elp_note_type VARCHAR(100) NOT NULL default 'Notification',
							  PRIMARY KEY  (elp_note_id)
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_squeezeips (
							  elp_ip_guid VARCHAR(255) NOT NULL,
							  elp_ip_value varchar(50) NOT NULL,
							  elp_ip_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
							  elp_squeeze_type varchar(20) NOT NULL default 'NA',
							  elp_squeeze_value varchar(20) NOT NULL default '0',
							  elp_squeeze_status varchar(20) NOT NULL default 'In-Queue'
							) $charset_collate;
							CREATE TABLE {$wpdb->prefix}elp_blockedemails (
							  elp_blocked_id INT unsigned NOT NULL AUTO_INCREMENT,
							  elp_blocked_guid VARCHAR(255) NOT NULL,
							  elp_blocked_type varchar(50) NOT NULL,
							  elp_blocked_value VARCHAR(255) NOT NULL,
							  elp_blocked_delete INT unsigned NOT NULL default 9999,
							  elp_blocked_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
							  PRIMARY KEY (elp_blocked_id)
							) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $elp_default_tables );
		
		// Plugin tables
		$array_tables_to_plugin = array('elp_templatetable', 'elp_emaillist', 'elp_sendsetting', 'elp_sentdetails', 'elp_deliverreport', 'elp_pluginconfig', 'elp_postnotification', 'elp_squeezeips', 'elp_blockedemails');
		$errors = array();
		
		// list the tables that haven't been created
		$elp_has_errors = false;
        $elp_missing_tables=array();
        foreach($array_tables_to_plugin as $table_name) {
			if(strtoupper($wpdb->get_var("SHOW TABLES like  '". $wpdb->prefix.$table_name . "'")) != strtoupper($wpdb->prefix.$table_name)) {
                $elp_missing_tables[]=$wpdb->prefix.$table_name;
            }
        }
		
		// add error in to array variable
        if($elp_missing_tables) {
			$errors[] = __('These tables could not be created on installation ' . implode(', ',$elp_missing_tables), 'email-posts-to-subscribers');
            $elp_has_errors = true;
        }
		
		// if error call wp_die()
        if($elp_has_errors) {
			wp_die( __( $errors[0] , 'email-posts-to-subscribers' ) );
			return false;
		}
		else {
			elp_cls_dbinsert::elp_template_default();
			elp_cls_dbinsert::elp_pluginconfig_default();
			elp_cls_dbinsert::elp_sendsetting_default();
			elp_cls_dbinsert::elp_subscriber_default();
			elp_cls_dbquerynote::elp_notification_default();
			elp_cls_dbinsert::elp_security_default();
		}
		
		elp_cls_dbinsert::elp_default_add_option();
		
        return true;
	}
	
	public static function elp_synctables()
	{
//		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
//		if($elp_c_plugin_ver <> "3.0")
//		{
//			global $wpdb;
//			
//			// loading the sql file, load it and separate the queries
//			$sql_file = ELP_DIR.'sql'.DS.'createDB.sql';
//			$prefix = $wpdb->prefix;
//			$handle = fopen($sql_file, 'r');
//			$query = fread($handle, filesize($sql_file));
//			fclose($handle);
//			$query=str_replace('CREATE TABLE IF NOT EXISTS ','CREATE TABLE '.$prefix, $query);
//			$query=str_replace('ENGINE=MyISAM /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/','', $query);
//			$queries=explode('-- SQLQUERY ---', $query);
//	
//			// includes db upgrade file
//			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//			
//			// run the queries one by one
//			foreach($queries as $sSql)
//			{
//				dbDelta( $sSql );
//			}
//			elp_cls_dbinsert::elp_db_value_sync();
//			
//			update_option('email-posts-to-subscribers', "3.0" );
//			add_option('elp_cron_mailcount', "75");
//		}
	}
	
	public static function elp_synctables_3_4()
	{
//		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
//		if($elp_c_plugin_ver <> "3.4")
//		{
//			global $wpdb;
//			
//			// loading the sql file, load it and separate the queries
//			$sql_file = ELP_DIR.'sql'.DS.'createDB.sql';
//			$prefix = $wpdb->prefix;
//			$handle = fopen($sql_file, 'r');
//			$query = fread($handle, filesize($sql_file));
//			fclose($handle);
//			$query=str_replace('CREATE TABLE IF NOT EXISTS ','CREATE TABLE '.$prefix, $query);
//			$query=str_replace('ENGINE=MyISAM /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/','', $query);
//			$queries=explode('-- SQLQUERY ---', $query);
//	
//			// includes db upgrade file
//			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//			
//			// run the queries one by one
//			foreach($queries as $sSql)
//			{
//				dbDelta( $sSql );
//			}
//			elp_cls_dbquerynote::elp_notification_default();
//			
//			update_option('email-posts-to-subscribers', "3.4" );
//		}
	}
	
	public static function elp_synctables_3_9()
	{
//		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
//		$elp_c_plugin_ver = floatval($elp_c_plugin_ver);
//		
//		if($elp_c_plugin_ver < 3.9)
//		{
//			$elp_cron_trigger_option = get_option('elp_cron_trigger_option', '0');
//			if($elp_cron_trigger_option == "0")
//			{
//				add_option('elp_cron_trigger_option', "YES");
//			}
//			update_option('email-posts-to-subscribers', "3.9" );
//		}
	}
	
	public static function elp_synctables_4_5()
	{
		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
		$elp_c_plugin_ver = floatval($elp_c_plugin_ver);
		
		if($elp_c_plugin_ver < 5.0)
		{
			// update_option('email-posts-to-subscribers', "5.0" );
			update_option('email-posts-to-subscribers', "5.1" ); // Added on 5.1 upgrade
		}
	}
	
	public static function elp_synctables_5_1()
	{
		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
		$elp_c_plugin_ver = floatval($elp_c_plugin_ver);
		
		if($elp_c_plugin_ver < 5.1) {
			update_option('email-posts-to-subscribers', "5.1" );
		}
	}
	
	public static function elp_synctables_5_4()
	{
		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
		$elp_c_plugin_ver = floatval($elp_c_plugin_ver);
		
		if($elp_c_plugin_ver < 5.4) {
			update_option('email-posts-to-subscribers', "5.4" );
		}
	}
	
	public static function elp_synctables_all_versions()
	{
		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
		$elp_c_plugin_ver = floatval($elp_c_plugin_ver);
		
		if($elp_c_plugin_ver < 5.0)
		{
			elp_cls_registerhook::elp_activation();
			elp_cls_registerhook::elp_synctables_5_4();
		}
		elseif($elp_c_plugin_ver == 5.0)
		{
			elp_cls_registerhook::elp_activation();
			elp_cls_registerhook::elp_synctables_5_4();
		}
		elseif($elp_c_plugin_ver == 5.1)
		{
			elp_cls_registerhook::elp_activation();
			elp_cls_registerhook::elp_synctables_5_4();
		}
		else
		{
			elp_cls_registerhook::elp_activation();
			elp_cls_registerhook::elp_synctables_5_4();
		}
	}
	
	public static function elp_deactivation()
	{
		// do not generate any output here
	}
	
	public static function elp_uninstall()
	{
		// do not generate any output here
	}
	
	public static function elp_adminmenu()
	{
		
		$elp_role_subscriber 	= "manage_options";
		$elp_role_templates 	= "manage_options";
		$elp_role_mailconfig 	= "manage_options";
		$elp_role_postnotify 	= "manage_options";
		$elp_role_compose 		= "manage_options";
		$elp_role_sendemail 	= "manage_options";
		$elp_role_sentmail 		= "manage_options";
		$elp_role_options 		= "manage_options";
		$elp_role_setting 		= "manage_options";
			
		$elp_roles = get_option('elp_c_rolesandcapabilities', 'norecord');
		if($elp_roles == 'norecord' || $elp_roles == "") {
			// No action
		}
		else {
			$elp_role_subscriber 	= isset( $elp_roles['elp_role_subscriber'] ) ? $elp_roles['elp_role_subscriber'] : 'manage_options';
			$elp_role_templates 	= isset( $elp_roles['elp_role_templates'] ) ? $elp_roles['elp_role_templates'] : 'manage_options';
			$elp_role_mailconfig 	= isset( $elp_roles['elp_role_mailconfig'] ) ? $elp_roles['elp_role_mailconfig'] : 'manage_options';
			$elp_role_postnotify 	= isset( $elp_roles['elp_role_postnotify'] ) ? $elp_roles['elp_role_postnotify'] : 'manage_options';
			$elp_role_compose 		= isset( $elp_roles['elp_role_compose'] ) ? $elp_roles['elp_role_compose'] : 'manage_options';
			$elp_role_sendemail 	= isset( $elp_roles['elp_role_sendemail'] ) ? $elp_roles['elp_role_sendemail'] : 'manage_options';
			$elp_role_sentmail 		= isset( $elp_roles['elp_role_sentmail'] ) ? $elp_roles['elp_role_sentmail'] : 'manage_options';
			$elp_role_options 		= 'manage_options';
			$elp_role_setting 		= isset( $elp_roles['elp_role_setting'] ) ? $elp_roles['elp_role_setting'] : 'manage_options';
		}
		
		add_menu_page( __( 'Email Posts', 'email-posts-to-subscribers' ), 
			__( 'Email Posts', 'email-posts-to-subscribers' ), 'admin_dashboard', 'email-post', array( 'elp_cls_intermediate', 'elp_subscribers' ), ELP_URL.'images/mail.png', 53 );
			
		add_submenu_page('email-post', __( 'Subscribers', 'email-posts-to-subscribers' ), 
			__( 'Subscribers', 'email-posts-to-subscribers' ), $elp_role_subscriber , 'elp-view-subscribers', array( 'elp_cls_intermediate', 'elp_subscribers' ));
						
		add_submenu_page('email-post', __( 'Templates', 'email-posts-to-subscribers' ), 
			__( 'Templates', 'email-posts-to-subscribers' ), $elp_role_templates, 'elp-email-template', array( 'elp_cls_intermediate', 'elp_template' ));
			
		add_submenu_page('email-post', __( 'Mail Configuration', 'email-posts-to-subscribers' ), 
			__( 'Mail Configuration', 'email-posts-to-subscribers' ), $elp_role_mailconfig, 'elp-configuration', array( 'elp_cls_intermediate', 'elp_configuration' ));	
			
		add_submenu_page('email-post', __( 'Post Notification', 'email-posts-to-subscribers' ), 
			__( 'Post Notification', 'email-posts-to-subscribers' ), $elp_role_postnotify, 'elp-postnotification', array( 'elp_cls_intermediate', 'elp_postnotification' ));
		
		add_submenu_page('email-post', __( 'Compose Newsletter', 'email-posts-to-subscribers' ), 
			__( 'Compose Mail', 'email-posts-to-subscribers' ), $elp_role_compose, 'elp-composenewsletter', array( 'elp_cls_intermediate', 'elp_composenewsletter' ));
							
		add_submenu_page('email-post', __( 'Send Email', 'email-posts-to-subscribers' ), 
			__( 'Send Email', 'email-posts-to-subscribers' ), $elp_role_sendemail, 'elp-sendemail', array( 'elp_cls_intermediate', 'elp_sendemail' ));
					
		add_submenu_page('email-post', __( 'Sent Mail', 'email-posts-to-subscribers' ), 
			__( 'Sent Mail', 'email-posts-to-subscribers' ), $elp_role_sentmail, 'elp-sentmail', array( 'elp_cls_intermediate', 'elp_sentmail' ));	
		
		add_submenu_page('email-post', __( 'Options', 'email-posts-to-subscribers' ), 
			__( 'Options', 'email-posts-to-subscribers' ), $elp_role_options, 'elp-options', array( 'elp_cls_intermediate', 'elp_options' ));
			
		add_submenu_page('email-post', __( 'Plugin Settings', 'email-posts-to-subscribers' ), 
			__( 'Plugin Settings', 'email-posts-to-subscribers' ), $elp_role_setting, 'elp-settings', array( 'elp_cls_intermediate', 'elp_settings' ));
			
		//add_submenu_page('email-post', __( 'Cron Details', 'email-posts-to-subscribers' ), 
		//	__( 'Cron Details', 'email-posts-to-subscribers' ), $elp_role_crondetails, 'elp-crondetails', array( 'elp_cls_intermediate', 'elp_crondetails' ));
				
		//add_submenu_page('email-post', __( 'Settings', 'email-posts-to-subscribers' ), 
		//	__( 'Settings', 'email-posts-to-subscribers' ), $elp_role_setting , 'elp-settings', array( 'elp_cls_intermediate', 'elp_settings' ));	
					
		//add_submenu_page('email-post', __( 'Roles', 'email-posts-to-subscribers' ), 
		//	__( 'Roles', 'email-posts-to-subscribers' ), 'manage_options', 'elp-roles', array( 'elp_cls_intermediate', 'elp_roles' ));	
			
		//add_submenu_page('email-post', __( 'Help & Info', 'email-posts-to-subscribers' ), 
		//	__( 'Help & Info', 'email-posts-to-subscribers' ),  'manage_options', 'elp-general-information', array( 'elp_cls_intermediate', 'elp_information' ));
			
		//add_submenu_page('email-post', __( 'Send Newsletter', 'email-posts-to-subscribers' ), 
		//	__( 'Send Newsletter', 'email-posts-to-subscribers' ), 'manage_options', 'elp-sendnewsletter', array( 'elp_cls_intermediate', 'elp_sendnewsletter' ));		
			
		//add_submenu_page('email-post', __( 'reCaptcha', 'email-posts-to-subscribers' ), 
		//	__( 'reCaptcha', 'email-posts-to-subscribers' ), 'manage_options', 'elp-recaptcha', array( 'elp_cls_intermediate', 'elp_recaptcha' ));
	}
	
	public static function elp_widget_loading()
	{
		register_widget( 'elp_widget_register' );
	}
	
	public static function elp_load_scripts_front() {
		wp_enqueue_script( 'email-posts-to-subscribers', ELP_URL . '/inc/email-posts-to-subscribers.js', array( 'jquery' ), '2.2', false );
		
		$elp_data = array(
			'messages' => array(
				'elp_name_required'     => __( 'Please enter name.', 'email-posts-to-subscribers' ),
				'elp_email_required'    => __( 'Please enter email address.', 'email-posts-to-subscribers' ),
				'elp_invalid_name'      => __( 'Name seems invalid.', 'email-posts-to-subscribers' ),
				'elp_invalid_email'     => __( 'Email address seems invalid.', 'email-posts-to-subscribers' ),
				'elp_unexpected_error'  => __( 'Oops.. Unexpected error occurred.', 'email-posts-to-subscribers' ),
				'elp_invalid_captcha'   => __( 'Robot verification failed, please try again.', 'email-posts-to-subscribers' ),
				'elp_invalid_key'   	=> __( 'Robot verification failed, invalid key.', 'email-posts-to-subscribers' ),
				'elp_successfull_single'=> __( 'You have successfully subscribed.', 'email-posts-to-subscribers' ),
				'elp_successfull_double'=> __( 'You have successfully subscribed. You will receive a confirmation email in few minutes. Please follow the link in it to confirm your subscription. If the email takes more than 15 minutes to appear in your mailbox, please check your spam folder.', 'email-posts-to-subscribers' ),
				'elp_email_exist'   	=> __( 'Email already exist.', 'email-posts-to-subscribers' ),
				'elp_email_squeeze'   	=> __( 'You are trying to submit too fast. try again in 1 minute.', 'email-posts-to-subscribers' )
			),
			'elp_ajax_url' => admin_url( 'admin-ajax.php' ),
		);
		
		wp_localize_script( 'email-posts-to-subscribers', 'elp_data', $elp_data );
	}
	
	public static function elp_load_style_front() {
		echo '<style>';
		echo '.elp_form_message.success { color: #008000;font-weight: bold; } ';
		echo '.elp_form_message.error { color: #ff0000; } ';
		echo '.elp_form_message.boterror { color: #ff0000; } ';
		echo '</style>';
	}
	
	public static function elp_load_scripts()
	{
		if( !empty( $_GET['page'] ) )
		{
			switch ( $_GET['page'] ) 
			{
				case 'elp-view-subscribers':
					wp_register_script( 'elp-view-subscribers', ELP_URL . 'subscribers/view-subscriber.js', '', '', true );
					wp_enqueue_script( 'elp-view-subscribers' );
					$elp_script_params = array(
						'elp_subscribers_del_record1' => _x( 'Do you want to delete this record?', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_del_record2' => _x( 'Are you sure you want to delete?', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_add_email'   => _x( 'Please enter email address.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_email_group' => _x( 'Please enter email group.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_add_status'  => _x( 'Please select the status.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_bulk_action' => _x( 'Please select the bulk action.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_resend' 	  => _x( 'Do you want to resend confirmation email? Also please note, this will update subscriber current status to Unconfirmed.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_add_group'   => _x( 'Please select new subscriber group.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_update_group'=> _x( 'Do you want to update subscribers group?.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_export_email'=> _x( 'Do you want to export the emails?.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_csv'		  => _x( 'Please select only csv file. Please check official website for csv structure.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
						'elp_subscribers_num_letters' => _x( 'Please input numeric and letters only.', 'elp-subscribers-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-view-subscribers', 'elp_subscribers_script', $elp_script_params );
					break;
					
				case 'elp-email-template':
					wp_register_script( 'elp-email-template', ELP_URL . 'template/template.js', '', '', true );
					wp_enqueue_script( 'elp-email-template' );
					$elp_script_params = array(
						'elp_template_heading' => _x( 'Please enter template heading.', 'elp-template-script', 'email-posts-to-subscribers' ),
						'elp_template_delete'  => _x( 'Do you want to delete this record?', 'elp-template-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-email-template', 'elp_template_script', $elp_script_params );
					break;
					
				case 'elp-composenewsletter':
					wp_register_script( 'elp-composenewsletter', ELP_URL . 'template/template.js', '', '', true );
					wp_enqueue_script( 'elp-composenewsletter' );
					$elp_script_params = array(
						'elp_composenewsletter_heading' => _x( 'Please enter newsletter subject.', 'elp-composenewsletter-script', 'email-posts-to-subscribers' ),
						'elp_composenewsletter_delete'  => _x( 'Do you want to delete this record?', 'elp-composenewsletter-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-composenewsletter', 'elp_composenewsletter_script', $elp_script_params );
					break;
				
				case 'elp-configuration':
					wp_register_script( 'elp-configuration', ELP_URL . 'configuration/configuration.js', '', '', true );
					wp_enqueue_script( 'elp-configuration' );
					$elp_script_params = array(
						'elp_configuration_mailsub' => _x( 'Please enter mail subject.', 'elp-configuration-script', 'email-posts-to-subscribers' ),
						'elp_configuration_mailtemp'=> _x( 'Please select template for this configuration.', 'elp-configuration-script', 'email-posts-to-subscribers' ),
						'elp_configuration_delete'  => _x( 'Do you want to delete this record?', 'elp-configuration-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-configuration', 'elp_configuration_script', $elp_script_params );
					break;
					
				case 'elp-sendemail':
					wp_register_script( 'elp-sendemail', ELP_URL . 'sendmail/sendmail.js', '', '', true );
					wp_enqueue_script( 'elp-sendemail' );
					$elp_script_params = array(
						'elp_sendemail_configuration' 	=> _x( 'Please select mail configuration.', 'elp-sendemail-script', 'email-posts-to-subscribers' ),
						'elp_sendemail_mailtype'		=> _x( 'Please select your mail type.', 'elp-sendemail-script', 'email-posts-to-subscribers' ),
						'elp_sendemail_confirm'  		=> _x( 'Are you sure you want to send email to all selected email address?', 'elp-sendemail-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-sendemail', 'elp_sendemail_script', $elp_script_params );
					break;
					
				case 'elp-sendnewsletter':
					wp_register_script( 'elp-sendnewsletter', ELP_URL . 'sendmail/sendmail.js', '', '', true );
					wp_enqueue_script( 'elp-sendnewsletter' );
					$elp_script_params = array(
						'elp_sendnewsletter_newsletter' => _x( 'Please select your newsletter.', 'elp-sendnewsletter-script', 'email-posts-to-subscribers' ),
						'elp_sendnewsletter_mailtype'	=> _x( 'Please select your mail type.', 'elp-sendnewsletter-script', 'email-posts-to-subscribers' ),
						'elp_sendnewsletter_group'		=> _x( 'Please select subscriber group.', 'elp-sendnewsletter-script', 'email-posts-to-subscribers' ),
						'elp_sendnewsletter_confirm'  	=> _x( 'Are you sure you want to send email to selected subscriber group?', 'elp-sendnewsletter-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-sendnewsletter', 'elp_sendnewsletter_script', $elp_script_params );
					break;
					
				case 'elp-postnotification':
					wp_register_script( 'elp-postnotification', ELP_URL . 'notification/notification.js', '', '', true );
					wp_enqueue_script( 'elp-postnotification' );
					$elp_script_params = array(
						'elp_notification_group' 		=> _x( 'Please select email subscribers group.', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_status'		=> _x( 'Please select notification status.', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_subject'		=> _x( 'Please enter notification mail subject.', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_categories'  	=> _x( 'Please select post categories for this notification.', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_delete'		=> _x( 'Do you want to delete this record?', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_release'		=> _x( 'Do you want to release this queue imediatly?', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
						'elp_notification_deleteall'	=> _x( 'Are you sure you want to delete?', 'elp-postnotification-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-postnotification', 'elp_notification_script', $elp_script_params );
					break;
					
				case 'elp-sentmail':
					wp_register_script( 'elp-sentmail', ELP_URL . 'sentmail/sentmail.js', '', '', true );
					wp_enqueue_script( 'elp-sentmail' );
					$elp_script_params = array(
						'elp_sentmail_delete'		=> _x( 'Do you want to delete this record?', 'elp-sentmail-script', 'email-posts-to-subscribers' ),
						'elp_sentmail_delete_all'	=> _x( 'Do you want to delete all records except latest 20?', 'elp-sentmail-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-sentmail', 'elp_sentmail_script', $elp_script_params );
					break;
					
				//case 'elp-crondetails':
				//	wp_register_script( 'elp-crondetails', ELP_URL . 'cron/cron.js', '', '', true );
				//	wp_enqueue_script( 'elp-crondetails' );
				//	$elp_script_params = array(
				//		'elp_crondetails_number1'	=> _x( 'Please enter number of mails you want to send on every cron trigger.', 'elp-crondetails-script', 'email-posts-to-subscribers' ),
				//		'elp_crondetails_number2'	=> _x( 'Please enter the mail count, only number.', 'elp-crondetails-script', 'email-posts-to-subscribers' ),
				//	);
				//	wp_localize_script( 'elp-crondetails', 'elp_crondetails_script', $elp_script_params );
				//	break;
					
				case 'elp-settings':
					wp_register_script( 'elp-settings', ELP_URL . 'settings/settings.js', '', '', true );
					wp_enqueue_script( 'elp-settings' );
					
				//case 'elp-roles':
				//	wp_register_script( 'elp-roles', ELP_URL . 'roles/roles.js', '', '', true );
				//	wp_enqueue_script( 'elp-roles' );
					
				case 'elp-recaptcha':
					wp_register_script( 'elp-recaptcha', ELP_URL . 'recaptcha/recaptcha.js', '', '', true );
					wp_enqueue_script( 'elp-recaptcha' );
					$elp_script_params = array(
						'elp_recaptcha_sitekey_add'		=> _x( 'Please enter valid site key value.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
						'elp_recaptcha_secretkey_add'	=> _x( 'Please enter valid secret key value.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
						'elp_recaptcha_save_all'		=> _x( 'Do you want to update all the details.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-recaptcha', 'elp_recaptcha_script', $elp_script_params );
					break;
				case 'elp-options':
					wp_register_script( 'elp-options', ELP_URL . 'options/options.js', '', '', true );
					wp_enqueue_script( 'elp-options' );
					$elp_script_params = array(
						'elp_crondetails_number1'	=> _x( 'Please enter number of mails you want to send on every cron trigger.', 'elp-crondetails-script', 'email-posts-to-subscribers' ),
						'elp_crondetails_number2'	=> _x( 'Please enter the mail count, only number.', 'elp-crondetails-script', 'email-posts-to-subscribers' ),
						'elp_recaptcha_sitekey_add'		=> _x( 'Please enter valid site key value.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
						'elp_recaptcha_secretkey_add'	=> _x( 'Please enter valid secret key value.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
						'elp_recaptcha_save_all'		=> _x( 'Do you want to update all the details.', 'elp-recaptcha-script', 'email-posts-to-subscribers' ),
						'elp_security_delete'			=> _x( 'Do you want to delete this record?', 'elp-sentmail-script', 'email-posts-to-subscribers' ),
					);
					wp_localize_script( 'elp-options', 'elp_options_script', $elp_script_params );
					break;
			}
		}
	}
}

class elp_widget_register extends WP_Widget 
{
	function __construct() 
	{
		$widget_ops = array('classname' => 'widget_text elp-widget', 'description' => __(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'), ELP_PLUGIN_NAME);
		parent::__construct(ELP_PLUGIN_NAME, __(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'), $widget_ops);
	}
	
	function widget( $args, $instance ) 
	{
		extract( $args, EXTR_SKIP );
		
		$elp_title 	= apply_filters( 'widget_title', empty( $instance['elp_title'] ) ? '' : $instance['elp_title'], $instance, $this->id_base );
		$elp_desc	= $instance['elp_desc'];
		$elp_name	= $instance['elp_name'];
		$elp_group	= $instance['elp_group'];

		echo $args['before_widget'];
		if ( ! empty( $elp_title ) )
		{
			echo $args['before_title'] . $elp_title . $args['after_title'];
		}
		// Call widget method
		$atts = array();
		//$arr["elp_title"] 	= $elp_title;
		$atts["namefield"] 	= $elp_name;
		$atts["desc"] 		= $elp_desc;
		$atts["group"] 		= $elp_group;
		//$arr["type"] 		= "widget";	
		
		elp_cls_shortcode::elp_shortcode_render($atts);
		// echo elp_cls_widget::elp_widget_int($arr);
		// Call widget method
			
		echo $args['after_widget'];
	}
	
	function update( $new_instance, $old_instance ) 
	{
		$instance 				= $old_instance;
		$instance['elp_title'] 	= ( ! empty( $new_instance['elp_title'] ) ) ? strip_tags( $new_instance['elp_title'] ) : '';
		$instance['elp_desc'] 	= ( ! empty( $new_instance['elp_desc'] ) ) ? strip_tags( $new_instance['elp_desc'] ) : '';
		$instance['elp_name'] 	= ( ! empty( $new_instance['elp_name'] ) ) ? strip_tags( $new_instance['elp_name'] ) : '';
		$instance['elp_group'] 	= ( ! empty( $new_instance['elp_group'] ) ) ? strip_tags( $new_instance['elp_group'] ) : '';
		return $instance;
	}
	
	function form( $instance ) 
	{
		$defaults = array(
			'elp_title' => '',
            'elp_desc' 	=> '',
            'elp_name' 	=> '',
			'elp_group'  => ''
        );
		$instance 		= wp_parse_args( (array) $instance, $defaults);
		$elp_title 		= $instance['elp_title'];
        $elp_desc 		= $instance['elp_desc'];
        $elp_name 		= $instance['elp_name'];
		$elp_group 		= $instance['elp_group'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('elp_title'); ?>"><?php _e('Widget Title', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_title'); ?>" name="<?php echo $this->get_field_name('elp_title'); ?>" type="text" value="<?php echo $elp_title; ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('elp_name'); ?>"><?php _e('Name Field', 'email-posts-to-subscribers'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('elp_name'); ?>" name="<?php echo $this->get_field_name('elp_name'); ?>">
				<option value="YES" <?php $this->elp_selected($elp_name == 'YES'); ?>>YES</option>
				<option value="NO" <?php $this->elp_selected($elp_name == 'NO'); ?>>NO</option>
			</select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('elp_desc'); ?>"><?php _e('Short Description', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_desc'); ?>" name="<?php echo $this->get_field_name('elp_desc'); ?>" type="text" value="<?php echo $elp_desc; ?>" />
			Short description about your widget.
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('elp_group'); ?>"><?php _e('Subscriber Group', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_group'); ?>" name="<?php echo $this->get_field_name('elp_group'); ?>" type="text" maxlength="20" value="<?php echo $elp_group; ?>" />
        </p>
		<?php
	}
	
	function elp_selected($var) 
	{
		if ($var==1 || $var==true) 
		{
			echo 'selected="selected"';
		}
	}
}

class elp_cls_savesubscriber {

	public function __construct() {
	}
	
	public static function elp_save_subscriber() {
		$response = array( 'status' => 'SUCCESS', 'message' => '' );
		
		//////////////////////////////Robot verification//////////////////////////////////////////////////
		$elp_captcha_widget = get_option('elp_captcha_widget', '');
		if($elp_captcha_widget == 'YES') {
			$elp_captcha_secret = get_option('elp_captcha_secret');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$elp_captcha_secret.'&response='.$_POST['elp_g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if(!$responseData->success) {
				$response['message'] = 'elp_invalid_captcha';
				$response['status'] = 'ERROR';
				elp_do_response( $response );
				exit;
			}
		}
		//////////////////////////////Robot verification//////////////////////////////////////////////////
		
		$elp_submit = elp_get_posted_data( 'elp_submit' ,'' , true);
		$elp_nonce 	= elp_get_posted_data( 'elp_nonce' ,'' , true );
		
		if ( $elp_submit === 'submitted' && ! empty( $elp_nonce ) ) {
			$data = elp_get_posted_data();
			
			//Security check
			$action = elp_cls_dbquerysqueeze::elp_squeeze_check();
			if($action == 'squeeze') {
				$response['message'] = 'elp_email_squeeze';
				$response['status'] = 'ERROR';
			}
			
			$elp_name = isset( $data['elp_name'] ) ? $data['elp_name'] : '';
			if ( $elp_name != '' && strlen( $elp_name ) > 50) {
				$response['message'] = 'elp_invalid_name';
				$response['status'] = 'ERROR';
			}
			
			$elp_email = isset( $data['elp_email'] ) ? $data['elp_email'] : '';
			if ( $elp_email == '') {
				$response['message'] = 'elp_email_required';
				$response['status'] = 'ERROR';
			}
			if ( ! filter_var( $elp_email, FILTER_VALIDATE_EMAIL ) ) {
				$ed_response['message'] = 'elp_invalid_email';
				$response['status'] = 'ERROR';
			}
			
			$elp_group = isset( $data['elp_group'] ) ? $data['elp_group'] : '';
			
			if ($response['status'] == 'SUCCESS') {
			
				$elp_spam_check = true;
				$elp_email_name = isset( $data['elp_email_name'] ) ? $data['elp_email_name'] : '';
				if ($elp_email_name != '') {
					$elp_spam_check = false;
				}
				
				if($elp_spam_check) {
					$data = elp_cls_pluginconfig::elp_setting_select(1);
					if( $data['elp_c_optinoption'] == "Double Opt In" ) {
						$inputdata = array($elp_name, $elp_email, "Unconfirmed", $elp_group);
					}
					else {
						$inputdata = array($elp_name, $elp_email, "Single Opt In", $elp_group);
					}
					
					$action = elp_cls_dbquery::elp_view_subscriber_widget($inputdata);
					if($action == "sus") {
						$subscribers = array();
						$subscribers = elp_cls_dbquery::elp_view_subscriber_one($elp_email);
						if( $data['elp_c_optinoption'] == "Double Opt In" ) {
							elp_cls_sendmail::elp_sendmail("optin", $subject = "", $content = "", $subscribers);
							$response['message'] = 'elp_successfull_double';
						}
						else {
							if( $data['elp_c_usermailoption'] == "YES" ) {
								elp_cls_sendmail::elp_sendmail("welcome", $subject = "", $content = "", $subscribers);
							}
							$response['message'] = 'elp_successfull_single';
						}
						
						//Security check, Add IPs and Delete Old records
						elp_cls_dbquerysqueeze::elp_squeeze_ins();
						elp_cls_dbquerysqueeze::elp_squeeze_del();
					}
					elseif($action == "ext") {
						$response['message'] = 'elp_email_exist';
						$response['status'] = 'ERROR';
					}
					elseif($action == "blk") {
						// Email blocked, Dummy message to users.
						$response['message'] = 'elp_successfull_single';  
						$response['status'] = 'ERRORBOT';
					}
					elseif($action == "secblk") {
						// Email blocked, Dummy message to users.
						$response['message'] = 'elp_successfull_single'; 
						$response['status'] = 'ERRORBOT'; 
					}
				}
				else {
					// Spam check, Dummy message to users.
					$response['message'] = 'elp_successfull_single';
					$response['status'] = 'ERRORBOT'; 
				}
			}
		}
		
		elp_do_response( $response );
		exit;
	}
}

function elp_get_posted_data( $var = '', $default = '', $clean = true ) {
	return elp_posted_data( $_POST, $var, $default, $clean );
}

function elp_posted_data( $array = array(), $var = '', $default = '', $clean = false ) {
	if ( ! empty( $var ) ) {
		$value = isset( $array[ $var ] ) ? wp_unslash( $array[ $var ] ) : $default;
	} else {
		$value = wp_unslash( $array );
	}

	if ( $clean ) {
		$value = elp_posted_clean_data( $value );
	}
	return $value;
}

function elp_posted_clean_data( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'elp_posted_clean_data', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}

function elp_do_response( $response ) {
	$message = isset( $response['message'] ) ? $response['message'] : '';
	$response['message_text'] = '';
	if ( ! empty( $message ) ) {
		if($message == 'elp_successfull_single' || $message == 'elp_successfull_double') {
			$data = elp_cls_pluginconfig::elp_setting_select(1);
			if($message == 'elp_successfull_single') {
				$response['message_text'] = $data['elp_c_message6'];
			}
			
			if($message == 'elp_successfull_double') {
				$response['message_text'] = $data['elp_c_message3'];
			}
			
			if($response['message_text'] == '') {
				$response['message_text'] = 'Thank You, You have been successfully subscribed.';
			}
		}
		else {
			$response['message_text'] = elp_get_messages( $message );
		}
	}

	echo json_encode( $response );
	exit;
}

function elp_get_messages($message) {
	$messages = array(
		'elp_name_required'     => __( 'Please enter name.', 'email-posts-to-subscribers' ),
		'elp_email_required'    => __( 'Please enter email address.', 'email-posts-to-subscribers' ),
		'elp_invalid_name'      => __( 'Name seems invalid.', 'email-posts-to-subscribers' ),
		'elp_invalid_email'     => __( 'Email address seems invalid.', 'email-posts-to-subscribers' ),
		'elp_unexpected_error'  => __( 'Oops.. Unexpected error occurred.', 'email-posts-to-subscribers' ),
		'elp_invalid_captcha'   => __( 'Robot verification failed, please try again.', 'email-posts-to-subscribers' ),
		'elp_invalid_key'   	=> __( 'Robot verification failed, invalid key.', 'email-posts-to-subscribers' ),
		'elp_successfull_single'=> __( 'You have successfully subscribed.', 'email-posts-to-subscribers' ),
		'elp_successfull_double'=> __( 'You have successfully subscribed. You will receive a confirmation email in few minutes. Please follow the link in it to confirm your subscription. If the email takes more than 15 minutes to appear in your mailbox, please check your spam folder.', 'email-posts-to-subscribers' ),
		'elp_email_exist'   	=> __( 'Email already exist.', 'email-posts-to-subscribers' ),
		'elp_email_squeeze'   	=> __( 'You are trying to submit too fast. try again in 1 minute.', 'email-posts-to-subscribers' ),
	);

	$messages = apply_filters('elp_form_messages', $messages);
	if ( ! empty( $messages ) ) {
		return isset($messages[ $message ]) ? $messages[ $message ] : '';
	}
	
	return $messages;
}

function elp_sync_registereduser( $user_id ) 
{        
	$elp_c_syncemail = get_option('elp_c_syncemail', 'norecord');
	if($elp_c_syncemail == 'norecord' || $elp_c_syncemail == "") 
	{
		// No action is required
	} 
	else 
	{
		if(($elp_c_syncemail['elp_registered'] == "YES") && ($user_id <> "")) 
		{
			$user_info = get_userdata($user_id);
			$user_firstname = $user_info->user_firstname;
			if($user_firstname == "") 
			{
				$user_firstname = $user_info->user_login;
			}
			$user_mail = $user_info->user_email;
			
			$form['elp_email_name'] = $user_firstname;
			$form['elp_email_mail'] = $user_mail;
			$form['elp_email_status'] = "Confirmed";
			$form['elp_email_group'] = $elp_c_syncemail['elp_registered_group'];
			$inputdata = array($form['elp_email_name'], $form['elp_email_mail'], $form['elp_email_status'], trim($form['elp_email_group']));
			$action = "";
			$action = elp_cls_dbquery::elp_view_subscriber_ins($inputdata);	
			if($action == "sus")
			{
				//Inserted successfully. Below 3 line of code will send WELCOME email to subscribers.
				//$subscribers = array();
				//$subscribers = elp_cls_dbquery::elp_view_subscriber_one($user_mail);
				//elp_cls_sendmail::elp_sendmail("welcome", $subject = "", $content = "", $subscribers);
			}
		}
	}
}


function elp_cron_activation() {
	if (! wp_next_scheduled ( 'elp_cron_hourly_event' )) {
		wp_schedule_event(time(), 'hourly', 'elp_cron_hourly_event');
    }
}

function elp_cron_deactivation() {
	wp_clear_scheduled_hook('elp_cron_hourly_event');
}


function elp_cron_every_interval( $schedules ) {
    $schedules['elp_cron_every_halfhourly'] = array(
            'interval'  => 1800,
            'display'   => __( 'Every 30 Minutes', 'email-posts-to-subscribers' )
    );
	
	$schedules['elp_cron_every_monthly'] = array(
            'interval'  => 2635200,
            'display'   => __( 'Every 30 Days', 'email-posts-to-subscribers' )
    );
     
    return $schedules;
}
add_filter( 'cron_schedules', 'elp_cron_every_interval' );

function elp_cron_activation_halfhourly() {
	if (! wp_next_scheduled ( 'elp_cron_halfhourly_event' )) {
		wp_schedule_event( time(), 'elp_cron_every_halfhourly', 'elp_cron_halfhourly_event' );
    }
	if (! wp_next_scheduled ( 'elp_cron_monthly_event' )) {
		wp_schedule_event( time(), 'elp_cron_every_monthly', 'elp_cron_monthly_event' );
    }
}

function elp_cron_deactivation_halfhourly() {
	wp_clear_scheduled_hook('elp_cron_halfhourly_event');
	wp_clear_scheduled_hook('elp_cron_monthly_event');
}

function elp_cron_trigger_hourly() 
{
	$elp_cron_trigger_option = get_option('elp_cron_trigger_option');
	if ($elp_cron_trigger_option <> "YES")
	{
		return;
	}
	
	$elp_c_croncount = get_option('elp_cron_mailcount');
	if(!is_numeric($elp_c_croncount))
	{
		$elp_c_croncount = 50;
	}
	
	$data = array();
	$data = elp_cls_dbquery::elp_configuration_cron_trigger();
	
	if(count($data) > 0)
	{
		$subject = $data[0]['elp_set_name'];
		$content = elp_cls_newsletter::elp_template_compose($data[0]['elp_set_templid'], $data[0]['elp_set_postcount'], 
				$data[0]['elp_set_postcategory'], $data[0]['elp_set_postorderby'], $data[0]['elp_set_postorder'], $data[0]['elp_set_posttype'], "send");
		
		if($content == "NO_POST_FOUND_FOR_THIS_MAIL_CONFIGURATION")
		{
			$sendguid = elp_cls_common::elp_generate_guid(60);
			$currentdate = date('Y-m-d G:i:s');
			elp_cls_dbquery2::elp_sentmail_ins($sendguid, 0, "cron", $currentdate, $currentdate, 0, $content, "Cron Mail", $subject);
			elp_cls_dbquery::elp_configuration_cron_trigger_update($data[0]['elp_set_guid']);
		}
		else
		{
			if(!is_numeric($data[0]['elp_set_totalsent']))
			{
				$elp_set_totalsent = 9999;
			}
			else
			{
				$elp_set_totalsent = $data[0]['elp_set_totalsent'];
			}
			
			$elp_set_emaillistgroup = $data[0]['elp_set_emaillistgroup'];
			if($elp_set_emaillistgroup == "")
			{
				$elp_set_emaillistgroup = "Public";
			}
			
			elp_cls_sendmail::elp_prepare_newsletter($subject, $content, 1, $elp_set_totalsent, $elp_set_emaillistgroup);
			elp_cls_dbquery::elp_configuration_cron_trigger_update($data[0]['elp_set_guid']);
		}
	}
	//else
	//{
		$sentmail = array();
		$sentmail = elp_cls_dbquery2::elp_sentmail_select_cron_trigger();
		if(count($sentmail) > 0)
		{		
			$delivery = array();
			$delivery = elp_cls_dbquery2::elp_delivery_select_cron_trigger($sentmail[0]['elp_sent_guid'], 0, $elp_c_croncount);
			elp_cls_sendmail::elp_sendmail_cron_trigger("newsletter", $sentmail[0]['elp_sent_subject'], $sentmail[0]['elp_sent_preview'], $delivery);
			elp_cls_dbquery2::elp_sentmail_select_cron_update($sentmail[0]['elp_sent_guid']);
		}
	//}
	elp_cls_dbquerynote::elp_send_notification();
}
add_action('elp_cron_hourly_event', 'elp_cron_trigger_hourly');

function elp_cron_trigger_halfhourly() {
	elp_cls_dbquerynote::elp_send_notification();
}
add_action('elp_cron_halfhourly_event', 'elp_cron_trigger_halfhourly');

function elp_cron_trigger_monthly() {
	elp_cls_optimize::elp_housekeep_sentdetails();
	elp_cls_optimize::elp_housekeep_deliverreport();
}
add_action('elp_cron_monthly_event', 'elp_cron_trigger_monthly');
?>