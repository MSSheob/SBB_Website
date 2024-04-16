<?php
add_action( 'wp_ajax_begin_fill_staffs', 'begin_fill_staffs' ); # For logged-in users
add_action( 'wp_ajax_nopriv_begin_fill_staffs','begin_fill_staffs'); # For logged-out users 
function begin_fill_staffs() {
	if( isset($_REQUEST['service_id']) ){
		
		$service_id = $_REQUEST['service_id'];
		
		if( begin_is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) {
			global $sitepress;
			
			$default_lang = $sitepress->get_default_language();
			$current_lang = ICL_LANGUAGE_CODE;
			
			if( $default_lang != $current_lang ) {
				$service_id =  icl_object_id(  $service_id ,'dt_services', true ,$sitepress->get_default_language());
			}
		}

		$wp_query = new WP_Query();
		$staffs = array(
			'post_type' => 'dt_staffs',
			'posts_per_page' => '-1',
			'meta_query'=>array());

		$staffs['meta_query'][] = array(
			'key'     => '_services',
			'value'   =>  $service_id,
			'compare' => 'LIKE');
		
		$wp_query->query( $staffs );
		echo "<option value=''>".esc_html__('Select','begin')."</option>";
		if( $wp_query->have_posts() ):
			while( $wp_query->have_posts() ):
				$wp_query->the_post();
				$id = get_the_ID();
				$title = get_the_title($id);
				echo "<option value='{$id}'>{$title}</option>";
			endwhile;
		endif;	
	}
	die( '' );
}

//appointment type2
add_action( 'wp_ajax_begin_dt_generate_schedule', 'begin_dt_generate_schedule' );
add_action( 'wp_ajax_nopriv_begin_dt_generate_schedule','begin_dt_generate_schedule');
function begin_dt_generate_schedule() {

	$seldate = $_REQUEST['datepicker'];
	$staffid = $_REQUEST['staffid'];
	$staff = get_the_title($staffid);
	$staffids_str = $_REQUEST['staffids'];
	$serviceid = $_REQUEST['serviceid'];
	$service = get_the_title($serviceid);
	$staffs_arr = array();

	if( empty( $staffid ) ) {
		$wp_query = new WP_Query();
		$staffs = array( 'post_type' => 'dt_staffs', 'orderby'=>'ID', 'order'=>'DESC', 'posts_per_page' => '-1', 'meta_query'=>array());
		
		if($staffids_str != '') {
			$staffids = explode(',', $staffids_str);
			$staffs['post__in'] = $staffids;
		}
		
		$staffs['meta_query'][] = array( 'key' => '_services', 'value' => $serviceid, 'compare' => 'LIKE');
		$wp_query->query( $staffs );
		if( $wp_query->have_posts() ):
			while( $wp_query->have_posts() ):
				$wp_query->the_post();
				$staffid = get_the_ID();
				$staff =  get_the_title($staffid);
				$staffs_arr[$staffid] = $staff;
			endwhile;
		endif;	
		wp_reset_postdata();
	} else {
		$staffs_arr = array($staffid=>$staff);
	}

	$serviceinfo = get_post_meta( $serviceid, "_info",true);
	$serviceinfo = is_array($serviceinfo) ? $serviceinfo : array();
	$service_duration = array_key_exists('duration', $serviceinfo) ? $serviceinfo['duration'] :  1800;

	$out = '';
	$out .= '<h2>'.esc_html__('Select Time','begin').'</h2><div class="dt-sc-single-border-separator"></div><div class="dt-sc-hr-invisible-small"></div>';
	$out .= '<div class="dt-sc-available-times">';

	$seldate = new DateTime($seldate);
	$seldate = $seldate->format('Y-m-d');

	foreach( $staffs_arr as $sid => $sname ) {

		# 1. Get Staff Schedule Time
		$timer = array();
		$meta_times = get_post_meta( $sid, "_staff_info",true);
		$timer = array_merge($meta_times['appointment_fs1'], $meta_times['appointment_fs2'], $meta_times['appointment_fs3'], $meta_times['appointment_fs4'], $meta_times['appointment_fs5'], $meta_times['appointment_fs6'], $meta_times['appointment_fs7']);
		$timer = array_filter($timer);
		$timer = array_diff( $timer, array('00:00'));

		$working_hours = array();

		foreach ( array('monday','tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday') as $day ):
			if(  array_key_exists("dt_company_{$day}_start",$timer)  ):
				$working_hours[$day] = array( 'start' => $timer["dt_company_{$day}_start"] , 'end' => $timer["dt_company_{$day}_end"]);
			endif;	
		endforeach;

		#Staff existing bookings
		$bookings = array();
		global $wpdb;
		$q = "SELECT option_value FROM $wpdb->options WHERE option_name LIKE '_dt_reservation_mid_{$sid}%' ORDER BY option_id ASC";
		$rows = $wpdb->get_results( $wpdb->prepare($q) );
		if( $rows ){
			foreach ($rows as $row ) {
				if( is_serialized($row->option_value ) ) {
					$data = unserialize($row->option_value);
					$data = $data['start'];
					$data = explode("(", $data);
					$data = new DateTime($data[0]);	
					$data = $data->format("Y-m-d G:i:s");
					$bookings[] = $data;
					
				}
			}
		}
		#Staff existing bookings

		$slots = array();

		if( count($working_hours) ){
			$slot = begin_dt_findTimeSlot( $working_hours, $bookings, $seldate, $service_duration );
			if( !empty($slot) ){
				$slots[] = $slot;
			}
		}

		$out .= "<h3 class='staff-name'>";
		$out .= "{$sname}";
		$out .= "</h3>";

		if( !empty($slots) ) {
			
			$sinfo = get_post_meta( $sid , "_info",true);
			$sinfo = is_array($sinfo) ? $sinfo : array();
		
			$out .= '<ul class="time-table">';
			foreach( $slots as $slot ){
				
				if( is_array($slot) ){
					foreach( $slot as $date => $s  ){
						if(is_array($s)){
							$daydate = $date;
							$out .= '<ul class="time-slots">';
							foreach( $s as $time ){
								$start = new DateTime($time->start);
								$start = $start->format( 'm/d/Y H:i');
	
								$end = new DateTime($time->end);
								$end = $end->format( 'm/d/Y H:i');
	
								$date =  new DateTime($time->date);
								$date = $date->format( 'm/d/Y');
	
								$out .= '<li>';
								$out .= "<a href='#' data-staffid='{$sid}' data-staffname='{$sname}' data-serviceid='{$serviceid}' data-start='{$start}' data-end='{$end}' data-date='{$date}' data-time='{$time->hours}' data-daydate='{$daydate}' class='time-slot'>";
								$out .= $time->label;
								$out .= '</a>';
								$out .= '</li>';
							}
							$out .= '</ul>';
						}
						$out .= '</li>';
					}
				}
			}
			$out .= "</ul>";
		} else {
			$out .= '<div class="dt-sc-info-box">'.esc_html__('Time slots not available for your requested date!. Please try again by changing date.', 'begin').'</div>';	
		}
	} # Staffs loops end

	$out .= '</div>';

	echo ($out != '') ? $out : '<p class="dt-sc-info-box">'.esc_html__('No Time slots available','begin').'</p>';
	die();

}
//appointment type2

