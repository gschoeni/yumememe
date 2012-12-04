<?
require_once 'php_helpers/functions.php';
require_once 'db/connect_to_db.php';

if ($_POST['check_registration']) {

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

		$params = array( 
			"ssss", 
			$_POST['first_name'], 
			$_POST['last_name'] , 
			$_POST['email'] , 
			sha1($_POST['password']));

		DbHelper::query($query, $params);
		//header("Location: profile.php");
	} else {
		echo $error_message;
	}

}




?>