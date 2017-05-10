<?php
/**
 * Single post template
 *
 * @package WordPress
 */

get_header();
?>
	<section id="content">
		<div class="container">
			<div class="row">
				<main class="twelve col offset-2" role="main">
				<h1><?php the_title(); ?></h1>
				<small><?php the_time( 'd/m/y' ); ?></small>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
				endif;
				?>
				</main>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
