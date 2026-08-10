<?php
/**
 * Latest updates section.
 *
 * @package SarkariResult
 * @var array $args Section args.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = isset( $args['title'] ) ? $args['title'] : __( 'Latest Updates', 'sarkariresult' );
$count = isset( $args['count'] ) ? absint( $args['count'] ) : 6;

$query = new WP_Query(
	array(
		'posts_per_page'         => $count,
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	)
);

if ( ! $query->have_posts() ) {
	return;
}
?>
<section class="sre-section sre-section--latest" aria-labelledby="sre-latest-heading">
	<div class="sre-section__head">
		<h2 id="sre-latest-heading" class="sre-section__title"><?php echo esc_html( $title ); ?></h2>
	</div>
	<div class="sre-card-grid sre-card-grid--featured">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/content', 'card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
