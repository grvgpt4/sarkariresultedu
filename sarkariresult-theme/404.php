<?php
/**
 * 404 template.
 *
 * @package SarkariResult
 */

get_header();
?>

<main id="main" class="container" style="padding: 3rem 0; text-align:center;">
	<div class="content-block">
		<header class="content-block__head"><h1><?php esc_html_e( 'Page Not Found', 'sarkariresult' ); ?></h1></header>
		<div class="content-block__body content-block__body--center">
			<p><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'sarkariresult' ); ?></p>
			<p><a class="btn btn--whatsapp" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'sarkariresult' ); ?></a></p>
		</div>
	</div>
</main>

<?php
get_footer();
