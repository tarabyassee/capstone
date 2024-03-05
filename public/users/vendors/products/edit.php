<?php 
  require_once('../../../private/initialize.php');
  if(!isset($_GET['id_prod'])) {
    redirectTo(urlFor('/vendors/products/index.php'));
  }

  $pageTitle = "Edit Products";

  $id_prod = $_GET['id_prod'] ?? '1';

  if(isPostRequest()) {
    $product = [];
    $product['id_prod'] = $_POST['id_prod'];
    $product['product_name'] =$_POST['product_name'];
    $product['category_name'] =$POST['category_name'];

  $result = updateProduct($product);

  }

  include(SHARED_PATH . '/users_header.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit Products</title>
  </head>
  
  <body>
    <div id="content">
      <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>

      <h1>Edit Products</h1>
      <h2>Vendor Name</h2>
      <form action="" method="post">
        <dl>
          <dt>Product Name</dt>
          <dd><input type="text" name="productName" value=""><?php echo h($products['id_prod']); ?></dd>
        </dl>
        <dl>
          <dt>Category</dt>
          <dd>
            <select name="category">
              <option value="animal">Animal</option>
            </select>
          </dd>
        </dl>
        <input type="submit" value="Edit a Product"/>
      </form>

    </div>
  </body>
</html>