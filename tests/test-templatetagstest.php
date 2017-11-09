<?php
/**
 * Class TemplateTagsTest
 *
 * @package jHuy
 */

/**
 * Template tags test case.
 */
class TemplateTagsTest extends WP_UnitTestCase {
	/**
	 * Post does not exist then return false
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_post_does_not_exist() {
		$this->assertFalse( get_elapsed_time_string( null ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in minutes.
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_minutes() {
		$time = new DateTime( '-1 minute' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );
		$this->assertEquals( '1 minute', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '1 minute', get_elapsed_time_string( true, $post->ID ) );

		$time = new DateTime( '-10 minutes' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );
		$this->assertEquals( '10 minutes', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '10 minutes', get_elapsed_time_string( true, $post->ID ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in hours.
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_hours() {
		$time = new DateTime( '-1 hour' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '1 hour', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '1 hour', get_elapsed_time_string( true, $post->ID ) );

		$time = new DateTime( '-2 hours' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '2 hours', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '2 hours', get_elapsed_time_string( true, $post->ID ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in days.
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_days() {
		$time = new DateTime( '-1 day' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '1 day', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '1 day', get_elapsed_time_string( true, $post->ID ) );

		$time = new DateTime( '-2 days' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '2 days', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '2 days', get_elapsed_time_string( true, $post->ID ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in months.
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_months() {
		$time = new DateTime( '-1 month' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '1 month', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '1 month', get_elapsed_time_string( true, $post->ID ) );

		$time = new DateTime( '-2 months' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '2 months', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '2 months', get_elapsed_time_string( true, $post->ID ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in years.
	 *
	 * @return void
	 */
	function test_get_elapsed_time_string_years() {
		$time = new DateTime( '-1 year' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '1 year', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '1 year', get_elapsed_time_string( true, $post->ID ) );

		$time = new DateTime( '-2 years' );
		$post = self::factory()->post->create_and_get( array(
			'post_date'     => $time->format( 'Y-m-d H:i:s' ),
			'post_modified' => $time->format( 'Y-m-d H:i:s' ),
		) );

		$this->assertEquals( '2 years', get_elapsed_time_string( false, $post->ID ) );
		$this->assertEquals( '2 years', get_elapsed_time_string( true, $post->ID ) );
	}
}
