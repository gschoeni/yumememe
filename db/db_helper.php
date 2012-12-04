<?

class DbHelper {

	private static $db;
	private static $hostname = "localhost";
	private static $username = "team03";
	private static $password = "magenta";
	private static $db_name = "yumememe";

	private static function initialize() {
		
		if (self::$db) {
			return;
		}

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

	public static function register_user($first_name, $last_name, $email, $password) {
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



}


?>