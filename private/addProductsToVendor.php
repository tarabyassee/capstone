<?php
  <?php 
  require_once('initialize.php');

  if(isset($_POST['selectedProducts[]'])) {
    $selectedProductsArray = $_POST['categoryId'];

    $productSet = getProductsByCategory($categoryId);

    $_SESSION['productSet'] = $productSet;
    header('Location: new.php');
    exit();
  } else {
    $_SESSION['error'] = "No category chosen. Try again.";
    header('Location: new.php');
    exit();
  }
?>

?>