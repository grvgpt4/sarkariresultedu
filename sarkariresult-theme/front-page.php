<?php
/**
 * Front page — proposal homepage structure.
 *
 * @package SarkariResult
 */

get_header();

$count = sre_posts_per_section();
?>

<main id="main" class="sre-main sre-front-page" tabindex="-1">
	<?php get_template_part( 'template-parts/sections/hero' ); ?>

	<?php sre_render_ad( 'intro', array( 'class' => 'sre-container', 'min_height' => 90 ) ); ?>

	<div class="sre-container sre-front-layout">
		<div class="sre-front-content">
			<?php get_template_part( 'template-parts/sections/quick-tools' ); ?>

			<?php if ( sre_section_enabled( 'latest' ) ) : ?>
				<?php
				get_template_part(
					'template-parts/sections/latest-updates',
					null,
					array(
						'title' => __( 'Latest Updates', 'sarkariresult' ),
						'count' => max( 5, $count ),
					)
				);
				?>
			<?php endif; ?>

			<?php
			sre_render_ad( 'home', array( 'min_height' => 90 ) );
			if ( is_active_sidebar( 'home-ad' ) ) {
				echo '<div class="sre-home-ad-wrap">';
				dynamic_sidebar( 'home-ad' );
				echo '</div>';
			}
			?>

			<?php get_template_part( 'template-parts/sections/dual-lists' ); ?>

			<?php get_template_part( 'template-parts/sections/board-strip' ); ?>

			<?php if ( sre_section_enabled( 'recruitment' ) ) : ?>
				<?php
				get_template_part(
					'template-parts/sections/category-block',
					null,
					array(
						'slug'  => 'recruitment',
						'title' => __( 'Latest Recruitment', 'sarkariresult' ),
						'count' => min( 3, $count ),
					)
				);
				?>
			<?php endif; ?>

			<?php
			// Optional remaining homepage category blocks (admin-controlled).
			$extra = array(
				'answer-key'         => __( 'Latest Answer Key', 'sarkariresult' ),
				'syllabus'           => __( 'Syllabus', 'sarkariresult' ),
				'scholarship'        => __( 'Scholarship', 'sarkariresult' ),
				'exam-date'          => __( 'Exam Date', 'sarkariresult' ),
				'time-table'         => __( 'Time Table', 'sarkariresult' ),
				'sarkari-result'     => __( 'Latest Sarkari Result', 'sarkariresult' ),
			);
			foreach ( $extra as $slug => $label ) {
				if ( ! sre_section_enabled( $slug ) ) {
					continue;
				}
				get_template_part(
					'template-parts/sections/category-block',
					null,
					array(
						'slug'  => $slug,
						'title' => $label,
						'count' => min( 3, $count ),
					)
				);
			}
			?>

			<?php get_template_part( 'template-parts/sections/trust-band' ); ?>
		</div>
	</div>
</main>

<?php
get_footer();
