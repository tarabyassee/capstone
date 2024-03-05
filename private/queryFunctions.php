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
  $product = mysqli_fetch_assoc($result);
  var_dump($product);
  mysqli_free_result($result);
  return $product;
}

function findAllProductsByVendorId($vendorId) {
  global $db;
  $sql = "SELECT p.id_prod, p.product_name_prod, c.category_name_cat ";
  $sql .= "FROM product_prod p ";
  $sql .= "INNER JOIN product_category_cat c ";
  $sql .= "ON p.id_cat_prod = c.id_cat ";
  $sql .= "INNER JOIN vendor_junction_vjunc vj ";
  $sql .= "ON p.id_prod = vj.id_prod_vjunc ";
  $sql .= "INNER JOIN vendor_ven v ";
  $sql .= "ON vj.id_ven_vjunc = v.id_ven ";
  $sql .= "WHERE v.id_ven = $vendorId";
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $products = [];
  while($product = mysqli_fetch_assoc($result)) {
    $products[] = $product;
  }
  mysqli_free_result($result);
  return $products;
}

function getUserVendorInformation($userId) {
  global $db;
  $sql = "SELECT vendor_name_ven, id_ven, vendor_description_ven, stall_number_ven ";
  $sql .= "FROM vendor_ven ";
  $sql .= "WHERE id_usr_ven = $userId";
  echo $sql;
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

function getVendorInformation($vendorId) {
  global $db;
  $sql = "SELECT v.id_ven, v.vendor_name_ven, v.vendor_description_ven, v.stall_number_ven ";
  $sql .= "FROM vendor_ven v ";
  $sql .= "WHERE v.id_ven = $vendorId";
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
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row["id_cat"] . "'>" . $row["category_name_cat"] . "</options>";
    }
  } else {
    echo "No categories found";
  }

  mysqli_free_result($result);
}

function getProductsByCategory($categoryId) {
  global $db;

  $sql = "SELECT p.product_name_prod ";
  $sql .= "FROM product_prod p ";
  $sql .= "WHERE id_cat_prod = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $categoryId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $product = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
  return $product;
}

function getVendorId($userId) {
  global $db;
  $sql = "SELECT id_ven ";
  $sql .= "FROM vendor_ven ";
  $sql .= "WHERE id_usr_ven = $userId LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject;
}

function insertIntoProducts($productName, $categoryId) {
  global $db;
  $sql = "INSERT INTO product_prod (product_name_prod, id_cat_prod) ";
  $sql .= "VALUES (?, ?)";
  $stmt = mysqli_stmt_init($db);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../public/users/vendors/products/new.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "si", $productName, $categoryId);
  $result = mysqli_stmt_execute($stmt);
  if ($result) {
    $newId = mysqli_insert_id($db);
    header("Location: ../products/show.php?id=" . $newId);
    exit();
  } else {
    header("Location: ../public/users/vendors/products/new.php?error=failedToAdd");
    exit();
    }
    mysqli_stmt_close($stmt);
  }

?>