<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once DOCUMENT_ROOT.'layouts/header.php'; ?>
<div id="profile_page">

	<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
	<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>


	<div id="content">
		<form action="upload_meme.php" method="post" name="upload_image" enctype="multipart/form-data">
			<fieldset>
				<label for="upload_image">Pick an image to upload:</label>
					<input type="file" name="upload_image" id="upload_image"/><br/>
					<input type="text" name="img_title" id="img_title" />
				<input type="submit" value="Upload" />
			</fieldset>
		</form>

		<div id="memes">
			<? foreach (DbHelper::find_users_memes($_SESSION['user_id']) as $meme) { ?>
				<div class="meme">
					<img src="uploads/<?= $meme->get_id(); ?>_thumb.jpg"> 
					<?= $meme->get_title(); ?><br/>
					Uploaded at: <?= $meme->get_timestamp(); ?>
				</div>
			<? } ?>
			
		</div>
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>