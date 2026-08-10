<?php
/**
 * Comments template.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}

if ( ! comments_open() && ! get_comments_number() ) {
	return;
}
?>

<section id="comments" class="sre-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="sre-comments__title">
			<?php
			$count = (int) get_comments_number();
			printf(
				/* translators: %d: comment count */
				esc_html( _n( '%d Comment', '%d Comments', $count, 'sarkariresult' ) ),
				$count
			);
			?>
		</h2>

		<ol class="sre-comments__list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 48,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	if ( comments_open() ) {
		comment_form(
			array(
				'class_form'         => 'sre-comment-form',
				'title_reply_before' => '<h2 id="reply-title" class="sre-comments__reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
	}
	?>
</section>
