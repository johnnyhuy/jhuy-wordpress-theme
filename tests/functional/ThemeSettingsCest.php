<?php
/**
 * Class ThemeSettingsCest
 *
 * @package jHuy
 */

/**
 * Template tags test case.
 */
class ThemeSettingsCest {
	/**
	 * Ensure admin users can access the theme settings panel
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	public function test_admin_should_visit_theme_settings_page( FunctionalTester $I ) {
		$I->loginAsAdmin();
		$I->amOnPage('/themes.php?page=jhuy-theme-options');
	}

	/**
	 * Ensure editors users cannot access the theme settings panel
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	// public function test_editor_cannot_visit_theme_settings_page( FunctionalTester $I ) {
		
	// }
}
