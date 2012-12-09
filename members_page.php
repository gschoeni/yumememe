<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>

<div id="content">
  <div id="members">
    <h2>All Members</h2>
    <?  if (isset($_GET['message'])) {
          echo $_GET['message'] ."<br/><br/>" ;
        }
      foreach (DbHelper::find_all_users() as $user) { ?>
      <? if ($user->get_id() != $_SESSION['user_id']) { ?>
        <div class="member">
          <?= $user->get_name() ?>
          <a style="color:green" href="php_helpers/toggle_follower.php?name=<?= $user->get_name() ?>&user=<?= $_SESSION['user_id'] ?>&other=<?=$user->get_id()?>" alt="follow this user">
            <? if (DbHelper::is_following($_SESSION['user_id'], $user->get_id()) > 0) { // is_following returns the id of the row in the following table or 0
              echo "Unfollow";
            } else { 
              echo "Follow";
            }?>
          </a>
        </div>
      <? } ?>
    <? } ?>
  </div>
</div>
<div class="clear"></div>

<? require_once 'layouts/footer.php' ?>
