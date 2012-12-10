<?php
	require_once('init.php');
	check_logged_in();
	if (isset($_FILES['upload_image']) && strlen($_FILES['upload_image']['name']) > 0) {
	 	upload_photo_with_dir_and_id('../uploads/profile_pictures/', $_SESSION['user_id']);
	}
	if (isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['confirm_password'] == $_POST['password']) {
		DbHelper::update_user_password($_SESSION['user_id'], $_POST['password']);
	}
	DbHelper::update_user($_SESSION['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email']);

	header('Location: ../update_profile_page.php');
?>
