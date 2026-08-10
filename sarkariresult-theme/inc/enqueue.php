<?php
/**
 * Enqueue scripts and styles.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front-end assets.
 */
function sre_enqueue_assets() {
	$css_path = SRE_DIR . '/assets/css/main.css';
	$js_path  = SRE_DIR . '/assets/js/main.js';
	$css_ver  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : SRE_VERSION;
	$js_ver   = file_exists( $js_path ) ? (string) filemtime( $js_path ) : SRE_VERSION;

	// One purposeful family, limited weights, display=swap.
	wp_enqueue_style(
		'sre-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sre-main',
		SRE_URI . '/assets/css/main.css',
		array( 'sre-fonts' ),
		$css_ver
	);

	wp_enqueue_style(
		'sre-print',
		SRE_URI . '/assets/css/print.css',
		array( 'sre-main' ),
		SRE_VERSION,
		'print'
	);

	// Dynamic CSS variables from Customizer.
	$primary   = sanitize_hex_color( sre_get_mod( 'sre_color_primary', '#061a2e' ) );
	$secondary = sanitize_hex_color( sre_get_mod( 'sre_color_secondary', '#dc2626' ) );
	$accent    = sanitize_hex_color( sre_get_mod( 'sre_color_accent', '#0891b2' ) );

	if ( ! $primary ) {
		$primary = '#061a2e';
	}
	if ( ! $secondary ) {
		$secondary = '#dc2626';
	}
	if ( ! $accent ) {
		$accent = '#0891b2';
	}

	$custom_css = ':root{--sre-primary:' . $primary . ';--sre-secondary:' . $secondary . ';--sre-accent:' . $accent . ';}';
	wp_add_inline_style( 'sre-main', $custom_css );

	wp_enqueue_script(
		'sre-main',
		SRE_URI . '/assets/js/main.js',
		array(),
		$js_ver,
		true
	);

	// Defer when supported (WP 6.3+).
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_script_add_data( 'sre-main', 'strategy', 'defer' );
	}

	wp_localize_script(
		'sre-main',
		'sreData',
		array(
			'tocEnabled' => (bool) sre_get_mod( 'sre_enable_toc', true ),
			'i18n'       => array(
				'menuOpen'  => __( 'Open menu', 'sarkariresult' ),
				'menuClose' => __( 'Close menu', 'sarkariresult' ),
				'tocTitle'  => __( 'Table of Contents', 'sarkariresult' ),
			),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sre_enqueue_assets' );

/**
 * Preconnect for Google Fonts.
 *
 * @param array  $urls          URLs.
 * @param string $relation_type Relation.
 * @return array
 */
function sre_font_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'sre_font_resource_hints', 10, 2 );

/**
 * Remove unnecessary emoji scripts for performance.
 */
function sre_disable_emojis() {
	if ( ! (bool) sre_get_mod( 'sre_disable_emojis', true ) ) {
		return;
	}
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'sre_disable_emojis' );
