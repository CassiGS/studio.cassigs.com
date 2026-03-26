<?php
/**
 * indice functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package indice
 * @since indice 1.0
 */

declare( strict_types = 1 );

if ( ! function_exists( 'indice_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since indice 1.0
	 * @return void
	 */
	function indice_support() {

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

		// Make theme available for translation.
		load_theme_textdomain( 'indice' );
	}

endif;

add_action( 'after_setup_theme', 'indice_support' );

if ( ! function_exists( 'indice_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since indice 1.0
	 * @return void
	 */
	function indice_styles() {

		// Register theme stylesheet.
		wp_register_style(
			'indice-style',
			get_stylesheet_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'indice-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'indice_styles' );

if ( ! function_exists( 'indice_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since indice 1.0.7
	 * @return void
	 */
	function indice_block_stylesheets() {
		$indice_styled_blocks = array(
			'core/post-featured-image' => 'post-featured-image'
		);

		foreach ( $indice_styled_blocks as $block_name_with_namespace => $block_name ) {
			wp_enqueue_block_style(
				$block_name_with_namespace,
				array(
					'handle' => 'indice-' . $block_name,
					'src'    => get_template_directory_uri() . '/assets/css/blocks/' . $block_name . '.css',
					'path'   => get_template_directory() . '/assets/css/blocks/' . $block_name . '.css',
				)
			);
		}
	}
endif;

add_action( 'init', 'indice_block_stylesheets' );

if ( ! function_exists( 'has_body_class' ) ) :
	/**
	 * Helper function to detect body classes early
	 *
	 * @since indice 1.0.7
	 * @param string $class Class name to check
	 * @return bool
	 */
	function has_body_class( $class ) {
		$classes = get_body_class();
		return in_array( $class, $classes, true );
	}
endif;

if ( ! function_exists( 'indice_register_scripts' ) ) :
	/**
	 * Register a custom JS for the hover effect
	 *
	 * @since indice 1.0.7
	 * @return void
	 */
	function indice_register_scripts() {
		wp_register_script(
			'post-featured-image',
			get_template_directory_uri() . '/assets/js/post-featured-image.js',
			array(),
			filemtime( get_template_directory() . '/assets/js/post-featured-image.js' ),
			true
		);
	}
endif;

add_action( 'wp_enqueue_scripts', 'indice_register_scripts', 5 );

if ( ! function_exists( 'indice_enqueue_hover_script' ) ) :
	/**
	 * Enqueue a custom JS on the Page Gallery template
	 *
	 * @since indice 1.0.7
	 * @return void
	 */
	function indice_enqueue_hover_script() {
		add_action( 'wp_enqueue_scripts', function() {
			if ( has_body_class( 'page-template-page-gallery' ) ) {
				wp_enqueue_script('post-featured-image');
			}
		}, 20 );
	}
endif;

add_action( 'wp', 'indice_enqueue_hover_script' );
