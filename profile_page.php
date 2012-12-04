<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once DOCUMENT_ROOT.'layouts/header.php'; ?>
<div id="profile_page">

	<div id="title_bar">
		<div id="home"><a href="profile_page.php">Home</a></div>
		<div id="logout"><a href="logout.php">Logout</a></div>
	</div>

	<div id="side_bar">
		<h3>Welcome Memer!</h3>
		<div id="profile_picture">
			<img class="image" src="sample_content/profile.png" />
		</div>
		<div id="my_memes"><a href="profile_page.php">My Memes</a></div>
		<div id="friends_memes"><a href="profile_page.php">Friends Memes</a></div>
		<div id="all_memes"><a href="profile_page.php">All Memes</a></div>
	</div>

	<div id="content">
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>