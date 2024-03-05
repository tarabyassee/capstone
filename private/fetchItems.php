<?php 
  require_once('initialize.php');
  
  if(isset($_GET['categoryId'])) {
    $categoryId = mysqli_real_escape_string($db, $_GET['categoryId']);
    $products = getProductsByCategory($categoryId);
    $_SESSION['products'] = $products;
    var_dump($_SESSION['products']);
    header("Location: ../public/users/vendors/products/new.php");
    exit();
  }
/*    else {
    echo "No products found";
    header("Location: ../public/users/vendors/index.php");
  } */

?>