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
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $products = [];
  while($product = mysqli_fetch_assoc($result)) {
    $products[] = $product;
  }
  mysqli_free_result($result);
  return $products;
}

function getUserVendorInformation($user_id) {
  global $db;
  $sql = "SELECT u.first_name_usr, v.vendor_name_ven, v.id_ven ";
  $sql .= "FROM user_usr u JOIN vendor_ven v ";
  $sql .= "WHERE u.id_usr = $user_id";
  #echo $sql;
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

function getUserInformation($user) {
  global $db;
  $sql = "SELECT u.id_usr, u.first_name_usr, u.last_name_usr, u.phone_number_usr, t.type_phn, u.email_usr, u.username_usr, u.is_admin ";
  $sql .= "FROM user_usr u JOIN phone_type_phn t ";
  $sql .= "WHERE u.id_phn_usr = t.id_phn";
  echo $sql;
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

function getVendorInformation($ven_id) {
  global $db;
  $sql = "SELECT v.id_ven, v.vendor_name_ven, v.vendor_description_ven, v.vendor_address_ven, v.vendor_city_ven, s.name_sta, v.stall_number_ven ";
  $sql .= "FROM vendor_ven v JOIN state_sta s ";
  $sql .= "ON v.id_sta_ven = s.id_sta ";
  $sql .= "WHERE v.id_ven = $ven_id";
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

function getCategories() {
  global $db;
  $sql = "SELECT * FROM product_category_cat";
  $result = mysqli_query($db, $sql);
  $categories = array();
  while($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
  };
  mysqli_free_result($result);
  return $categories;
}

function getProductsByCategory($categoryId) {
  global $db;

  $sql = "SELECT p.product_name_prod ";
  $sql .= "FROM product_prod p ";
  $sql .= "JOIN product_category_cat pc ";
  $sql .= "ON p.id_cat_prod = pc.id_cat ";
  $sql .= "WHERE pc.id_cat = $categoryId";

  $result = mysqli_query($db, $sql);
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo '<pre>';
  var_dump($products);
  echo '<pre>';
  return $products;
}


?>