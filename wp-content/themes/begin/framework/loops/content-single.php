<?php $post_meta = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	$post_meta = is_array($post_meta) ? $post_meta  : array();

	if(empty($post_meta)) {
		$post_meta['show-featured-image'] = 'true';
		$post_meta['enable-sub-title'] = 'true';
	}

	$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';

	$post_style = cs_get_option( 'post-style' );
	$post_classes = array('blog-entry','single', $post_style, 'format-'.$format );

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
	$show_tag_meta = !empty( $show_tag_meta ) ? "" : "hidden";?>

<article id="post-<?php the_ID();?>" <?php post_class($post_classes);?>>
	<?php if( array_key_exists('show-featured-image', $post_meta) && ( $post_meta['show-featured-image'] == true ) ):?>
			<!-- Featured Image -->
			<?php if( $format == "image" || empty($format) ) :
					if( has_post_thumbnail() ) :?>
						<div class="entry-thumb">
							<?php the_post_thumbnail("full");?>
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
                        		<?php the_post_thumbnail("full");?>
                        		<div class="entry-format <?php echo esc_attr($show_post_format);?>">
                        			<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                        		</div>
                        	</div><?php
                        endif;
                   elseif( $format === "video" ) :
                   		if( $post_meta['media-url'] != '' ) :
                   			echo '<div class="entry-thumb">';
                   			echo'	<div class="dt-video-wrap">';
                   						if( $post_meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] )) :
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
                        		<?php the_post_thumbnail("full");?>
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
	                   			<?php the_post_thumbnail("full");?>
	                   			<div class="entry-format <?php echo esc_attr($show_post_format);?>">
	                   				<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
	                   			</div>
	                   		</div><?php
                        endif;
                   else:
                   		if( has_post_thumbnail() ) :?>
                   			<div class="entry-thumb">
                   				<?php the_post_thumbnail("full");?>
                   				<div class="entry-format <?php echo esc_attr($show_post_format);?>">
                   					<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                   				</div>
                   			</div><?php
                   		endif;
                   	endif;?>
			<!-- Featured Image -->
	<?php endif;?>

	<!-- Content -->
	<?php if( $post_style == "entry-date-left"):?>
			<!-- .entry-details -->
			<div class="entry-details">

				<!-- .entry-date -->
				<div class="entry-date">
					
					<div class="<?php echo esc_attr($show_date_meta);?>">
						<?php echo get_the_date('d');?> <span><?php echo get_the_date('M');?></span>
					</div>

					<div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
						comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>								
					</div>
				</div><!-- .entry-date -->

				<?php
				if($post_meta['enable-sub-title'] != 'true' ):
					?>
					<div class="entry-title">
						<h4><?php the_title(); ?></h4>
					</div>
					<?php
				endif;
				?>

                <div class="entry-body">
                	<?php the_content();?>
                    <?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
						'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Author & Category & Tag -->
				<div class="entry-meta-data">
					<p class="author <?php echo esc_attr( $show_author_meta );?>">
						<i class="pe-icon pe-user"> </i>
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
							title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>"><?php echo get_the_author();?></a>
					</p>

					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>

					<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','begin' ) ); ?>
			</div><!-- .entry-details -->
	<?php elseif( $post_style == "entry-date-author-left"):?>
			<div class="entry-date-author">
				<div class="entry-date <?php echo esc_attr($show_date_meta);?>">
					<?php echo get_the_date('d');?> <span><?php echo get_the_date('M');?></span>
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

				<?php
				if($post_meta['enable-sub-title'] != 'true' ):
					?>
					<div class="entry-title">
						<h4><?php the_title(); ?></h4>
					</div>
					<?php
				endif;
				?>			

				<div class="entry-body">
					<?php the_content();?>
					<?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
							'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Category & Tag -->
				<div class="entry-meta-data">
					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
					<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','begin' ) ); ?>
			</div>	
	<?php else: # Default Post Style ?>
			<!-- .entry-details -->
			<div class="entry-details">

				<!-- .entry-meta -->
				<div class="entry-meta">
					<div class="date <?php echo esc_attr($show_date_meta);?>"><?php esc_html_e('Posted on','begin'); ?>  <?php echo get_the_date ( get_option('date_format') );?></div>
					<div class="comments <?php echo esc_attr($show_comment_meta);?>"> / <?php
						comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>');?>								
					</div>
					<div class="author <?php echo esc_attr( $show_author_meta );?>">
						/ <i class="pe-icon pe-user"> </i>
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'begin'); echo get_the_author();?>">
							<?php echo get_the_author();?></a>
                    </div>					
				</div><!-- .entry-meta -->

				<?php
				if($post_meta['enable-sub-title'] != 'true' ):
					?>
					<div class="entry-title">
						<h4><?php the_title(); ?></h4>
					</div>
					<?php
				endif;
				?>

				<div class="entry-body">
					<?php the_content();?>
                    <?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
                                'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Category & Tag -->
				<div class="entry-meta-data">
					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
					$categories = get_the_category();
					if ( ! empty( $categories ) ):?>
						<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
					endif;?>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','begin' ) ); ?>
			</div><!-- .entry-details -->
	<?php endif;?>
	<!-- Content -->
</article>

<?php # Post Author Information Box
	$post_author_box = cs_get_option( 'single-post-authorbox' );
	if( !empty($post_author_box) ):?>
		<div class="dt-sc-hr"></div>
		<div class="dt-sc-clear"></div>
		<section class="author-info">
        	<h2><?php esc_html_e('About Author','begin');?></h2>
			<div class="thumb">
				<?php echo get_avatar(get_the_author_meta('ID'), 450 );?>
			</div>
			<div class="desc-wrapper">
				<h3><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h3>
				<div class="desc"><?php the_author_meta('description'); ?></div>
			</div>	
		</section>
<?php endif;

	# Related Posts
	$related_post = cs_get_option( 'single-post-related' );
	if( !empty($related_post) && $aCategories = wp_get_post_categories( get_the_ID() ) ):

			$page_layout  = array_key_exists( "layout", $post_meta ) ? $post_meta['layout'] : "content-full-width";
			if( $page_layout == "content-full-width" ){
				$post_class = "column dt-sc-one-third";
			}else{
				$post_class = "column dt-sc-one-third with-sidebar";
			}

			$sc = "[dt_sc_blog_related_post post_class='".$post_class."' post_style='".$post_style."' id='".get_the_ID()."' /]";
			if( shortcode_exists( 'dt_sc_blog_related_post' ) )
				echo do_shortcode($sc);
	endif;

	#Post Comments
	$post_comment = cs_get_option( 'single-post-comments' );
	if( !empty($post_comment) ):?>
		<div class="dt-sc-hr"></div>
		<div class="dt-sc-clear"></div>
		<!-- ** Comment Entries ** -->
		<section class="commententries">
			<?php  comments_template('', true); ?>
		</section>
<?php endif;?>