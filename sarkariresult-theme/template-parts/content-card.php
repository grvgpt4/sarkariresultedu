<?php
/**
 * Post card for grids / archives.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'sre-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="sre-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php
			the_post_thumbnail(
				'sre-card',
				array(
					'class'   => 'sre-card__img',
					'loading' => 'lazy',
					'alt'     => esc_attr( get_the_title() ),
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="sre-card__body">
		<div class="sre-card__meta-top">
			<?php sre_category_badge(); ?>
			<time class="sre-card__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>
		<h2 class="sre-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="sre-card__excerpt"><?php echo esc_html( sre_trim_words( get_the_excerpt(), 20 ) ); ?></p>
		<div class="sre-card__meta-bottom">
			<span class="sre-card__author"><?php the_author(); ?></span>
			<?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) + DAY_IN_SECONDS ) : ?>
				<span class="sre-card__updated">
					<?php
					printf(
						/* translators: %s: modified date */
						esc_html__( 'Updated %s', 'sarkariresult' ),
						esc_html( get_the_modified_date() )
					);
					?>
				</span>
			<?php endif; ?>
		</div>
	</div>
</article>
