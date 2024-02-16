<?php

function findAllCategories($db) {
  global $db;

  $sql = "SELECT * FROM product_category_cat";
  $result = mysqli_query($db, $sql);
  return $result;
}

function findProductsById($id) {
  global $db;

  $sql = "SELECT * FROM product_prod ";
  $sql .= "WHERE id_prod ='" . dbEscape($db, $id) . "'";
  echo $sql;
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

?>