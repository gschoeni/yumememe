<?

  class Comment {

    private $id;
    private $comment;
    private $user_id;
    private $meme_id;
    private $timestamp;

    public function __construct($id, $comment, $user_id, $meme_id, $timestamp) {
      $this->id = $id;
      $this->comment = $comment;
      $this->user_id = $user_id;
      $this->meme_id = $meme_id;
      $this->timestamp = $timestamp;
    }

    public function get_id() {
      return $this->id;
    }

    public function get_comment() {
      return $this->comment;
    }

    public function get_user_id() {
      return $this->user_id;
    }

    public function get_meme_id() {
      return $this->meme_id;
    }

    public function get_timestamp() {
      return $this->timestamp;
    }

    public function get_user() {
      return DbHelper::find_user_by_id($this->user_id);
    }

  }

?>
