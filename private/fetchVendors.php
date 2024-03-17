<?php 
  require_once('initialize.php');

  if(isset($_GET['productName'])) {
    $productName = $_GET['productName'];
    $vendors = getVendorsByProduct($productName);
    header('Content-Type: application/json');
    echo json_encode($vendors);
  } else {
    http_response_code(400);
    echo json_encode(array("error" => "Product name is required"));
    }
    
?>