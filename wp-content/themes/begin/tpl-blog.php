<?php
/*
Template Name: Blog Template
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
				get_template_part( 'framework/loops/content', 'page' );
			endwhile;
		endif;?>

        <div class="dt-sc-clear"></div>

        <!-- Blog Template -->
		<?php $post_layout = isset( $tpl_default_settings['blog-post-layout'] ) ? $tpl_default_settings['blog-post-layout'] : "one-half";
		$post_per_page = isset($tpl_default_settings['blog-post-per-page']) ? $tpl_default_settings['blog-post-per-page'] : -1;
		$post_style = isset( $tpl_default_settings['blog-post-style'] ) ? $tpl_default_settings['blog-post-style'] : "";

		$categories = isset($tpl_default_settings['blog-post-cats']) ? array_filter($tpl_default_settings['blog-post-cats']) : NULL;

		$show_date_meta = ( $tpl_default_settings['show-date-info'] == 'true' ) ? "" : "hidden";
		$show_comment_meta = ( $tpl_default_settings['show-comment-info'] == 'true' ) ? "comments" : "hidden";
		$show_author_meta = ( $tpl_default_settings['show-author-info'] == 'true' ) ? "" : "hidden";
		$show_category_meta = ( $tpl_default_settings['show-category-info'] == 'true' ) ? "" : "hidden";
		$show_tag_meta = ( $tpl_default_settings['show-tag-info'] == 'true' ) ? "" : "hidden";
		$show_post_format = ( $tpl_default_settings['show-postformat-info'] == 'true' )? "" : "hidden";
		$container_class = "";

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

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		} else { 
			$paged = 1;
		}

		if ( empty( $categories ) ):
			$args = array( 'paged'=>$paged, 'posts_per_page'=>$post_per_page, 'post_type'=> 'post' );
		else:
			$exclude_cats = array_unique( $categories );
			$args = array( 'paged'=>$paged, 'posts_per_page'=>$post_per_page, 'category__not_in'=>$exclude_cats, 'post_type'=>'post' );
		endif;

		$the_query = new WP_Query($args);

		if( $the_query->have_posts() ):
			$i = 1;
			echo "<div class='tpl-blog-holder ".esc_attr( $container_class )."'>";
			echo "<div class='grid-sizer ".esc_attr( $post_class )."'></div>";
			while( $the_query->have_posts() ):
				$the_query->the_post();

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
                            endif; ?>
                        <!-- Featured Image -->
                        
                        <!-- Content -->
                        <?php if( $post_style == "entry-date-left"): ?>
                        		
                                <div class="entry-details">

                                	<?php $tclass = ( ($show_date_meta == "hidden" ) && ($show_comment_meta == "hidden" ) ) ? "hidden" : ""; ?>
                                
                                    <div class="entry-date <?php echo esc_attr($tclass);?>">
                                    
                                        <!-- date -->
                                        <div class="<?php echo esc_attr($show_date_meta);?>">
                                            <?php echo get_the_date('d');?>
                                             <span><?php echo get_the_date('M');?></span>
                                        </div><!-- date -->
                                        
                                        <!-- comment -->
                                        <div class="<?php echo esc_attr($show_comment_meta);?>"><?php
											comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>
                                        </div><!-- comment -->                                         
                                     </div><!-- .entry-date -->


                                	<div class="entry-title">
                                    	<?php if( is_sticky(get_the_id()) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'begin').'</span>'; ?>
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>
                                    
                                    <?php if( $tpl_default_settings['blog-post-excerpt'] == 'true' && $tpl_default_settings['blog-post-excerpt-length'] != '' ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($tpl_default_settings['blog-post-excerpt-length']);?></div>
                                    <?php endif;?>

                                   <!-- Author & Category & Tag -->
                                   <?php $tclass = ( ($show_author_meta == "hidden" ) && ($show_tag_meta == "hidden" ) && ($show_category_meta == "hidden" ) ) ? "hidden" : ""; ?>
                                   <div class="entry-meta-data <?php echo esc_attr($tclass);?>">
                                   
                                   		<p class="author <?php echo esc_attr( $show_author_meta );?>">
                                        	<i class="pe-icon pe-user"> </i>
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                            	title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><?php echo get_the_author();?></a>
                                        </p>
                                                                           
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
                                        
                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
                                        
                                   </div><!-- Category & Tag -->
                                   
                                   <!-- Read More Button -->
                                   <?php if( $tpl_default_settings['enable-blog-readmore'] == 'true' ):
								   			$sc = isset( $tpl_default_settings['blog-readmore'] ) ? $tpl_default_settings['blog-readmore'] : "";
											$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';
										endif;?><!-- Read More Button -->
                                   
                                </div><!-- .entry-details -->
                                
                        <?php elseif( $post_style == "entry-date-author-left"):
                        		$tclass = ( ($show_date_meta == "hidden" ) && ($show_comment_meta == "hidden" ) && ($show_author_meta == "hidden" ) ) ? "hidden" : ""; ?>
                        
                        		<div class="entry-date-author <?php echo esc_attr($tclass);?>">
                                
                                	<div class="entry-date <?php echo esc_attr($show_date_meta);?>">
                                    	<?php echo get_the_date('d');?>
                                        <span><?php echo get_the_date('M');?></span>
                                    </div>
                                    
                                    <div class="entry-author <?php echo esc_attr( $show_author_meta );?>">
                                    	<?php echo get_avatar(get_the_author_meta('ID'), 72 );?>
                                    	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                        	title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><span><?php echo get_the_author();?></span></a>
                                    </div>
                                    
                                    <div class="<?php echo esc_attr($show_comment_meta);?>"><?php
										comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>
                                    </div>
                                </div>
                                
                                <div class="entry-details">
                                
                                	<div class="entry-title">
                                    	<?php if( is_sticky(get_the_id()) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'begin').'</span>'; ?>
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>

                                    <?php if( $tpl_default_settings['blog-post-excerpt'] == 'true' && $tpl_default_settings['blog-post-excerpt-length'] != '' ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($tpl_default_settings['blog-post-excerpt-length']);?></div>
                                    <?php endif;?>

                                   <!-- Category & Tag -->
                                   <?php $tclass = ( ($show_tag_meta == "hidden" ) && ($show_category_meta == "hidden" ) ) ? "hidden" : ""; ?>
                                   <div class="entry-meta-data <?php echo esc_attr($tclass);?>">
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
                                   </div><!-- Category & Tag -->
                                   
                                   <!-- Read More Button -->
                                   <?php if( $tpl_default_settings['enable-blog-readmore'] == 'true' ):
								   			$sc = isset( $tpl_default_settings['blog-readmore'] ) ? $tpl_default_settings['blog-readmore'] : "";
											$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';
										endif;?><!-- Read More Button -->
                                </div>
                                
                        <?php else: # Default Post Style ?>
                        		<div class="entry-details">
                                	<!-- Meta -->
                                	<?php $tclass = ( ($show_date_meta == "hidden" ) && ($show_comment_meta == "hidden" ) && ($show_author_meta == "hidden" ) ) ? "hidden" : ""; ?>
                                    <div class="entry-meta <?php echo esc_attr($tclass);?>">
                                    
                                    	<div class="date <?php echo esc_attr($show_date_meta);?>"><?php esc_html_e('Posted on','begin'); echo get_the_date(' d M Y');?></div>
                                        
                                        <div class="<?php echo esc_attr($show_comment_meta);?>"> / <?php
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
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','begin'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>

                                    <?php if( $tpl_default_settings['blog-post-excerpt'] == 'true' && $tpl_default_settings['blog-post-excerpt-length'] != '' ):?>
                                    		<div class="entry-body"><?php echo begin_excerpt($tpl_default_settings['blog-post-excerpt-length']);?></div>
                                    <?php endif;?>
                                    
                                    <!-- Category & Tag -->
                                    <?php $tclass = ( ($show_tag_meta == "hidden" ) && ($show_category_meta == "hidden" ) ) ? "hidden" : ""; ?>
                                    <div class="entry-meta-data <?php echo esc_attr($tclass);?>">
                                    	<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
                                    </div><!-- Category & Tag -->

                                    <!-- Read More Button -->
                                    <?php if( $tpl_default_settings['enable-blog-readmore'] == 'true' ):
											$sc = isset( $tpl_default_settings['blog-readmore'] ) ? $tpl_default_settings['blog-readmore'] : "";
											$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';
										  endif;?><!-- Read More Button -->
                            	</div><!-- .entry-details -->
                        <?php endif;?>
                        <!-- Content -->                        
                    </article>                	
				</div><?php				
			endwhile;
			echo '</div>';
		endif;?>
        
        <!-- **Pagination** -->
        <div class="pagination blog-pagination"><?php echo begin_pagination($the_query); ?></div><!-- **Pagination** -->
        <!-- Blog Template Ends -->
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section><?php
		endif;
	endif;
get_footer();?>