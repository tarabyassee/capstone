<?php 
  require_once('../../../../private/initialize.php');

  $pageTitle = 'Show Product';
  $categoryId = $_GET['id'];

  $product = findProductsById($categoryId);

  include(SHARED_PATH . '/usersHeader.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Show</title>
  </head>
  
  <body>
    <div id="show-body">
      <h1>Subject: <?php echo h($product['id_prod']) ?></h1>
      <div>
        <dl>
          <dt>Product Id</dt>
          <dd><?php echo h($product['id_prod']); ?></dd>
        </dl>
        <dl>
          <dt>Product Name</dt>
          <dd><?php echo h($product['product_name_prod']);?></dd>
        </dl>
        <dl>
          <dt>Product Category</dt>
          <dd><?php echo h($product['id_cat_prod']);?></dd>
        </dl>
      </div>

    </div>

  </body>
</html>