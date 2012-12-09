<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once DOCUMENT_ROOT.'layouts/header.php'; ?>
<div id="profile_page">

	<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
	<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>
	<? $user = DbHelper::find_user_by_id($_SESSION['user_id']); ?>


	<div id="content">
		<form action="php_helpers/update_profile.php" method="post" name="upload_image" enctype="multipart/form-data">
			<fieldset>
				<label for="upload_image">Profile Picture:</label><input type="file" name="upload_image" id="upload_image"/><br/>
				<label for="first_name">First Name</label><input type="text" name="first_name" value="<?=$user->get_first_name()?>" /><br/>
				<label for="last_name">Last Name</label><input type="text" name="last_name" value="<?=$user->get_last_name()?>" /><br/>
				<label for="email">Email</label><input type="text" name="email" value="<?=$user->get_email()?>" /><br/>
				
				<input type="submit" value="Update" />
			</fieldset>
		</form>
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>