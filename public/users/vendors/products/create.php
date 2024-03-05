<?php
  require_once('../../../../private/initialize.php');

  if(isPostRequest()) {
    $productName = $_POST['productName'] ?? '';
    $categoryId = $_POST['categoryId'] ?? '';

    $product = insertIntoProducts($productName, $categoryId);
    echo "Product Added! <br>";
    echo "Product Name:" . $productName . "<br>";
    echo "CategoryName:" . $categoryId . "<br>";

  } else {
    redirectTo(urlFor('users/vendors/products/new.php'));
  }

  