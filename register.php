<? require_once 'php_helpers/init.php' ?>
<? require_once 'php_helpers/check_registration.php' ?>
<? require_once 'layouts/header.php' ?>

<div id="register">
	<form action="register.php" method="POST" id="register">
		<fieldset>
			<legend>Y U REGISTER???</legend>
			<p class="error_message">
				<?
				if ($error_message != '') { // set in check_login.php
					echo "<div class='alert alert-error message'><p>".$error_message."</p></div>";
				}
				?>
			</p>
			<p>
				<label for="first_name" value="First name">First Name: </label>
				<input type="text" name="first_name" value="<?= get_string_if_set($_POST, 'first_name') ?>" required />
			</p>
			<p>
				<label for="last_name" value="Last name">Last Name: </label>
				<input type="text" name="last_name" value="<?= get_string_if_set($_POST, 'last_name') ?>" required />
		  </p>
			<p>
				<label for="email" value="E-Mail">E-Mail: </label>
				<input type="email" name="email" value="<?= get_string_if_set($_POST, 'email') ?>" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" title="Must be a valid email address." required />
			</p>
			<p>
				<label for="password" value="Password">Password: </label>
				<input id="password" type="password" name="password" required />
			</p>
			<p>
				<label for="confirm_password" value="Confirm Password">Confirm Password: </label>
				<input id="confirm_password" type="password" name="confirm_password" required />
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

<script type="text/javascript">

  var password1 = document.getElementById('password');
  var password2 = document.getElementById('confirm_password');

  var matchPasswords = function() {
    if (password1.value != password2.value) {
      password2.setCustomValidity('Passwords must match.');
    } else {
      password2.setCustomValidity('');
    }
  };

  password1.addEventListener('input', matchPasswords, false);
  password2.addEventListener('input', matchPasswords, false);

</script>
<? require_once 'layouts/footer.php' ?>
