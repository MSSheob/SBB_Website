<?php get_header();?>

	<section id="primary" class="content-full-width">

		<!-- #post-<?php the_ID(); ?> -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

			$queried_object = get_queried_object();

			// Add the map shortcode
        	echo do_shortcode( '[wpsl_map]' );?>

        	<div class="container">

        		<div class="entry-content">

            		<div class="dt-sc-margin60"></div><?php

            		$post = get_post( $queried_object->ID );
            		setup_postdata( $post );?>

            		<div class="column dt-sc-one-half first"><?php

            			if(has_post_thumbnail()) { ?>
            				<div class="entry-thumb">
            					<a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s', 'begin'), the_title_attribute('echo=0') );?>"><?php
            						$attachment_id = get_post_thumbnail_id( $post->ID );
                                	$img_attributes = wp_get_attachment_image_src( $attachment_id, 'begin-1170x767' );
                                	echo '<img src="'.esc_url($img_attributes[0]).'" alt="'.get_the_title().'" title="'.get_the_title().'" />';?>
                                </a>
                            </div><?php
                        }?>
                    </div>

                    <div class="column dt-sc-one-half"><?php

                        the_content();

                        // Add the address shortcode
                    	echo do_shortcode( '[wpsl_address]' );?>
                    </div><?php

                    wp_reset_postdata( $post );?>
            	</div>
        	</div>
		</article><!-- #post-<?php the_ID(); ?> -->
	</section>
<?php get_footer();?>