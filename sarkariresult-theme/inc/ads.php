<?php
/**
 * AdSense helpers — load script once, render configurable slots.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether theme should output the AdSense library.
 *
 * @return bool
 */
function sre_should_output_adsense() {
	$pub = sre_get_mod( 'sre_adsense_publisher', 'ca-pub-3078934234879441' );
	if ( ! $pub ) {
		return false;
	}
	if ( sre_has_external_adsense() && ! sre_get_mod( 'sre_force_adsense', false ) ) {
		return false;
	}
	// Only load if at least one placement is enabled with code, or publisher set for auto ads.
	$placements = array( 'header', 'intro', 'top', 'middle', 'bottom', 'sidebar', 'footer', 'home' );
	foreach ( $placements as $key ) {
		if ( sre_get_mod( 'sre_ad_' . $key . '_enable', false ) && sre_get_mod( 'sre_ad_' . $key . '_code', '' ) ) {
			return true;
		}
	}
	// Publisher alone can enable Auto Ads.
	return (bool) apply_filters( 'sre_adsense_autoload', false );
}

/**
 * Enqueue AdSense script once.
 */
function sre_enqueue_adsense() {
	if ( is_admin() || ! sre_should_output_adsense() ) {
		return;
	}

	$pub = sre_sanitize_adsense_pub( sre_get_mod( 'sre_adsense_publisher', 'ca-pub-3078934234879441' ) );
	if ( ! $pub ) {
		return;
	}

	wp_enqueue_script(
		'sre-adsense',
		'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . rawurlencode( $pub ),
		array(),
		null,
		false
	);

	// Ensure crossorigin / async attributes.
	add_filter(
		'script_loader_tag',
		static function ( $tag, $handle ) use ( $pub ) {
			if ( 'sre-adsense' !== $handle ) {
				return $tag;
			}
			if ( false === strpos( $tag, 'async' ) ) {
				$tag = str_replace( ' src', ' async src', $tag );
			}
			if ( false === strpos( $tag, 'crossorigin' ) ) {
				$tag = str_replace( ' src', ' crossorigin="anonymous" src', $tag );
			}
			return $tag;
		},
		10,
		2
	);
}
add_action( 'wp_enqueue_scripts', 'sre_enqueue_adsense', 20 );

/**
 * Inject middle ad after roughly the 2nd paragraph (output only, no DB change).
 *
 * @param string $content Content.
 * @return string
 */
function sre_inject_middle_ad( $content ) {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( ! sre_get_mod( 'sre_ad_middle_enable', false ) || ! sre_get_mod( 'sre_ad_middle_code', '' ) ) {
		return $content;
	}

	static $done = false;
	if ( $done ) {
		return $content;
	}
	$done = true;

	ob_start();
	sre_render_ad( 'middle', array( 'min_height' => 90 ) );
	$ad = ob_get_clean();
	if ( ! $ad ) {
		return $content;
	}

	$parts = preg_split( '/(<\/p>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE );
	if ( ! $parts || count( $parts ) < 5 ) {
		return $content . $ad;
	}

	$out      = '';
	$p_count  = 0;
	$inserted = false;
	$total    = count( $parts );

	for ( $i = 0; $i < $total; $i++ ) {
		$out .= $parts[ $i ];
		if ( '</p>' === strtolower( $parts[ $i ] ) ) {
			$p_count++;
			if ( 2 === $p_count && ! $inserted ) {
				$out     .= $ad;
				$inserted = true;
			}
		}
	}

	if ( ! $inserted ) {
		$out .= $ad;
	}

	return $out;
}
add_filter( 'the_content', 'sre_inject_middle_ad', 14 );

/**
 * Render an ad placement.
 *
 * @param string $placement Placement key.
 * @param array  $args      Optional args (class, min_height).
 */
function sre_render_ad( $placement, $args = array() ) {
	$placement = sanitize_key( $placement );
	$enabled   = (bool) sre_get_mod( 'sre_ad_' . $placement . '_enable', false );
	$code      = sre_get_mod( 'sre_ad_' . $placement . '_code', '' );

	$class      = isset( $args['class'] ) ? $args['class'] : '';
	$min_height = isset( $args['min_height'] ) ? absint( $args['min_height'] ) : 90;

	if ( ! $enabled || ! $code ) {
		// Empty reserved placeholder only in customizer preview for layout planning.
		if ( is_customize_preview() ) {
			printf(
				'<div class="sre-ad sre-ad--%1$s sre-ad--placeholder %2$s" style="min-height:%3$dpx" aria-hidden="true"><span>%4$s</span></div>',
				esc_attr( $placement ),
				esc_attr( $class ),
				(int) $min_height,
				esc_html( sprintf(
					/* translators: %s: placement name */
					__( 'Ad slot: %s', 'sarkariresult' ),
					$placement
				) )
			);
		}
		return;
	}

	printf(
		'<div class="sre-ad sre-ad--%1$s %2$s" style="min-height:%3$dpx" data-ad-placement="%1$s">',
		esc_attr( $placement ),
		esc_attr( $class ),
		(int) $min_height
	);
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- sanitized via sre_sanitize_ad_code on save.
	echo sre_sanitize_ad_code( $code );
	echo '</div>';
}
