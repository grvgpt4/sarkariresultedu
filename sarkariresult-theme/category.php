<?php
/**
 * Category archive.
 *
 * @package SarkariResult
 */

get_header();

$term = get_queried_object();
?>

<main id="main" class="sre-main" tabindex="-1">
	<div class="sre-container sre-layout">
		<div class="sre-content">
			<header class="sre-archive-header">
				<?php sre_breadcrumbs(); ?>
				<h1 class="sre-archive-header__title"><?php single_cat_title(); ?></h1>
				<?php
				$desc = category_description();
				if ( $desc ) :
					?>
					<div class="sre-archive-header__desc"><?php echo wp_kses_post( $desc ); ?></div>
				<?php else : ?>
					<p class="sre-archive-header__desc">
						<?php
						printf(
							/* translators: %s: category name */
							esc_html__( 'Latest %s updates', 'sarkariresult' ),
							esc_html( single_cat_title( '', false ) )
						);
						?>
					</p>
				<?php endif; ?>
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
