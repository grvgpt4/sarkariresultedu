<?php
/**
 * Performance helpers.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove WP version from head (minor hardening; not a security fix alone).
 */
function sre_remove_version() {
	return '';
}
add_filter( 'the_generator', 'sre_remove_version' );

/**
 * Disable embeds script when not needed on archives.
 */
function sre_dequeue_embed() {
	if ( is_singular() ) {
		return;
	}
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'sre_dequeue_embed' );

/**
 * Preconnect hints only when AdSense or GA is theme-managed.
 *
 * @param array  $urls          URLs.
 * @param string $relation_type Relation.
 * @return array
 */
function sre_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	if ( function_exists( 'sre_should_output_adsense' ) && sre_should_output_adsense() ) {
		$urls[] = array(
			'href'        => 'https://pagead2.googlesyndication.com',
			'crossorigin' => 'anonymous',
		);
	}

	if ( function_exists( 'sre_should_output_analytics' ) && sre_should_output_analytics() ) {
		$urls[] = 'https://www.googletagmanager.com';
		$urls[] = 'https://www.google-analytics.com';
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'sre_resource_hints', 10, 2 );

/**
 * Limit heartbeat on front-end.
 */
function sre_disable_heartbeat_frontend() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'heartbeat' );
	}
}
add_action( 'init', 'sre_disable_heartbeat_frontend', 1 );
