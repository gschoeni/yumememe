<? require_once 'layouts/header.php' ?>

<div id="register">
	<form action="index.php" method="POST">
		<fieldset>
			<legend>Y U REGISTER???</legend>
			<p>
				<label for="first_name" value="First name">First Name: </label>
				<input type="text" name="first_name" />
			</p>
			<p>
				<label for="last_name" value="Last name">Last Name: </label>
				<input type="text" name="last_name" />
		  </p>
			<p>
				<label for="email" value="E-Mail">E-Mail: </label>
				<input type="text" name="email" />
			</p>
			<p>
				<label for="password" value="Password">Password: </label>
				<input type="text" name="password" />
			</p>
			<p>
				<label for="confirm_password" value="Confirm Password">Confirm Password: </label>
				<input type="text" name="confirm_password" />
			</p>
		</fieldset>
		<p>
			<input type="submit" value="Register" />
		</p>
	</form>
</div>

<? require_once 'layouts/footer.php' ?>