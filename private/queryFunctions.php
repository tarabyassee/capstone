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

function findAllProductsByVendorId($ven_id) {
  global $db;

  $sql = "SELECT p.id_prod, p.product_name_prod, c.category_name_cat ";
  $sql .= "FROM product_prod p ";
  $sql .= "INNER JOIN product_category_cat c ";
  $sql .= "ON p.id_cat_prod = c.id_cat ";
  $sql .= "INNER JOIN vendor_junction_vjunc vj ";
  $sql .= "ON p.id_prod = vj.id_prod_vjunc ";
  $sql .= "INNER JOIN vendor_ven v ";
  $sql .= "ON vj.id_ven_vjunc = v.id_ven ";
  $sql .= "WHERE v.id_ven = '" . dbEscape($db, $ven_id) . "'";
  echo $sql;
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $products = [];
  while($product = mysqli_fetch_assoc($result)) {
    $products[] = $product;
  }
  mysqli_free_result($result);
  return $products;
}

function getUserVendorInformation($id_user) {
  global $db;
  $sql = "SELECT u.first_name_usr, v.vendor_name_ven, v.id_ven ";
  $sql .= "FROM user_usr u JOIN vendor_ven v ";
  $sql .= "WHERE u.id_usr = $id_user";
  echo $sql;
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

?>