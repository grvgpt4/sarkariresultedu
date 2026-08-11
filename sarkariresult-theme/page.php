<?php
/**
 * Page template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="container" style="padding: 2rem 0 3rem;">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'content-block' ); ?>>
			<header class="content-block__head">
				<h1><?php the_title(); ?></h1>
			</header>
			<div class="content-block__body">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
