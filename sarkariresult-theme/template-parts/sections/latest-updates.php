<?php
/**
 * Latest updates — asymmetric bento board.
 *
 * @package SarkariResult
 * @var array $args Section args.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = isset( $args['title'] ) ? $args['title'] : __( 'Latest Updates', 'sarkariresult' );
$count = isset( $args['count'] ) ? absint( $args['count'] ) : 6;

$query = new WP_Query(
	array(
		'posts_per_page'         => max( 5, $count ),
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	)
);

if ( ! $query->have_posts() ) {
	return;
}

$posts = $query->posts;
$lead  = array_shift( $posts );
$side  = array_slice( $posts, 0, 2 );
$rest  = array_slice( $posts, 2 );
?>
<section class="sre-section sre-section--latest" aria-labelledby="sre-latest-heading">
	<div class="sre-section__head">
		<div>
			<p class="sre-section__eyebrow"><?php esc_html_e( 'Signal feed', 'sarkariresult' ); ?></p>
			<h2 id="sre-latest-heading" class="sre-section__title"><?php echo esc_html( $title ); ?></h2>
		</div>
	</div>

	<div class="sre-bento">
		<?php
		if ( $lead ) {
			$GLOBALS['post'] = $lead; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $lead );
			?>
			<article <?php post_class( 'sre-bento__lead' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="sre-bento__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
						<?php
						the_post_thumbnail(
							'large',
							array(
								'class'         => 'sre-bento__img',
								'loading'       => 'eager',
								'fetchpriority' => 'high',
							)
						);
						?>
					</a>
				<?php else : ?>
					<a class="sre-bento__media sre-bento__media--empty" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"></a>
				<?php endif; ?>
				<div class="sre-bento__body">
					<div class="sre-bento__meta">
						<?php sre_category_badge(); ?>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
					<h3 class="sre-bento__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="sre-bento__excerpt"><?php echo esc_html( sre_trim_words( get_the_excerpt(), 28 ) ); ?></p>
					<a class="sre-textlink" href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Open update', 'sarkariresult' ); ?>
						<?php echo sre_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</div>
			</article>
			<?php
		}
		?>

		<div class="sre-bento__stack">
			<?php
			foreach ( $side as $item ) {
				$GLOBALS['post'] = $item; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $item );
				?>
				<article <?php post_class( 'sre-bento__tile' ); ?>>
					<div class="sre-bento__meta">
						<?php sre_category_badge(); ?>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
					<h3 class="sre-bento__title sre-bento__title--sm"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</article>
				<?php
			}
			?>
		</div>

		<?php
		foreach ( $rest as $i => $item ) {
			$GLOBALS['post'] = $item; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $item );
			?>
			<article <?php post_class( 'sre-bento__wide' ); ?>>
				<div class="sre-bento__meta">
					<?php sre_category_badge(); ?>
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				</div>
				<h3 class="sre-bento__title sre-bento__title--sm"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="sre-bento__excerpt"><?php echo esc_html( sre_trim_words( get_the_excerpt(), 18 ) ); ?></p>
			</article>
			<?php
		}
		wp_reset_postdata();
		?>
	</div>
</section>
