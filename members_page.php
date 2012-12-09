<? require_once 'php_helpers/init.php' ?>
<? check_logged_in(); ?>
<? require_once 'layouts/header.php' ?>
<? require_once DOCUMENT_ROOT.'layouts/title_bar.php'; ?>
<? require_once DOCUMENT_ROOT.'layouts/sidebar.php'; ?>

<div id="content">
  <div id="members">
    <h2>All Members</h2>
    <form action="members_page.php">
      <input type="text" name="q" />
      <input type="submit" value="search" />
    </form>
    <?  if (isset($_GET['message'])) {
          echo $_GET['message'] ."<br/><br/>" ;
        }
      if (isset($_GET['q'])) {
        $result_set = DbHelper::find_users_by_name_or_email($_GET['q']);
      } else {
        $result_set = DbHelper::find_all_users();
      }
      $count = 0;
      foreach ($result_set as $user) { ?>
      <? if ($user->get_id() != $_SESSION['user_id']) { 
          $count++;
      ?>
        <div class="member">
          <img width="70" height="70" src="<?= $user->get_profile_pic() ?>" /><a href="profile_page.php?id=<?= $user->get_id(); ?>"/> <?= $user->get_name(); ?></a>
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
    <? if ($count == 0) { echo "No results found for '".$_GET['q']."'"; }?>
  </div>
</div>
<div class="clear"></div>

<? require_once 'layouts/footer.php' ?>
