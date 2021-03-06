<?php
/**
 * Class IconTest
 *
 * @package jHuy
 */

/**
 * Test the icons related tasks in inc/icon.php
 */
class IconTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * Start functions before running tests.
	 *
	 * @return void
	 */
	public function _before() {
		switch_theme( 'jhuy' );

		// Set icon file prior to tests.
		$this->icon_file = get_theme_file_uri( '/assets/images/svg/open-iconic/open-iconic.svg' );
	}

	/**
	 * Return an error if the icon name is empty
	 *
	 * @return void
	 */
	public function test_icon_should_error_name_is_empty() {
		$icon = jhuy_get_oi_svg( array(
			'name' => '',
		) );
		$error = __( 'Error has occured, please enter an icon name in the first parameter.', 'jhuy' );

		$this->assertEquals( $icon, $error );
	}

	/**
	 * When dimenisions is not set, default to no width and height.
	 *
	 * @return void
	 */
	public function test_icon_should_fallback_no_size() {
		// Get pin icon form Open Iconic sprite.
		$icon = jhuy_get_oi_svg( array(
			'name' => 'pin',
		) );

		// Create expected SVG output.
		$svg  = '<svg viewBox="0 0 8 8" role="img">';
		$svg .= '<use href="' . $this->icon_file . '#pin"></use>';
		$svg .= '</svg>';

		// Compare actual to expected.
		$this->assertEquals( $icon, $svg );
	}

	/**
	 * Change SVG icon dimensions.
	 *
	 * @return void
	 */
	public function test_icon_should_change_dimensions() {
		// Get pin icon form Open Iconic sprite.
		$icon = jhuy_get_oi_svg( array(
			'name'   => 'pin',
			'width'  => 200,
			'height' => 200,
		) );

		// Create expected SVG output.
		$svg  = '<svg width="200" height="200" viewBox="0 0 8 8" role="img">';
		$svg .= '<use href="' . $this->icon_file . '#pin"></use>';
		$svg .= '</svg>';

		// Compare actual to expected.
		$this->assertEquals( $icon, $svg );
	}

	/**
	 * Icon color fallback to black.
	 *
	 * @return void
	 */
	public function test_icon_fallback_black_color() {
		// Get pin icon form Open Iconic sprite.
		$icon = jhuy_get_oi_svg( array(
			'name' => 'pin',
		) );

		// Create expected SVG output.
		$svg  = '<svg viewBox="0 0 8 8" role="img">';
		$svg .= '<use href="' . $this->icon_file . '#pin"></use>';
		$svg .= '</svg>';

		// Compare actual to expected.
		$this->assertEquals( $icon, $svg );
	}

	/**
	 * Can change icon to a certain color via the style attribute.
	 *
	 * @return void
	 */
	public function test_icon_should_change_color() {
		// Try different formats in color.
		$colors = array(
			'red',
			'#fff',
			'#ffffff',
			'rgb(255,255,255)',
		);

		foreach ( $colors as $color ) {
			// Get pin icon form Open Iconic sprite.
			$icon = jhuy_get_oi_svg( array(
				'name' => 'pin',
				'fill' => $color,
			) );

			// Create expected SVG output.
			$svg  = '<svg style="fill: ' . $color . '" viewBox="0 0 8 8" role="img">';
			$svg .= '<use href="' . $this->icon_file . '#pin"></use>';
			$svg .= '</svg>';

			// Compare actual to expected.
			$this->assertEquals( $icon, $svg );
		}
	}

	/**
	 * Be able to set classes in the SVG icon.
	 *
	 * @return void
	 */
	public function test_icon_should_set_class() {
		// Get pin icon form Open Iconic sprite.
		$icon = jhuy_get_oi_svg( array(
			'name'  => 'pin',
			'class' => 'test-class',
		) );

		// Create expected SVG output.
		$svg  = '<svg class="test-class" viewBox="0 0 8 8" role="img">';
		$svg .= '<use href="' . $this->icon_file . '#pin"></use>';
		$svg .= '</svg>';

		// Compare actual to expected.
		$this->assertEquals( $icon, $svg );
	}
}
