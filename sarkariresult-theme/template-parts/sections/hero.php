<?php
/**
 * Compact homepage hero / intro.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = sre_get_mod( 'sre_hero_title', __( 'Sarkari Result 2026', 'sarkariresult' ) );
$text  = sre_get_mod( 'sre_hero_text', __( 'Latest Government Jobs, Results, Admit Cards, Answer Keys, Board Results and Education Updates.', 'sarkariresult' ) );
?>
<section class="sre-hero" aria-label="<?php esc_attr_e( 'Introduction', 'sarkariresult' ); ?>">
	<div class="sre-container">
		<h1 class="sre-hero__title"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $text ) : ?>
			<p class="sre-hero__text"><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>
	</div>
</section>
