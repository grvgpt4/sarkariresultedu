<?php
/**
 * Theme Customizer settings.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function sre_customize_register( $wp_customize ) {

	/* ---------- Panel ---------- */
	$wp_customize->add_panel(
		'sre_panel',
		array(
			'title'       => __( 'Sarkari Result Theme', 'sarkariresult' ),
			'description' => __( 'Theme settings for branding, homepage, ads, and analytics.', 'sarkariresult' ),
			'priority'    => 30,
		)
	);

	/* ---------- Branding ---------- */
	$wp_customize->add_section(
		'sre_branding',
		array(
			'title' => __( 'Branding & Colors', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	$wp_customize->add_setting(
		'sre_site_tagline',
		array(
			'default'           => __( 'Latest Sarkari Jobs, Results, Admit Card & Education Updates', 'sarkariresult' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'sre_site_tagline',
		array(
			'label'   => __( 'Header subtitle', 'sarkariresult' ),
			'section' => 'sre_branding',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'sre_hero_title',
		array(
			'default'           => __( 'Sarkari Result 2026', 'sarkariresult' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'sre_hero_title',
		array(
			'label'   => __( 'Homepage H1 title', 'sarkariresult' ),
			'section' => 'sre_branding',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'sre_hero_text',
		array(
			'default'           => __( 'Latest Government Jobs, Results, Admit Cards, Answer Keys, Board Results and Education Updates.', 'sarkariresult' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'sre_hero_text',
		array(
			'label'   => __( 'Homepage intro text', 'sarkariresult' ),
			'section' => 'sre_branding',
			'type'    => 'textarea',
		)
	);

	foreach ( array(
		'sre_color_primary'   => array( '#0b3d5c', __( 'Primary color', 'sarkariresult' ) ),
		'sre_color_secondary' => array( '#c0392b', __( 'Secondary / accent red', 'sarkariresult' ) ),
		'sre_color_accent'    => array( '#e67e22', __( 'Accent orange', 'sarkariresult' ) ),
	) as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[0],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$id,
				array(
					'label'   => $data[1],
					'section' => 'sre_branding',
				)
			)
		);
	}

	/* ---------- Homepage ---------- */
	$wp_customize->add_section(
		'sre_homepage',
		array(
			'title' => __( 'Homepage Sections', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	$wp_customize->add_setting(
		'sre_posts_per_section',
		array(
			'default'           => 6,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'sre_posts_per_section',
		array(
			'label'       => __( 'Posts per section', 'sarkariresult' ),
			'section'     => 'sre_homepage',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 3,
				'max' => 12,
			),
		)
	);

	foreach ( sre_homepage_sections() as $slug => $label ) {
		$key = 'sre_show_' . str_replace( '-', '_', $slug );
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => true,
				'sanitize_callback' => 'sre_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => sprintf(
					/* translators: %s: section name */
					__( 'Show: %s', 'sarkariresult' ),
					$label
				),
				'section' => 'sre_homepage',
				'type'    => 'checkbox',
			)
		);
	}

	/* ---------- Article ---------- */
	$wp_customize->add_section(
		'sre_article',
		array(
			'title' => __( 'Article Options', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	foreach ( array(
		'sre_enable_toc'           => array( true, __( 'Enable Table of Contents', 'sarkariresult' ) ),
		'sre_enable_related'       => array( true, __( 'Enable Related Posts', 'sarkariresult' ) ),
		'sre_enable_author_box'    => array( true, __( 'Enable Author Box', 'sarkariresult' ) ),
		'sre_enable_theme_crumbs'  => array( true, __( 'Theme breadcrumbs when Yoast breadcrumbs are off', 'sarkariresult' ) ),
		'sre_disable_emojis'       => array( true, __( 'Disable WordPress emoji scripts', 'sarkariresult' ) ),
	) as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[0],
				'sanitize_callback' => 'sre_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $data[1],
				'section' => 'sre_article',
				'type'    => 'checkbox',
			)
		);
	}

	/* ---------- Footer ---------- */
	$wp_customize->add_section(
		'sre_footer',
		array(
			'title' => __( 'Footer Content', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	$default_about = "Sarkari Result is an educational portal for students and aspirants who will appear in Sarkari Exams. We provide all Sarkari Jobs, online forms, admit cards, answer keys, Sarkari Result 2026, and board and university updates.\n\nSarkariResult.edu.pl is a trusted destination for Sarkari Result 2026, Sarkari Naukri, Latest Jobs, Admit Card, Exam Result, Answer Key, Admission Updates, Board Results, and other education-related notifications. The website is owned by Gaurav Gupta and supported by a dedicated team including Vijay Kumar, Neeraj Kumar Gaur, Yogendra Gupta, and Praveen Kumar Khare.\n\nEvery update published on our website is verified through official notifications and government websites before going live. Our mission is to provide well research, fast, accurate, and free information to students and job aspirants across India.";

	$wp_customize->add_setting(
		'sre_footer_about',
		array(
			'default'           => $default_about,
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'sre_footer_about',
		array(
			'label'   => __( 'About / footer description', 'sarkariresult' ),
			'section' => 'sre_footer',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'sre_newsletter_embed',
		array(
			'default'           => '',
			'sanitize_callback' => 'sre_sanitize_newsletter',
		)
	);
	$wp_customize->add_control(
		'sre_newsletter_embed',
		array(
			'label'       => __( 'Newsletter embed HTML (optional)', 'sarkariresult' ),
			'description' => __( 'Paste Mailchimp / Brevo / ConvertKit embed. Leave empty to hide.', 'sarkariresult' ),
			'section'     => 'sre_footer',
			'type'        => 'textarea',
		)
	);

	/* ---------- Social ---------- */
	$wp_customize->add_section(
		'sre_social',
		array(
			'title' => __( 'Social Links', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	foreach ( array(
		'facebook'  => 'Facebook URL',
		'telegram'  => 'Telegram URL',
		'instagram' => 'Instagram URL',
		'youtube'   => 'YouTube URL',
		'twitter'   => 'Twitter / X URL',
	) as $key => $label ) {
		$wp_customize->add_setting(
			'sre_social_' . $key,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'sre_social_' . $key,
			array(
				'label'   => $label,
				'section' => 'sre_social',
				'type'    => 'url',
			)
		);
	}

	/* ---------- Analytics ---------- */
	$wp_customize->add_section(
		'sre_analytics',
		array(
			'title' => __( 'Analytics', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	$wp_customize->add_setting(
		'sre_ga_id',
		array(
			'default'           => 'G-LKE1MH72PR',
			'sanitize_callback' => 'sre_sanitize_ga_id',
		)
	);
	$wp_customize->add_control(
		'sre_ga_id',
		array(
			'label'       => __( 'GA4 Measurement ID', 'sarkariresult' ),
			'description' => __( 'Theme injects GA4 only if no analytics plugin (Site Kit, MonsterInsights, etc.) is detected. Leave blank to disable.', 'sarkariresult' ),
			'section'     => 'sre_analytics',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting(
		'sre_force_ga',
		array(
			'default'           => false,
			'sanitize_callback' => 'sre_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sre_force_ga',
		array(
			'label'   => __( 'Force theme GA even if a plugin is detected (not recommended)', 'sarkariresult' ),
			'section' => 'sre_analytics',
			'type'    => 'checkbox',
		)
	);

	/* ---------- AdSense ---------- */
	$wp_customize->add_section(
		'sre_ads',
		array(
			'title' => __( 'AdSense', 'sarkariresult' ),
			'panel' => 'sre_panel',
		)
	);

	$wp_customize->add_setting(
		'sre_adsense_publisher',
		array(
			'default'           => 'ca-pub-3078934234879441',
			'sanitize_callback' => 'sre_sanitize_adsense_pub',
		)
	);
	$wp_customize->add_control(
		'sre_adsense_publisher',
		array(
			'label'       => __( 'AdSense Publisher ID', 'sarkariresult' ),
			'description' => __( 'Loads adsbygoogle.js once. Leave blank to disable script.', 'sarkariresult' ),
			'section'     => 'sre_ads',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting(
		'sre_force_adsense',
		array(
			'default'           => false,
			'sanitize_callback' => 'sre_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'sre_force_adsense',
		array(
			'label'   => __( 'Force theme AdSense script even if an ads plugin is detected', 'sarkariresult' ),
			'section' => 'sre_ads',
			'type'    => 'checkbox',
		)
	);

	$placements = array(
		'header'  => __( 'Header / top ad HTML', 'sarkariresult' ),
		'intro'   => __( 'After intro ad HTML', 'sarkariresult' ),
		'top'     => __( 'Article top ad HTML', 'sarkariresult' ),
		'middle'  => __( 'Article middle ad HTML', 'sarkariresult' ),
		'bottom'  => __( 'Article bottom ad HTML', 'sarkariresult' ),
		'sidebar' => __( 'Sidebar ad HTML', 'sarkariresult' ),
		'footer'  => __( 'Footer ad HTML', 'sarkariresult' ),
		'home'    => __( 'Between homepage sections ad HTML', 'sarkariresult' ),
	);

	foreach ( $placements as $key => $label ) {
		$enable = 'sre_ad_' . $key . '_enable';
		$code   = 'sre_ad_' . $key . '_code';

		$wp_customize->add_setting(
			$enable,
			array(
				'default'           => false,
				'sanitize_callback' => 'sre_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			$enable,
			array(
				'label'   => sprintf(
					/* translators: %s: placement name */
					__( 'Enable %s', 'sarkariresult' ),
					ucfirst( $key )
				),
				'section' => 'sre_ads',
				'type'    => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			$code,
			array(
				'default'           => '',
				'sanitize_callback' => 'sre_sanitize_ad_code',
			)
		);
		$wp_customize->add_control(
			$code,
			array(
				'label'   => $label,
				'section' => 'sre_ads',
				'type'    => 'textarea',
			)
		);
	}
}
add_action( 'customize_register', 'sre_customize_register' );

/**
 * Sanitize checkbox.
 *
 * @param mixed $checked Value.
 * @return bool
 */
function sre_sanitize_checkbox( $checked ) {
	return (bool) $checked;
}

/**
 * Sanitize GA4 ID.
 *
 * @param string $id ID.
 * @return string
 */
function sre_sanitize_ga_id( $id ) {
	$id = strtoupper( trim( (string) $id ) );
	if ( preg_match( '/^G-[A-Z0-9]+$/', $id ) ) {
		return $id;
	}
	return '';
}

/**
 * Sanitize AdSense publisher ID.
 *
 * @param string $id ID.
 * @return string
 */
function sre_sanitize_adsense_pub( $id ) {
	$id = strtolower( trim( (string) $id ) );
	if ( preg_match( '/^ca-pub-\d+$/', $id ) ) {
		return $id;
	}
	return '';
}

/**
 * Sanitize ad unit HTML (allow script/ins for AdSense).
 *
 * @param string $code Code.
 * @return string
 */
function sre_sanitize_ad_code( $code ) {
	$allowed = array(
		'script' => array(
			'async'          => true,
			'src'            => true,
			'crossorigin'    => true,
			'type'           => true,
			'data-ad-client' => true,
		),
		'ins'    => array(
			'class'          => true,
			'style'          => true,
			'data-ad-client' => true,
			'data-ad-slot'   => true,
			'data-ad-format' => true,
			'data-full-width-responsive' => true,
		),
		'div'    => array(
			'class' => true,
			'id'    => true,
			'style' => true,
		),
		'span'   => array(
			'class' => true,
			'style' => true,
		),
	);
	return wp_kses( (string) $code, $allowed );
}

/**
 * Sanitize newsletter embed.
 *
 * @param string $html HTML.
 * @return string
 */
function sre_sanitize_newsletter( $html ) {
	return wp_kses_post( $html );
}
