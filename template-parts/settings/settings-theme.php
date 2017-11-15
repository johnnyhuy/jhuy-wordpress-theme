<?php
/**
 * The jHuy settings page shown under the Appearance menu
 *   in the WordPress admin panel
 *
 * @package WordPress
 * @subpackage jHuy
 * @since 1.0
 */

?>
<div class="wrap">
	<h1>jHuy Theme Settings</h1>
	<form method="post" action="options.php" novalidate="novalidate">
		<?php
		settings_fields( 'jhuy-theme-options-fields' );
		do_settings_sections( 'jhuy-theme-options' );
		submit_button();
		?>
	</form>
</div>
