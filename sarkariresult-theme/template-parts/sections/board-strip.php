<?php
/**
 * Board & University strip.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tiles = array(
	array(
		'label' => __( 'Board Results', 'sarkariresult' ),
		'slug'  => 'board-results',
		'note'  => __( 'State & central boards', 'sarkariresult' ),
	),
	array(
		'label' => __( 'University Results', 'sarkariresult' ),
		'slug'  => 'university-results',
		'note'  => __( 'Semester & annual', 'sarkariresult' ),
	),
	array(
		'label' => __( 'Scholarship', 'sarkariresult' ),
		'slug'  => 'scholarship',
		'note'  => __( 'Schemes & deadlines', 'sarkariresult' ),
	),
	array(
		'label' => __( 'Syllabus', 'sarkariresult' ),
		'slug'  => 'syllabus',
		'note'  => __( 'Exam syllabus PDFs', 'sarkariresult' ),
	),
	array(
		'label' => __( 'Exam Date', 'sarkariresult' ),
		'slug'  => 'exam-date',
		'note'  => __( 'Schedules & notices', 'sarkariresult' ),
	),
	array(
		'label' => __( 'Time Table', 'sarkariresult' ),
		'slug'  => 'time-table',
		'note'  => __( 'Routines & dates', 'sarkariresult' ),
	),
);

$items = array();
foreach ( $tiles as $tile ) {
	$term = sre_get_category_by_slug( $tile['slug'] );
	if ( $term ) {
		$tile['url'] = get_category_link( $term->term_id );
		$items[]     = $tile;
	}
}

if ( empty( $items ) ) {
	return;
}
?>
<section class="sre-section sre-boards" aria-labelledby="sre-boards-heading">
	<div class="sre-section__head">
		<div>
			<p class="sre-section__eyebrow"><?php esc_html_e( 'Education desk', 'sarkariresult' ); ?></p>
			<h2 id="sre-boards-heading" class="sre-section__title"><?php esc_html_e( 'Board & University', 'sarkariresult' ); ?></h2>
		</div>
	</div>
	<div class="sre-boards__grid">
		<?php foreach ( $items as $item ) : ?>
			<a class="sre-board" href="<?php echo esc_url( $item['url'] ); ?>">
				<span class="sre-board__label"><?php echo esc_html( $item['label'] ); ?></span>
				<span class="sre-board__note"><?php echo esc_html( $item['note'] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
