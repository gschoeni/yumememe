<?

class DbHelper {

	private static $db;
	private static $hostname = "localhost";
	private static $username = "root";
	private static $password = "";
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
		for ($i = 0; $i < sizeof($params) ; $i++) { 
			array_push($new, &$params[$i]);
		}

		call_user_func_array(array(&$stmt, 'bind_param'), $new);
		
		$stmt->execute();
		self::close_connection();
	}

}


?>