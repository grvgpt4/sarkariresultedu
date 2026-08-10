<?php
/**
 * Front page template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="sre-main sre-front-page" tabindex="-1">
	<?php get_template_part( 'template-parts/sections/hero' ); ?>

	<?php sre_render_ad( 'intro', array( 'class' => 'sre-container', 'min_height' => 90 ) ); ?>

	<div class="sre-container sre-front-layout">
		<div class="sre-front-content">
			<?php
			$sections = sre_homepage_sections();
			$count    = sre_posts_per_section();
			$i        = 0;

			foreach ( $sections as $slug => $label ) {
				if ( ! sre_section_enabled( $slug ) ) {
					continue;
				}

				if ( 'latest' === $slug ) {
					get_template_part(
						'template-parts/sections/latest-updates',
						null,
						array(
							'title' => $label,
							'count' => $count,
						)
					);
				} else {
					get_template_part(
						'template-parts/sections/category-block',
						null,
						array(
							'slug'  => $slug,
							'title' => $label,
							'count' => $count,
						)
					);
				}

				$i++;
				if ( 1 === $i ) {
					sre_render_ad( 'home', array( 'min_height' => 90 ) );
					if ( is_active_sidebar( 'home-ad' ) ) {
						echo '<div class="sre-home-ad-wrap">';
						dynamic_sidebar( 'home-ad' );
						echo '</div>';
					}
				}
			}
			?>
		</div>
	</div>
</main>

<?php
get_footer();
