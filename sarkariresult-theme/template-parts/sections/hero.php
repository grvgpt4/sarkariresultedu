<?php
/**
 * Homepage intro — bold brand-first composition.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title   = sre_get_mod( 'sre_hero_title', __( 'Sarkari Result 2026', 'sarkariresult' ) );
$text    = sre_get_mod( 'sre_hero_text', __( 'Latest Government Jobs, Results, Admit Cards, Answer Keys, Board Results and Education Updates.', 'sarkariresult' ) );
$results = sre_get_category_by_slug( 'results' );
$jobs    = sre_get_category_by_slug( 'recruitment' );
?>
<section class="sre-intro" aria-label="<?php esc_attr_e( 'Introduction', 'sarkariresult' ); ?>">
	<div class="sre-container">
		<div class="sre-intro__panel">
			<div class="sre-intro__copy">
				<p class="sre-intro__eyebrow">
					<span class="sre-pulse" aria-hidden="true"></span>
					<?php echo esc_html( get_bloginfo( 'name' ) ?: 'Sarkari Result' ); ?>
					<span class="sre-intro__live"><?php esc_html_e( 'Live updates', 'sarkariresult' ); ?></span>
				</p>
				<h1 class="sre-intro__title"><?php echo esc_html( $title ); ?></h1>
				<?php if ( $text ) : ?>
					<p class="sre-intro__text"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>
				<div class="sre-intro__actions">
					<?php if ( $results ) : ?>
						<a class="sre-btn" href="<?php echo esc_url( get_category_link( $results->term_id ) ); ?>"><?php esc_html_e( 'Explore results', 'sarkariresult' ); ?></a>
					<?php endif; ?>
					<?php if ( $jobs ) : ?>
						<a class="sre-btn sre-btn--ghost" href="<?php echo esc_url( get_category_link( $jobs->term_id ) ); ?>"><?php esc_html_e( 'Open jobs', 'sarkariresult' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="sre-intro__art" aria-hidden="true">
				<div class="sre-intro__ring"></div>
				<div class="sre-intro__ring sre-intro__ring--2"></div>
				<span class="sre-intro__mark">SR</span>
			</div>
		</div>

		<?php
		$chip_slugs = array( 'results', 'admit-card', 'recruitment', 'answer-key', 'board-results', 'syllabus', 'university-results', 'scholarship' );
		$chips      = array();
		foreach ( $chip_slugs as $slug ) {
			$term = sre_get_category_by_slug( $slug );
			if ( $term ) {
				$chips[] = $term;
			}
		}
		if ( $chips ) :
			?>
			<div class="sre-chips" aria-label="<?php esc_attr_e( 'Popular categories', 'sarkariresult' ); ?>">
				<?php foreach ( $chips as $term ) : ?>
					<a class="sre-chip" href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
