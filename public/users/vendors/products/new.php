<?php 
  require_once('../../../private/initialize.php');

  $productId = $_GET['id'] ?? '';
  $pageTitle = "New Product";

  include(SHARED_PATH . '/users_header.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
  </head>
  
  <body>
    <div id="content">
      <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>

      <h1>Add Products</h1>
      <h2>Vendor Name</h2>
      <form action="" method="post">
        <dl>
          <dt>Product Name</dt>
          <dd><input type="text" name="productName" value=""></dd>
        </dl>
        <dl>
          <dt>Category</dt>
          <dd>
            <select name="category">
              <option value="animal">Animal</option>
            </select>
          </dd>
        </dl>
        <input type="submit" value="Add a Product"/>
      </form>

    </div>
  </body>
</html>