<?
if (isset($_POST['submit_login'])) {

	$error = '';

	if (!$_POST['email']) {
		$error .= 'Please enter your email.<br/>';
	}

	if (!$_POST['password']) {
		$error .= 'Please enter your password.<br/>';
	}

	if ($error == '') {
		$user_id = DbHelper::authenticate_user($_POST['email'], $_POST['password']);
		if ($user_id > 0) { // we have found a user
			
		}
	}
}

?>