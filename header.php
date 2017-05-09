<?php
/**
 * The template for displaying the theme header
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '|', 'right', true ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/icons/favicon.png" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<div id="<?php echo esc_attr( wp_get_theme()->get( 'TextDomain' ) ); ?>">
			<nav>
				<?php
				if ( is_page( 'home' ) ) {
					wp_nav_menu( array( 'theme_location' => 'homepage-header', 'container' => false, 'menu_class' => 'nav' ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_class' => 'nav' ) );
				}
				?>
			</nav>
