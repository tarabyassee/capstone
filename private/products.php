<?php

$categoryId = $_GET["category"];
$sql = "SELECT id_prod, product_name FROM product_prod WHERE id_cat_prod = ?";
$stmt = mysqli_stmt_init($db);
mysqli_stmt_bind_param($stmt, "i", $categoryId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$products = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}
$stmt->close();

