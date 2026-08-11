<?php
/**
 * No results content.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="sre-no-results">
	<h2 class="sre-no-results__title"><?php esc_html_e( 'No results found', 'sarkariresult' ); ?></h2>
	<p><?php esc_html_e( 'Try a different search or browse the latest updates below.', 'sarkariresult' ); ?></p>
	<?php get_search_form(); ?>

	<h3 class="sre-section__title"><?php esc_html_e( 'Latest Posts', 'sarkariresult' ); ?></h3>
	<div class="sre-card-grid">
		<?php
		$latest = new WP_Query(
			array(
				'posts_per_page'      => 4,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( $latest->have_posts() ) :
			while ( $latest->have_posts() ) :
				$latest->the_post();
				get_template_part( 'template-parts/content', 'card' );
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>
