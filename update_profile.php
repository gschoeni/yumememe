<?php
	require_once('php_helpers/init.php');
	check_logged_in();
	upload_photo_with_dir_and_id('uploads/profile_pictures/', $_SESSION['user_id']);
	header('Location: update_profile_page.php');
?>
