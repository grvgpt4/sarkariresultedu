<?php
/**
 * Dual lists: Latest Results + Latest Admit Cards.
 *
 * @package SarkariResult
 */

defined( 'ABSPATH' ) || exit;

$results_cat = sre_get_category_by_slug( 'results' );
if ( ! $results_cat ) {
	$results_cat = sre_get_category_by_slug( 'sarkari-result' );
}
$admit_cat = sre_get_category_by_slug( 'admit-card' );

$results_q = $results_cat ? sre_query_category_posts( $results_cat->slug, 8 ) : null;
$admits_q  = $admit_cat ? sre_query_category_posts( $admit_cat->slug, 8 ) : null;

$has_results = $results_q && $results_q->have_posts();
$has_admits  = $admits_q && $admits_q->have_posts();

if ( ! $results_cat && ! $admit_cat ) {
	return;
}
?>
<section class="sre-section sre-dual" aria-label="<?php esc_attr_e( 'Results and admit cards', 'sarkariresult' ); ?>">
	<div class="sre-dual__grid">
		<div class="sre-dual__col">
			<div class="sre-dual__head">
				<div>
					<p class="sre-section__eyebrow"><?php esc_html_e( 'Verified', 'sarkariresult' ); ?></p>
					<h2 class="sre-dual__title"><?php esc_html_e( 'Latest Results', 'sarkariresult' ); ?></h2>
				</div>
				<?php if ( $results_cat ) : ?>
					<a class="sre-section__more" href="<?php echo esc_url( get_category_link( $results_cat->term_id ) ); ?>"><?php esc_html_e( 'View all', 'sarkariresult' ); ?></a>
				<?php endif; ?>
			</div>
			<?php if ( $has_results ) : ?>
				<ul class="sre-dual__list">
					<?php
					while ( $results_q->have_posts() ) :
						$results_q->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<span class="sre-dual__dot" aria-hidden="true"></span>
								<span class="sre-dual__link-text"><?php the_title(); ?></span>
								<span class="sre-dual__meta"><?php echo esc_html( get_the_date( 'd M' ) ); ?></span>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="sre-dual__empty"><?php esc_html_e( 'No results published yet.', 'sarkariresult' ); ?></p>
			<?php endif; ?>
		</div>

		<div class="sre-dual__col">
			<div class="sre-dual__head">
				<div>
					<p class="sre-section__eyebrow"><?php esc_html_e( 'Download', 'sarkariresult' ); ?></p>
					<h2 class="sre-dual__title"><?php esc_html_e( 'Latest Admit Cards', 'sarkariresult' ); ?></h2>
				</div>
				<?php if ( $admit_cat ) : ?>
					<a class="sre-section__more" href="<?php echo esc_url( get_category_link( $admit_cat->term_id ) ); ?>"><?php esc_html_e( 'View all', 'sarkariresult' ); ?></a>
				<?php endif; ?>
			</div>
			<?php if ( $has_admits ) : ?>
				<ul class="sre-dual__list">
					<?php
					while ( $admits_q->have_posts() ) :
						$admits_q->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<span class="sre-dual__dot sre-dual__dot--alt" aria-hidden="true"></span>
								<span class="sre-dual__link-text"><?php the_title(); ?></span>
								<span class="sre-dual__meta"><?php echo esc_html( get_the_date( 'd M' ) ); ?></span>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="sre-dual__empty"><?php esc_html_e( 'No admit cards published yet.', 'sarkariresult' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
