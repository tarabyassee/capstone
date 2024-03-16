<?php 
  require_once('initialize.php');

  if(isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];

    $productSet = getProductsByCategory($categoryId);

    header('Content-Type: application/json');
    echo json_encode($productSet);
  } else {
    http_response_code(400);
    echo json_encode(array("error" => "Category Id is required"));
  }
?>