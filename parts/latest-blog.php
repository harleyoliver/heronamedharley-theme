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
				<article>
					<h3><?php the_title(); ?></h3>
					<?php the_excerpt(); ?>
					<br>
					<a href="<?php the_permalink(); ?>" class="btn right">Read More</a>
				</article>
			</div>
		</div>
	</div>
</section>
