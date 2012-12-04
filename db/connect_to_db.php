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
		print_r(self::$db);
		if($stmt = self::$db->prepare($query)) {

		} else {
			echo "error";
		}

		$new = array("ssss", "greg", "schoeninger", "email", "pass");
		// for ($i = 0; $i < sizeof($params) ; $i++) { 
		// 	$new[$i] = $params[$i];
		// }
		print_r($new);

		call_user_func_array(array(&$stmt, 'bind_param'), $new);
		
		$stmt->execute();
		self::close_connection();
	}

}


?>