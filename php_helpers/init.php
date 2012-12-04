<?
// Display errors
ini_set('display_errors',1); 
error_reporting(E_ALL);

// Define globals
define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']."/SN/");

// require useful files
require_once(DOCUMENT_ROOT.'php_helpers/functions.php');
require_once(DOCUMENT_ROOT.'db/db_helper.php');

// init the users session
session_start();


?>