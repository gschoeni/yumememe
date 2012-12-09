<?php
	require_once('php_helpers/init.php');
	check_logged_in();
	upload_photo_with_dir_and_id('uploads/memes/', DbHelper::insert_meme($_POST['img_title'], $_SESSION['user_id']));
	header('Location: profile_page.php');
?>
