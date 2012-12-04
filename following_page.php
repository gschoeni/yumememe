<? require_once 'php_helpers/init.php' ?>
<? require_once 'php_helpers/check_registration.php' ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>

<div id="content">
	<h2>Who I am Following</h2>
	<div id="members">
	  <?  if (isset($_GET['message'])) {
	        echo $_GET['message'] ;
	      }
	    foreach (DbHelper::find_following_users($_SESSION['user_id']) as $user) { ?>
	    <div class="member">
	      <?= $user->get_name() ?>
	    </div>
	  <? } ?>
	</div>
</div>

<? require_once 'layouts/footer.php' ?>
