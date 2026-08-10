<?php
/**
 * Sidebar template.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) && ! sre_get_mod( 'sre_ad_sidebar_enable', false ) ) {
	return;
}
?>
<aside id="secondary" class="sre-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'sarkariresult' ); ?>">
	<?php sre_render_ad( 'sidebar', array( 'min_height' => 250 ) ); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
		<section class="sre-widget">
			<h2 class="sre-widget__title"><?php esc_html_e( 'Search', 'sarkariresult' ); ?></h2>
			<?php get_search_form(); ?>
		</section>

		<section class="sre-widget">
			<h2 class="sre-widget__title"><?php esc_html_e( 'Latest Posts', 'sarkariresult' ); ?></h2>
			<ul class="sre-widget-posts">
				<?php
				$recent = new WP_Query(
					array(
						'posts_per_page'         => 5,
						'ignore_sticky_posts'    => true,
						'no_found_rows'          => true,
						'update_post_meta_cache' => false,
					)
				);
				if ( $recent->have_posts() ) :
					while ( $recent->have_posts() ) :
						$recent->the_post();
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</ul>
		</section>

		<section class="sre-widget">
			<h2 class="sre-widget__title"><?php esc_html_e( 'Categories', 'sarkariresult' ); ?></h2>
			<ul class="sre-widget-cats">
				<?php
				wp_list_categories(
					array(
						'title_li' => '',
						'number'   => 12,
						'orderby'  => 'count',
						'order'    => 'DESC',
					)
				);
				?>
			</ul>
		</section>
	<?php endif; ?>
</aside>