add_action( 'wp_ajax_begin_available_times', 'begin_available_times' ); # For logged-in users
add_action( 'wp_ajax_nopriv_begin_available_times', 'begin_available_times' ); # For logged-out users
function begin_available_times(){

	$date = $_REQUEST['date'];
	$stime = $_REQUEST['stime'];
	$etime = $_REQUEST['etime'];
	$staff = $_REQUEST['staff'];
	$staffid = $_REQUEST['staffid'];
	$service = $_REQUEST['service'];
	$serviceid = $_REQUEST['serviceid'];
	$mgs = array();
	
	if( empty( $staffid ) ) {
		# Staff
		$wp_query = new WP_Query();
		$staffs = array( 'post_type' => 'dt_staffs', 'orderby'=>'ID', 'order'=>'DESC', 'posts_per_page' => '-1', 'meta_query'=>array());
		$staffs['meta_query'][] = array( 'key' => '_services', 'value' => $serviceid ,'compare' => 'LIKE');
		$wp_query->query( $staffs );
		
		if( $wp_query->have_posts() ):
			while( $wp_query->have_posts() ):
				$wp_query->the_post();
				$staffid = get_the_ID();
				$staff =  get_the_title($staffid);
				$mgs[$staffid] = $staff;
			endwhile;
		endif;	
		# Staff
	} else {
		$mgs = array($staffid=>$staff);
	}
	
	$info = get_post_meta( $serviceid, "_info",true);
	$info = is_array($info) ? $info : array();
	$service_duration = array_key_exists('duration', $info) ? $info['duration'] :  1800;

	$bookings = array();
	$working_hours = array();
	$out = "";
	
	foreach( $mgs as $sid => $sname ) {

		# 1. Get Staff Schedule Time
		$timer = array();
		$meta_times = get_post_meta( $sid, "_staff_info",true);
		$timer = array_merge($meta_times['appointment_fs1'], $meta_times['appointment_fs2'], $meta_times['appointment_fs3'], $meta_times['appointment_fs4'], $meta_times['appointment_fs5'], $meta_times['appointment_fs6'], $meta_times['appointment_fs7']);
		$timer = array_filter($timer);
		$timer = array_diff( $timer, array('00:00'));

		$working_hours = array();

		foreach ( array('monday','tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday') as $day ):
			if(  array_key_exists("dt_company_{$day}_start",$timer)  ):
				$working_hours[$day] = array( 'start' => $timer["dt_company_{$day}_start"] , 'end' => $timer["dt_company_{$day}_end"]);
			endif;	
		endforeach;
		
		#Staff existing bookings
		global $wpdb;
		$q = "SELECT option_value FROM $wpdb->options WHERE option_name LIKE '_dt_reservation_mid_{$staffid}%' ORDER BY option_id ASC";
		$rows = $wpdb->get_results( $q );
		if( $rows ){
			foreach ($rows as $row ) {
				if( is_serialized($row->option_value ) ) {
					$data = unserialize($row->option_value);
					$data = $data['start'];
					$data = explode("(", $data);
					$data = new DateTime($data[0]);	
					$data = $data->format("Y-m-d G:i:s");
					$bookings[] = $data;
				}
			}
		}
		#Staff existing bookings
		
		$slots = array();
		
		if( count($working_hours) ){
			//$loop = ( count($working_hours) == 7 ) ? 7 : 10;
			$loop = 7;
			$i = 0;
			
			while( $i < $loop ){
				$slot = begin_findTimeSlot( $working_hours, $bookings, $date , $service_duration );
				if( !empty($slot) ){
					$slots[] = $slot;
				}
				$date = new DateTime($date);
				$date->modify("+1 day");
				$date = $date->format('Y-m-d');
				$i++;
			}#endwhile
		}
		
		
		if( !empty($slots) ) {
			$out .= "<div class='dt-sc-title with-right-border-decor'><h3>";
			$out .= "{$sname}";
			$out .= "</h3></div>";
			$out .= "<ul class='time-table'>";
			foreach( $slots as $slot ){
				if( is_array($slot) ){
					foreach( $slot as $date => $s  ){
						$out .= "<li> <span> {$sname} {$date} </span>";
						if(is_array($s)){
							$out .= "<ul class='time-slots' >";
							foreach( $s as $time ){
								$start = new DateTime($time->start);
								$start = $start->format( 'm/d/Y H:i');

								$end = new DateTime($time->end);
								$end = $end->format( 'm/d/Y H:i');

								$date =  new DateTime($time->date);
								$date = $date->format( 'm/d/Y');

								$out .= '<li>';
								$out .= "<a href='#' data-sid='{$sid}' data-start='{$start}' data-end='{$end}' data-date='{$date}' data-time='{$time->hours}' class='time-slot'>";
								$out .= $time->label;
								$out .= '</a>';
								$out .= '</li>';
							}
							$out .= '</ul>';
						}
						$out .= '</li>';
					}
				}
			}
			$out .= "</ul>";
		}	
	} # Staffs loops end
	
	if( empty($out) )
		echo '<p class="dt-sc-info-box">'.esc_html__('No Time slots available','begin').'</p>';
	else
		echo $out;
		
	die('');
}

