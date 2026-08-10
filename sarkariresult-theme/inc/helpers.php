<?php
/**
 * Helper functions.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme mod with fallback.
 *
 * @param string $key     Theme mod key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function sre_get_mod( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * Check if Yoast SEO is active.
 *
 * @return bool
 */
function sre_is_yoast_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'WPSEO_Options' );
}

/**
 * Check if a GA / Site Kit plugin is likely injecting analytics.
 *
 * @return bool
 */
function sre_has_external_analytics() {
	if ( defined( 'GOOGLESITEKIT_VERSION' ) ) {
		return true;
	}
	if ( defined( 'GAWP_VERSION' ) || class_exists( 'Ga_Admin' ) ) {
		return true;
	}
	if ( function_exists( 'monsterinsights_get_ua' ) || defined( 'MONSTERINSIGHTS_VERSION' ) ) {
		return true;
	}
	if ( defined( 'EXACTMETRICS_VERSION' ) ) {
		return true;
	}
	/**
	 * Filter whether an external analytics plugin is active.
	 *
	 * @param bool $has_external Whether external analytics is detected.
	 */
	return (bool) apply_filters( 'sre_has_external_analytics', false );
}

/**
 * Check if AdSense / ads plugin is likely injecting the AdSense library.
 *
 * @return bool
 */
function sre_has_external_adsense() {
	if ( defined( 'ADSENSE_PLUGIN_VERSION' ) || class_exists( 'AdSense' ) ) {
		return true;
	}
	if ( defined( 'ADINSERTER_VERSION' ) || defined( 'AI_VERSION' ) ) {
		return true;
	}
	if ( defined( 'QUADS_VERSION' ) || class_exists( 'QuickAdsenseReloaded' ) ) {
		return true;
	}
	if ( defined( 'GOOGLESITEKIT_VERSION' ) && get_option( 'googlesitekit_adsense_settings' ) ) {
		return true;
	}
	/**
	 * Filter whether an external AdSense plugin is active.
	 *
	 * @param bool $has_external Whether external AdSense is detected.
	 */
	return (bool) apply_filters( 'sre_has_external_adsense', false );
}

/**
 * Get category by slug safely.
 *
 * @param string $slug Category slug.
 * @return WP_Term|null
 */
function sre_get_category_by_slug( $slug ) {
	$slug = sanitize_title( $slug );
	$term = get_category_by_slug( $slug );
	if ( $term && ! is_wp_error( $term ) ) {
		return $term;
	}

	// Fallback: match by sanitized name (handles minor slug differences on existing sites).
	$cats = get_categories(
		array(
			'hide_empty' => false,
		)
	);
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		return null;
	}
	foreach ( $cats as $cat ) {
		if ( sanitize_title( $cat->slug ) === $slug || sanitize_title( $cat->name ) === $slug ) {
			return $cat;
		}
	}
	return null;
}

/**
 * Query recent posts for a category slug. Returns empty if category missing or no posts.
 *
 * @param string $slug  Category slug.
 * @param int    $count Number of posts.
 * @return WP_Query
 */
function sre_query_category_posts( $slug, $count = 6 ) {
	$term = sre_get_category_by_slug( $slug );
	if ( ! $term ) {
		return new WP_Query( array( 'post__in' => array( 0 ) ) );
	}

	return new WP_Query(
		array(
			'posts_per_page'      => absint( $count ),
			'cat'                 => (int) $term->term_id,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => true,
		)
	);
}

/**
 * Homepage section definitions (slug => label).
 *
 * @return array
 */
function sre_homepage_sections() {
	$sections = array(
		'latest'             => __( 'Latest Updates', 'sarkariresult' ),
		'sarkari-result'     => __( 'Latest Sarkari Result', 'sarkariresult' ),
		'recruitment'        => __( 'Latest Recruitment', 'sarkariresult' ),
		'admit-card'         => __( 'Latest Admit Card', 'sarkariresult' ),
		'answer-key'         => __( 'Latest Answer Key', 'sarkariresult' ),
		'board-results'      => __( 'Board Results', 'sarkariresult' ),
		'university-results' => __( 'University Results', 'sarkariresult' ),
		'exam-date'          => __( 'Exam Date', 'sarkariresult' ),
		'time-table'         => __( 'Time Table', 'sarkariresult' ),
		'syllabus'           => __( 'Syllabus', 'sarkariresult' ),
		'scholarship'        => __( 'Scholarship', 'sarkariresult' ),
	);

	/**
	 * Filter homepage section map (slug => title).
	 *
	 * @param array $sections Sections.
	 */
	return apply_filters( 'sre_homepage_sections', $sections );
}

/**
 * Whether a homepage section is enabled.
 *
 * @param string $slug Section slug.
 * @return bool
 */
