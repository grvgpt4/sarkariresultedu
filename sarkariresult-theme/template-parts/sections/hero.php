<?php
/**
 * Compact homepage intro — brand-first, not a giant hero.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = sre_get_mod( 'sre_hero_title', __( 'Sarkari Result 2026', 'sarkariresult' ) );
$text  = sre_get_mod( 'sre_hero_text', __( 'Latest Government Jobs, Results, Admit Cards, Answer Keys, Board Results and Education Updates.', 'sarkariresult' ) );
?>
<section class="sre-intro" aria-label="<?php esc_attr_e( 'Introduction', 'sarkariresult' ); ?>">
	<div class="sre-container sre-intro__inner">
		<div class="sre-intro__copy">
			<p class="sre-intro__brand" aria-hidden="true"><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Sarkari Result' ); ?></p>
			<h1 class="sre-intro__title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $text ) : ?>
				<p class="sre-intro__text"><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
		</div>
		<div class="sre-intro__aside" aria-hidden="true">
			<span class="sre-intro__mark">SR</span>
			<span class="sre-intro__year"><?php echo esc_html( gmdate( 'Y' ) ); ?></span>
		</div>
	</div>
</section>
