<?php
/**
 * Related posts.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! sre_get_mod( 'sre_enable_related', true ) ) {
	return;
}

$query = sre_related_posts_query( 4 );
if ( ! $query->have_posts() ) {
	return;
}
?>
<section class="sre-related" aria-labelledby="sre-related-title">
	<h2 id="sre-related-title" class="sre-section__title"><?php esc_html_e( 'Related Posts', 'sarkariresult' ); ?></h2>
	<div class="sre-related__grid">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			?>
			<article class="sre-related__item">
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="sre-related__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
						<?php the_post_thumbnail( 'sre-related', array( 'loading' => 'lazy', 'class' => 'sre-related__img' ) ); ?>
					</a>
				<?php endif; ?>
				<h3 class="sre-related__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</article>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
