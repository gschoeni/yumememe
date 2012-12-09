<div id="side_bar">
	<h3>Welcome <a href="profile_page.php"><?= current_user()->get_name() ?></a></h3>
	<div id="profile_picture">
		<img class="image" src="<?= current_user()->get_profile_pic() ?>" />
	</div>
	<div class="side_bar_links"><a href="update_profile_page.php">Update Profile</a></div>
	<div class="side_bar_links"><a href="members_page.php">All Members</a></div>
	<div class="side_bar_links"><a href="following_page.php">Following</a></div>
	<div class="side_bar_links"><a href="followers_page.php">Followers</a></div>
</div>