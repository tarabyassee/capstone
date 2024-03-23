<?php 
  require_once('initialize.php');

  if(isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];
    $productSet = getProductsByCategory($categoryId);

    header('Content-Type: application/json');
    echo json_encode($productSet);
    exit();
  } 
?>