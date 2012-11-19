<? require_once 'layouts/header.php' ?>

	<form action="index.php" method="POST">
		<fieldset>
			<legend>Login</legend>
			<p><label for="email">E-mail</label><input type="text" name="email" /></p>
			<p><label for="password">Password</label><input type="password" /></p>
			<p><input type="submit" value="Login" /></p>
		</fieldset>
	</form>

<? require_once 'layouts/footer.php' ?>