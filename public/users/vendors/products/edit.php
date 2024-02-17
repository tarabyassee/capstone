<?php 
  require_once('../../../private/initialize.php');

  $test = $_GET['test'] ?? '';

  if($test == '404') {
    error_404();
  } elseif($test == '500') {
    error_500();
  } elseif($test == 'redirect') {
    redirectTo(urlFor('/users/vendors/index.php'));
  } 

  $pageTitle = "Edit Products";

  $ven_id = $_GET['id_ven'] ?? '1';

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