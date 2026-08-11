<?php
/**
 * Main index template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="container" style="padding: 2rem 0 3rem;">
	<?php if ( have_posts() ) : ?>
		<header class="section-label" style="text-align:left;margin-bottom:1.5rem;">
			<h1><?php echo esc_html( is_home() ? __( 'Latest Updates', 'sarkariresult' ) : wp_get_document_title() ); ?></h1>
		</header>
		<div class="triple-cols__grid" style="grid-template-columns:1fr;">
			<article class="list-panel">
				<ul class="list-panel__list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
					<?php endwhile; ?>
				</ul>
			</article>
		</div>
		<div style="margin-top:1.5rem;">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts found.', 'sarkariresult' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
