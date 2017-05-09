<?php
/**
 * Portfolio partial
 *
 * @package WordPress
 */

?>
<section id="portfolio">
	<h2>Work</h2>
	<div class="container">
		<div class="row">
			<?php

			// WP_Query arguments.
			$args = array(
				'post_type'              => array( 'post' ),
				'post_status'            => array( 'publish' ),
				'category'               => 'portfolio',
				'posts_per_page'         => '4',
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'tax_query' => array(
					array(
						'operator'         => 'IN',
						'taxonomy'         => 'category',
						'field'            => 'slug',
						'terms'            => 'portfolio',
						'include_children' => false,
					),
				),
			);

			// The Query.
			$sites = new WP_Query( $args );

			// WordPress Loop.
			if ( $sites->have_posts() ) {
				while ( $sites->have_posts() ) {
					$sites->the_post();
					$url = get_post_meta( $post->ID, 'url_external_url', true );
					?>
					<article id="<?php echo esc_attr( $post->post_name ); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'portfolio' );
						} else {
							?>
							<img src="<?php echo esc_url( bloginfo( 'template_directory' ) ); ?>/assets/img/portfolio-default.png" alt="<?php the_title(); ?>">
							<?php
						}
						?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noreferrer nofollow">
							<div class="portfolio-desc">
								<h3><?php the_title(); ?></h3>
							</div>
						</a>
					</article>
					<?php
				}
			}

			// Restore original Post Data.
			wp_reset_postdata();

			?>
		</div>
	</div>
</section>
