<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>
<? $meme = DbHelper::find_meme($_GET['id']); ?>
<div id="content">
	<h2><?= $meme->get_title(); ?></h2>
	<img class="img-polaroid" src="uploads/memes/<?= $meme->get_id(); ?>.jpg"><br/>
	<a href="php_helpers/like_meme.php?id=<?= $meme->get_id(); ?>">Like (<?= $meme->get_likes(); ?>)</a>
	<form action="php_helpers/submit_comment.php" method="POST">
		<label>Comment:</label><textarea name="comment"></textarea>
		<input type="hidden" value="<?= $meme->get_id(); ?>" name="meme_id" />
		<input type="submit" value="Comment" />
	</form>
	<div class="comments">
		<?
		$count = 0;
	    foreach (DbHelper::get_meme_comments($meme->get_id()) as $comment) {
	    	$count++;
	    	$user = $comment->get_user();
	    	?>
	    	<div class="comment">
	    		<img style="float:left; padding:10px;" width="60" height="60" src="<?= $user->get_profile_pic(); ?>">
	    		<a href="profile_page.php?id=<?= $user->get_id(); ?>" alt="view profile"><?= $user->get_name(); ?></a> said: <br/>
	    		<?= $comment->get_comment(); ?>
	    	</div>
	    	<div class="clear"></div>
	    	<?
	    }
	    if ($count == 0) echo "No Comments Yet.";
		?>
	</div>
</div>
<div class="clear"></div>
<? require_once 'layouts/footer.php' ?>
