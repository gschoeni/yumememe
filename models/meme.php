<?

  class Meme {

    private $id;
    private $title;
    private $user_id;
    private $timestamp;

    public function __construct($id, $title, $user_id, $timestamp) {
      $this->id = $id;
      $this->title = $title;
      $this->user_id = $user_id;
      $this->timestamp = $timestamp;
    }

    public function get_id() {
      return $this->id;
    }

    public function get_title() {
      return $this->title;
    }

    public function get_user_id() {
      return $this->user_id;
    }

    public function get_timestamp() {
      return $this->timestamp;
    }

    public function get_likes() {
      return DbHelper::num_meme_likes($this->id);
    }

    public function get_comments() {
      return DbHelper::get_meme_comments($this->id);
    }

  }

?>