function sre_section_enabled( $slug ) {
	$key = 'sre_show_' . str_replace( '-', '_', $slug );
	return (bool) sre_get_mod( $key, true );
}

/**
 * Posts per homepage section.
 *
 * @return int
 */
function sre_posts_per_section() {
	return max( 3, min( 12, absint( sre_get_mod( 'sre_posts_per_section', 6 ) ) ) );
}

/**
 * Truncate excerpt safely.
 *
 * @param string $text  Text.
 * @param int    $words Word count.
 * @return string
 */
function sre_trim_words( $text, $words = 22 ) {
	return wp_trim_words( wp_strip_all_tags( $text ), absint( $words ), '&hellip;' );
}

/**
 * Get page permalink by slug if the page exists.
 *
 * @param string $slug Page slug.
 * @return string
 */
function sre_get_page_url_by_slug( $slug ) {
	$page = get_page_by_path( sanitize_title( $slug ) );
	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}
	return '';
}

/**
 * Legal / footer page links (dynamic).
 *
 * @return array Array of label => url.
 */
function sre_legal_links() {
	$map = array(
		__( 'Privacy Policy', 'sarkariresult' )     => array( 'privacy-policy-2', 'privacy-policy' ),
		__( 'Disclaimer', 'sarkariresult' )         => array( 'disclaimer' ),
		__( 'Terms & Conditions', 'sarkariresult' ) => array( 'terms-conditions', 'terms-and-conditions' ),
		__( 'Contact Us', 'sarkariresult' )         => array( 'contact-us', 'contact' ),
		__( 'About Us', 'sarkariresult' )           => array( 'about-us', 'about' ),
	);

	$links = array();
	foreach ( $map as $label => $slugs ) {
		foreach ( (array) $slugs as $slug ) {
			$url = sre_get_page_url_by_slug( $slug );
			if ( $url ) {
				$links[ $label ] = $url;
				break;
			}
		}
	}

	return $links;
}

/**
 * Social networks configured in Customizer.
 *
 * @return array Network key => URL.
 */
function sre_social_links() {
	$networks = array( 'facebook', 'telegram', 'instagram', 'youtube', 'twitter' );
	$links    = array();
	foreach ( $networks as $network ) {
		$url = trim( (string) sre_get_mod( 'sre_social_' . $network, '' ) );
		if ( $url && filter_var( $url, FILTER_VALIDATE_URL ) ) {
			$links[ $network ] = esc_url_raw( $url );
		}
	}
	return $links;
}

/**
 * SVG icon markup (inline, lightweight).
 *
 * @param string $name Icon name.
 * @param string $class Extra class.
 * @return string
 */
function sre_icon( $name, $class = '' ) {
	$icons = array(
		'search'  => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>',
		'menu'    => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>',
		'close'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
		'arrow'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
		'home'    => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
		'top'     => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18 15-6-6-6 6"/></svg>',
		'check'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$class = trim( 'sre-icon sre-icon--' . $name . ' ' . $class );
	return '<span class="' . esc_attr( $class ) . '">' . $icons[ $name ] . '</span>';
}

/**
 * Accessible pagination.
 *
 * @param WP_Query|null $query Query object.
 */
function sre_pagination( $query = null ) {
	global $wp_query;
	$q = $query instanceof WP_Query ? $query : $wp_query;

	if ( $q->max_num_pages <= 1 ) {
		return;
	}

	$links = paginate_links(
		array(
			'total'     => (int) $q->max_num_pages,
			'current'   => max( 1, get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : (int) get_query_var( 'page' ) ),
			'prev_text' => '&larr; ' . esc_html__( 'Previous', 'sarkariresult' ),
			'next_text' => esc_html__( 'Next', 'sarkariresult' ) . ' &rarr;',
			'type'      => 'list',
			'mid_size'  => 1,
			'end_size'  => 1,
		)
	);

	if ( $links ) {
		echo '<nav class="sre-pagination" aria-label="' . esc_attr__( 'Posts pagination', 'sarkariresult' ) . '">';
		echo $links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- paginate_links() is escaped.
		echo '</nav>';
	}
}

/**
 * Primary category for a post (first category).
 *
 * @param int|null $post_id Post ID.
 * @return WP_Term|null
 */
function sre_primary_category( $post_id = null ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$cats    = get_the_category( $post_id );
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		return null;
	}

	// Prefer Yoast primary category when available.
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		$primary = new WPSEO_Primary_Term( 'category', $post_id );
		$term_id = $primary->get_primary_term();
		if ( $term_id && ! is_wp_error( $term_id ) ) {
			$term = get_term( $term_id, 'category' );
			if ( $term && ! is_wp_error( $term ) ) {
				return $term;
			}
		}
	}

	return $cats[0];
}
