<?php
/**
 * Class SampleTest
 *
 * @package Jhuy
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_sample() {
		// Replace this with some actual testing code.
		$this->assertTrue( true );
	}

	function test_posted_on() {
		$this->assertTrue( jhuy_posted_on() );
		$this->assertEquals( 'this is a test', jhuy_time_link() );
	}
}
