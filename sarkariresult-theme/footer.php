<?php
/**
 * Theme footer.
 *
 * @package SarkariResult
 */

$host = wp_parse_url( home_url(), PHP_URL_HOST );
$host = $host ? $host : 'sarkariresult.edu.pl';
?>
<footer class="site-footer">
	<div class="footer-glow" aria-hidden="true"></div>
	<div class="container">
		<div class="footer-top">
			<div class="footer-brand">
				<a class="footer-brand__name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<p class="footer-brand__url"><?php echo esc_html( $host ); ?></p>
				<p class="footer-brand__text"><?php esc_html_e( 'Your trusted companion for Sarkari Naukri, results, admit cards, answer keys, and exam updates across India — clear, fast, and free.', 'sarkariresult' ); ?></p>
				<div class="footer-social">
					<a href="#" aria-label="Telegram"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M21.8 4.2 2.9 11.5c-1.3.5-1.3 1.2-.2 1.5l4.8 1.5 1.9 5.8c.2.7.4.9 1 .9.5 0 .8-.2 1.1-.6l2.6-3.5 5.1 3.8c.9.5 1.6.2 1.8-.9l3.3-15.5c.3-1.3-.5-1.9-1.5-1.3z"/></svg></a>
					<a href="#" aria-label="WhatsApp"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91A9.86 9.86 0 0 0 12.04 2z"/></svg></a>
					<a href="#" aria-label="X / Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-6.8 7.8L23 22h-6.5l-5.1-6.7L5.7 22H2.6l7.3-8.3L1 2h6.7l4.6 6.1L18.9 2zm-1.1 18h1.8L6.3 3.9H4.4L17.8 20z"/></svg></a>
					<a href="#" aria-label="YouTube"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31.5 31.5 0 0 0 0 12a31.5 31.5 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.5 31.5 0 0 0 24 12a31.5 31.5 0 0 0-.5-5.8zM9.8 15.5v-7l6.3 3.5-6.3 3.5z"/></svg></a>
				</div>
			</div>

			<div class="footer-cols">
				<div class="footer-col">
					<h3><?php esc_html_e( 'Quick Links', 'sarkariresult' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/#latest-jobs' ) ); ?>"><?php esc_html_e( 'Latest Jobs', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#results' ) ); ?>"><?php esc_html_e( 'Results', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#admit-cards' ) ); ?>"><?php esc_html_e( 'Admit Cards', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#admission' ) ); ?>"><?php esc_html_e( 'Answer Keys', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#syllabus' ) ); ?>"><?php esc_html_e( 'Syllabus', 'sarkariresult' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-col">
					<h3><?php esc_html_e( 'Categories', 'sarkariresult' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/#railway' ) ); ?>"><?php esc_html_e( 'Railway Jobs', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#latest-jobs' ) ); ?>"><?php esc_html_e( 'Banking Jobs', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#latest-jobs' ) ); ?>"><?php esc_html_e( 'SSC Jobs', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#latest-jobs' ) ); ?>"><?php esc_html_e( 'Defence Jobs', 'sarkariresult' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#admission' ) ); ?>"><?php esc_html_e( 'Admission', 'sarkariresult' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-col">
					<h3><?php esc_html_e( 'Company', 'sarkariresult' ); ?></h3>
					<ul>
						<?php if ( has_nav_menu( 'footer' ) ) : ?>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'container'      => false,
									'items_wrap'     => '%3$s',
									'depth'          => 1,
								)
							);
							?>
						<?php else : ?>
							<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php esc_html_e( 'About Us', 'sarkariresult' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'sarkariresult' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'sarkariresult' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>"><?php esc_html_e( 'Disclaimer', 'sarkariresult' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>"><?php esc_html_e( 'Sitemap', 'sarkariresult' ); ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-disclaimer">
			<p><strong><?php esc_html_e( 'Disclaimer:', 'sarkariresult' ); ?></strong>
			<?php
			printf(
				/* translators: %s: site host */
				esc_html__( '%s is an independent informational website and is not associated with any government organization. Candidates must verify all details from official sources before applying or making decisions.', 'sarkariresult' ),
				esc_html( $host )
			);
			?>
			</p>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $host ); ?> — <?php esc_html_e( 'All rights reserved.', 'sarkariresult' ); ?></p>
			<nav class="footer-bottom__links" aria-label="<?php esc_attr_e( 'Legal', 'sarkariresult' ); ?>">
				<a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php esc_html_e( 'About Us', 'sarkariresult' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'sarkariresult' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'sarkariresult' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>"><?php esc_html_e( 'Disclaimer', 'sarkariresult' ); ?></a>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
