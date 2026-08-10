<?php
/**
 * Sarkari Result Theme functions and definitions.
 *
 * @package SarkariResult
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SRE_VERSION', '1.1.0' );
define( 'SRE_DIR', get_template_directory() );
define( 'SRE_URI', get_template_directory_uri() );

/**
 * Load theme includes.
 */
$sre_includes = array(
	'inc/helpers.php',
	'inc/theme-setup.php',
	'inc/enqueue.php',
	'inc/widgets.php',
	'inc/customizer.php',
	'inc/performance.php',
	'inc/ads.php',
	'inc/analytics.php',
	'inc/template-tags.php',
);

foreach ( $sre_includes as $sre_file ) {
	$sre_path = SRE_DIR . '/' . $sre_file;
	if ( file_exists( $sre_path ) ) {
		require_once $sre_path;
	}
}
