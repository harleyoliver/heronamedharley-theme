<?php
/**
 * Page templte for the 404 Not Found page.
 *
 * @package WordPress
 */

get_header(); ?>
<section id="content">
	<div class="container">
		<div class="row">
			<main class="eight col offset-4" role="main">
				<h1>Not Found</h1>
				<br>
				<p><a href="<?php echo esc_url( home_url() ); ?>">Come back</a> to and see if you can relocate what you're after</p>
			</main>
		</div>
	</div>
</section>
<?php get_footer(); ?>
