<? require_once 'php_helpers/init.php' ?>
<? require_once 'php_helpers/check_registration.php' ?>
<? require_once 'layouts/header.php' ?>

<div id="members">
  <?  if (isset($_GET['message'])) {
        echo $_GET['message'] ;
      }
    foreach (DbHelper::find_all_users() as $user) { ?>
    <div class="member">
      <?= $user->get_name() ?>
      <a style="color:green" href="php_helpers/toggle_follower.php?name=<?= $user->get_name() ?>&user=<?= $_SESSION['user_id'] ?>&other=<?=$user->get_id()?>" alt="follow this user">
        Follow/Unfollow Me
      </a>
    </div>
  <? } ?>
</div>

<? require_once 'layouts/footer.php' ?>
