<?php
	require_once('init.php');
	check_logged_in();
	if (isset($_FILES['upload_image'])) {
	 	upload_photo_with_dir_and_id('../uploads/profile_pictures/', $_SESSION['user_id']);
	}
	DbHelper::update_user($_SESSION['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email']);
	
	header('Location: ../update_profile_page.php');
?>
