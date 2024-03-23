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
  $result = mysqli_query($db, $sql);
  confirmResultSet($result);
  $product = mysqli_fetch_assoc($result);
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
  $sql = "SELECT id_ven, vendor_name_ven, vendor_description_ven, stall_number_ven ";
  $sql .= "FROM vendor_ven ";
  $sql .= "WHERE id_ven = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "s", $vendorId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $vendor = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
  return $vendor;
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
  $sql = "SELECT product_name_prod, id_prod ";
  $sql .= "FROM product_prod ";
  $sql .= "WHERE id_cat_prod = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $categoryId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $products = array();
  while ($row = mysqli_fetch_assoc($result))
  $products[] = $row;
  mysqli_free_result($result);
  return $products;
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

function updateVendor($vendorId) {
  global $db;
  $vendor = [];
  $vendor['vendor_name_ven'] =$_POST['vendor_name_ven'] ?? '';
  $vendor['vendor_description_ven'] =$_POST['vendor_description_ven'] ?? '';
  $vendor['stall_number_ven'] =$_POST['stall_number_ven'] ?? '';

  $sql = "UPDATE vendor_ven SET ";
  $sql .= "vendor_name_ven=?, ";
  $sql .= "vendor_description_ven=?, ";
  $sql .= "stall_number_ven=? ";
  $sql .= "WHERE id_ven=? ";
  $sql .= "LIMIT 1";

  $stmt = mysqli_prepare($db, $sql);
  if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($db));
  }

  mysqli_stmt_bind_param($stmt, "sssi", $vendor['vendor_name_ven'], $vendor['vendor_description_ven'], $vendor['stall_number_ven'], $vendorId);

  $result = mysqli_stmt_execute($stmt);
  if (!$result) {
    die("Error executing statement: " . mysqli_stmt_error($stmt));
  }

  if ($result) {
    redirectTo(urlFor('/users/vendors/index.php?id=' . $vendorId));
  } else {
    echo mysqli_error($db);
    dbDisconnect($db);
    exit;
  }
}

function getAllVendors() {
  global $db;
  $sql = "SELECT id_ven, vendor_name_ven, vendor_description_ven, stall_number_ven ";
  $sql .= "FROM vendor_ven ";
  $result = mysqli_query($db, $sql);
  if(!$result) {
    echo "Error: " . mysqli_error($db);
    return false;
  }
  $vendors = array();
  while ($row = mysqli_fetch_assoc($result))
  $vendors[] = $row;

  mysqli_free_result($result);
  return $vendors;
}

function deleteProductFromVendor($id_prod, $id_ven) {
  global $db;
  $sql_select = "SELECT id_vjunc ";
  $sql_select .= "FROM vendor_junction_vjunc ";
  $sql_select .= "WHERE id_prod_vjunc = ? AND id_ven_vjunc = ? ";

  $stmt_select = mysqli_stmt_init($db);

  if(!mysqli_stmt_prepare($stmt_select, $sql_select)) {
    header("Location: index.php?error=selectStmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt_select, "ss", $id_prod, $id_ven);
  mysqli_stmt_execute($stmt_select);

  if(mysqli_stmt_error($stmt_select)) {
    header("Location: index.php?error=stmtSelectError");
    exit();
  }

  $result = mysqli_stmt_get_result($stmt_select);
  $row = mysqli_fetch_assoc($result);
  $id_vjunc = $row['id_vjunc'];

  $sql = "DELETE FROM vendor_junction_vjunc ";
  $sql .= "WHERE id_vjunc = ?";
  $stmt = mysqli_stmt_init($db);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $id_junc);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_error($stmt)) {
    header("Location: index.php?error=stmtError");
    exit();
  }

  $result = mysqli_stmt_get_result($stmt);
  if($result == false) {
    echo "Error: no result";
  } else {
    echo "Product deletion successful.";
  }

}

function addProductToVendor($id_prod, $id_ven) {
  global $db;
  $sql = "INSERT INTO vendor_junction_vjunc (id_ven_vjunc, id_ven_prod) ";
  $sql .= "VALUES (?, ?)";

  $stmt = mysqli_stmt_init($db);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../public/users/vendors/products/new.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_ven, $id_prod);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("Location: ../public/users/vendors/products/new.php?error=none");
}

function getProductSuggestions($searchTerm) {
  global $db;
  $sql = "SELECT product_name_prod ";
  $sql .= "FROM product_prod ";
  $sql .= "WHERE product_name_prod LIKE ?";
  $stmt = mysqli_prepare($db, $sql);
  $param = "%{$searchTerm}%";
  mysqli_stmt_bind_param($stmt, "s", $param);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $suggestions = array();
  while($row = mysqli_fetch_assoc($result)) {
    $suggestions[] = $row;
  }
  mysqli_stmt_close($stmt);
  return $suggestions;
}

function getVendorsByProduct($productName) {
  global $db;
  $sql = "SELECT ven.vendor_name_ven ";
  $sql .= "FROM vendor_ven AS ven ";
  $sql .= "JOIN vendor_junction_vjunc AS vj ON ven.id_ven = vj.id_ven_vjunc ";
  $sql .= "JOIN product_prod AS p ON vj.id_prod_vjunc = p.id_prod ";
  $sql .= "WHERE p.product_name_prod = ?";

  $stmt = mysqli_prepare($db, $sql);
  $stmt = mysqli_prepare($db, $sql);

  mysqli_stmt_bind_param($stmt, "s", $productName);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $vendors = array();
  while($row = mysqli_fetch_assoc($result)) {
    $vendors[] = $row;
  }
  mysqli_stmt_close($stmt);
  return $vendors;
}

function addNewProduct($vendorId, $productId) {
  global $db;
  $sql = "INSERT INTO vendor_junction_vjunc(id_ven_vjunc, id_prod_vjunc) ";
  $sql .= "VALUES (?, ?) ";

  $stmt = mysqli_prepare($db, $sql);
  if(!$stmt) {
    die("error preparing statement: " . mysqli_error($db));
  }
  mysqli_stmt_bind_param($stmt, "ii", $vendorId, $productId);
  $result = mysqli_stmt_execute($stmt);
  if(!$result) {
    die("error executing statement: " . mysqli_stmt_error($stmt));
  }
  mysqli_stmt_close($stmt);
  echo "<p>You have successfully entered your products!</p>";


}

?>