function begin_findTimeSlot( $working_hours, $bookings, $date , $service_duration = 1800 ){

	$time_format = get_option('time_format');

	$timeslot= array();
	$dayofweek = date('l',strtotime($date));
	$dayofweek = strtolower($dayofweek);

	$is_date_today = ($date == date( 'Y-m-d', current_time( 'timestamp' ) ) );
	$current_time  = date( 'H:i:s', ceil( current_time( 'timestamp' ) / 900 ) * 900 );

	$past = ( $date <  date('Y-m-d') ) ? true : false;
	
	if( array_key_exists($dayofweek, $working_hours)  && !$past ){

		$working_start_time = ($is_date_today && $current_time > $working_hours[ $dayofweek ][ 'start' ]) ? $current_time : $working_hours[ $dayofweek ][ 'start' ];
		$working_end_time = $working_hours[ $dayofweek ][ 'end' ];

		$show = $is_date_today && ($current_time > $working_end_time) ? false : true;
		if( $show ) {

			$intersection = begin_findInterSec( $working_start_time,$working_hours[ $dayofweek ][ 'end' ],$_REQUEST['stime'],$_REQUEST['etime']);

			for( $time = begin_StrToTime($intersection['start']); $time <= ( begin_StrToTime($intersection['end']) - $service_duration ); $time += $service_duration ){

				$value = $date.' '.date('G:i:s', $time);
				$end = $date.' '.date('G:i:s', ($time+$service_duration));
				
				if( !in_array($value, $bookings) ) { # if already booked in $time
					$object = new stdClass();
					$object->label = date( $time_format, $time );
					$object->date = $date;
					$object->start = $value;
					$object->hours = date('g:i A', $time).' - '.date('g:i A', ($time+$service_duration));
					$object->end = $end;
					$translatable_day =  begin_translatableDay( date('l',strtotime($date)) );
					$p = $date.' ('.$translatable_day.')';
					$timeslot[$p][$time] = $object;
				}
			}
		}
	}
	
	return $timeslot;
}

//appointment type2
function begin_dt_findTimeSlot( $working_hours, $bookings, $date , $service_duration = 1800 ){
	
	$time_format = get_option('time_format');
	
	$timeslot= array();
	$dayofweek = date('l',strtotime($date));
	$dayofweek = strtolower($dayofweek);

	$is_date_today = ($date == date( 'Y-m-d', current_time( 'timestamp' ) ) );
	$current_time  = date( 'H:i:s', ceil( current_time( 'timestamp' ) / 900 ) * 900 );

	$past = ( $date <  date('Y-m-d') ) ? true : false;
	

	if( array_key_exists($dayofweek, $working_hours)  && !$past ){

		$working_start_time = ($is_date_today && $current_time > $working_hours[ $dayofweek ][ 'start' ]) ? $current_time : $working_hours[ $dayofweek ][ 'start' ];
		$working_end_time = $working_hours[ $dayofweek ][ 'end' ];

		$show = $is_date_today && ($current_time > $working_end_time) ? false : true;
		if( $show ) {
			
			$intersection = begin_findInterSec( $working_start_time,$working_hours[ $dayofweek ][ 'end' ],'00:00','23:59');
			
			for( $time = begin_StrToTime($intersection['start']); $time <= ( begin_StrToTime($intersection['end']) - $service_duration ); $time += $service_duration ){

				$value = $date.' '.date('G:i:s', $time);
				$end = $date.' '.date('G:i:s', ($time+$service_duration));

				if( !in_array($value, $bookings) ) { # if already booked in $time
					$object = new stdClass();
					$object->label = date( $time_format, $time );
					$object->date = $date;
					$object->start = $value;
					$object->hours = date('g:i A', $time).' - '.date('g:i A', ($time+$service_duration));
					$object->end = $end;
					$p = $date.' ('.date('l',strtotime($date)).')';
					$timeslot[$p][$time] = $object;
				}
			}
		}
	}
	return $timeslot;
}
//appointment type2

function begin_translatableDay( $day ) {
	
	switch( $day ):
		case 'Sunday':
			$day = esc_html__('Sunday','begin');
		break;
	
		case 'Monday':
			$day = esc_html__('Monday','begin');
		break;

		case 'Tuesday':
			$day = esc_html__('Tuesday','begin');
		break;

		case 'Wednesday':
			$day = esc_html__('Wednesday','begin');
		break;

		case 'Thursday':
			$day = esc_html__('Thursday','begin');
		break;

		case 'Friday':
			$day = esc_html__('Friday','begin');
		break;

		case 'Saturday':
			$day = esc_html__('Saturday','begin');
		break;
	endswitch;
	
	return $day;
}

function begin_findInterSec( $p1_start, $p1_end, $p2_start, $p2_end ) {
	$result = false;
	if ( $p1_start <= $p2_start && $p1_end >= $p2_start && $p1_end <= $p2_end ) {
		$result = array( 'start' => $p2_start, 'end' => $p1_end );
	} else if ( $p1_start <= $p2_start && $p1_end >= $p2_end ) {
		$result = array( 'start' => $p2_start, 'end' => $p2_end );
	} else if ( $p1_start >= $p2_start && $p1_start <= $p2_end && $p1_end >= $p2_end ) {
		$result = array( 'start' => $p1_start, 'end' => $p2_end );
	} else if ( $p1_start >= $p2_start && $p1_end <= $p2_end ) {
		$result = array( 'start' => $p1_start, 'end' => $p1_end );
    }
	return $result;
}

