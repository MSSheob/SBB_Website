<?php
	$page_layout  = cs_get_option( 'post-archives-page-layout' );
	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
    $container_class = '';
	
	$show_sidebar = true;
	if( $page_layout == "content-full-width" ){
		$show_sidebar = false;
	}

	$post_layout = cs_get_option( 'post-archives-post-layout' );	
	switch($post_layout):
		default:
		case 'one-column':
			$post_class = $show_sidebar ? "column dt-sc-one-column with-sidebar blog-fullwidth" : "column dt-sc-one-column blog-fullwidth";
			$columns = 1;
		break;
		
		case 'one-half-column':
			$post_class = $show_sidebar ? "column dt-sc-one-half with-sidebar" : "column dt-sc-one-half";
			$columns = 2;
			$container_class = "apply-isotope";
		break;
		
		case 'one-third-column':
			$post_class = $show_sidebar ? "column dt-sc-one-third with-sidebar" : "column dt-sc-one-third";
			$columns = 3;
			$container_class = "apply-isotope";
		break;
	endswitch;

	$allow_excerpt = cs_get_option( 'post-archives-enable-excerpt' );
	$excerpt = cs_get_option( 'post-archives-excerpt' );

	$allow_read_more = cs_get_option( 'post-archives-enable-readmore' );
	$read_more = cs_get_option( 'post-archives-readmore' );

	$post_style = cs_get_option( 'post-style' );

	$show_post_format = cs_get_option( 'post-format-meta' );
	$show_post_format = !empty( $show_post_format ) ? "" : "hidden";

	$show_author_meta = cs_get_option( 'post-author-meta' );
	$show_author_meta = !empty( $show_author_meta ) ? "" : "hidden";

	$show_date_meta = cs_get_option( 'post-date-meta' );
	$show_date_meta = !empty( $show_date_meta ) ? "" : "hidden";

	$show_comment_meta = cs_get_option( 'post-comment-meta' );
	$show_comment_meta = !empty( $show_comment_meta ) ? "" : "hidden";

	$show_category_meta = cs_get_option( 'post-category-meta' );
	$show_category_meta = !empty( $show_category_meta ) ? "" : "hidden";

	$show_tag_meta = cs_get_option( 'post-tag-meta' );
	$show_tag_meta = !empty( $show_tag_meta ) ? "" : "hidden";

	if( have_posts() ) :
		$i = 1;
		echo "<div class='tpl-blog-holder ".esc_attr( $container_class )."'>";
		echo "<div class='grid-sizer ".esc_attr( $post_class )."'></div>";
		while( have_posts() ):
			the_post();

			$temp_class = "";
			
			if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
			if($i == $columns) $i = 1; else $i = $i + 1;
			
			$link = get_permalink( get_the_id() );
			$link = rawurlencode( $link );
			
			$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
			$post_meta = is_array($post_meta) ? $post_meta : array();
			
			$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
			$format_link = 	get_post_format_link( $format ); ?>

				<div class="<?php echo esc_attr($temp_class);?>">
                	<article id="post-<?php the_ID();?>" <?php post_class('blog-entry '.$post_style.' '.'format-'.$format);?>>
                    	<!-- Featured Image -->
                        <?php if( $format == "image" || empty($format) ) :
                                if( has_post_thumbnail() ) :?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                                            <div class="entry-format <?php echo esc_attr($show_post_format);?>">
                                                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                            </div>
                                    </div><?php
                                endif;
                            elseif( $format === "gallery" ) :
                                if( $post_meta['post-gallery-items'] != '' ) :
                                    echo '<div class="entry-thumb">';
                                    echo '	<ul class="entry-gallery-post-slider">';
												$items = explode(',', $post_meta["post-gallery-items"]);
                                                foreach ( $items as $item ) {
                                                    echo '<li>'.wp_get_attachment_image( $item, 'full' ).'</li>';
                                                }
                                    echo '	</ul>';
                                    echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
                                    echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
                                    echo '	</div>';
                                    echo '</div>';
                                elseif( has_post_thumbnail() ):?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                                        <div class="entry-format <?php echo esc_attr($show_post_format);?>">
                                            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                        </div>
                                    </div><?php
                                endif;
                            elseif( $format === "video" ) :
                                if( $post_meta['media-url'] != '' ) :
                                    echo '<div class="entry-thumb">';
                                    echo'	<div class="dt-video-wrap">';
                                                if( $post_meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
                                                    echo wp_oembed_get($post_meta['media-url']);
                                                elseif( $post_meta['media-type'] == 'self' ) :
                                                    echo wp_video_shortcode( array('src' => $post_meta['media-url']) );
                                                endif;
                                    echo '	</div>';
                                    echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
                                    echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
                                    echo '	</div>';
                                    echo '</div>';
                                elseif( has_post_thumbnail() ):?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                                        <div class="entry-format <?php echo esc_attr($show_post_format);?>">
                                            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                        </div>                                    
                                    </div><?php
                                endif;
                            elseif( $format === "audio" ) :
                                if( $post_meta['media-url'] != '' ) :
                                    echo '<div class="entry-thumb">';
                                            if( $post_meta['media-type'] == 'oembed' ) :
                                                echo wp_oembed_get($post_meta['media-url']);
                                            elseif( $post_meta['media-type'] == 'self' ) :
                                                echo wp_audio_shortcode( array('src' => $post_meta['media-url']) );
                                            endif;
                                    echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
                                    echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
                                    echo '	</div>';
                                    echo '</div>';
                                elseif( has_post_thumbnail() ):?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                                        <div class="entry-format <?php echo esc_attr($show_post_format);?>">
                                            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                        </div>
                                    </div><?php
                                endif;
                            else:
                                if( has_post_thumbnail() ) :?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                                        <div class="entry-format <?php echo esc_attr($show_post_format);?>">
                                            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                        </div>
                                    </div><?php
                                endif;
                            endif;?>
                        <!-- Featured Image -->
                        
                        <!-- Content -->
                        <?php if( $post_style == "entry-date-left"): ?>
                        		
                                <div class="entry-details">
                                
                                    <div class="entry-date">
                                    
                                        <!-- date -->
                                        <div class="<?php echo esc_attr($show_date_meta);?>">
                                            <?php echo get_the_date('d');?>
                                             <span><?php echo get_the_date('M');?></span>
                                        </div><!-- date -->
                                        
                                        <!-- comment -->
                                        <div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
											comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>
                                        </div><!-- comment -->                                         
                                     </div><!-- .entry-date -->


                                	<div class="entry-title">
                                    	<?php if( is_sticky(get_the_id()) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'begin').'</span>'; ?>
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>
                                    
                                   <?php if( !empty($allow_excerpt) && !empty($excerpt) ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($excerpt);?></div>
                                   <?php endif;?>

                                   <!-- Author & Category & Tag -->
                                   <div class="entry-meta-data">
                                   
                                   		<p class="author <?php echo esc_attr( $show_author_meta );?>">
                                        	<i class="pe-icon pe-user"> </i>
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                            	title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><?php echo get_the_author();?></a>
                                        </p>
                                                                           
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                        
                                   </div><!-- Category & Tag -->

                                   <!-- Read More Button -->
                                   <?php if( !empty($allow_read_more) && !empty($read_more) ):
								   			if( shortcode_exists( 'dt_sc_button' ) && begin_is_plugin_active('js_composer/js_composer.php') ):
												$read_more = stripcslashes($read_more);
												$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
												$sc = do_shortcode($sc);
												echo !empty( $sc ) ? $sc : '';
											else:
												echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1 dt-sc-readmore-link">'.esc_html__('Read More', 'begin').'<span class="fa fa-long-arrow-right"> </span></a>';
											endif;
										endif;?><!-- Read More Button -->

                                </div><!-- .entry-details -->
                                
                        <?php elseif( $post_style == "entry-date-author-left"):?>
                        
                        		<div class="entry-date-author">
                                
                                	<div class="entry-date <?php echo esc_attr($show_date_meta);?>">
                                    	<?php echo get_the_date('d');?>
                                        <span><?php echo get_the_date('M');?></span>
                                    </div>
                                    
                                    <div class="entry-author <?php echo esc_attr( $show_author_meta );?>">
                                    	<?php echo get_avatar(get_the_author_meta('ID'), 72 );?>
                                    	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                        	title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><span><?php echo get_the_author();?></span></a>
                                    </div>
                                    
                                    <div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
										comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>							
                                    </div>
                                </div>
                                
                                <div class="entry-details">
                                
                                	<div class="entry-title">
                                    	<?php if( is_sticky(get_the_id()) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'begin').'</span>'; ?>
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>
                                    
                                    <?php if( !empty($allow_excerpt) && !empty($excerpt) ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($excerpt);?></div>
                                   <?php endif;?>
                                   
                                   <!-- Category & Tag -->
                                   <div class="entry-meta-data">
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                   </div><!-- Category & Tag -->
                                   
                                   <!-- Read More Button -->
                                   <?php if( !empty($allow_read_more) && !empty($read_more) ):
								   			if( shortcode_exists( 'dt_sc_button' ) && begin_is_plugin_active('js_composer/js_composer.php') ):
												$read_more = stripcslashes($read_more);
												$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
												$sc = do_shortcode($sc);
												echo !empty( $sc ) ? $sc : '';
											else:
												echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1 dt-sc-readmore-link">'.esc_html__('Read More', 'begin').'<span class="fa fa-long-arrow-right"> </span></a>';
											endif;
										endif;?><!-- Read More Button -->
                                </div>
                                
                        <?php else: # Default Post Style ?>
                        		<div class="entry-details">
                                	<!-- Meta -->
                                    <div class="entry-meta">
                                    
                                    	<div class="date <?php echo esc_attr($show_date_meta);?>"><?php esc_html_e('Posted on','begin'); ?>  <?php echo get_the_date ( get_option('date_format') );?></div>
                                        
                                        <div class="comments <?php echo esc_attr($show_comment_meta);?>"> / <?php
											comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>								
                                        </div>
                                        
                                        <div class="author <?php echo esc_attr( $show_author_meta );?>">
                                        	/ <i class="pe-icon pe-user"> </i>
                                            
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                            	title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><?php echo get_the_author();?></a>
                                        </div>
                                    
                                    </div><!-- Meta -->
                                    
                                    <div class="entry-title">
                                    	<?php if( is_sticky(get_the_id()) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'begin').'</span>'; ?>
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>

                                    <?php if( !empty($allow_excerpt) && !empty($excerpt) ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($excerpt);?></div>
                                    <?php endif;?>

                                    <!-- Category & Tag -->
                                    <div class="entry-meta-data">
                                    	<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                    </div><!-- Category & Tag -->

                                    <!-- Read More Button -->
                                    <?php if( !empty($allow_read_more) && !empty($read_more) ):
								   			if( shortcode_exists( 'dt_sc_button' ) && begin_is_plugin_active('js_composer/js_composer.php') ):
												$read_more = stripcslashes($read_more);
												$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
												$sc = do_shortcode($sc);
												echo !empty( $sc ) ? $sc : '';
											else:
												echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1 dt-sc-readmore-link">'.esc_html__('Read More', 'begin').'<span class="fa fa-long-arrow-right"> </span></a>';
											endif;
										  endif;?><!-- Read More Button -->
                            	</div><!-- .entry-details -->
                        <?php endif;?>
                        <!-- Content -->
                    </article>
				</div><?php
		endwhile;
		
		echo '</div>';?>
        
        <!-- **Pagination** -->
        <div class="pagination blog-pagination"><?php echo begin_pagination();?></div><!-- **Pagination** -->
        <!-- Blog Template Ends --><?php

	else:?>
    	<h2><?php esc_html_e('Nothing Found.', 'begin'); ?></h2>
        <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'begin'); ?></p><?php
	endif;?>