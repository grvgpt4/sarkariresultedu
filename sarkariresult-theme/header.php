<?php
/**
 * Header — Next.js / modern product style.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sre-skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'sarkariresult' ); ?></a>

<header class="sre-header" role="banner">
	<div class="sre-header__bar sre-container">
		<div class="sre-header__left">
			<?php sre_site_brand(); ?>
		</div>

		<nav id="sre-primary-nav" class="sre-nav" data-sre-nav aria-label="<?php esc_attr_e( 'Primary', 'sarkariresult' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'sre-nav__list',
						'fallback_cb'    => false,
						'depth'          => 2,
					)
				);
			} else {
				echo '<ul class="sre-nav__list sre-nav__list--fallback">';
				echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'sarkariresult' ) . '</a></li>';
				$fallback_slugs = array( 'recruitment', 'results', 'admit-card', 'answer-key', 'syllabus', 'time-table', 'board-results' );
				foreach ( $fallback_slugs as $slug ) {
					$term = sre_get_category_by_slug( $slug );
					if ( $term ) {
						echo '<li><a href="' . esc_url( get_category_link( $term->term_id ) ) . '">' . esc_html( $term->name ) . '</a></li>';
					}
				}
				echo '</ul>';
			}
			?>
		</nav>

		<div class="sre-header__right">
			<button type="button" class="sre-icon-btn sre-search-toggle" data-sre-search-toggle aria-expanded="false" aria-controls="sre-search-panel" aria-label="<?php esc_attr_e( 'Open search', 'sarkariresult' ); ?>">
				<?php echo sre_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
			<button type="button" class="sre-icon-btn sre-menu-toggle" data-sre-menu-toggle aria-expanded="false" aria-controls="sre-primary-nav" aria-label="<?php esc_attr_e( 'Open menu', 'sarkariresult' ); ?>">
				<?php echo sre_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
		</div>
	</div>

	<div id="sre-search-panel" class="sre-search-panel" data-sre-search-panel hidden>
		<div class="sre-container">
			<?php get_search_form(); ?>
		</div>
	</div>

	<?php sre_render_ad( 'header', array( 'class' => 'sre-container sre-ad--topbar', 'min_height' => 90 ) ); ?>
</header>
