<?php
	require_once('php_helpers/init.php');
	check_logged_in();
	$image_id = DbHelper::insert_meme($_POST['img_title'], $_SESSION['user_id']);

	// Check to see if the file uploaded. NOTE: 'upload_image' is the name of the file input type on profile.php
	if(!is_uploaded_file($_FILES['upload_image']['tmp_name']) || $_FILES['upload_image']['error'] != UPLOAD_ERR_OK){
	    exit('File not uploaded.');
	}

	// Check to make sure that the file is an image file. (Useful for security purposes..)
	switch(strtolower($_FILES['upload_image']['type'])){
    	case 'image/jpeg':
        	$image = imagecreatefromjpeg($_FILES['upload_image']['tmp_name']);
        	break;
    	case 'image/png':
        	$image = imagecreatefrompng($_FILES['upload_image']['tmp_name']);
        	break;
    	case 'image/gif':
        	$image = imagecreatefromgif($_FILES['upload_image']['tmp_name']);
        	break;
    	default:
        	exit('Unsupported type: '.$_FILES['upload_image']['type']);
	}

	/********************************************************************************
	This first example creates a small image that is a maximum size of 50 X 50 pixels 
	********************************************************************************/

	// The maximum dimensions for your new image
	$max_width = 150;
	$max_height = 150;

	// The current dimensions for your new image
	$old_width = imagesx($image);
	$old_height = imagesy($image);

	// Scale the width and height according to your previous dimensions
	$scale = min($max_width/$old_width, $max_height/$old_height);

	// Create a new width and height based on the scale
	$new_width  = ceil($scale*$old_width);
	$new_height = ceil($scale*$old_height);

	// Actually create the new image
	$new = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

	// Store the image in the "uploads" directory as image_thumb.jpg. The 90 at the end specifies the quality of the image
	imagejpeg($new, "uploads/".$image_id."_thumb.jpg", 90);
	

	/******************************************************************************* 
	This example creates a larger image that is a maximum size of 400 X 400 pixels 
	********************************************************************************/

	// The maximum dimensions for your new image
	$max_width = 400;
	$max_height = 400;

	// The current dimensions for your new image
	$old_width = imagesx($image);
	$old_height = imagesy($image);

	// Scale the width and height according to your previous dimensions
	$scale = min($max_width/$old_width, $max_height/$old_height);

	// Create a new width and height based on the scale
	$new_width  = ceil($scale*$old_width);
	$new_height = ceil($scale*$old_height);

	// Actually create the new image
	$new = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
	
	// Store the image in the "uploads" directory as image.jpg.
	imagejpeg($new, "uploads/".$image_id.".jpg", 90);
	
	// Clean up
	imagedestroy($image);
	imagedestroy($new);

	header('Location: profile_page.php');
?>
