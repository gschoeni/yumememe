<?
  require_once 'init.php';
  check_logged_in();
  if (isset($_GET['id'])) {
    $meme_id = $_GET['id'];
    DbHelper::like_meme($_SESSION['user_id'], $meme_id);
    header("Location: ../view_meme.php?id=$meme_id");
  }

?>
