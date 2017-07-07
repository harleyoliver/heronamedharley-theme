<?php
/**
 * Mobile Navigation template part
 *
 * @package WordPress
 */

?>
<div id="mobile-nav">
	<?php
	wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_class' => 'mobile-nav' ) );
	?>
	<span>
		<i class="fa fa-bars"></i>
	</span>
</div>
