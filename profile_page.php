<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once DOCUMENT_ROOT.'layouts/header.php'; ?>
<div id="profile_page">

	<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
	<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>
	<? if (isset($_GET['id'])) $user_id = $_GET['id']; // viewing someone elses profile
			else $user_id = $_SESSION['user_id']; // viewing your own profile
	?>


	<div id="content">
		<? if ($user_id == $_SESSION['user_id']) {
		?>
		<form action="upload_meme.php" method="post" name="upload_image" enctype="multipart/form-data">
			<fieldset>
				<label for="upload_image">Pick an image to upload:</label>
					<input type="file" name="upload_image" id="upload_image"/><br/>
					<input type="text" name="img_title" id="img_title" />
				<input type="submit" value="Upload" />
			</fieldset>
		</form>
		<?
		}?>
		

		<div id="memes">
			<? 
			$count = 0;
			foreach (DbHelper::find_users_memes($user_id) as $meme) { 
				$count++;
			?>
				<div class="meme">
					<?= $meme->get_title(); ?><br/>
					<a href="view_meme.php?id=<?= $meme->get_id(); ?>"><img src="uploads/memes/<?= $meme->get_id(); ?>_thumb.jpg"></a>
					Uploaded at: <?= $meme->get_timestamp(); ?>
				</div>
			<? } 
			if ($count == 0) echo "No Meme Uploads Yet."; ?>
		</div>
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>