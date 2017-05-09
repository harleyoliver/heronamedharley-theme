<?php
/**
 * Blog template
 *
 * @package WordPress
 */

get_header();
?>
	<section id="content">
		<div class="container">
			<div class="row">
				<main class="twelve col offset-2" role="main">
					<h1>Latest News & Projects</h1>
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							?>
							<article class="<?php post_class( 'row' ); ?>">
								<h3><?php the_title(); ?></h3>
								<small>
									<?php the_time( 'd/m/y' ); ?>
								</small>
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
							</article>
							<?php
						endwhile;
					endif;
					?>
				</main>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
