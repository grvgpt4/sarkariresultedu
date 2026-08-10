<?php
/**
 * Latest updates — featured lead + supporting list.
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
		'posts_per_page'         => max( 4, $count ),
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
?>
<section class="sre-section sre-section--latest" aria-labelledby="sre-latest-heading">
	<div class="sre-section__head">
		<h2 id="sre-latest-heading" class="sre-section__title"><?php echo esc_html( $title ); ?></h2>
		<span class="sre-section__rule" aria-hidden="true"></span>
	</div>

	<div class="sre-latest">
		<?php
		if ( $lead ) {
			$GLOBALS['post'] = $lead; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $lead );
			?>
			<article <?php post_class( 'sre-lead' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="sre-lead__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
						<?php
						the_post_thumbnail(
							'large',
							array(
								'class'    => 'sre-lead__img',
								'loading'  => 'eager',
								'fetchpriority' => 'high',
							)
						);
						?>
					</a>
				<?php endif; ?>
				<div class="sre-lead__body">
					<div class="sre-lead__meta">
						<?php sre_category_badge(); ?>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
					<h3 class="sre-lead__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<p class="sre-lead__excerpt"><?php echo esc_html( sre_trim_words( get_the_excerpt(), 28 ) ); ?></p>
					<a class="sre-readmore" href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Read update', 'sarkariresult' ); ?>
						<?php echo sre_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</div>
			</article>
			<?php
		}
		?>

		<div class="sre-latest__rail" role="list">
			<?php
			foreach ( $posts as $item ) {
				$GLOBALS['post'] = $item; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $item );
				?>
				<article <?php post_class( 'sre-rail-item' ); ?> role="listitem">
					<div class="sre-rail-item__meta">
						<?php sre_category_badge(); ?>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
					<h3 class="sre-rail-item__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</article>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
