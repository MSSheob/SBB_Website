<?php
/*
Template Name: Reservation Template
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
	endif;?>
    <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
		if( have_posts() ):
			while( have_posts() ):
				the_post();
				get_template_part( 'functions/loops/content', 'page' );
			endwhile;
		endif;?>
        
    <?php if( isset($_REQUEST['action'] ) ):
		if( $_REQUEST['action'] === "success" ):
			$successmsg = cs_get_option('success_message');
			$successmsg = isset($successmsg) ? '<div class="dt-sc-success-box">'.$successmsg.'</div>' : '';
			echo $successmsg;
			$page_id = $post->ID;
			$page_link = get_page_link($page_id);
			_e("<p>To continue or make another one, please click this button</p>",'begin');
			echo do_shortcode('[dt_sc_button title="Back to Reservation" size="medium" link="url:'.rawurlencode($page_link).'" style="bordered" /]');

		elseif( $_REQUEST['action'] === "error" ):
			$errormsg = cs_get_option('error_message');
			$errormsg = isset($errormsg) ? '<div class="dt-sc-error-box">'.$errormsg.'</div>' : '';
			echo $errormsg;
		endif;
	  else: ?>
		  <?php 
          $staffids = isset($_REQUEST['staffids']) ? $_REQUEST['staffids'] : '';
		  $serviceids = isset($_REQUEST['serviceids']) ? $_REQUEST['serviceids'] : '';
		  
		  $time_format = get_option( 'time_format' );
		  $fetch_start_time = isset($_REQUEST['start-time']) ? date($time_format, strtotime($_REQUEST['start-time'])) : date($time_format, strtotime('8:00 am'));
		  
		  $fetch_end_time = isset($_REQUEST['end-time']) ? $_REQUEST['end-time'] : '';
          ?>
          <input type="hidden" id="hidden-end-time" name="hidden-end-time" value="<?php echo esc_attr($fetch_end_time); ?>">
          
          
	<div class="column dt-sc-one-half first">
		<h5><?php esc_html_e('Available Services','begin');?></h5>
		<select name="services" class="dt-select-service">
			<option value=""><?php esc_html_e('Select','begin');?></option><?php 
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
                                    <option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['services'])) echo selected($_REQUEST['services'], $id, false); ?>><?php echo esc_html($title); ?></option>
                                    <?php
                                }
                            }
                            ?>
		</select>
        </div>

		<div class="column dt-sc-one-half">
        <h5><?php esc_html_e('Staffs','begin');?></h5>
		<select name="staff" class="dt-select-staff">
			<option value=""><?php esc_html_e('Select','begin');?></option><?php
			$staffs_args = array(
				  'post_type' => 'dt_staffs',
				  'posts_per_page' => '-1',
				  'meta_query'=>array()
				  );
			  if($staffids != '') {
				  $staffids_arr = explode(',', $staffids);
				  $staffs_args['post__in'] = $staffids_arr;
			  }
			  if(isset($_REQUEST['services'])) {
				  $staffs_args['meta_query'][] = array(
											  'key'     => '_services',
											  'value'   =>  $_REQUEST['services'],
											  'compare' => 'LIKE'
											  );
			  }
			  $cp_staffs = get_posts( $staffs_args );
			if( $cp_staffs ){
				foreach( $cp_staffs as $cp_staff ){
					$id = $cp_staff->ID;
					$title = $cp_staff->post_title; ?>
					<option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['staff'])) echo selected($_REQUEST['staff'], $id, false); ?>><?php echo esc_html($title); ?></option><?php
				}
			}?></select>
            </div>
		
        <div class="dt-sc-hr-invisible-small"> </div>
		<div class="dt-sc-clear"> </div>
        <div class="dt-sc-title with-right-border-decor"><h3><?php esc_html_e('Time','begin');?></h3></div>
        <div class="dt-sc-hr-invisible-very-small"> </div>
		<div class="dt-sc-clear"> </div>     
           
        <div class="column dt-sc-one-fourth first">
            <h5><?php esc_html_e('I am available on','begin');?></h5>
            <p class="form-calender-icon"><input type="text" id="datepicker" name="date" value="<?php if(isset($_REQUEST['date'])) echo esc_attr($_REQUEST['date']); else echo date('Y-m-d'); ?>"/></p>
        </div>

		<div class="column dt-sc-three-fourth">
        	<div class="column dt-sc-one-half first">
                <h5><?php esc_html_e('Start :','begin');?></h5><select name="start-time" class='start-time'>

                <?php $time_format = get_option( 'time_format' ); 
					  $fetch_start_time = isset($_REQUEST['start-time']) ? date($time_format, strtotime($_REQUEST['start-time'])) : date($time_format, strtotime('8:00 am'));
					  $fetch_end_time = isset($_REQUEST['end-time']) ? date($time_format, strtotime($_REQUEST['end-time'])) : date($time_format, strtotime('11:00 pm'));
					  $selected = 'selected="selected"'; ?>
                    
                    <option value="00:00" <?php if( $fetch_start_time == date($time_format, strtotime('12:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('12:00 am')); ?></option>	
					<option value="01:00" <?php if( $fetch_start_time == date($time_format, strtotime('1:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('1:00 am')); ?></option>	
                    <option value="02:00" <?php if( $fetch_start_time == date($time_format, strtotime('2:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('2:00 am')); ?></option> 
                    <option value="03:00" <?php if( $fetch_start_time == date($time_format, strtotime('3:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('3:00 am')); ?></option>
                    <option value="04:00" <?php if( $fetch_start_time == date($time_format, strtotime('4:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('4:00 am')); ?></option>  
                    <option value="05:00" <?php if( $fetch_start_time == date($time_format, strtotime('5:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('5:00 am')); ?></option>  
                    <option value="06:00" <?php if( $fetch_start_time == date($time_format, strtotime('6:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('6:00 am')); ?></option> 
                    <option value="07:00" <?php if( $fetch_start_time == date($time_format, strtotime('7:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('7:00 am')); ?></option>
                    <option value="08:00" <?php if( $fetch_start_time == date($time_format, strtotime('8:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('8:00 am')); ?></option>
                    <option value="09:00" <?php if( $fetch_start_time == date($time_format, strtotime('9:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('9:00 am')); ?></option> 
                    <option value="10:00" <?php if( $fetch_start_time == date($time_format, strtotime('10:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('10:00 am')); ?></option> 
                    <option value="11:00" <?php if( $fetch_start_time == date($time_format, strtotime('11:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('11:00 am')); ?></option> 
                    <option value="12:00" <?php if( $fetch_start_time == date($time_format, strtotime('12:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('12:00 pm')); ?></option>
                    <option value="13:00" <?php if( $fetch_start_time == date($time_format, strtotime('1:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('1:00 pm')); ?></option> 
                    <option value="14:00" <?php if( $fetch_start_time == date($time_format, strtotime('2:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('2:00 pm')); ?></option>  
                    <option value="15:00" <?php if( $fetch_start_time == date($time_format, strtotime('3:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('3:00 pm')); ?></option> 
                    <option value="16:00" <?php if( $fetch_start_time == date($time_format, strtotime('4:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('4:00 pm')); ?></option>
                    <option value="17:00" <?php if( $fetch_start_time == date($time_format, strtotime('5:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('5:00 pm')); ?></option> 
                    <option value="18:00" <?php if( $fetch_start_time == date($time_format, strtotime('6:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('6:00 pm')); ?></option> 
                    <option value="19:00" <?php if( $fetch_start_time == date($time_format, strtotime('7:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('7:00 pm')); ?></option> 
                    <option value="20:00" <?php if( $fetch_start_time == date($time_format, strtotime('8:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('8:00 pm')); ?></option>
                    <option value="21:00" <?php if( $fetch_start_time == date($time_format, strtotime('9:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('9:00 pm')); ?></option> 
                    <option value="22:00" <?php if( $fetch_start_time == date($time_format, strtotime('10:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('10:00 pm')); ?></option> 
                    <option value="23:00" <?php if( $fetch_start_time == date($time_format, strtotime('11:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('11:00 pm')); ?></option></select> 
            </div>
            
            <div class="column dt-sc-one-half"> 
                <h5><?php esc_html_e('End :','begin');?></h5><select name="end-time" class='end-time'>
                    <option value="09:00" <?php if( $fetch_end_time == date($time_format, strtotime('9:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('9:00 am')); ?></option>	
                    <option value="10:00" <?php if( $fetch_end_time == date($time_format, strtotime('10:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('10:00 am')); ?></option>	
                    <option value="11:00" <?php if( $fetch_end_time == date($time_format, strtotime('11:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('11:00 am')); ?></option>	
                    <option value="12:00" <?php if( $fetch_end_time == date($time_format, strtotime('12:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('12:00 pm')); ?></option>
                    <option value="13:00" <?php if( $fetch_end_time == date($time_format, strtotime('1:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('1:00 pm')); ?></option>	
                    <option value="14:00" <?php if( $fetch_end_time == date($time_format, strtotime('2:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('2:00 pm')); ?></option>	
                    <option value="15:00" <?php if( $fetch_end_time == date($time_format, strtotime('3:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('3:00 pm')); ?></option>	
                    <option value="16:00" <?php if( $fetch_end_time == date($time_format, strtotime('4:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('4:00 pmm')); ?></option>
                    <option value="17:00" <?php if( $fetch_end_time == date($time_format, strtotime('5:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('5:00 pm')); ?></option>	
                    <option value="18:00" <?php if( $fetch_end_time == date($time_format, strtotime('6:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('6:00 pm')); ?></option>	
                    <option value="19:00" <?php if( $fetch_end_time == date($time_format, strtotime('7:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('7:00 pm')); ?></option>	
                    <option value="20:00" <?php if( $fetch_end_time == date($time_format, strtotime('8:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('8:00 pm')); ?></option>
                    <option value="21:00" <?php if( $fetch_end_time == date($time_format, strtotime('9:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('9:00 pm')); ?></option>	
                    <option value="22:00" <?php if( $fetch_end_time == date($time_format, strtotime('10:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('10:00 pm')); ?></option> 
                    <option value="23:00" <?php if( $fetch_end_time == date($time_format, strtotime('11:00 pm')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('11:00 pm')); ?></option> 
                    <option value="23:59" <?php if( $fetch_end_time == date($time_format, strtotime('12:00 am')) ){ echo $selected; } ?>><?php echo date($time_format, strtotime('12:00 am')); ?></option>
                    </select>
         </div>
		</div>            
		<div class="dt-sc-clear"></div>
		<p class="aligncenter"><a href="#" class="dt-sc-button medium bordered show-time"><?php esc_html_e('Show Time','begin');?></a></p>			
		<div class="dt-sc-hr-invisible-large"> </div>
		<div class="dt-sc-clear"> </div> 
		<div class="available-times"></div>

		<div id="personalinfo" class="personal-info" style="display:none;">
			<div class="dt-sc-title with-right-border-decor"><h3><?php esc_html_e('Personal Info','begin');?></h3></div>
            <div class="dt-sc-hr-invisible-very-small"> </div>
            <div class="dt-sc-clear"> </div>

            	<div class="column dt-sc-one-half first">
					<p><input type="text" name="name" value="<?php if(isset($_REQUEST['cli-name'])) echo esc_attr($_REQUEST['cli-name']); ?>" placeholder="<?php esc_attr_e('Name:','begin');?>"></p>
                    
                </div>
				<div class="column dt-sc-one-half">                
					<p><input type="email" name="email" value="<?php if(isset($_REQUEST['cli-email'])) echo esc_attr($_REQUEST['cli-email']); ?>" required placeholder="<?php esc_attr_e('Email:','begin');?>"></p>
				</div>  
                
            	<div class="column dt-sc-one-half first">                                  
					<p><input type="text" name="phone" value="<?php if(isset($_REQUEST['cli-phone'])) echo esc_attr($_REQUEST['cli-phone']); ?>" required placeholder="<?php esc_attr_e('Phone:','begin');?>"></p>
            	</div>
                
				<div class="column dt-sc-one-half">
                    <div class="choose-payment" style="display:none;">
                        <?php $payatarrival = cs_get_option('enable-pay-at-arrival');
                        $paypal = cs_get_option('enable-paypal');?>
                        <select name="payment_type">
                            <option value=""><?php esc_html_e('Choose Payment','begin');?></option>
                            <?php if( !empty($payatarrival) ): ?>
                                <option value="local"><?php esc_html_e('Pay At Arrival','begin');?></option>
                            <?php endif;?>
                            <?php if( !empty($paypal) ): ?>					
                                <option value="paypal"><?php esc_html_e('Pay with Paypal','begin');?></option>
                            <?php endif;?>
                        </select>
                    </div>
                </div>

                <textarea name="note" placeholder="<?php esc_attr_e('Note:','begin');?>"><?php if(isset($_REQUEST['cli-msg'])) echo esc_attr($_REQUEST['cli-msg']); ?></textarea>
                
                <?php	$temp = $ctemp = rand(3212, 8787);
				$temp = str_split($temp, 1);?>
                <div class="column dt-sc-one-half first">
                	<p><input type="text" name="captcha" required  placeholder="<?php esc_attr_e('Captcha','begin');?>"></p>
                    <input type="hidden" name="hiddencaptcha" readonly="readonly" value="<?php echo esc_attr($ctemp);?>"/>
                </div>

                <div class="column dt-sc-one-half">
                	<p><span class="dt-sc-captcha">
							<?php echo esc_html($temp[0]);?>
	                        <sup><?php echo esc_html($temp[1]);?></sup>
    	                    <?php echo esc_html($temp[2]);?>
        	                <sub><?php echo esc_html($temp[3]);?></sub>
                        </span></p>
                </div>
		</div>
        <div class="dt-sc-clear"> </div>
		<p class="aligncenter"><a href="#" class="dt-sc-button medium bordered schedule-it" style="display:none;"><?php esc_html_e('Schedule It', 'begin'); ?></a></p>
	<?php endif;?>
        
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section><?php
		endif;
	endif;
get_footer();?>