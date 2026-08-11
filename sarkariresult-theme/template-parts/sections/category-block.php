<?php
/**
 * Category block for homepage.
 *
 * @package SarkariResult
 * @var array $args Section args (slug, title, count).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug  = isset( $args['slug'] ) ? sanitize_title( $args['slug'] ) : '';
$title = isset( $args['title'] ) ? $args['title'] : '';
$count = isset( $args['count'] ) ? absint( $args['count'] ) : 6;

if ( ! $slug ) {
	return;
}

$term = sre_get_category_by_slug( $slug );
if ( ! $term ) {
	return;
}

$query = sre_query_category_posts( $slug, $count );
if ( ! $query->have_posts() ) {
	return;
}

$heading_id = 'sre-section-' . $slug;
?>
<section class="sre-section sre-section--category" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
	<div class="sre-section__head">
		<div>
			<p class="sre-section__eyebrow"><?php echo esc_html( $term->name ); ?></p>
			<h2 id="<?php echo esc_attr( $heading_id ); ?>" class="sre-section__title">
				<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>"><?php echo esc_html( $title ? $title : $term->name ); ?></a>
			</h2>
		</div>
		<a class="sre-section__more" href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">
			<?php esc_html_e( 'View all', 'sarkariresult' ); ?>
			<?php echo sre_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
	<div class="sre-card-grid">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/content', 'card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
