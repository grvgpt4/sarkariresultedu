<?php
/**
 * Search results template.
 *
 * @package SarkariResult
 */

get_header();

global $wp_query;
$result_count = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
?>

<main id="main" class="sre-main" tabindex="-1">
	<div class="sre-container sre-layout">
		<div class="sre-content">
			<header class="sre-archive-header">
				<?php sre_breadcrumbs(); ?>
				<h1 class="sre-archive-header__title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search Results For: “%s”', 'sarkariresult' ),
						esc_html( get_search_query() )
					);
					?>
				</h1>
				<?php if ( have_posts() ) : ?>
					<p class="sre-archive-header__desc">
						<?php
						printf(
							/* translators: %d: number of results */
							esc_html( _n( '%d result found', '%d results found', $result_count, 'sarkariresult' ) ),
							(int) $result_count
						);
						?>
					</p>
				<?php endif; ?>
				<div class="sre-search-again">
					<?php get_search_form(); ?>
				</div>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="sre-card-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					?>
				</div>
				<?php sre_pagination(); ?>

				<section class="sre-related-cats" aria-label="<?php esc_attr_e( 'Relevant categories', 'sarkariresult' ); ?>">
					<h2 class="sre-section__title"><?php esc_html_e( 'Browse Categories', 'sarkariresult' ); ?></h2>
					<ul class="sre-chip-list">
						<?php
						$cats = get_categories(
							array(
								'number'  => 10,
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
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
