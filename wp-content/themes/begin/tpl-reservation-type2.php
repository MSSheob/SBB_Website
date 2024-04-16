<?php
/*
Template Name: Reservation Type2 Template
*/
get_header();
	$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";

	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";

	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "page-with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "page-with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;
		
		case 'with-both-sidebar':
			$page_layout = "page-with-sidebar with-both-sidebar";
			$show_sidebar = $show_left_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-both-sidebar";
		break;

		case 'content-full-width':
		default:
			$page_layout = "content-full-width";
		break;
	} 
	
	if ( $show_sidebar ):
		if ( $show_left_sidebar ): ?>
			<!-- Secondary Left -->
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('left');?></section><?php
		endif;
	endif; ?>
<!-- ** Primary Section ** -->
<section id="primary" class="<?php echo esc_attr($page_layout); ?>"><?php
		if( have_posts() ):
			while( have_posts() ):
				the_post();
				get_template_part( 'framework/loops/content', 'page' );
			endwhile;
		endif;

		$staffids = isset($_REQUEST['staffids']) ? $_REQUEST['staffids'] : '';
		$serviceids = isset($_REQUEST['serviceids']) ? $_REQUEST['serviceids'] : '';
		
		$firstname = isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : '';
		$lastname = isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : '';
		$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
		$emailid = isset($_REQUEST['emailid']) ? $_REQUEST['emailid'] : '';
		$address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
		
		//about your project
		$about_your_project = isset($_REQUEST['about_your_project']) ? $_REQUEST['about_your_project'] : '';
	   
	   if($firstname == '') { 
			$from_step1 = 'true'; 
			$servicebox_style = ''; 
			$contactbox_style = 'style="display:none;"'; 
			
			$gobackbox_style = 'style="display:none;"'; 
			$step_value = 1; 
			$current_step1 = 'dt-sc-current-step';
			$current_step2 = '';
			$completed_step = '';
			$timeslotbox_style = 'style="display:none;"';
			
		} else { 
			$from_step1 = 'false'; 
			$servicebox_style = 'style="display:none;"'; 
			$contactbox_style = ''; 
			$gobackbox_style = ''; 
			$step_value = 2; 
			$current_step1 = '';
			$current_step2 = 'dt-sc-current-step';
			$completed_step = 'dt-sc-completed-step';

			$contact_info_data = '<ul>';
				if($firstname != '') { $contact_info_data .= '<li>'.$firstname.' '.$lastname.'</li>'; }
				if($phone != '') { $contact_info_data .= '<li>'.$phone.'</li>'; }
				if($emailid != '') { $contact_info_data .= '<li>'.$emailid.'</li>'; }
				if($address != '') { $contact_info_data .= '<li>'.$address.'</li>'; }
				if($about_your_project != '') { $contact_info_data .= '<li>'.$about_your_project.'</li>'; }
			$contact_info_data .= '</ul>';
		} ?>
        
		<div class="dt-sc-clear"></div>
        <div class="dt-sc-schedule-progress-wrapper">
            <div class="dt-sc-schedule-progress step1 <?php echo esc_attr($current_step1.' '.$completed_step); ?>">
            	<div class="dt-sc-progress-step">
                	<span>1</span>
                </div>
                <h4><?php echo esc_html__('Select Date / Time slot', 'begin'); ?></h4>
                <p><?php echo esc_html__('Choose the type of department and your staff along with the time slot', 'begin'); ?></p>
            </div>
            <div class="dt-sc-schedule-progress step2 <?php echo esc_attr($current_step2); ?>">
            	<div class="dt-sc-progress-step">
                	<span>2</span>
                </div>
                <h4><?php echo esc_html__('Fill Contact Details', 'begin'); ?></h4>
                <p><?php echo esc_html__('Fill in your personal details and brief description of your treatment needed', 'begin'); ?></p>
            </div>
            <div class="dt-sc-schedule-progress step3">
            	<div class="dt-sc-progress-step">
                	<span>3</span>
                </div>
                <h4><?php echo esc_html__('Check Details', 'begin'); ?></h4>
                <p><?php echo esc_html__('Proof read the details about the choosen staff,service & personal details', 'begin'); ?></p>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-small"></div>
        <div class="dt-sc-clear"></div>
        
		<p><?php esc_html_e('All fields are mandatory','begin');?></p>
       
        <div class="dt-sc-hr-invisible-small"></div>
        <div class="dt-sc-clear"></div>
        
		<div class="dt-sc-goback-box" <?php echo begin_wp_kses($gobackbox_style); ?>>
            <input class="appointment-goback" value="<?php echo esc_html__('Go Back and edit', 'begin'); ?>" type="button" />
            <input type="hidden" value="<?php echo esc_attr($from_step1); ?>" name="appointment-step-checker"  id="appointment-step-checker"  />
			<input type="hidden" value="<?php echo esc_attr($step_value); ?>" name="appointment-step"  id="appointment-step"  />
		</div> 
		
		<div class="dt-sc-schedule-box steps step1" <?php echo begin_wp_kses($servicebox_style); ?>>
		
			<h2><?php echo esc_html__('Select Department & Date', 'begin'); ?></h2>
            <div class="dt-sc-single-border-separator"></div>
			<div class="dt-sc-hr-invisible-xsmall"></div>

			<div class="dt-sc-service-box" <?php echo begin_wp_kses($servicebox_style); ?>>
			
				<form class="dt-sc-appointment-scheduler-form" name="dt-sc-appointment-scheduler-form" method="post">
					<div class="column dt-sc-one-third first">
						<select name="serviceid" id="serviceid" class="dt-select-service">
							<option value=""><?php echo esc_html__('Select Department', 'begin'); ?></option>
								<?php
								$services_args = array('post_type'=>'dt_services', 'posts_per_page'=>'-1' , 'suppress_filters' => false );
								
								if($serviceids != '') {
									$serviceids_arr = explode(',', $serviceids);
									$services_args['post__in'] = $serviceids_arr;
								}
								
								$cp_services = get_posts( $services_args );
								if( $cp_services ){
									foreach( $cp_services as $cp_service ){
										$id = $cp_service->ID; 
										$title = $cp_service->post_title;
										?>
										<option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['serviceid'])) { echo selected($_REQUEST['serviceid'], $id, false); } ?>><?php echo esc_html($title); ?></option>
										<?php
									}
								}
								?>
						</select>
					</div>
	
					<div class="column dt-sc-one-third">
						<select name="staffid" id="staffid" class="dt-select-staff">
							<option value=""><?php echo esc_html__('Select Staff','begin'); ?></option>
							<?php
							$staffs_args = array(
								'post_type' => 'dt_staffs',
								'posts_per_page' => '-1',
								'meta_query'=>array()
								);
							if($staffids != '') {
								$staffids_arr = explode(',', $staffids);
								$staffs_args['post__in'] = $staffids_arr;
							}
							if(isset($_REQUEST['serviceid'])) {
								$staffs_args['meta_query'][] = array(
															'key'     => '_services',
															'value'   =>  $_REQUEST['serviceid'],
															'compare' => 'LIKE'
															);
							}
							
							$cp_staffs = get_posts( $staffs_args );
							if( $cp_staffs ){
								foreach( $cp_staffs as $cp_staff ){
									$id = $cp_staff->ID;
									$title = $cp_staff->post_title;
									?>
									<option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['staffid'])) { echo selected($_REQUEST['staffid'], $id, false); } ?>><?php echo esc_html($title); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
	
					<div class="column dt-sc-one-third">
						<div class="selection-box form-calender-icon">
                       	 <input type="text" id="datepicker" name="date" value="<?php if(isset($_REQUEST['date'])) echo esc_attr($_REQUEST['date']); else echo esc_html__('Select Date', 'begin'); ?>" required />
                        </div>
					</div>
                    
                    <p class="aligncenter"><input class="generate-schedule dt-sc-button medium bordered" value="<?php echo esc_html__('Check available time', 'begin'); ?>" type="button" /></p>
                    <input type="hidden" id="staffids" name="staffids" value="<?php echo esc_attr($staffids); ?>" />
                    <input type="hidden" id="serviceids" name="serviceids" value="<?php echo esc_attr($serviceids); ?>" />

				</form>
				
			</div>
			
			<div class="dt-sc-timeslot-box" <?php echo begin_wp_kses($timeslotbox_style); ?>>
				<div class="appointment-ajax-holder"></div>
			</div>
		
		</div>
        
        <div class="dt-sc-contactdetails-box steps step2" <?php echo begin_wp_kses($contactbox_style); ?>>
		
        	<div class="border-title"><h2><?php echo esc_html__('Contact Details', 'begin'); ?></h2></div>
            
			<form class="dt-sc-appointment-contactdetails-form" name="dt-sc-appointment-contactdetails-form" method="post" >
			
				<div class="column dt-sc-one-half first"><input type="text" id="firstname" name="firstname" value="<?php echo esc_attr($firstname); ?>" placeholder="<?php echo esc_html__('Name', 'begin'); ?>" required /></div>
				<div class="column dt-sc-one-half"><input type="text" id="lastname" name="lastname" value="<?php echo esc_attr($lastname); ?>" placeholder="<?php echo esc_html__('Last Name', 'begin'); ?>" required /></div>
				
				<div class="column dt-sc-one-half first"><input type="text" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" placeholder="<?php echo esc_html__('Phone', 'begin'); ?>" required /></div>
				<div class="column dt-sc-one-half"><input type="text" id="emailid" name="emailid" value="<?php echo esc_attr($emailid); ?>" placeholder="<?php echo esc_html__('Email', 'begin'); ?>" required /></div>
                
                <div class="column dt-sc-one-column first"><input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>" placeholder="<?php echo esc_html__('Address', 'begin'); ?>" required /></div>
				
				<p><?php echo esc_html('A brief description about your reason of visit','begin'); ?></p>
                <div class="column dt-sc-one-column first"><textarea id="about_your_project" name="about_your_project" placeholder="<?php echo esc_html__('Message', 'begin'); ?>" required><?php echo esc_attr($about_your_project); ?></textarea></div>
				
				<p class="aligncenter"><input class="generate-servicebox dt-sc-button medium bordered" value="<?php echo esc_html__('Submit Details', 'begin'); ?>" type="submit" /></p>

			</form>
			
		</div>
		
		<div class="dt-sc-notification-box steps step3" style="display:none;">
		
            <div class="border-title"><h2><?php echo esc_html__('Confirm Details', 'begin'); ?></h2></div>
            
			<div class="column dt-sc-one-half dt-sc-notification-details dt-sc-notification-schedulebox first">
				<div class="dt-sc-schedule-details" id="dt-sc-schedule-details"></div>
			</div>
            
            <div class="column dt-sc-one-half dt-sc-notification-details dt-sc-notification-contactbox ">
				<div class="dt-sc-contact-info" id="dt-sc-contact-info"><?php echo begin_wp_kses($contact_info_data); ?></div>
			</div>

			<div class="dt-sc-clear"></div>
            
            	<div class="dt-sc-aboutproject-box">
		
                    <input type="hidden" id="hid_firstname" name="hid_firstname" value="<?php echo esc_attr($firstname); ?>" />
                    <input type="hidden" id="hid_lastname" name="hid_lastname" value="<?php echo esc_attr($lastname); ?>" />
                    <input type="hidden" id="hid_phone" name="hid_phone" value="<?php echo esc_attr($phone); ?>" />
                    <input type="hidden" id="hid_emailid" name="hid_emailid" value="<?php echo esc_attr($emailid); ?>" />
                    <input type="hidden" id="hid_address" name="hid_address" value="<?php echo esc_attr($address); ?>" />
                    <input type="hidden" id="hid_about_your_project" name="hid_about_your_project" value="<?php echo esc_attr($about_your_project); ?>" />

                    <div id="dt-sc-ajax-load-image" style="display:none;"><img src="<?php echo BEGIN_THEME_URI .'/images/loading.png'; ?>" alt="" /></div>

                    <form class="dt-sc-about-project-form" name="dt-sc-about-project-form" method="post">
                        <p class="aligncenter"><input class="schedule-it dt-sc-button medium bordered" value="<?php echo esc_html__('Check & Confirm', 'begin'); ?>" type="submit" />	</p>
                    </form>

                </div>
			 
			<div class="dt-sc-clear"></div>
            
            <div class="dt-sc-apt-success-box dt-sc-success-box" style="display:none;"><?php
				$success = cs_get_option('success_message');
				$success = stripslashes($success);
				echo !empty($success) ? $success : '';?>
			</div>
			<div class="dt-sc-apt-error-box dt-sc-error-box" style="display:none;"><?php
				$error= cs_get_option('error_message');
				$error = stripslashes($error);
				echo !empty($error) ? $error : '';?>
			</div>
		</div>
</section><!-- ** Primary Section End ** -->
    
<?php if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section><?php
		endif;
	endif; ?>

<?php get_footer(); ?>