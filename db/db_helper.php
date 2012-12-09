<?

class DbHelper {

	private static $db;
	private static $hostname = "localhost";
	private static $username = "team03";
	private static $password = "magenta";
	private static $db_name = "team03";

	private static function initialize() {
		self::$db = new mysqli(self::$hostname, self::$username, self::$password, self::$db_name);
		if (mysqli_connect_errno()) {
				printf("Connection failed %s\n", mysqli_connect_error());
				exit();
		}
	}

	private static function close_connection() {
		if (!self::$db->close()) {
			printf("Could not close connection to database\n");
			exit();
		}
	}

	public static function query($query, $params) {
		self::initialize();
		$stmt = self::$db->prepare($query);

		$new = array();
		for ($i = 0; $i < sizeof($params); $i++) {
			$new[$i] = $params[$i];
		}

		call_user_func_array(array(&$stmt, 'bind_param'), $new);

		$stmt->execute();
		self::close_connection();
	}

	public static function find_user_by_email($email) {
		self::initialize();
		$user_id = 0;
		if ($stmt = self::$db->prepare("SELECT id FROM users WHERE email = ?;")){
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->bind_result($user_id);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $user_id;
	}

	public static function register_user($first_name, $last_name, $email, $password) {
		if (self::find_user_by_email($email) > 0) { // this email has already been registered
			return false;
		} else {
			self::initialize();
			if ($stmt = self::$db->prepare("INSERT INTO users (first_name, last_name, email, hashed_password) VALUES (?,?,?,?)")){
				$stmt->bind_param('ssss', $fname, $lname, $em, $pass);
				$fname = $first_name;
				$lname = $last_name;
				$em = $email;
				$pass = sha1($password);
				$stmt->execute();
				$stmt->close();
			} else {
				die('prepare() failed: ' . htmlspecialchars(self::$db->error));
			}
			self::close_connection();
			return true;
		}
	}

	public static function authenticate_user($email, $password) {
		self::initialize();
		$user_id = 0;
		if ($stmt = self::$db->prepare("SELECT id FROM users WHERE email = ? AND hashed_password = ?;")){
			$stmt->bind_param('ss', $e, $p);
			$e = $email;
			$p = sha1($password);
			$stmt->execute();
			$stmt->bind_result($user_id);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $user_id;
	}

	public static function find_all_users() {
		self::initialize();
		$users = array();
		$query = "SELECT id, email, first_name, last_name FROM users";
		if ($stmt = self::$db->prepare($query)){
			$stmt->execute();
			$stmt->bind_result($id, $email, $first_name, $last_name);
			while ($stmt->fetch()) {
				array_push($users, new User($id, $email, $first_name, $last_name));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $users;
	}

	public static function find_users_memes($user_id) {
		self::initialize();
		$memes = array();
		$query = "SELECT id, title, user_id, timestamp FROM memes WHERE user_id = ? ORDER BY timestamp DESC;";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->bind_result($id, $title, $user_id, $timestamp);
			while ($stmt->fetch()) {
				array_push($memes, new Meme($id, $title, $user_id, $timestamp));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $memes;
	}

	public static function find_meme($id) {
		self::initialize();
		$user_id = 0;
		if ($stmt = self::$db->prepare("SELECT memes.title, memes.user_id, memes.timestamp FROM memes WHERE memes.id = ?;")){
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($title, $user_id, $timestamp);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return new Meme($id, $title, $user_id, $timestamp);
	}

	public static function find_users_by_name_or_email($search_string) {
		self::initialize();
		$users = array();
		$query = "SELECT id, email, first_name, last_name FROM users WHERE first_name = ? or last_name = ? or email = ?";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('sss', explode(" ", $search_string)[0], explode(" ", $search_string)[1], $search_string);
			$stmt->execute();
			$stmt->bind_result($id, $email, $first_name, $last_name);
			while ($stmt->fetch()) {
				array_push($users, new User($id, $email, $first_name, $last_name));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $users;
	}

	public static function find_following_users($user_id) {
		self::initialize();
		$users = array();
		$query = "SELECT users.id, users.email, users.first_name, users.last_name FROM users, followers WHERE users.id = followers.user_id AND followers.follower_id = ?;";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->bind_result($id, $email, $first_name, $last_name);
			while ($stmt->fetch()) {
				array_push($users, new User($id, $email, $first_name, $last_name));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $users;
	}

	public static function find_followers($user_id) {
		self::initialize();
		$users = array();
		$query = "SELECT users.id, users.email, users.first_name, users.last_name FROM users, followers WHERE users.id = followers.follower_id AND followers.user_id = ?;";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->bind_result($id, $email, $first_name, $last_name);
			while ($stmt->fetch()) {
				array_push($users, new User($id, $email, $first_name, $last_name));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $users;
	}

	public static function find_user_by_id($_id) {
		self::initialize();
		$query = "SELECT id, email, first_name, last_name FROM users WHERE id = ?";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $_id);
			$stmt->execute();
			$stmt->bind_result($id, $email, $first_name, $last_name);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return new User($id, $email, $first_name, $last_name);
	}

	public static function update_user($id, $first_name, $last_name, $email) {
		self::initialize();
		$query = "UPDATE users SET email = ?, first_name = ?, last_name = ? WHERE id = ?";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('sssi', $email, $first_name, $last_name, $id);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
	}

	public static function toggle_following($user, $other) {
		$id = self::is_following($user, $other);

		if ($id == 0) {
			$query = "INSERT INTO followers (user_id, follower_id) VALUES (?, ?)";
		} else {
			$query = "DELETE FROM followers WHERE id = ?";
		}

		self::initialize();

		if ($stmt = self::$db->prepare($query)){
			if ($id == 0) {
				$stmt->bind_param("ii", $other, $user);
			} else {
				$stmt->bind_param("i", $id);
			}
			$stmt->execute();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $id == 0;
	}

	public static function is_following($user, $other) {
		self::initialize();
		$id = 0;
		$query = "SELECT id FROM followers WHERE user_id = ? and follower_id = ?";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('ii', $other, $user);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $id;
	}

	public static function insert_meme($title, $user_id) {
		self::initialize();
		$id = 0;
		if ($stmt = self::$db->prepare("INSERT INTO memes (title, user_id) VALUES (?,?)")){
			$stmt->bind_param('si', $title, $user_id);
			$stmt->execute();
			$id = self::$db->insert_id;
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $id;	
	}

	public static function like_meme($user_id, $meme_id) {
		self::initialize();
		$id = 0;
		if ($stmt = self::$db->prepare("INSERT INTO likes (user_id, meme_id) VALUES (?,?)")){
			$stmt->bind_param('ii', $user_id, $meme_id);
			$stmt->execute();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
	}

	public static function num_meme_likes($meme_id) {
		self::initialize();
		$num_likes = 0;
		$query = "SELECT COUNT(*) FROM likes WHERE meme_id = ?;";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $meme_id);
			$stmt->execute();
			$stmt->bind_result($num_likes);
			$stmt->fetch();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $num_likes;
	}

	public static function comment_on_meme($comment, $user_id, $meme_id) {
		self::initialize();
		$id = 0;
		if ($stmt = self::$db->prepare("INSERT INTO comments (comment, user_id, meme_id) VALUES (?,?,?)")){
			$stmt->bind_param('sii', $comment, $user_id, $meme_id);
			$stmt->execute();
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
	}

	public static function get_meme_comments($meme_id) {
		self::initialize();
		$comments = array();
		$query = "SELECT id, user_id, comment, timestamp FROM comments WHERE comments.meme_id = ? ORDER BY timestamp DESC;";
		if ($stmt = self::$db->prepare($query)){
			$stmt->bind_param('i', $meme_id);
			$stmt->execute();
			$stmt->bind_result($id, $user_id, $comment, $timestamp);
			while ($stmt->fetch()) {
				array_push($comments, new Comment($id, $comment, $user_id, $meme_id, $timestamp));
			}
			$stmt->close();
		} else {
			die('prepare() failed: ' . htmlspecialchars(self::$db->error));
		}
		self::close_connection();
		return $comments;
	}

}


?>
