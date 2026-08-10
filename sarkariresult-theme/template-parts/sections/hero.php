<?php
/**
 * Homepage intro — Next.js-style brand composition.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = sre_get_mod( 'sre_hero_title', __( 'Sarkari Result 2026', 'sarkariresult' ) );
$text  = sre_get_mod( 'sre_hero_text', __( 'Latest Government Jobs, Results, Admit Cards, Answer Keys, Board Results and Education Updates.', 'sarkariresult' ) );
$tagline = sre_get_mod( 'sre_site_tagline', __( 'Latest Sarkari Jobs, Results, Admit Card & Education Updates', 'sarkariresult' ) );
?>
<section class="sre-intro" aria-label="<?php esc_attr_e( 'Introduction', 'sarkariresult' ); ?>">
	<div class="sre-container sre-intro__inner">
		<p class="sre-intro__eyebrow"><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Sarkari Result' ); ?></p>
		<h1 class="sre-intro__title"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $text ) : ?>
			<p class="sre-intro__text"><?php echo esc_html( $text ); ?></p>
		<?php elseif ( $tagline ) : ?>
			<p class="sre-intro__text"><?php echo esc_html( $tagline ); ?></p>
		<?php endif; ?>
		<div class="sre-intro__actions">
			<?php
			$results = sre_get_category_by_slug( 'results' );
			$jobs    = sre_get_category_by_slug( 'recruitment' );
			if ( $results ) :
				?>
				<a class="sre-btn" href="<?php echo esc_url( get_category_link( $results->term_id ) ); ?>"><?php esc_html_e( 'Browse results', 'sarkariresult' ); ?></a>
			<?php endif; ?>
			<?php if ( $jobs ) : ?>
				<a class="sre-btn sre-btn--secondary" href="<?php echo esc_url( get_category_link( $jobs->term_id ) ); ?>"><?php esc_html_e( 'Latest jobs', 'sarkariresult' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
