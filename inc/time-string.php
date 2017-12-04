<?php
/**
 * Time string functions.
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

/**
 * Return time link for post.
 *
 * @return string
 */
function jhuy_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%4$s ago</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>, <time class="updated" datetime="%3$s">%4$s ago</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_elapsed_time_string( get_the_time( 'U' ), 'U' ),
		get_elapsed_time_string( get_the_modified_time( 'U' ), 'U' ),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	return sprintf(
		'%s',
		'<a class="entry-date-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}


function jhuy_edit_link() {
	// TODO
}

/**
 * Get the elapsed time in a string
 *
 * @param boolean $time time string that can be in format 'Y-m-d H:i:s' or 'U'.
 * @param string  $format time format.
 * @return string
 */
function get_elapsed_time_string( $time, $format = 'Y-m-d H:i:s' ) {
	if ( empty( $time ) ) {
		return false;
	}

	// Get the current time.
	$now = new DateTime();

	// Check modified field of post.
	$post_time = DateTime::createFromFormat( $format, $time );

	// Check if time format is valid.
	if ( false === $post_time ) {
		return false;
	}

	$diff = $post_time->diff( $now );

	// Set the time word prefix by comparing time in seconds.
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

	// If plural, append 's' character to string.
	if ( $elapsed_time > 1 ) {
		$time_word .= 's';
	}

	$time_string = $elapsed_time . ' ' . $time_word;

	return $time_string;
}