function begin_StrToTime( $str ) {
	return strtotime( sprintf( '1985-03-17 %s', $str ) );
}


#Front End - tpl-reservation ajax
function begin_customer( $name, $email, $phone ){

	$user = array('name'=>$name,'emailid'=>$email,'phone'=>$phone);
	$users = array();

	$wp_query = new WP_Query();
	$customers = array('post_type'=>'dt_customers','posts_per_page'=>-1,'order_by'=>'published');
	
		$wp_query->query($customers);
		if( $wp_query->have_posts() ):
			while( $wp_query->have_posts() ):
				$wp_query->the_post();
				$the_id = get_the_ID();
				$title = get_the_title($the_id);

				$info = get_post_meta ( $the_id, "_info",true);
				$info = is_array($info) ? $info : array();
				$info['name'] = $title;
				$users[$the_id] = $info;
			endwhile;
		endif;

	$uid = array_search( $user, $users);

	if( $uid  ){
		$uid = $uid;
	} else {
		#Insert new customer
		$post_id = wp_insert_post( array('post_title' => $user['name'], 'post_type' => 'dt_customers', 'post_status' => 'publish'));
		if( $post_id > 0 ) {
			$info['emailid'] = $user['emailid'];
			$info['phone'] = $user['phone'];
			update_post_meta ( $post_id, "_info",$info);
			$uid = $post_id;
		}
	}
	return $uid;
}

//appointment type2
function begin_appointment_type2_customer( $customer ){

	$user = $customer;
	$users = array();

	$wp_query = new WP_Query();
	$customers = array('post_type'=>'dt_customers','posts_per_page'=>-1,'order_by'=>'published');
	
		$wp_query->query($customers);
		if( $wp_query->have_posts() ):
			while( $wp_query->have_posts() ):
				$wp_query->the_post();
				$the_id = get_the_ID();
				$title = get_the_title($the_id);

				$info = get_post_meta ( $the_id, "_info",true);
				$info = is_array($info) ? $info : array();
				$info['name'] = $title;
				$users[$the_id] = $info;
			endwhile;
		endif;

	$uid = array_search( $user, $users);

	if( $uid  ){
		$uid = $uid;
	} else {
		#Insert new customer
		$post_id = wp_insert_post( array('post_title' => $user['firstname'].' '.$user['lastname'], 'post_type' => 'dt_customers', 'post_status' => 'publish'));
		if( $post_id > 0 ) {
			$info['firstname'] = $user['firstname'];
			$info['lastname'] = $user['lastname'];
			$info['phone'] = $user['phone'];
			$info['emailid'] = $user['emailid'];
			$info['address'] = $user['address'];
			$info['aboutyourproject'] = $user['aboutyourproject'];
			update_post_meta ($post_id, "_info", $info);
			$uid = $post_id;
		}
	}
	return $uid;
}
//appointment type2

