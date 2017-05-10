<?php
/**
 * Latest Blog partial
 *
 * @package WordPress
 */

?>
<section id="latest-blog">
	<h2>Blog</h2>
	<div class="container">
		<div class="row">
			<div class="five col offset-2">
				<h3>A collection of stuff i found on the internet & other fun stories</h3>
				<a href="<?php echo esc_url( home_url() ); ?>/blog" class="btn right">
					All Posts
				</a>
			</div>
			<div class="five col offset-2">
				<?php
				$args = array(
					'post_type' => array( 'post' ),
					'post_status' => array( 'publish' ),
					'posts_per_page' => '1',
					'order' => 'DESC',
					'orderby' => 'date',
					'category_name' => 'news',
				);

				$news = new WP_Query( $args );

				if ( $news->have_posts() ) {
					while ( $news->have_posts() ) {
						$news->the_post();
						?>
						<article>
							<h3><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
							<br>
							<a href="<?php the_permalink(); ?>" class="btn right">Read More</a>
						</article>
						<?php
					}
				}

				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
