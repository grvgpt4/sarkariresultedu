<?php
/**
 * Post card — modern content tile.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'sre-card' ); ?>>
	<a class="sre-card__link" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<span class="sre-card__media">
				<?php
				the_post_thumbnail(
					'sre-card',
					array(
						'class'   => 'sre-card__img',
						'loading' => 'lazy',
						'alt'     => '',
					)
				);
				?>
			</span>
		<?php else : ?>
			<span class="sre-card__media sre-card__media--empty" aria-hidden="true"></span>
		<?php endif; ?>

		<span class="sre-card__body">
			<span class="sre-card__meta-top">
				<?php
				$cat = sre_primary_category();
				if ( $cat ) {
					echo '<span class="sre-badge">' . esc_html( $cat->name ) . '</span>';
				}
				?>
				<time class="sre-card__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</span>
			<span class="sre-card__title"><?php the_title(); ?></span>
			<span class="sre-card__excerpt"><?php echo esc_html( sre_trim_words( get_the_excerpt(), 16 ) ); ?></span>
		</span>
	</a>
</article>
