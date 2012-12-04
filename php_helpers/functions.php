<?
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
?>