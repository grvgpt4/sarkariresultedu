<?php
/**
 * Quick tools strip.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tools = array(
	array(
		'slug'  => 'results',
		'label' => __( 'Check Result', 'sarkariresult' ),
		'desc'  => __( 'Latest exam results', 'sarkariresult' ),
		'icon'  => 'check',
	),
	array(
		'slug'  => 'admit-card',
		'label' => __( 'Download Admit Card', 'sarkariresult' ),
		'desc'  => __( 'Hall tickets & city slips', 'sarkariresult' ),
		'icon'  => 'arrow',
	),
	array(
		'slug'  => 'recruitment',
		'label' => __( 'Latest Jobs', 'sarkariresult' ),
		'desc'  => __( 'New government vacancies', 'sarkariresult' ),
		'icon'  => 'home',
	),
	array(
		'slug'  => 'answer-key',
		'label' => __( 'Answer Key', 'sarkariresult' ),
		'desc'  => __( 'Official keys & papers', 'sarkariresult' ),
		'icon'  => 'search',
	),
);

$items = array();
foreach ( $tools as $tool ) {
	$term = sre_get_category_by_slug( $tool['slug'] );
	if ( $term ) {
		$tool['url']  = get_category_link( $term->term_id );
		$tool['term'] = $term;
		$items[]      = $tool;
	}
}

if ( empty( $items ) ) {
	return;
}
?>
<section class="sre-section sre-tools" aria-labelledby="sre-tools-heading">
	<div class="sre-section__head">
		<div>
			<p class="sre-section__eyebrow"><?php esc_html_e( 'Quick access', 'sarkariresult' ); ?></p>
			<h2 id="sre-tools-heading" class="sre-section__title"><?php esc_html_e( 'Quick Tools', 'sarkariresult' ); ?></h2>
		</div>
	</div>
	<div class="sre-tools__grid">
		<?php foreach ( $items as $item ) : ?>
			<a class="sre-tool" href="<?php echo esc_url( $item['url'] ); ?>">
				<span class="sre-tool__icon" aria-hidden="true"><?php echo sre_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="sre-tool__body">
					<span class="sre-tool__label"><?php echo esc_html( $item['label'] ); ?></span>
					<span class="sre-tool__desc"><?php echo esc_html( $item['desc'] ); ?></span>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
