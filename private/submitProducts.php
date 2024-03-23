<?php 
  require_once('initialize.php');
  session_start();
  $vendorId = $_SESSION["vendorId"]; 

  $data = json_decode(file_get_contents('php://input'), true);
  $productIds = $data['productIds'];
  
  foreach($productIds as $productId) {
    addNewProduct($vendorId, $productId);
  }

?>