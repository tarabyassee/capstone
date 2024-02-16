<?php 
  require_once('../../../private/initialize.php');

  $id = $GET_['id_prod'] ?? '1';

  $product = findProductsById($id);

  $pageTitle = 'Show Product';

  include(SHARED_PATH . '/users_header.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Show</title>
  </head>
  
  <body>
    <div id="show-body">
      <h1>Subject: <?php echo h($subject['id_prod']) ?></h1>
      <div>
        <dl>
          <dt>Product Id</dt>
          <dd><?php echo h($subject['id_prod']); ?></dd>
        </dl>
        <dl>
          <dt>Product Name</dt>
          <dd><?php echo h($subject['product_name_prod']);?></dd>
        </dl>
        <dl>
          <dt>Product Category</dt>
          <dd><?php echo h($subject['id_cat_prod']);?></dd>
        </dl>
      </div>

    </div>

  </body>
</html>