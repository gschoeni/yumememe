<?
require_once 'functions.php';

if ($_POST['submit_registration']) {

	$error_message = "";

	if (!$_POST['first_name']) {
		$error_message .= "Please enter your first name. <br/>";
	}

	if (!$_POST['last_name']) {
		$error_message .= "Please enter your last name. <br/>";
	}

	if (!validate_email($_POST['email'])) {
		$error_message .= "Please provide a valid email. <br/>";
	}

	if (!$_POST['password'] || !$_POST['confirm_password'] || ) {
		$error_message .= "Please confirm your password. <br/>";
	}

	if ($_POST['confirm_password'] != $_POST['password']) {
		$error_message .= "Your passwords do not match. <br/>";
	}

	if ($error_message == "") {
		echo "GOOD JOB!";
		//$db = new DbHelper();
		//header("Location: profile.php");
	} else {
		echo $error_message;
	}

}




?>