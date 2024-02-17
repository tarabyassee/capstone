<?php
  require_once('../../../../private/initialize.php');
  $pageTitle = "Products";
  $ven_id = $_GET['id_ven'] ?? '1';

  $productSet = findAllProductsByVendorId($ven_id);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
  </head>
  
  <body>
  <table border=1>
      <caption>Products</caption>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Category Name</th>
      </tr>
      <?php foreach($productSet as $product) { ?>
        <tr>
          <td><?php echo $product['id_prod']; ?></td>
          <td><?php echo $product['product_name_prod']; ?></td>
          <td><?php echo $product['category_name_cat']; ?></td>
        </tr>
      <?php } ?>
      </table>
    </div>
  </body>
</html>