add_action( 'wp_ajax_begin_new_reservation', 'begin_new_reservation' ); # For logged-in users
add_action( 'wp_ajax_nopriv_begin_new_reservation','begin_new_reservation'); # For logged-out users
function begin_new_reservation(){
	global $wpdb;

	#New Customer
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		$customer = begin_customer($name,$email,$phone);
	#New Customer
	
	$id = $wpdb->get_var("SELECT max(option_id) FROM $wpdb->options");
	$title = esc_html__("New Reservation By ",'begin').$name;
	$body =  $_REQUEST['body'];

	$staff = $_REQUEST['staff'];
	$service = $_REQUEST['service'];
	if( begin_is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) {
		global $sitepress;
		
		$default_lang = $sitepress->get_default_language();
		$current_lang = ICL_LANGUAGE_CODE;
		
		if( $default_lang != $current_lang ) {
			$service =  icl_object_id(  $service ,'dt_services', true ,$sitepress->get_default_language());
		}
	}
	
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];

	$option = "_dt_reservation_mid_{$staff}_id_{$id}";
	
	$data = array( 'id' => $id, 'title' => $title, 'body' => $body, 'start'=> $start, 'end'=>$end, 'service'=>$service, 'user'=>$customer, 'readOnly'=>true );
	
	# Sending Mail
	$client_name = $client_phone = $client_email = $amount = "";
	
	#Staff
	$staff_name = get_the_title($staff);
	$service_name = get_the_title($service);

	$sinfo = get_post_meta( $staff , "_staff_info",true);
	$sinfo = is_array($sinfo) ? $sinfo : array();
	$staff_price = array_key_exists("price", $sinfo) ? $sinfo['price'] : 0;
	$staff_price = floatval($staff_price);

	#Service Price
	if( !empty( $data['service']) ){
		$serviceinfo = get_post_meta($data['service'],'_info',true );
		$serviceinfo = is_array( $serviceinfo ) ? $serviceinfo : array();
		$service_price = array_key_exists("price", $serviceinfo) ? $serviceinfo['price'] : 0;
		$service_price = floatval($service_price);
	}

	$amount = ( ($staff_price+$service_price) > 0 ) ?  begin_currency_symbol( cs_get_option('appointment-currency') ).' '.( $staff_price+$service_price ) : $amount;
	
	#Client
	if( !empty($data['user']) ){

		$client_name = get_the_title($data['user']);
		$cinfo = get_post_meta( $data['user'], "_info",true);
		$cinfo = is_array($cinfo) ? $cinfo : array();

		$client_email = array_key_exists('emailid', $cinfo) ? $cinfo['emailid'] : "";
		$client_phone = array_key_exists('phone', $cinfo) ? $cinfo['phone'] : "";;
	}

	#Admin
	$user_info = get_userdata(1);
	$admin_name = $user_info->nickname;
	$admin_email = $user_info->user_email;

	$array = array(
		'admin_name' => $admin_name,
		'staff_name' => $staff_name,
		'service_name' => $service_name,
		'appointment_id' => $data['id'],
		'appointment_time' => $_POST['time'],
		'appointment_date' => $_POST['date'],
		'appointment_title' => $data['title'],
		'appointment_body' =>  $data['body'],
		'client_name' => $client_name,
		'client_phone' => $client_phone,
		'client_email' => $client_email,
		'amount' => $amount,
		'company_logo' => 'Company Logo',
		'company_name' => 'Company Name',
		'company_phone' => 'Company Phone',
		'company_address' => 'Company Address',
		'company_website' => 'Company Website');

		#Admin Mail
		$subject =  cs_get_option('appointment_notification_to_admin_subject');
		$subject = begin_replace( $subject, $array);
		
		$message =  cs_get_option('appointment_notification_to_admin_message' );
		$message = begin_replace( $message, $array);
		begin_send_mail( $admin_email, $subject, $message);
		

		#Staff Mail
		$subject = cs_get_option('appointment_notification_to_staff_subject');
		$subject = begin_replace( $subject, $array);

		$message = cs_get_option('appointment_notification_to_staff_message');
		$message = begin_replace( $message, $array);
		begin_send_mail( $sinfo["emailid"], $subject, $message);

		#Client Mail
		if( !empty($client_email) ) {
			$subject = cs_get_option('appointment_notification_to_client_subject');
			$subject = begin_replace( $subject, $array);

			$message = cs_get_option('appointment_notification_to_client_message');
			$message = begin_replace( $message, $array);

			begin_send_mail( $client_email, $subject, $message);
		}


	# Sending Mail
	if( update_option( $option, $data ) ){
		#echo "Added";
		
		#Add Payment Details to options table
		$payment_id = str_replace('_dt_reservation_',"_dt_payment_",$option);
		#$amount = trim(str_replace(dt_currency_symbol( get_option("dt_currency") ),"",$amount));
		$amount = $staff_price+$service_price;

		$payment_data = array( 
			'date' =>  date('Y-m-d H:i:s'),
			'service' => get_the_title($data['service']),
			'type' => 'local',
			'customer_id' =>$data['user'],
			'total'=> $amount);

		update_option($payment_id,$payment_data);
		# $result['url'] = home_url();
		
		$url = begin_get_page_permalink_by_its_template('tpl-reservation.php');
		$url = add_query_arg( array('action'=>'success'), $url );
		$result['url'] =  $url;
		echo json_encode( $result );
	}else{
		echo "FAiled";
	}
	die('');
}

add_action( 'wp_ajax_begin_paypal_request', 'begin_paypal_request' ); # For logged-in users
add_action( 'wp_ajax_nopriv_begin_paypal_request','begin_paypal_request'); # For logged-out users
function begin_paypal_request() {

	global $wpdb;

	#New Customer
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$phone = $_REQUEST['phone'];
		$customer = begin_customer($name,$email,$phone);
	#New Customer

	$id = $wpdb->get_var("SELECT max(option_id) FROM $wpdb->options");
	$title = esc_html__("New Reservation By ",'begin').$name;
	$body =  $_REQUEST['body'];

	$staff = $_REQUEST['staff'];
	$service = $_REQUEST['service'];
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];

	$option = "_dt_reservation_mid_{$staff}_id_{$id}";
	$data = array( 'id' => $id, 'title' => $title, 'body' => $body, 'start'=> $start, 'end'=>$end, 'service'=>$service, 'user'=>$customer, readOnly=>true );

	# Amount Calculation
		$sinfo = get_post_meta( $staff , "_staff_info",true);
		$sinfo = is_array($sinfo) ? $sinfo : array();
		$staff_price = array_key_exists("price", $sinfo) ? $sinfo['price'] : 0;
		$staff_price = floatval($staff_price);

		$serviceinfo = get_post_meta($data['service'],'_info',true );
		$serviceinfo = is_array( $serviceinfo ) ? $serviceinfo : array();
		$service_price = array_key_exists("price", $serviceinfo) ? $serviceinfo['price'] : 0;
		$service_price = floatval($service_price);
		$amount = ($staff_price+$service_price);
	# Amount Calculation

	# Paypal
	if( update_option( $option, $data ) ) {
		
		$mode = cs_get_option('enable-paypal-live') ? "" : ".sandbox";
		$uname = cs_get_option('paypal-username');
		$currency_code = cs_get_option('appointment-currency');
		
		$url = add_query_arg( array( 
			'cmd' => '_xclick',
			'item_name' => esc_html__("Service :",'begin').' '.get_the_title($service).' - '. esc_html__("Time :",'begin').$_REQUEST['date'].'('.$_REQUEST['time'].')',
			'item_number' => $option,
			'business' => $uname,
			'currency_code' => $currency_code,
			'amount' => $amount,
			'return' => add_query_arg( array( 'action'=>'dt_paypal_retrun', 'res'=>$option ) , home_url('/')  ) ,
			'cancel_return' => add_query_arg ( array( 'action'=>'dt_paypal_cancel', 'res'=>$option ), home_url('/')  )		
			
		 ), 'https://www'.$mode.'.paypal.com/cgi-bin/webscr' );
		
		$result['url'] = $url;
		echo json_encode( $result );
	}
	
	die('');
}
#Paypal Express Checkout End

