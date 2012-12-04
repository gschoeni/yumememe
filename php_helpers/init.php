<?
// Display errors
ini_set('display_errors',1);
error_reporting(E_ALL);

// Define globals
define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/team03/sn/");

// require useful files
require_once(DOCUMENT_ROOT.'php_helpers/functions.php');
require_once(DOCUMENT_ROOT.'db/db_helper.php');
require_once(DOCUMENT_ROOT.'models/user.php');
// init the users session
session_start();


?>
