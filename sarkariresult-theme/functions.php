<?php
/**
 * Sarkari Result Premium — theme functions.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SRE_VERSION', '1.0.0' );
define( 'SRE_DIR', get_template_directory() );
define( 'SRE_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function sre_theme_setup() {
	load_theme_textdomain( 'sarkariresult', SRE_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'sarkariresult' ),
			'footer'  => __( 'Footer Menu', 'sarkariresult' ),
		)
	);
}
add_action( 'after_setup_theme', 'sre_theme_setup' );

/**
 * Enqueue styles and scripts.
 */
function sre_enqueue_assets() {
	wp_enqueue_style(
		'sre-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sre-main',
		SRE_URI . '/assets/css/main.css',
		array( 'sre-fonts' ),
		SRE_VERSION
	);

	wp_enqueue_script(
		'sre-main',
		SRE_URI . '/assets/js/main.js',
		array(),
		SRE_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sre_enqueue_assets' );

/**
 * Fallback primary menu.
 */
function sre_fallback_menu() {
	$items = array(
		home_url( '/' ) => __( 'Home', 'sarkariresult' ),
		home_url( '/#latest-jobs' ) => __( 'Latest Jobs', 'sarkariresult' ),
		home_url( '/#admit-cards' ) => __( 'Admit Cards', 'sarkariresult' ),
		home_url( '/#syllabus' ) => __( 'Syllabus', 'sarkariresult' ),
		home_url( '/#results' ) => __( 'Results', 'sarkariresult' ),
		home_url( '/#railway' ) => __( 'RRB Naukri', 'sarkariresult' ),
		home_url( '/#admission' ) => __( 'Admission', 'sarkariresult' ),
	);

	echo '<ul id="nav-menu" class="nav-list">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s"%s>%s</a></li>',
			esc_url( $url ),
			( home_url( '/' ) === $url && is_front_page() ) ? ' class="is-active"' : '',
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Category archive URL by slug, with hash fallback.
 *
 * @param string $slug Category slug.
 * @param string $hash Fallback hash on front page.
 * @return string
 */
function sre_cat_url( $slug, $hash = '' ) {
	$term = get_category_by_slug( $slug );
	if ( $term && ! is_wp_error( $term ) ) {
		return get_category_link( $term->term_id );
	}
	return $hash ? home_url( '/#' . ltrim( $hash, '#' ) ) : home_url( '/' );
}

/**
 * Recent post links for a category slug.
 *
 * @param string $slug  Category slug.
 * @param int    $count Number of posts.
 * @param array  $fallback Fallback labels when no posts.
 */
function sre_list_category_posts( $slug, $count = 8, $fallback = array() ) {
	$term = get_category_by_slug( $slug );
	$query_args = array(
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	if ( $term && ! is_wp_error( $term ) ) {
		$query_args['cat'] = (int) $term->term_id;
	}

	$q = new WP_Query( $query_args );

	if ( $q->have_posts() ) {
		while ( $q->have_posts() ) {
			$q->the_post();
			echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
		}
		wp_reset_postdata();
		return;
	}

	foreach ( $fallback as $item ) {
		$label = is_array( $item ) ? $item['label'] : $item;
		$url   = is_array( $item ) && ! empty( $item['url'] ) ? $item['url'] : '#';
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
}
