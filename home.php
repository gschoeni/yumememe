<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once DOCUMENT_ROOT.'layouts/header.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>
	<? if (isset($_GET['id'])) $user_id = $_GET['id']; // viewing someone elses profile
			else $user_id = $_SESSION['user_id']; // viewing your own profile
	?>
	<div id="content">
		<h2>Meme Feed</h2>
		<div id="memes">
			<?
			$count = 0;
			foreach (DbHelper::find_my_friends_memes($user_id) as $meme) {
				$count++;
			?>
				<div class="meme">
					<a href="view_meme.php?id=<?= $meme->get_id(); ?>">
						<?= $meme->get_title(); ?><br/>
						<img class="img-polaroid" src="uploads/memes/<?= $meme->get_id(); ?>_thumb.jpg">
					</a>
					<?= $meme->get_timestamp(); ?>
				</div>
			<? }
			if ($count == 0) echo "No Meme Uploads Yet."; ?>
		</div>
	</div>
	<div class="clear"></div>

</div>

<? require_once DOCUMENT_ROOT.'layouts/footer.php'; ?>