add_action( 'wp_loaded', 'begin_paypal_listener' ); # Paypal ExpressCheckout redirect 
function begin_paypal_listener() {

	if( isset( $_GET['action'] ) ) {
		switch ( $_GET['action'] ) {

			case 'dt_paypal_cancel':
				$args = array('action','res');
				delete_option($_GET['res']);
				$url = begin_get_page_permalink_by_its_template('tpl-reservation.php');
				$url = add_query_arg( array( 'action' => 'error' ) , $url );
				wp_safe_redirect($url);
				exit;
			break;

			case 'dt_paypal_retrun':		
				#if( isset( $_REQUEST['st'] ) && ( $_REQUEST['st'] == 'Completed' ) ) {
					
					$reservation = get_option($_REQUEST['item_number']);
					
					$staff = explode("_",$_REQUEST['item_number']);
					$staff_name = get_the_title($staff[4]);
					$service_name = get_the_title($reservation['service']);
					$start = new DateTime($reservation['start']);
					$end = new DateTime($reservation['end']);
					$date = date_format($start, "Y/m/d");
					$time = date_format($start,"g:i a").' - '.date_format($end,"g:i a");
	
					$client_name = get_the_title($reservation['user']);
					$cinfo = get_post_meta( $reservation['user'], "_info",true);
					$cinfo = is_array($cinfo) ? $cinfo : array();
					$client_email = array_key_exists('emailid', $cinfo) ? $cinfo['emailid'] : "";
					$client_phone = array_key_exists('phone', $cinfo) ? $cinfo['phone'] : "";
	
					#Staff Price
					$sinfo = get_post_meta( $staff[4] , "_staff_info",true);
					$sinfo = is_array($sinfo) ? $sinfo : array();
					$staff_price = array_key_exists("price", $sinfo) ? $sinfo['price'] : 0;
					$staff_price = floatval($staff_price);
	
					#Service Price
					$serviceinfo = get_post_meta($reservation['service'],'_info',true );
					$serviceinfo = is_array( $serviceinfo ) ? $serviceinfo : array();
					$service_price = array_key_exists("price", $serviceinfo) ? $serviceinfo['price'] : 0;
					$service_price = floatval($service_price);
	
					$amount = ( ($staff_price+$service_price) > 0 ) ? ( $staff_price+$service_price ) : "";
					
					$currency_code = cs_get_option('appointment-currency');
					$amount = !empty( $amount ) ? $currency_code . $amount.' ['.$_REQUEST['st'].']' : '';
					
					#Admin
					$user_info = get_userdata(1);
					$admin_name = $user_info->nickname;
					$admin_email = $user_info->user_email;

					$array = array(
						'admin_name' => $admin_name,
						'admin_email' => $admin_email,
						'staff_name' => $staff_name,
						'service_name' => $service_name,
						'appointment_id' => $reservation['id'],
						'appointment_time' => $time,
						'appointment_date' => $date,
						'appointment_title' => $reservation['title'],
						'appointment_body' =>  $reservation['body'],
						'client_name' => $client_name,
						'client_phone' => $client_phone,
						'client_email' => $client_email,
						'amount' => $amount,
						'company_logo' => 'Company Logo',
						'company_name' => 'Company Name',
						'company_phone' => 'Company Phone',
						'company_address' => 'Company Address',
						'company_website' => 'Company Website');
					
					#Admin Mail
					$subject =  cs_get_option('appointment_notification_to_admin_subject');
					$subject = begin_replace( $subject, $array);
					
					$message =  cs_get_option('appointment_notification_to_admin_message' );
					$message = begin_replace( $message, $array);

					begin_send_mail( $admin_email, $subject, $message);
					
					
					#Staff Mail
					$subject =  cs_get_option('appointment_notification_to_staff_subject');
					$subject = begin_replace( $subject, $array);

					$message =  cs_get_option('appointment_notification_to_staff_message' );
					$message = begin_replace( $message, $array);

					begin_send_mail( $sinfo["emailid"], $subject, $message);

					#Customer Mail
					$subject =  cs_get_option('appointment_notification_to_client_subject');
					$subject = begin_replace( $subject, $array);

					$message =  cs_get_option('appointment_notification_to_client_message' );
					$message = begin_replace( $message, $array);

					begin_send_mail( $client_email, $subject, $message);

					#Add Payment Details to options table
					$payment_id = str_replace('_dt_reservation_',"_dt_payment_",$_REQUEST['item_number']);
					
					$payment_data = array( 
						'date' =>  date('Y-m-d H:i:s'),
						'service' => get_the_title($reservation['service']),
						'type' => 'paypal',
						'customer_id' =>$reservation['user'],
						'status' => $_REQUEST['st'],
						'transaction_id'=> $_REQUEST['tx'],
						'total'=> urldecode( $_REQUEST['amt']));
					update_option($payment_id,$payment_data);
					
					$url = begin_get_page_permalink_by_its_template('tpl-reservation.php');
					$url = add_query_arg( array( 'action' => 'success' ) , $url );
					
					wp_safe_redirect($url);
					exit();
				#} # st == Completed
			break;
		}
	}
}

/* Calender */
function begin_replace( $content , $array ){
    $replace = array(
	 '[ADMIN_NAME]' => $array['admin_name'],
     '[STAFF_NAME]' => $array['staff_name'],
     '[SERVICE]' => $array['service_name'],
     '[CLIENT_NAME]' => $array['client_name'],
     '[CLIENT_PHONE]' => $array['client_phone'],
     '[CLIENT_EMAIL]' => $array['client_email'],
     '[APPOINTMENT_ID]' => $array['appointment_id'],
     '[APPOINTMENT_TIME]' => $array['appointment_time'],
     '[APPOINTMENT_DATE]' => $array['appointment_date'],
     '[APPOINTMENT_TITLE]' => $array['appointment_title'],   
     '[APPOINTMENT_BODY]' => $array['appointment_body'],
     '[AMOUNT]' => $array['amount'],
     '[COMPANY_LOGO]' => $array['company_logo'],
     '[COMPANY_NAME]' => $array['company_name'],
     '[COMPANY_PHONE]' => $array['company_phone'],
     '[COMPANY_ADDRESS]' => $array['company_address'],
     '[COMPANY_WEBSITE]' => $array['company_website']);

    return str_replace( array_keys( $replace ), array_values( $replace ), $content );
}

