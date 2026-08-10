<?php
/**
 * Header template — editorial masthead.
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
	<div class="sre-topbar">
		<div class="sre-container sre-topbar__inner">
			<p class="sre-topbar__trust">
				<?php echo sre_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php esc_html_e( 'Verified from official government notifications', 'sarkariresult' ); ?></span>
			</p>
			<p class="sre-topbar__date">
				<time datetime="<?php echo esc_attr( gmdate( 'c' ) ); ?>"><?php echo esc_html( date_i18n( 'l, j F Y' ) ); ?></time>
			</p>
		</div>
	</div>

	<div class="sre-masthead">
		<div class="sre-container sre-masthead__inner">
			<div class="sre-masthead__brand">
				<?php sre_site_brand(); ?>
				<?php
				$tagline = sre_get_mod( 'sre_site_tagline', __( 'Latest Sarkari Jobs, Results, Admit Card & Education Updates', 'sarkariresult' ) );
				if ( $tagline ) :
					?>
					<p class="sre-masthead__tagline"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
			</div>

			<div class="sre-masthead__actions">
				<button type="button" class="sre-icon-btn sre-search-toggle" data-sre-search-toggle aria-expanded="false" aria-controls="sre-search-panel" aria-label="<?php esc_attr_e( 'Open search', 'sarkariresult' ); ?>">
					<?php echo sre_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
				<button type="button" class="sre-icon-btn sre-menu-toggle" data-sre-menu-toggle aria-expanded="false" aria-controls="sre-primary-nav" aria-label="<?php esc_attr_e( 'Open menu', 'sarkariresult' ); ?>">
					<?php echo sre_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
			</div>
		</div>
	</div>

	<div class="sre-nav-wrap">
		<div class="sre-container">
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
		</div>
	</div>

	<div id="sre-search-panel" class="sre-search-panel" data-sre-search-panel hidden>
		<div class="sre-container">
			<?php get_search_form(); ?>
		</div>
	</div>

	<?php sre_render_ad( 'header', array( 'class' => 'sre-container sre-ad--topbar', 'min_height' => 90 ) ); ?>
</header>
