<?php 
  require_once('initialize.php');
  if(isset($_GET['categoryId'])) {
    $categoryId = mysqli_real_escape_string($db, $_GET['categoryId']);
    $products = getProductsByCategory($categoryId);
    
    header('Content-Type: application/json');
    echo json_encode($products);
  } else {
    echo "No such category id.";
  }

?>
