<?php
/**
 * Functions file.
 *
 * @package WordPress
 * @param var $post_id ID of the Post variable.
 */

/* Register navigation menus */
register_nav_menus(
	array(
		'homepage-header' => 'Homepage Header',
		'header' => 'Header',
	)
);

/* Thumbnail Support */
add_theme_support( 'post-thumbnails' );
add_image_size( 'portfolio', 950, 430, true );

/**
 * Register styles and scripts.
 */
function theme_scripts() {
	/* CSS */
	wp_enqueue_style( 'style', get_stylesheet_uri(), null, null, 'all' );

	/* FontAwesome */
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, 'null', 'all' );

	/* Modernizr */
	wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/js/modernizr.js', null, null, true );
	wp_enqueue_script( 'modernizr' );

	/* Load jQuery from Google CDN */
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', null, null, true );
	wp_enqueue_script( 'jquery' );

	/* Webfont Loader */
	wp_register_script( 'webfontloader', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', null, null, true );
	wp_enqueue_script( 'webfontloader' );

	/* Google Fonts */
	wp_register_script( 'googlefonts', get_stylesheet_directory_uri() . '/assets/js/googlefonts.js', array( 'webfontloader' ), null, true );
	wp_enqueue_script( 'googlefonts' );

	/* Custom JavaScript */
	wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'scripts' );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * Custom meta field for linking portfolio posts to their external URLs
 */
class External_URL {

	/**
	 * Check if admin
	 */
	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	/**
	 * Initialize meta boxes
	 */
	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );

	}

	/**
	 * Addd meta boxes to posts
	 */
	public function add_metabox() {

		add_meta_box(
			'',
			__( 'External URL', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'post',
			'advanced',
			'high'
		);

	}

	/**
	 * Render the metaboxes in the editor
	 *
	 * @param var $post Global Post variable.
	 */
	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'url_nonce_action', 'url_nonce' );

		// Retrieve an existing value from the database.
		$external_url = get_post_meta( $post->ID, 'url_external_url', true );

		// Set default values.
		if ( empty( $external_url ) ) {
			$external_url = '';
		}

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="url_external_url" class="url_external_url_label">' . esc_attr__( 'External URL', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="url" id="url_external_url" name="url_external_url" class="url_external_url_field bigwide" placeholder="' . esc_attr__( 'External URL', 'text_domain' ) . '" value="' . esc_attr( $external_url ) . '">';
		echo '			<p class="description">' . esc_attr__( 'URL to link to', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	/**
	 * Save meta field
	 */
	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['url_nonce'] ) ? $_POST['url_nonce'] : '';
		$nonce_action = 'url_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) ) {
			return;
		}

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}

		// Sanitize user input.
		$url_new_external_url = isset( $_POST['url_external_url'] ) ? esc_url( $_POST['url_external_url'] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'url_external_url', $url_new_external_url );

	}

}

new External_URL;
