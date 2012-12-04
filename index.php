<? require_once 'php_helpers/init.php' ?>
<? check_already_logged_in(); ?>
<? require_once 'php_helpers/check_login.php' ?>
<? require_once 'layouts/header.php' ?>
	<form action="index.php" method="POST">
		<fieldset>
			<legend>Y U Login???</legend>
			<p class="error_message">
				<? 
				if (isset($_GET['message'])){
					echo $_GET['message'];
				} else if ($error != '') { // set in check_login.php
					echo $error;
				}
				?>
			</p>
			<p><label for="email">E-mail/User</label><input type="text" name="email" /></p>
			<p><label for="password">Password</label><input type="password" name="password" /></p>
			<p>Y U No Have Account?? <a href="register.php">Register Here</a></p>
			<p><input type="submit" value="Login" name="submit_login" /></p>
		</fieldset>
	</form>
<? require_once 'layouts/footer.php' ?>