function begin_replace_agenda( $content , $array ){
    $replace = array(
     '[STAFF_NAME]' => $array['staff_name'],
     '[TOMORROW]' => $array['tomorrow'],
     '[TOMORROW_AGENDA]' => $array['tomorrow_agenda'],
     '[COMPANY_LOGO]' => $array['company_logo'],
     '[COMPANY_NAME]' => $array['company_name'],
     '[COMPANY_PHONE]' => $array['company_phone'],
     '[COMPANY_ADDRESS]' => $array['company_address'],
     '[COMPANY_WEBSITE]' => $array['company_website']);

    return str_replace( array_keys( $replace ), array_values( $replace ), $content );
}

function begin_currency_symbol( $currency = '' ) {
	switch( $currency ) {
		case 'AUD': 
		case 'CAD': 
		case 'HKD':
		case 'MXN':
		case 'NZD':
		case 'SGD':
		case 'USD':
		default:   
			$symbol = '&#36;';
		break;
		case 'BRL': 
			$symbol = '&#82;&#36;';
		break;
		case 'CZK': 
			$symbol = '&#75;&#269;';
		break;
		case 'DKK': 
			$symbol = '&#107;&#114;';
		break;
		case 'EUR': 
			$symbol = '&euro;';
		break;
		case 'HUF': 
			$symbol = '&#70;&#116;';
		break;
		case 'ILS': 
			$symbol = '&#8362;';
		break;
		case 'JPY': 
			$symbol = '&yen;';
		break;
		case 'MYR': 
			$symbol = '&#82;&#77;';
		break;
		case 'NOK': 
			$symbol = '&#107;&#114;';
		break;
		case 'PHP': 
			$symbol = '&#8369;';
		break;
		case 'PLN': 
			$symbol = '&#122;&#322;';
		break;
		case 'GBP': 
			$symbol = '&pound;';
		break;
		case 'RUB': 
			$symbol = '&#1088;&#1091;&#1073;.';
		break;

		case 'SEK': 
			$symbol = '&#107;&#114;';
		break;
		case 'CHF': 
			$symbol = '&#67;&#72;&#70;';
		break;
		case 'TWD': 
			$symbol = '&#78;&#84;&#36;';
		break;
		case 'THB': 
			$symbol = '&#3647;';
		break;
		case 'TRY': 
			$symbol = '&#84;&#76;';
		break;
	}
	
	return $symbol;	
}

function begin_currencies() {
	return array_unique( array(
		'AUD' => __('Australian Dollar','begin').' - '.'AUD',
		'BRL' => __('Brazilian Real ','begin').' - '.'BRL',
		'CAD' => __('Canadian Dollar','begin').' - '.'CAD',
		'CZK' => __('Czech Koruna','begin').' - '.'CZK',
		'DKK' => __('Danish Krone','begin').' - '.'DKK',
		'EUR' => __('Euro','begin').' - '.'EUR',
		'HKD' => __('Hong Kong Dollar','begin').' - '.'HKD',
		'HUF' => __('Hungarian Forint','begin').' - '.'HUF',
		'ILS' => __('Israeli New Sheqel','begin').' - '.'ILS',
		'JPY' => __('Japanese Yen','begin').' - '.'JPY',
		'MYR' => __('Malaysian Ringgit','begin').' - '.'MYR',
		'MXN' => __('Mexican Peso','begin').' - '.'MXN',
		'NOK' => __('Norwegian Krone','begin').' - '.'NOK',
		'NZD' => __('New Zealand Dollar','begin').' - '.'NZD',
		'PHP' => __('Philippine Peso','begin').' - '.'PHP',
		'PLN' => __('Polish Zloty','begin').' - '.'PLN',
		'GBP' => __('Pound Sterling','begin').' - '.'GBP',
		'RUB' => __('Russian Ruble','begin').' - '.'RUB',
		'SGD' => __('Singapore Dollar','begin').' - '.'SGD',
		'SEK' => __('Swedish Krona','begin').' - '.'SEK',
		'CHF' => __('Swiss Franc','begin').' - '.'CHF',
		'TWD' => __('Taiwan New Dollar','begin').' - '.'TWD',
		'THB' => __('Thai Baht','begin').' - '.'THB',
		'TRY' => __('Turkish Lira','begin').' - '.'TRY',
		'USD' => __('U.S. Dollar','begin').' - '.'USD'
	) );
}

function begin_currency_with_symbol() {

	$cws = array();
	$currencies = begin_currencies();

	foreach( $currencies as $code => $name ) {
		$symbol = begin_currency_symbol( $code );

		$cws[$code] = $name.' ('.$symbol.')';
	}
	return $cws;
}

function begin_durToString( $duration ) {

    $hours   = (int)( $duration / 3600 );
    $minutes = (int)( ( $duration % 3600 ) / 60 );
    $result  = '';
    if ( $hours > 0 ) {
        $result = sprintf( __( '%d h', 'begin' ), $hours );
        if ( $minutes > 0 ) {
            $result .= ' ';
        }
    }

    if ( $minutes > 0 ) {
        $result .= sprintf( __( '%d min', 'begin' ), $minutes );
    }
 return $result;
}

function begin_dates_range( $start_date, $end_date, $days = array() ){

    $interval = new DateInterval( 'P1D' );

    $realEnd = new DateTime( $end_date );
    $realEnd->add( $interval );

    $period = new DatePeriod( new DateTime( $start_date ), $interval, $realEnd );
    $dates = array();

    foreach ( $period as $date ) {
        $dates[] = in_array( strtolower( $date->format('l')) , $days ) ? $date->format( 'Y-m-d l' ) :"" ;
    }
    
    $dates = array_filter($dates);
    return $dates;
}

