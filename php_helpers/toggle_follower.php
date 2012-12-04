<?

  if (isset($_GET['follow'])) {
    DbHelper::toggle_following($_GET['user'], $_GET['other']);
    header("Location: members_page.php");
  }

?>
