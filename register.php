<? require_once 'php_helpers/init.php' ?>
<? require_once 'php_helpers/check_registration.php' ?>
<? require_once 'layouts/header.php' ?>

<div id="register">
	<form action="register.php" method="POST">
		<fieldset>
			<legend>Y U REGISTER???</legend>
			<p class="error_message">
				<? 
				if ($error_message != '') { // set in check_login.php
					echo $error_message;
				}
				?>
			</p>
			<p>
				<label for="first_name" value="First name">First Name: </label>
				<input type="text" name="first_name" value="<?= get_string_if_set($_POST, 'first_name') ?>" />
			</p>
			<p>
				<label for="last_name" value="Last name">Last Name: </label>
				<input type="text" name="last_name" value="<?= get_string_if_set($_POST, 'last_name') ?>" />
		  </p>
			<p>
				<label for="email" value="E-Mail">E-Mail: </label>
				<input type="text" name="email" value="<?= get_string_if_set($_POST, 'email') ?>" />
			</p>
			<p>
				<label for="password" value="Password">Password: </label>
				<input type="password" name="password" />
			</p>
			<p>
				<label for="confirm_password" value="Confirm Password">Confirm Password: </label>
				<input type="password" name="confirm_password" />
			</p>
			<p>Y U Already Have Account?? <a href="index.php">Login Here</a></p>
			<p>
				<input type="submit" value="Register" name="check_registration" />
			</p>
		</fieldset>
		<p>
		</p>
	</form>
</div>

<? require_once 'layouts/footer.php' ?>