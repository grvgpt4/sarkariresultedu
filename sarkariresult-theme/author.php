<?php
/**
 * Author archive.
 *
 * @package SarkariResult
 */

get_header();

$author = get_queried_object();
?>

<main id="main" class="sre-main" tabindex="-1">
	<div class="sre-container sre-layout">
		<div class="sre-content">
			<header class="sre-archive-header sre-author-header">
				<?php sre_breadcrumbs(); ?>
				<div class="sre-author-header__profile">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 96, '', esc_attr( get_the_author() ), array( 'class' => 'sre-author-header__avatar' ) ); ?>
					<div>
						<h1 class="sre-archive-header__title"><?php the_author(); ?></h1>
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
							<p class="sre-archive-header__desc"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</header>

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
