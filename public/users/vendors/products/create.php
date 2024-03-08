<?php
  require_once('../../../../private/initialize.php');

  if(isPostRequest()) {
    $categoryId = $_POST['categoryId'] ?? '';
    $productName = $_POST['productName'] ?? '';

    $product = insertIntoProducts($productName, $categoryId);
    echo "Product Added! <br>";
    echo "Product Name:" . $productName . "<br>";
    echo "CategoryName:" . $categoryId . "<br>";

  } else {
    redirectTo(urlFor('users/vendors/products/new.php'));
  }

  