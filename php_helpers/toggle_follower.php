<?

  if (isset($_POST['follow'])) {
    DbHelper::toggle_following($_POST['user'], $_POST['other']);
    header("Location: members_page.php");
  }

?>
