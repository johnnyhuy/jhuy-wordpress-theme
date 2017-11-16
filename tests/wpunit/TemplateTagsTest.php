<?php
/**
 * Class TemplateTagsTest
 *
 * @package jHuy
 */

/**
 * Template tags test case.
 */
class TemplateTagsTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * Post does not exist then return false
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_post_does_not_exist() {
		$this->assertFalse( get_elapsed_time_string( null ) );
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in minutes.
	 *
	 * We'll be testing lower, middle and upper bounds.
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_minutes() {
		/**
		 * Test data.
		 *  where key is the time subtracted from now.
		 *  and value is the expected result.
		 */
		$test_data = array(
			'60 seconds' => '1 minute',
			'1 minute'   => '1 minute',
			'30 minutes' => '30 minutes',
			'59 minutes' => '59 minutes',
		);

		foreach ( $test_data as $test_item => $expected_item ) {
			$time = new DateTime( '-' . $test_item );
			$post = self::factory()->post->create_and_get( array(
				'post_date'     => $time->format( 'Y-m-d H:i:s' ),
				'post_modified' => $time->format( 'Y-m-d H:i:s' ),
			) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( false, $post->ID ) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( true, $post->ID ) );
		}
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in hours.
	 *
	 * We'll be testing lower, middle and upper bounds.
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_hours() {
		/**
		 * Test data.
		 *  where key is the time subtracted from now.
		 *  and value is the expected result.
		 */
		$test_data = array(
			'60 minutes' => '1 hour',
			'1 hour'     => '1 hour',
			'12 hours'   => '12 hours',
			'23 hours'   => '23 hours',
		);

		foreach ( $test_data as $test_item => $expected_item ) {
			$time = new DateTime( '-' . $test_item );
			$post = self::factory()->post->create_and_get( array(
				'post_date'     => $time->format( 'Y-m-d H:i:s' ),
				'post_modified' => $time->format( 'Y-m-d H:i:s' ),
			) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( false, $post->ID ) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( true, $post->ID ) );
		}
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in days.
	 *
	 * We'll be testing lower, middle and upper bounds.
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_days() {
		/**
		 * Test data.
		 *  where key is the time subtracted from now.
		 *  and value is the expected result.
		 */
		$test_data = array(
			'24 hours' => '1 day',
			'1 day'    => '1 day',
			'15 days'  => '15 days',
			'29 days'  => '29 days',
			'30 days'  => '30 days',
		);

		foreach ( $test_data as $test_item => $expected_item ) {
			$time = new DateTime( '-' . $test_item );
			$post = self::factory()->post->create_and_get( array(
				'post_date'     => $time->format( 'Y-m-d H:i:s' ),
				'post_modified' => $time->format( 'Y-m-d H:i:s' ),
			) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( false, $post->ID ) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( true, $post->ID ) );
		}
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in months.
	 *
	 * We'll be testing lower, middle and upper bounds.
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_months() {
		/**
		 * Test data.
		 *  where key is the time subtracted from now.
		 *  and value is the expected result.
		 */
		$test_data = array(
			'31 days'   => '1 month',
			'32 days'   => '1 month',
			'1 month'   => '1 month',
			'6 months'  => '6 months',
			'11 months' => '11 months',
			'364 days'  => '11 months',
		);

		foreach ( $test_data as $test_item => $expected_item ) {
			$time = new DateTime( '-' . $test_item );
			$post = self::factory()->post->create_and_get( array(
				'post_date'     => $time->format( 'Y-m-d H:i:s' ),
				'post_modified' => $time->format( 'Y-m-d H:i:s' ),
			) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( false, $post->ID ) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( true, $post->ID ) );
		}
	}

	/**
	 * Test to get the elapsed time of
	 *  a post in years.
	 *
	 * We'll be testing lower, middle and upper bounds.
	 *
	 * @return void
	 */
	public function test_get_elapsed_time_string_years() {
		/**
		 * Test data.
		 *  where key is the time subtracted from now.
		 *  and value is the expected result.
		 */
		$test_data = array(
			'365 days'  => '1 year',
			'366 days'  => '1 year',
			'12 months' => '1 year',
			'1 year'    => '1 year',
			'6 years'   => '6 years',
			'64 years'  => '64 years',
		);

		foreach ( $test_data as $test_item => $expected_item ) {
			$time = new DateTime( '-' . $test_item );
			$post = self::factory()->post->create_and_get( array(
				'post_date'     => $time->format( 'Y-m-d H:i:s' ),
				'post_modified' => $time->format( 'Y-m-d H:i:s' ),
			) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( false, $post->ID ) );
			$this->assertEquals( $expected_item, get_elapsed_time_string( true, $post->ID ) );
		}
	}

}
