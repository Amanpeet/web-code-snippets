<?php

/**
 *  Contact Form 7, block links in the text fields.
 *
 */
add_filter( 'wpcf7_validate_text', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_text*', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_textarea', 'no_urls_allowed', 10, 3 );
add_filter( 'wpcf7_validate_textarea*', 'no_urls_allowed', 10, 3 );
function no_urls_allowed( $result, $tag ) {

	$tag = new WPCF7_Shortcode( $tag );

	$type = $tag->type;
	$name = $tag->name;

	$value = isset( $_POST[$name] )
		? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
		: '';

	// If this is meant to be a URL field, do nothing
	if ( 'url' == $tag->basetype || stristr($name, 'url') ) {
		return $result;
	}

	// Check for URLs
	$value = $_POST[$name];
	$not_allowed = array( 'http://', 'https://', 'www.', '[url', '<a ', ' seo ', '.com', '.net', '.org', '.xyz', '.ga', '.ly' );
	foreach ( $not_allowed as $na ) {
		if ( stristr( $value, $na ) ) {
			$result->invalidate( $tag, 'URLs are not allowed' );
			return $result;
		}
	}
	return $result;
}



