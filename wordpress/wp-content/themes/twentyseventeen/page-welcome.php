<?php
/**
 * Template Name: welcome
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/page/content', 'page' );

                $query = new WP_Query( array( 'category_name' => 'test' ) );
                                
                if ( $query->have_posts() ) {

                    echo '<br/><ul>';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        echo '<li>' . get_the_title( $query2->post->ID ) . '</li>';
                    }
                    echo '</ul>';
                }
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
