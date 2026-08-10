<?php
/**
 * Template tags / display helpers.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display site logo or text brand.
 */
function sre_site_brand() {
	echo '<a class="sre-brand" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
	if ( has_custom_logo() ) {
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		echo wp_get_attachment_image(
			$logo_id,
			'full',
			false,
			array(
				'class'    => 'sre-brand__logo',
				'loading'  => 'eager',
				'decoding' => 'async',
				'alt'      => esc_attr( get_bloginfo( 'name' ) ),
			)
		);
	} else {
		echo '<span class="sre-brand__text">' . esc_html( get_bloginfo( 'name' ) ?: 'Sarkari Result' ) . '</span>';
	}
	echo '</a>';
}

/**
 * Display breadcrumbs — prefer Yoast when available and enabled.
 */
function sre_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		// Yoast outputs nothing useful if breadcrumbs disabled in settings.
		ob_start();
		yoast_breadcrumb( '<nav class="sre-breadcrumbs sre-breadcrumbs--yoast" aria-label="' . esc_attr__( 'Breadcrumb', 'sarkariresult' ) . '">', '</nav>' );
		$out = trim( ob_get_clean() );
		if ( $out && false === strpos( $out, 'breadcrumb_error' ) && strip_tags( $out ) !== '' ) {
			echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}
	}

	if ( ! sre_get_mod( 'sre_enable_theme_crumbs', true ) ) {
		return;
	}

	if ( is_front_page() ) {
		return;
	}

	$items   = array();
	$items[] = array(
		'url'  => home_url( '/' ),
		'name' => __( 'Home', 'sarkariresult' ),
	);

	if ( is_category() || is_tag() || is_tax() ) {
		$term = get_queried_object();
		if ( $term && ! is_wp_error( $term ) ) {
			$items[] = array(
				'url'  => '',
				'name' => $term->name,
			);
		}
	} elseif ( is_singular( 'post' ) ) {
		$cat = sre_primary_category();
		if ( $cat ) {
			$items[] = array(
				'url'  => get_category_link( $cat->term_id ),
				'name' => $cat->name,
			);
		}
		$items[] = array(
			'url'  => '',
			'name' => get_the_title(),
		);
	} elseif ( is_page() ) {
		$items[] = array(
			'url'  => '',
			'name' => get_the_title(),
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'url'  => '',
			'name' => sprintf(
				/* translators: %s: search query */
				__( 'Search: %s', 'sarkariresult' ),
				get_search_query()
			),
		);
	} elseif ( is_author() ) {
		$items[] = array(
			'url'  => '',
			'name' => get_the_author(),
		);
	} elseif ( is_archive() ) {
		$items[] = array(
			'url'  => '',
			'name' => get_the_archive_title(),
		);
	} elseif ( is_404() ) {
		$items[] = array(
			'url'  => '',
			'name' => __( 'Page Not Found', 'sarkariresult' ),
		);
	}

	if ( count( $items ) < 2 ) {
		return;
	}

	echo '<nav class="sre-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'sarkariresult' ) . '"><ol class="sre-breadcrumbs__list">';
	$last = count( $items ) - 1;
	foreach ( $items as $i => $item ) {
		$name = wp_strip_all_tags( $item['name'] );
		echo '<li class="sre-breadcrumbs__item">';
		if ( $i < $last && ! empty( $item['url'] ) ) {
			echo '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $name ) . '</a>';
		} else {
			echo '<span aria-current="page">' . esc_html( $name ) . '</span>';
		}
		echo '</li>';
	}
	echo '</ol></nav>';
}

/**
 * Post meta line: published, updated, author.
 *
 * @param int|null $post_id Post ID.
 */
function sre_post_meta( $post_id = null ) {
	$post_id   = $post_id ? (int) $post_id : get_the_ID();
	$published = get_the_date( '', $post_id );
	$modified  = get_the_modified_date( '', $post_id );
	$author_id = (int) get_post_field( 'post_author', $post_id );
	?>
	<div class="sre-meta">
		<span class="sre-meta__item sre-meta__published">
			<span class="sre-meta__label"><?php esc_html_e( 'Published:', 'sarkariresult' ); ?></span>
			<time class="sre-meta__time" datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $post_id ) ); ?>"><?php echo esc_html( $published ); ?></time>
		</span>
		<?php if ( get_the_modified_time( 'U', $post_id ) > get_the_time( 'U', $post_id ) + DAY_IN_SECONDS ) : ?>
			<span class="sre-meta__item sre-meta__updated">
				<span class="sre-meta__label"><?php esc_html_e( 'Updated:', 'sarkariresult' ); ?></span>
				<time class="sre-meta__time" datetime="<?php echo esc_attr( get_the_modified_date( DATE_W3C, $post_id ) ); ?>"><?php echo esc_html( $modified ); ?></time>
			</span>
		<?php endif; ?>
		<?php if ( $author_id ) : ?>
			<span class="sre-meta__item sre-meta__author">
				<span class="sre-meta__label"><?php esc_html_e( 'By', 'sarkariresult' ); ?></span>
				<a class="sre-meta__author-link" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></a>
			</span>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Category badge for current post in loop.
 */
