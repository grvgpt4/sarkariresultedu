<?php
/**
 * Ad slot template part (optional include).
 *
 * Usage: get_template_part( 'template-parts/ads/ad-slot', null, array( 'placement' => 'header' ) );
 *
 * @package SarkariResult
 * @var array $args Args.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$placement = isset( $args['placement'] ) ? $args['placement'] : 'header';
sre_render_ad( $placement );
