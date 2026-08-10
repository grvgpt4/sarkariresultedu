<?php
/**
 * Trust band.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="sre-trust" aria-label="<?php esc_attr_e( 'Why trust Sarkari Result', 'sarkariresult' ); ?>">
	<div class="sre-trust__grid">
		<div class="sre-trust__item">
			<span class="sre-trust__icon" aria-hidden="true"><?php echo sre_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<div>
				<strong class="sre-trust__title"><?php esc_html_e( 'Verified sources', 'sarkariresult' ); ?></strong>
				<p class="sre-trust__text"><?php esc_html_e( 'Updates checked against official government notifications before publishing.', 'sarkariresult' ); ?></p>
			</div>
		</div>
		<div class="sre-trust__item">
			<span class="sre-trust__icon" aria-hidden="true"><?php echo sre_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<div>
				<strong class="sre-trust__title"><?php esc_html_e( 'Fast updates', 'sarkariresult' ); ?></strong>
				<p class="sre-trust__text"><?php esc_html_e( 'Results, admit cards and jobs published quickly for students across India.', 'sarkariresult' ); ?></p>
			</div>
		</div>
		<div class="sre-trust__item">
			<span class="sre-trust__icon" aria-hidden="true"><?php echo sre_icon( 'home' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<div>
				<strong class="sre-trust__title"><?php esc_html_e( 'Free for students', 'sarkariresult' ); ?></strong>
				<p class="sre-trust__text"><?php esc_html_e( 'Open access educational information — no paid wall for essential updates.', 'sarkariresult' ); ?></p>
			</div>
		</div>
	</div>
</section>
