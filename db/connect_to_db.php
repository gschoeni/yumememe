<?

class DbHelper {

	private static $db;
	private $hostname = "localhost";
	private $username = "root";
	private $password = "root";
	private $db_name = "yumememe";

	public __construct() {
		$db = self::getInstance();
	}

	public static function getInstance() {
		if (!self::$db) {
			self::$db = new mysqli($hostname, $username, $password, $db_name);
			if (mysqli_connect_errno()) {
				printf("Connection failed %s\n", mysqli_connect_error());
				exit();
			}
		}
		return self::$db;
	}

	private close_connection() {
		if (!$db->close()) {
			printf("Could not close connection to database\n");
			exit();
		}
	}

	public function query($query, $params) {
		
	}


}


?>