<?php
/**
 * Search form.
 *
 * @package SarkariResult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="sre-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="sre-search-field"><?php esc_html_e( 'Search for:', 'sarkariresult' ); ?></label>
	<input type="search" id="sre-search-field" class="sre-search-form__input" placeholder="<?php esc_attr_e( 'Search results, jobs, admit card…', 'sarkariresult' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" required>
	<button type="submit" class="sre-search-form__submit sre-btn">
		<?php echo sre_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span><?php esc_html_e( 'Search', 'sarkariresult' ); ?></span>
	</button>
</form>
