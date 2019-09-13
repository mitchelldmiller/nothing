<?php
/**
 * Nothing theme function
 *
 * One function to display nothing.
 *
 * @package Nothing
 * @version 1.1
 * @since 1.0
 */

function show_nothing() {
	if ( is_admin() ) {
		return;
	} // Ignore admin requests

	$filename = get_template_directory() . '/nothing.html';
	$html     = file_exists( $filename ) ? file_get_contents( $filename ) : '';
	echo $html;
	exit;
}

function disable_json_api () {
	// from: https://wordpress.stackexchange.com/a/212472
  // Filters for WP-API version 1.x
  add_filter('json_enabled', '__return_false');
  add_filter('json_jsonp_enabled', '__return_false');

  // Filters for WP-API version 2.x
  add_filter('rest_enabled', '__return_false');
  add_filter('rest_jsonp_enabled', '__return_false');
}

add_action( 'after_setup_theme', 'disable_json_api' );
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
add_action( 'template_redirect', 'show_nothing', 9999, 0 );
