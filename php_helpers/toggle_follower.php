<?
  require_once 'init.php';

  if (isset($_GET['user']) && isset($_GET['other'])) {
    $message = "";
    $following_id = DbHelper::toggle_following($_GET['user'], $_GET['other']);
    if ($following_id > 0) {
      $message = "You're now following ".$_GET['name'];
    } else {
      $message = "You're no longer following ".$_GET['name'];
    }
    header("Location: ../members_page.php?message=$message");
  }

?>
