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
	      <img width="70" height="70"  src="<?= $user->get_profile_pic() ?>" /><a href="profile_page.php?id=<?= $user->get_id(); ?>"/> <?= $user->get_name(); ?></a>
        <a style="color:green" href="php_helpers/toggle_follower.php?name=<?= $user->get_name() ?>&user=<?= $_SESSION['user_id'] ?>&other=<?=$user->get_id()?>" alt="follow this user">
          <? if (DbHelper::is_following($_SESSION['user_id'], $user->get_id()) > 0) { // is_following returns the id of the row in the following table or 0
            echo "Unfollow";
          } else {
            echo "Follow";
          }?>
        </a>
	    </div>
	  <? }
	  	if (!$count) {
	  		echo "You don't have any followers yet.. Posting funny memes will fix that!";
	  	}
	  ?>
	</div>
</div>
<div class="clear"></div>
<? require_once 'layouts/footer.php' ?>
