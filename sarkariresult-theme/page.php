<?php
/**
 * Page template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="sre-main sre-page" tabindex="-1">
	<div class="sre-container sre-layout sre-layout--page">
		<div class="sre-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile;
			?>
		</div>
	</div>
</main>

<?php
get_footer();
