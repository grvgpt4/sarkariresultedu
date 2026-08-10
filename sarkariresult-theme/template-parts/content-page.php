<?php
/**
 * Page content.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sre-page-article' ); ?>>
	<header class="sre-article__header">
		<?php sre_breadcrumbs(); ?>
		<h1 class="sre-article__title"><?php the_title(); ?></h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="sre-article__thumb">
			<?php the_post_thumbnail( 'large', array( 'class' => 'sre-article__img' ) ); ?>
		</figure>
	<?php endif; ?>

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
</article>
