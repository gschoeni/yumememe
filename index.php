<? require_once 'layouts/header.php' ?>
	<form action="index.php" method="POST">
		<fieldset>
			<legend>Y U Login???</legend>
			<p><label for="email_username">E-mail/User</label><input type="text" name="email_username" /></p>
			<p><label for="password">Password</label><input type="password" /></p>
			<p>Y U No Have Account?? <a href="register.php">Register Here</a></p>
			<p><input type="submit" value="Login" name="submit_login" /></p>
		</fieldset>
	</form>
<? require_once 'layouts/footer.php' ?>