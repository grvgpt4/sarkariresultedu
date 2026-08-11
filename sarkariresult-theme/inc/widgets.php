<?php
/**
 * Widget areas.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register sidebars / widget areas.
 */
function sre_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'sarkariresult' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears on single posts and archives.', 'sarkariresult' ),
			'before_widget' => '<section id="%1$s" class="sre-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sre-widget__title widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 1', 'sarkariresult' ),
			'id'            => 'footer-1',
			'description'   => __( 'Footer about / intro column.', 'sarkariresult' ),
			'before_widget' => '<section id="%1$s" class="sre-footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sre-footer-widget__title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 2', 'sarkariresult' ),
			'id'            => 'footer-2',
			'description'   => __( 'Footer categories / links.', 'sarkariresult' ),
			'before_widget' => '<section id="%1$s" class="sre-footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sre-footer-widget__title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 3', 'sarkariresult' ),
			'id'            => 'footer-3',
			'description'   => __( 'Footer important pages.', 'sarkariresult' ),
			'before_widget' => '<section id="%1$s" class="sre-footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sre-footer-widget__title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 4', 'sarkariresult' ),
			'id'            => 'footer-4',
			'description'   => __( 'Footer contact / social.', 'sarkariresult' ),
			'before_widget' => '<section id="%1$s" class="sre-footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="sre-footer-widget__title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Homepage Ad Area', 'sarkariresult' ),
			'id'            => 'home-ad',
			'description'   => __( 'Optional widget area between homepage sections.', 'sarkariresult' ),
			'before_widget' => '<div id="%1$s" class="sre-home-ad widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="screen-reader-text">',
			'after_title'   => '</span>',
		)
	);
}
add_action( 'widgets_init', 'sre_widgets_init' );
