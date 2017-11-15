<?php
/**
 * PHPUnit bootstrap file
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Get theme firectory to relative path.
 * Path is parent of this file.
 *
 * @return string
 */
function _set_theme_directory() {
	return dirname( dirname( __FILE__ ) );
}
tests_add_filter( 'template_directory', '_set_theme_directory', 'diks' );

/**
 * Switch to selected theme
 *
 * @return void
 */
function _switch_theme() {
	switch_theme( 'jhuy' );
}
tests_add_filter( 'setup_theme', '_switch_theme' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
