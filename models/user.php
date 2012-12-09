<?
// require_once 'db/connect_to_db.php';

  class User {

    private $id;
    private $email;
    private $first_name;
    private $last_name;

    public function __construct($id, $email, $first_name, $last_name) {
      $this->id = $id;
      $this->email = $email;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
    }

    public function get_id() {
      return $this->id;
    }

    public function get_email() {
      return $this->email;
    }

    public function get_first_name() {
      return $this->first_name;
    }

    public function get_last_name() {
      return $this->last_name;
    }

    public function get_name() {
      return $this->first_name." ".$this->last_name;
    }

    public function get_profile_pic() {
      $filename = 'uploads/profile_pictures/'.$this->get_id().'_thumb.jpg';
      if (file_exists($filename)) {
        return $filename;
      } else {
        return 'uploads/profile_pictures/no_prof.png';
      }
    }

  }

?>
