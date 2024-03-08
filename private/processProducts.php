<?php
require_once('initialize.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST["categoryId"])) {
    $categoryId = $_POST["categoryId"];
    $products = getProductsByCategory($categoryId);
  }
  if($products) {
    header("Location: " . urlFor('users/admins/index.php'));
    exit();
  } else {
    echo "<p>Try again. Category Id not found</p>";
  }
} else {
  echo "<p> Invalid request method</p>";
  }