function sre_category_badge() {
	$cat = sre_primary_category();
	if ( ! $cat ) {
		return;
	}
	printf(
		'<a class="sre-badge" href="%1$s">%2$s</a>',
		esc_url( get_category_link( $cat->term_id ) ),
		esc_html( $cat->name )
	);
}

/**
 * Related posts query (same category preferred).
 *
 * @param int $count Count.
 * @return WP_Query
 */
function sre_related_posts_query( $count = 4 ) {
	$post_id = get_the_ID();
	$cats    = wp_get_post_categories( $post_id );
	$args    = array(
		'posts_per_page'         => absint( $count ),
		'post__not_in'           => array( $post_id ),
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	);

	if ( ! empty( $cats ) ) {
		$args['category__in'] = $cats;
	}

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		unset( $args['category__in'] );
		$tags = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );
		if ( ! empty( $tags ) ) {
			$args['tag__in'] = $tags;
			$query           = new WP_Query( $args );
		}
	}

	if ( ! $query->have_posts() ) {
		unset( $args['tag__in'] );
		$query = new WP_Query( $args );
	}

	return $query;
}

/**
 * Auto TOC: add IDs to H2/H3 on output (does not modify DB).
 *
 * @param string $content Content.
 * @return string
 */
function sre_add_heading_ids( $content ) {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( ! sre_get_mod( 'sre_enable_toc', true ) ) {
		return $content;
	}
	if ( false === stripos( $content, '<h2' ) && false === stripos( $content, '<h3' ) ) {
		return $content;
	}

	$used = array();
	$content = preg_replace_callback(
		'/<h([23])([^>]*)>(.*?)<\/h\1>/is',
		static function ( $m ) use ( &$used ) {
			$level   = $m[1];
			$attrs   = $m[2];
			$inner   = $m[3];
			$text    = wp_strip_all_tags( $inner );
			$base    = sanitize_title( $text );
			if ( ! $base ) {
				$base = 'section';
			}
			$id = $base;
			$i  = 2;
			while ( isset( $used[ $id ] ) ) {
				$id = $base . '-' . $i;
				$i++;
			}
			$used[ $id ] = true;

			if ( preg_match( '/\sid=("|\')/i', $attrs ) ) {
				return $m[0];
			}
			return '<h' . $level . $attrs . ' id="' . esc_attr( $id ) . '">' . $inner . '</h' . $level . '>';
		},
		$content
	);

	return $content;
}
add_filter( 'the_content', 'sre_add_heading_ids', 8 );

/**
 * Build TOC HTML from content headings (for template use).
 *
 * @param string $content Post content.
 * @return string
 */
function sre_build_toc( $content ) {
	if ( ! sre_get_mod( 'sre_enable_toc', true ) ) {
		return '';
	}
	if ( ! preg_match_all( '/<h([23])[^>]*id=("|\')([^"\']+)\2[^>]*>(.*?)<\/h\1>/is', $content, $matches, PREG_SET_ORDER ) ) {
		// Headings may not have IDs yet; parse raw.
		if ( ! preg_match_all( '/<h([23])[^>]*>(.*?)<\/h\1>/is', $content, $matches, PREG_SET_ORDER ) ) {
			return '';
		}
		$items = array();
		foreach ( $matches as $m ) {
			$text = wp_strip_all_tags( $m[2] );
			$id   = sanitize_title( $text );
			if ( ! $text || ! $id ) {
				continue;
			}
			$items[] = array(
				'level' => (int) $m[1],
				'id'    => $id,
				'text'  => $text,
			);
		}
	} else {
		$items = array();
		foreach ( $matches as $m ) {
			$text = wp_strip_all_tags( $m[4] );
			if ( ! $text ) {
				continue;
			}
			$items[] = array(
				'level' => (int) $m[1],
				'id'    => $m[3],
				'text'  => $text,
			);
		}
	}

	if ( count( $items ) < 2 ) {
		return '';
	}

	$html  = '<nav class="sre-toc" aria-label="' . esc_attr__( 'Table of Contents', 'sarkariresult' ) . '">';
	$html .= '<div class="sre-toc__header">';
	$html .= '<strong class="sre-toc__title">' . esc_html__( 'Table of Contents', 'sarkariresult' ) . '</strong>';
	$html .= '<button type="button" class="sre-toc__toggle" aria-expanded="true" data-sre-toc-toggle>' . esc_html__( 'Hide', 'sarkariresult' ) . '</button>';
	$html .= '</div><ol class="sre-toc__list" data-sre-toc-list>';
	foreach ( $items as $item ) {
		$html .= '<li class="sre-toc__item sre-toc__item--h' . (int) $item['level'] . '">';
		$html .= '<a href="#' . esc_attr( $item['id'] ) . '">' . esc_html( $item['text'] ) . '</a>';
		$html .= '</li>';
	}
	$html .= '</ol></nav>';

	return $html;
}

/**
 * Wrap tables for horizontal scroll on mobile (output filter, no DB change).
 *
 * @param string $content Content.
 * @return string
 */
function sre_wrap_tables( $content ) {
	if ( false === stripos( $content, '<table' ) ) {
		return $content;
	}
	$content = preg_replace(
		'/(<table[^>]*>.*?<\/table>)/is',
		'<div class="sre-table-wrap">$1</div>',
		$content
	);
	return $content;
}
add_filter( 'the_content', 'sre_wrap_tables', 12 );
