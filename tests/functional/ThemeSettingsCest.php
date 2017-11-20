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
	public function _before( FunctionalTester $I ) {
		// Make sure to switch to the theme being tested.
		switch_theme( 'jhuy' );

		// Add capability since they are only loaded after one page load.
		$admin = get_role( 'administrator' );

		// Custom capability.
		$admin->add_cap( 'manage_theme_options' );
	}
	
	/**
	 * Ensure admin can change quote via the theme settings.
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	public function test_admin_should_change_quote( FunctionalTester $I ) {
		// Login and go to theme settings page.
		$I->loginAsAdmin();
		$I->amOnPage( '/wp-admin/themes.php?page=jhuy-theme-options' );

		// Submit form with a new quote.
		$I->submitForm( '#themeSettings', [
			'jhuy_quote' => 'New Quote!',
		] );

		// Go back to homepage and check if quote has changed.
		$I->amOnPage('/');
		$I->see( 'New Quote!' );
	}

	/**
	 * Ensure subscribers users cannot access the theme settings panel
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	public function test_subscribers_cannot_change_quote( FunctionalTester $I ) {
		$id = $I->factory()->user->create( array(
			'user_login' => 'subscriber_user',
			'user_pass'  => 'secret123!',
			'roles'      => 'subscriber',
		) );

		$I->loginAs( 'subscriber_user', 'secret123!' );
		$I->amOnPage( '/wp-admin/themes.php?page=jhuy-theme-options' );
		$I->seeWpDiePage();
	}

	/**
	 * Ensure author users cannot access the theme settings panel
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	public function test_author_cannot_change_quote( FunctionalTester $I ) {
		$id = $I->factory()->user->create( array(
			'user_login' => 'author_user',
			'user_pass'  => 'secret123!',
			'roles'      => 'author',
		) );

		$I->loginAs( 'author_user', 'secret123!' );
		$I->amOnPage( '/wp-admin/themes.php?page=jhuy-theme-options' );
		$I->seeWpDiePage();
	}

	/**
	 * Ensure editor users cannot access the theme settings panel
	 *
	 * @param FunctionalTester $I functional tester object.
	 * @return void
	 */
	public function test_editor_cannot_change_quote( FunctionalTester $I ) {
		$id = $I->factory()->user->create( array(
			'user_login' => 'editor_user',
			'user_pass'  => 'secret123!',
			'roles'      => 'editor',
		) );

		$I->loginAs( 'editor_user', 'secret123!' );
		$I->amOnPage( '/wp-admin/themes.php?page=jhuy-theme-options' );
		$I->seeWpDiePage();
	}

	public function test_admin_should_upload_image( FunctionalTester $I ) {
		// Login as admin and upload sample image.
		$I->loginAsAdmin();

		// File configuration.
		$file = codecept_data_dir() . 'sample_image.png';
		$filename = basename( $file );
		$upload_file = wp_upload_bits( $filename, null, file_get_contents( $file ) );

		// Check if uploaded file is created correctly.
		if ( ! $upload_file['error'] ) {
			$wp_filetype = wp_check_filetype( $filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype[ 'type' ],
				'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
			if (!is_wp_error($attachment_id)) {
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				wp_update_attachment_metadata( $attachment_id,  $attachment_data );
			}
		}
		
		// Go to theme settings and set new image to sample.
		$new_image     = wp_get_attachment_image_src( $attachment_id )[0];
		$form_settings = array( 'jhuy_quote_image' => $new_image );
		$I->amOnPage( '/wp-admin/themes.php?page=jhuy-theme-options' );
		$I->submitForm( '#themeSettings', $form_settings );
		
		// Check if image exists.
		$I->amOnPage( $new_image );
		$I->seeResponseCodeIs( 200 );

		// Go to homepage and check if image exists.
		$I->amOnPage( '/' );
		$I->seeElement( 'img', array(
			'alt' => 'jhuy_quote_image',
			'src' => $new_image,
		) );

		// Check if the image exists in database.
		$I->seeInDatabase( 'wp_options', array(
			'option_name'  => 'jhuy_quote_image',
			'option_value' => get_option( 'jhuy_quote_image' ),
		) );
	}
}
