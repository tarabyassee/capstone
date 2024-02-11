<?php

function find_all_categories($db) {
  $sql = "SELECT * FROM product_category_cat";
  $result = mysqli_query($db, $sql);
  return $result;
}



?>