<?php
/**
 * Theme setup.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function sre_theme_setup() {
	load_theme_textdomain( 'sarkariresult', SRE_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support( 'custom-logo', array(
		'height'      => 72,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );

	// Image sizes — keep minimal to avoid bloat.
	set_post_thumbnail_size( 800, 450, true );
	add_image_size( 'sre-card', 480, 270, true );
	add_image_size( 'sre-related', 360, 200, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'sarkariresult' ),
			'footer'  => __( 'Footer Menu', 'sarkariresult' ),
		)
	);

	// Yoast breadcrumbs support (does not force enable).
	add_theme_support( 'yoast-seo-breadcrumbs' );
}
add_action( 'after_setup_theme', 'sre_theme_setup' );

/**
 * Content width.
 */
function sre_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sre_content_width', 760 );
}
add_action( 'after_setup_theme', 'sre_content_width', 0 );

/**
 * Excerpt length for cards.
 *
 * @param int $length Length.
 * @return int
 */
function sre_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'sre_excerpt_length', 20 );

/**
 * Excerpt more.
 *
 * @return string
 */
function sre_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'sre_excerpt_more' );

/**
 * Add body classes.
 *
 * @param array $classes Classes.
 * @return array
 */
function sre_body_classes( $classes ) {
	if ( is_singular() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	if ( is_front_page() ) {
		$classes[] = 'sre-front';
	}
	$classes[] = 'sre-theme';
	return $classes;
}
add_filter( 'body_class', 'sre_body_classes' );

/**
 * Add fetchpriority / loading attributes for LCP featured image on singular.
 *
 * @param array        $attr       Attributes.
 * @param WP_Post      $attachment Attachment.
 * @param string|int[] $size       Size.
 * @return array
 */
function sre_post_thumbnail_attr( $attr, $attachment, $size ) {
	if ( is_singular() && in_the_loop() && is_main_query() ) {
		static $done = false;
		if ( ! $done ) {
			$attr['loading']       = 'eager';
			$attr['fetchpriority'] = 'high';
			$attr['decoding']      = 'async';
			$done                  = true;
			return $attr;
		}
	}
	if ( empty( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}
	if ( empty( $attr['decoding'] ) ) {
		$attr['decoding'] = 'async';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'sre_post_thumbnail_attr', 10, 3 );
