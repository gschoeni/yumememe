<div id="side_bar">
	<h3><a href="profile_page.php"><?= current_user()->get_name() ?></a></h3>
	<div id="profile_picture">
		<img class="image" src="<?= current_user()->get_profile_pic() ?>" />
	</div>
	<div class="side_bar_links"><a href="profile_page.php"><i class="icon icon-user"></i>View Profile</a></div>
	<div class="side_bar_links"><a href="home.php"><i class="icon  icon-align-justify"></i>Meme Feed</a></div>
	<div class="side_bar_links"><a href="following_page.php"><i class="icon icon-star"></i>Following</a></div>
	<div class="side_bar_links"><a href="followers_page.php"><i class="icon icon-star-empty"></i>Followers</a></div>
</div>
