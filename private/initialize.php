<?php 
  ob_start();
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  $publicEnd = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $docRoot = substr($_SERVER['SCRIPT_NAME'], 0, $publicEnd);
  define("WWW_ROOT", $docRoot);
  
  require_once('functions.php');
  require_once('database.php');
  require_once('queryFunctions.php');
  
  $db = dbConnect();

?>