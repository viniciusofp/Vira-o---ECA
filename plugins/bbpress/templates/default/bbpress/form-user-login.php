<?php

/**
 * User Login Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<fieldset class="bbp-form">
		<legend><?php _e( 'Log In', 'bbpress' ); ?></legend>

		<div class="bbp-username">
			<label for="user_login"><?php _e( 'Username', 'bbpress' ); ?>: </label>
			<input class="form-control" type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div class="bbp-password">
			<label for="user_pass"><?php _e( 'Password', 'bbpress' ); ?>: </label>
			<input class="form-control" type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div class="bbp-remember-me form-check">
			<input class="form-check-input" type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ) ); ?>
			<label class="form-check-label"= for="rememberme">Lembrar-me</label>
		</div>

		<?php do_action( 'login_form' ); ?>
		<div class="bbp-submit-wrapper">

			<button class="btn btn-primary form-control" type="submit" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Log In', 'bbpress' ); ?></button>

			<?php bbp_user_login_fields(); ?>

		</div>
		<div class="esqueci mt-3">
			<a href="<?php echo home_url('/?page_id=15') ?>"><strong>Esqueci minha senha</strong></a>
		</div>
	</fieldset>
</form>
		<div class="text-center mt-3">
			<a href="<?php echo home_url('/?page_id=13') ?>" style="color: #4A268B"><strong>Registrar novo usuário</strong></a>
		</div>
