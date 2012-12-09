<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>

<div id="content">
	<h2>Who's Following Me</h2>
	<div id="members">
	  <?  if (isset($_GET['message'])) {
	        echo $_GET['message'];
	      }
	    $count = 0;
	    foreach (DbHelper::find_followers($_SESSION['user_id']) as $user) { 
	    	$count++;
	  ?>
	    <div class="member">
	      <?= $user->get_name() ?>
	    </div>
	  <? } 
	  	if (!$count) {
	  		echo "You don't have any followers yet.. Posting funny memes will fix that!";
	  	}
	  ?>
	</div>
</div>

<? require_once 'layouts/footer.php' ?>
