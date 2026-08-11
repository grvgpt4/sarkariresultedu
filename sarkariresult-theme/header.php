<?php
/**
 * Theme header.
 *
 * @package SarkariResult
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'sarkariresult' ); ?></a>

<header class="site-header">
	<div class="brand-bar">
		<div class="brand-bar__bg" aria-hidden="true"></div>
		<div class="container brand-bar__inner">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="brand__mark"><?php bloginfo( 'name' ); ?></span>
					<span class="brand__url"><?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ?: 'sarkariresult.edu.pl' ); ?></span>
				<?php endif; ?>
			</a>
		</div>
	</div>

	<nav class="main-nav" aria-label="<?php esc_attr_e( 'Primary', 'sarkariresult' ); ?>">
		<div class="container main-nav__inner">
			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-menu" aria-label="<?php esc_attr_e( 'Open menu', 'sarkariresult' ); ?>">
				<span></span><span></span><span></span>
			</button>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'nav-menu',
						'menu_class'     => 'nav-list',
						'depth'          => 1,
						'fallback_cb'    => 'sre_fallback_menu',
					)
				);
			} else {
				sre_fallback_menu();
			}
			?>
			<a class="search-btn" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'sarkariresult' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
					<circle cx="11" cy="11" r="7" /><path d="M20 20l-3.5-3.5" />
				</svg>
			</a>
		</div>
	</nav>
</header>
