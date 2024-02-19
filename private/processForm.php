<?php 
require_once('initialize.php');

$selectedSubject = isset($_POST['search']) ? $_POST['search'] : '';

switch ($subject) {
  case 'user':
      getUserInformation($user);
      break;
  case 'vendor':
      $sql = "SELECT * FROM vendors WHERE ... (use search criteria if applicable)";
      break;
  case 'product':
      $sql = "SELECT * FROM products WHERE ... (use search criteria if applicable)";
      break;
  }
?>