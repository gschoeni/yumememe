<?

if (isset($_POST['check_registration'])) {

	$error_message = "";
	$query = "INSERT INTO users (first_name, last_name, email, hashed_password) VALUES (?,?,?,?)";

	if (!$_POST['first_name']) {
		$error_message .= "Please enter your first name. <br/>";
	}

	if (!$_POST['last_name']) {
		$error_message .= "Please enter your last name. <br/>";
	}

	if (!validate_email($_POST['email'])) {
		$error_message .= "Please provide a valid email. <br/>";
	}

	if (!$_POST['password'] || !$_POST['confirm_password']) {
		$error_message .= "Please confirm your password. <br/>";
	}

	if ($_POST['confirm_password'] != $_POST['password']) {
		$error_message .= "Your passwords do not match. <br/>";
	}

	if ($error_message == "") {
		DbHelper::register_user($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
		header("Location: index.php?message=Registration successful, please log in to continue.");
	} else {
		echo $error_message;
	}

}

?>