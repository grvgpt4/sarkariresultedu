<?php
/**
 * Single post content.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sre-article' ); ?>>
	<header class="sre-article__header">
		<?php sre_breadcrumbs(); ?>
		<div class="sre-article__cats"><?php sre_category_badge(); ?></div>
		<h1 class="sre-article__title"><?php the_title(); ?></h1>
		<?php sre_post_meta(); ?>
		<p class="sre-trust-line">
			<?php echo sre_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php esc_html_e( 'Information verified through official notifications and government sources before publishing.', 'sarkariresult' ); ?>
		</p>
	</header>

	<?php sre_render_ad( 'top', array( 'min_height' => 90 ) ); ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="sre-article__thumb">
			<?php
			the_post_thumbnail(
				'large',
				array(
					'class' => 'sre-article__img',
					'alt'   => esc_attr( get_the_title() ),
				)
			);
			$caption = get_the_post_thumbnail_caption();
			if ( $caption ) {
				echo '<figcaption class="sre-article__caption">' . esc_html( $caption ) . '</figcaption>';
			}
			?>
		</figure>
	<?php endif; ?>

	<?php
	// TOC from raw content (IDs added via the_content filter).
	$raw = get_post_field( 'post_content', get_the_ID() );
	$toc = sre_build_toc( $raw );
	if ( $toc ) {
		echo $toc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built with escaping.
	}
	?>

	<div class="entry-content sre-entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="sre-page-links">' . esc_html__( 'Pages:', 'sarkariresult' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php
	// Middle ad is injected via the_content filter (sre_inject_middle_ad).
	sre_render_ad( 'bottom', array( 'min_height' => 90 ) );
	?>

	<footer class="sre-article__footer">
		<?php
		$tags = get_the_tag_list( '', ', ' );
		if ( $tags ) :
			?>
			<div class="sre-article__tags">
				<span class="sre-article__tags-label"><?php esc_html_e( 'Tags:', 'sarkariresult' ); ?></span>
				<?php echo $tags; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/author-box' ); ?>
		<?php get_template_part( 'template-parts/related-posts' ); ?>
	</footer>

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
</article>
