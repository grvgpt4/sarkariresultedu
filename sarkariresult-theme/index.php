<?php
/**
 * Main fallback template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="sre-main" tabindex="-1">
	<div class="sre-container sre-layout">
		<div class="sre-content">
			<?php if ( have_posts() ) : ?>
				<div class="sre-card-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					?>
				</div>
				<?php sre_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php
get_footer();
