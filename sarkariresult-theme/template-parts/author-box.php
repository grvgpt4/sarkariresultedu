<?php
/**
 * Author box.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! sre_get_mod( 'sre_enable_author_box', true ) ) {
	return;
}

$author_id = (int) get_the_author_meta( 'ID' );
if ( ! $author_id ) {
	return;
}
?>
<aside class="sre-author-box" aria-label="<?php esc_attr_e( 'About the author', 'sarkariresult' ); ?>">
	<?php echo get_avatar( $author_id, 72, '', esc_attr( get_the_author() ), array( 'class' => 'sre-author-box__avatar' ) ); ?>
	<div class="sre-author-box__body">
		<h2 class="sre-author-box__name">
			<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a>
		</h2>
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<p class="sre-author-box__bio"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
		<?php endif; ?>
		<a class="sre-author-box__link" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
			<?php esc_html_e( 'View all posts', 'sarkariresult' ); ?>
			<?php echo sre_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
</aside>
