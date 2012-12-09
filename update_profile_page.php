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
		<form action="update_profile.php" method="post" name="upload_image" enctype="multipart/form-data">
			<fieldset>
				<label for="upload_image">Profile Picture:</label>
					<input type="file" name="upload_image" id="upload_image"/>
				<input type="submit" value="Upload" />
			</fieldset>
		</form>
		<?
		}?>
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>