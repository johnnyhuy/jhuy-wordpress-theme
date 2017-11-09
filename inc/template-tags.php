<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

if ( ! function_exists( 'jhuy_posted_on' ) ) :

	function jhuy_posted_on() {
		return true;
	}

endif;

if ( ! function_exists( 'jhuy_time_link' ) ) :

	function jhuy_time_link() {
		return 'this is a test';
	}

endif;

if ( ! function_exists( 'jhuy_edit_link' ) ) :

	function jhuy_edit_link() {
		// TODO
	}

endif;

/**
 * Get the elapsed time in a string
 *
 * @param boolean $modified
 * @param int|WP_Post $post
 * @return void
 */
function get_elapsed_time_string( $modified = false, $post = null ) {
	// Get post via parameter
	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	// Set times
	$now = new DateTime();

	// Check modified field of post
	if ( $modified ) {
		$post_time = DateTime::createFromFormat( 'Y-m-d H:i:s', $post->post_modified );
	} else {
		$post_time = DateTime::createFromFormat( 'Y-m-d H:i:s', $post->post_date );
	}

	$diff = $post_time->diff( $now );

	// Set the time word prefix by comparing time in seconds
	if ( 0 !== $diff->y ) {
		$elapsed_time = $diff->y;
		$time_word    = 'year';
	} elseif ( 0 !== $diff->m ) {
		$elapsed_time = $diff->m;
		$time_word    = 'month';
	} elseif ( 0 !== $diff->d ) {
		$elapsed_time = $diff->d;
		$time_word    = 'day';
	} elseif ( 0 !== $diff->h ) {
		$elapsed_time = $diff->h;
		$time_word    = 'hour';
	} elseif ( 0 !== $diff->i ) {
		$elapsed_time = $diff->i;
		$time_word    = 'minute';
	} else {
		$elapsed_time = $diff->s;
		$time_word    = 'second';
	}

	// If plural, append 's' character to string
	if ( $elapsed_time > 1 ) {
		$time_word .= 's';
	}

	$time_string = $elapsed_time . ' ' . $time_word;

	return $time_string;
}