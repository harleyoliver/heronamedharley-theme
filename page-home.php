<?php
/**
 * Homepage template
 *
 * @package WordPress
 */

get_header();
get_template_part( 'parts/social' );
get_template_part( 'parts/banner' );
?>
	<section id="about">
		<h2>About</h2>
		<div class="container">
			<div class="row">
				<main class="eight col" role="main">
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
<?php
get_template_part( 'parts/portfolio' );
get_template_part( 'parts/latest-blog' );
get_template_part( 'parts/contact-cta' );
get_footer();
?>
