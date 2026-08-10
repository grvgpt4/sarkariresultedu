<?php
/**
 * Google Analytics 4 — inject only when no conflicting plugin is present.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether theme should output GA4.
 *
 * @return bool
 */
function sre_should_output_analytics() {
	$id = sre_sanitize_ga_id( sre_get_mod( 'sre_ga_id', 'G-LKE1MH72PR' ) );
	if ( ! $id ) {
		return false;
	}
	if ( sre_has_external_analytics() && ! sre_get_mod( 'sre_force_ga', false ) ) {
		return false;
	}
	return true;
}

/**
 * Print GA4 in head (async, once).
 */
function sre_output_analytics() {
	if ( is_admin() || ! sre_should_output_analytics() ) {
		return;
	}

	$id = sre_sanitize_ga_id( sre_get_mod( 'sre_ga_id', 'G-LKE1MH72PR' ) );
	if ( ! $id ) {
		return;
	}

	$src = 'https://www.googletagmanager.com/gtag/js?id=' . rawurlencode( $id );
	?>
	<!-- Google Analytics (theme-managed, single instance) -->
	<script async src="<?php echo esc_url( $src ); ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', <?php echo wp_json_encode( $id ); ?>);
	</script>
	<?php
}
add_action( 'wp_head', 'sre_output_analytics', 5 );