function begin_send_mail( $to, $subject, $message ){
	$sender_name =  cs_get_option('notification_sender_name');
	$sender_name = !empty($sender_name) ? $sender_name : get_option( 'blogname' );

	$sender_email = cs_get_option('notification_sender_email');
	$sender_email = !empty( $sender_email ) ? $sender_email : get_option( 'admin_email' );

	$from = $sender_name."<{$sender_email}>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from.'' . "\r\n";
	return @mail( $to, $subject, $message, $headers );
}
/* Calender */

//appointment type2
add_action( 'wp_ajax_begin_dttheme_new_reservation', 'begin_dttheme_new_reservation' ); # For logged-in users
add_action( 'wp_ajax_nopriv_begin_dttheme_new_reservation','begin_dttheme_new_reservation'); # For logged-out users
function begin_dttheme_new_reservation(){
	global $wpdb;

	#New Customer
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$phone = $_REQUEST['phone'];
	$emailid = $_REQUEST['emailid'];
	$address = $_REQUEST['address'];
	$aboutyourproject = $_REQUEST['aboutyourproject'];

	$customer_data = array('firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone, 'emailid' => $emailid, 'address' => $address, 'aboutyourproject' => $aboutyourproject);
	$customer = begin_appointment_type2_customer($customer_data);
	#New Customer

	$id = $wpdb->get_var("SELECT max(option_id) FROM $wpdb->options");
	$title = esc_html__("New Reservation By ",'begin').$firstname;
	$body =  $aboutyourproject;

	$staffid = $_REQUEST['staffid'];
	$serviceid = $_REQUEST['serviceid'];
	if( begin_is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) {
		global $sitepress;
		$default_lang = $sitepress->get_default_language();
		$current_lang = ICL_LANGUAGE_CODE;
		if( $default_lang != $current_lang ) {
			$serviceid =  icl_object_id(  $serviceid ,'dt_services', true ,$sitepress->get_default_language());
		}
	}

	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];

	$option = "_dt_reservation_mid_{$staffid}_id_{$id}";
	$data = array( 'id' => $id, 'title' => $title, 'body' => $body, 'start'=> $start, 'end'=>$end, 'service'=>$serviceid, 'user'=>$customer, 'readOnly'=>true );

	# Sending Mail
	$client_name = $client_phone = $client_email = $client_address = $amount = '';

	#Staff
	$staff_name = get_the_title($staffid);
	$service_name = get_the_title($serviceid);

	$sinfo = get_post_meta( $staffid , "_staff_info",true);
	$sinfo = is_array($sinfo) ? $sinfo : array();
	$staff_price = array_key_exists("price", $sinfo) ? $sinfo['price'] : 0;
	$staff_price = floatval($staff_price);

	#Service Price
	if( !empty( $data['service']) ){
		$serviceinfo = get_post_meta($data['service'],'_info',true );
		$serviceinfo = is_array( $serviceinfo ) ? $serviceinfo : array();
		$service_price = array_key_exists("price", $serviceinfo) ? $serviceinfo['price'] : 0;
		$service_price = floatval($service_price);
	}

	$amount = ( ($staff_price+$service_price) > 0 ) ?  begin_currency_symbol( cs_get_option('appointment-currency') ).' '.( $staff_price+$service_price ) : $amount;

	#Client
	if( !empty($data['user']) ){
		$client_name = get_the_title($data['user']);
		$cinfo = get_post_meta( $data['user'], "_info",true);
		$cinfo = is_array($cinfo) ? $cinfo : array();

		$client_email = array_key_exists('emailid', $cinfo) ? $cinfo['emailid'] : "";
		$client_phone = array_key_exists('phone', $cinfo) ? $cinfo['phone'] : "";
		$client_address = array_key_exists('address', $cinfo) ? $cinfo['address'] : "";
	}

	#Admin
	$user_info = get_userdata(1);
	$admin_name = $user_info->nickname;
	$admin_email = $user_info->user_email;

	$array = array(
		'staff_name' => $staff_name,
		'service_name' => $service_name,
		'appointment_id' => $data['id'],
		'appointment_time' => $_REQUEST['time'],
		'appointment_date' => $_REQUEST['date'],
		'appointment_title' => $data['title'],
		'appointment_body' =>  $data['body'],
		'client_name' => $client_name,
		'client_phone' => $client_phone,
		'client_email' => $client_email,
		'client_address' => $client_address,
		'amount' => $amount,
		'admin_name' => $admin_name,
		'admin_email' => $admin_email,
		'company_logo' => 'Company Logo',
		'company_name' => 'Company Name',
		'company_phone' => 'Company Phone',
		'company_address' => 'Company Address',
		'company_website' => 'Company Website');
	
	$subject = cs_get_option('appointment_notification_to_staff_subject');
	$subject = begin_replace( $subject, $array);

	$message = cs_get_option('appointment_notification_to_staff_message');
	$message = begin_replace( $message, $array);

	#Staff Mail
	begin_send_mail( $sinfo["emailid"], $subject, $message);

	#Client Mail
	if( !empty($client_email) ) {
		$subject = cs_get_option('appointment_notification_to_client_subject');
		$subject = begin_replace( $subject, $array);

		$message = cs_get_option('appointment_notification_to_client_message');
		$message = begin_replace( $message, $array);

		begin_send_mail( $client_email, $subject, $message);
	}

	#Admin Mail
	if( !empty($admin_email) ) {
		$subject = cs_get_option('appointment_notification_to_admin_subject');
		$subject = begin_replace( $subject, $array);

		$message = cs_get_option('appointment_notification_to_admin_message');
		$message = begin_replace( $message, $array);

		begin_send_mail( $admin_email, $subject, $message);
	}

	# Sending Mail
	if( update_option( $option, $data ) ){
		echo json_encode('Success');
	} else {
		echo json_encode('Failed');
	}
	die('');

} ?>