<?php
/**
 * 404 template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="sre-main sre-404" tabindex="-1">
	<div class="sre-container">
		<header class="sre-404__header">
			<p class="sre-404__code" aria-hidden="true">404</p>
			<h1 class="sre-404__title"><?php esc_html_e( 'Page Not Found', 'sarkariresult' ); ?></h1>
			<p class="sre-404__text"><?php esc_html_e( 'The page you are looking for may have been moved or no longer exists. Try searching or browse the latest updates.', 'sarkariresult' ); ?></p>
			<div class="sre-404__search">
				<?php get_search_form(); ?>
			</div>
			<p><a class="sre-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'sarkariresult' ); ?></a></p>
		</header>

		<section class="sre-404__latest" aria-labelledby="sre-404-latest">
			<h2 id="sre-404-latest" class="sre-section__title"><?php esc_html_e( 'Latest Posts', 'sarkariresult' ); ?></h2>
			<div class="sre-card-grid">
				<?php
				$latest = new WP_Query(
					array(
						'posts_per_page'         => 6,
						'ignore_sticky_posts'    => true,
						'no_found_rows'          => true,
					)
				);
				if ( $latest->have_posts() ) :
					while ( $latest->have_posts() ) :
						$latest->the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</section>

		<section class="sre-404__cats" aria-labelledby="sre-404-cats">
			<h2 id="sre-404-cats" class="sre-section__title"><?php esc_html_e( 'Popular Categories', 'sarkariresult' ); ?></h2>
			<ul class="sre-chip-list">
				<?php
				$cats = get_categories(
					array(
						'number'  => 12,
						'orderby' => 'count',
						'order'   => 'DESC',
					)
				);
				foreach ( $cats as $cat ) {
					echo '<li><a class="sre-chip" href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
				}
				?>
			</ul>
		</section>
	</div>
</main>

<?php
get_footer();
