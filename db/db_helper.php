<?

class DbHelper {

	private static $db;
	private static $hostname = "localhost";
	private static $username = "team03";
	private static $password = "magenta";
	private static $db_name = "yumememe";

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
				$stmt->bind_param("ii", $user, $other);
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
			$stmt->bind_param('ii', $user, $other);
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

}


?>
