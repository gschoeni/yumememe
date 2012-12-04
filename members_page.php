<? require_once 'php_helpers/init.php' ?>
<? require_once 'php_helpers/check_registration.php' ?>
<? require_once 'layouts/header.php' ?>

<div id="members">
  <? foreach (DbHelper::find_all_users() as $user) { ?>
    <div class="member">
      <a href="/toggle_follower.php?user=<?= $_SESSION['user_id'] ?>&other=<?=$user->get_id()?>" alt="follow this user">
    </div>
  <? } ?>
</div>

<? require_once 'layouts/footer.php' ?>
