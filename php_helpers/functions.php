<?

function current_user() {
	return DbHelper::find_user_by_id($_SESSION['user_id']);
}

function validate_email($email) {
	return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}

function check_logged_in() {
	if(!isset($_SESSION['user'])){
 		header("Location: index.php?message=Please login to continue");
	}
}

function check_already_logged_in() {
	if(isset($_SESSION['user'])){
 		header("Location: profile_page.php");
	}
}

function get_string_if_set($var, $string) {
	if (isset($var[$string])){
		return $var[$string];
	} else {
		return "";
	}
}

?>