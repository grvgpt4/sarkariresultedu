<?php
/**
 * Footer template.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	<?php sre_render_ad( 'footer', array( 'class' => 'sre-container', 'min_height' => 90 ) ); ?>

	<footer class="sre-footer" role="contentinfo">
		<div class="sre-footer__main sre-container">
			<div class="sre-footer__grid">
				<div class="sre-footer__col sre-footer__col--about">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php else : ?>
						<h2 class="sre-footer-widget__title"><?php esc_html_e( 'About Sarkari Result', 'sarkariresult' ); ?></h2>
						<div class="sre-footer__about">
							<?php
							$about = sre_get_mod( 'sre_footer_about', '' );
							echo wp_kses_post( wpautop( $about ) );
							?>
						</div>
					<?php endif; ?>
				</div>

				<div class="sre-footer__col">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php else : ?>
						<h2 class="sre-footer-widget__title"><?php esc_html_e( 'Important Categories', 'sarkariresult' ); ?></h2>
						<ul class="sre-footer__links">
							<?php
							$slugs = array( 'sarkari-result', 'recruitment', 'results', 'admit-card', 'answer-key', 'board-results', 'university-results', 'syllabus' );
							foreach ( $slugs as $slug ) {
								$term = sre_get_category_by_slug( $slug );
								if ( $term ) {
									echo '<li><a href="' . esc_url( get_category_link( $term->term_id ) ) . '">' . esc_html( $term->name ) . '</a></li>';
								}
							}
							?>
						</ul>
					<?php endif; ?>
				</div>

				<div class="sre-footer__col">
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php else : ?>
						<h2 class="sre-footer-widget__title"><?php esc_html_e( 'Important Pages', 'sarkariresult' ); ?></h2>
						<ul class="sre-footer__links">
							<?php
							if ( has_nav_menu( 'footer' ) ) {
								wp_nav_menu(
									array(
										'theme_location' => 'footer',
										'container'      => false,
										'items_wrap'     => '%3$s',
										'depth'          => 1,
										'fallback_cb'    => false,
									)
								);
							} else {
								foreach ( sre_legal_links() as $label => $url ) {
									echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
								}
							}
							?>
						</ul>
					<?php endif; ?>
				</div>

				<div class="sre-footer__col">
					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-4' ); ?>
					<?php else : ?>
						<h2 class="sre-footer-widget__title"><?php esc_html_e( 'Follow / Contact', 'sarkariresult' ); ?></h2>
						<?php
						$social = sre_social_links();
						if ( ! empty( $social ) ) :
							?>
							<ul class="sre-social">
								<?php foreach ( $social as $network => $url ) : ?>
									<li>
										<a href="<?php echo esc_url( $url ); ?>" rel="noopener noreferrer" target="_blank">
											<?php echo esc_html( ucfirst( $network === 'twitter' ? 'X / Twitter' : $network ) ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<?php
						$contact = sre_get_page_url_by_slug( 'contact-us' );
						if ( $contact ) :
							?>
							<p><a class="sre-btn sre-btn--ghost" href="<?php echo esc_url( $contact ); ?>"><?php esc_html_e( 'Contact Us', 'sarkariresult' ); ?></a></p>
						<?php endif; ?>
						<?php
						$newsletter = sre_get_mod( 'sre_newsletter_embed', '' );
						if ( $newsletter ) :
							?>
							<div class="sre-newsletter">
								<?php echo wp_kses_post( $newsletter ); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="sre-footer__bottom">
			<div class="sre-container sre-footer__bottom-inner">
				<p class="sre-footer__copy">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">SarkariResult.edu.pl</a>
				</p>
				<ul class="sre-footer__legal">
					<?php
					$legal = sre_legal_links();
					// Prefer a compact set for the bottom bar.
					$order = array(
						__( 'Privacy Policy', 'sarkariresult' ),
						__( 'Disclaimer', 'sarkariresult' ),
						__( 'Terms & Conditions', 'sarkariresult' ),
						__( 'Contact Us', 'sarkariresult' ),
					);
					foreach ( $order as $label ) {
						if ( isset( $legal[ $label ] ) ) {
							echo '<li><a href="' . esc_url( $legal[ $label ] ) . '">' . esc_html( $label ) . '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</footer>

	<button type="button" class="sre-back-top" data-sre-back-top hidden aria-label="<?php esc_attr_e( 'Back to top', 'sarkariresult' ); ?>">
		<?php echo sre_icon( 'top' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</button>

<?php wp_footer(); ?>
</body>
</html>
