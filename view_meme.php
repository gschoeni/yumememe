<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>
<? $meme = DbHelper::find_meme($_GET['id']); ?>
<div id="content">
	<h2><?= $meme->get_title(); ?></h2>
	<img src="uploads/memes/<?= $meme->get_id(); ?>.jpg"><br/>
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
	    	?>
	    	<div class="comment">
	    		<?= $comment->get_user()->get_name(); ?> said: <br/>
	    		<?= $comment->get_comment(); ?>
	    	</div>
	    	<?
	    }
	    if ($count == 0) echo "No Comments Yet.";
		?>
	</div>
</div>

<? require_once 'layouts/footer.php' ?>
