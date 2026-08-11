<?php
/**
 * Single post template.
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
				<p style="color:var(--muted);font-size:0.9rem;margin-bottom:1.25rem;">
					<?php echo esc_html( get_the_date() ); ?>
					<?php
					$cats = get_the_category();
					if ( $cats ) {
						echo ' · ' . esc_html( $cats[0]->name );
					}
					?>
				</p>
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'large' );
				}
				the_content();
				?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
