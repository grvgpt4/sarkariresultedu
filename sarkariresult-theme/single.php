<?php
/**
 * Single post template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="sre-main sre-single" tabindex="-1">
	<div class="sre-container sre-layout">
		<div class="sre-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'single' );
			endwhile;
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
