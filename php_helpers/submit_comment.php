<?
  require_once 'init.php';
  check_logged_in();
  if (isset($_POST['comment']) && isset($_POST['meme_id'])) {
    $meme_id = $_POST['meme_id'];
    DbHelper::comment_on_meme($_POST['comment'], $_SESSION['user_id'], $meme_id);
    header("Location: ../view_meme.php?id=$meme_id");
  }

?>
