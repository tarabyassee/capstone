<?php 
  require_once('../../../private/initialize.php');
  $pageTitle = 'Vendors';
  include(SHARED_PATH . '/users_header.php');

  $ven_id = $_GET['id_ven'] ?? '2';
  $vendor = getVendorInformation($ven_id);
  $productSet = findAllProductsByVendorId($ven_id);
?>


<?php ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="../../stylesheets/users.css" rel="stylesheet">
  </head>
  
  <body>
  <div id="content">
    <div id="menu">
      <h2> Vendor Menu</h2>
      <table>
        <caption>Vendor Information</caption>
        <tr>
          <th>Vendor ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Stall Number</th>
          <th>&nbsp</th>
          
        </tr>
        
        <tr>
          <td><?php echo $vendor['id_ven']?></td>
          <td><?php echo $vendor['vendor_name_ven']?></td>
          <td><?php echo $vendor['vendor_description_ven']?></td>
          <td><?php echo $vendor['vendor_address_ven']?></td>
          <td><?php echo $vendor['vendor_city_ven']?></td>
          <td><?php echo $vendor['name_sta']?></td>
          <td><?php echo $vendor['stall_number_ven']?></td>
          <td><a class="action" href="<?php echo urlFor('/users/vendors/vendorEdit.php?id=' . h(u($vendor['id_ven']))); ?>">Edit</a></td>
        </tr>
      </table>
      
      <table>
        <caption>Product Information</caption>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Category</th>
        </tr>
        <a href="products/new.php">Add a new product</a>
        <?php foreach($productSet as $product) { ?>
          <tr>
            <td><?php echo $product['id_prod']?></td>
            <td><?php echo $product['product_name_prod']?></td>
            <td><?php echo $product['category_name_cat']?></td>
          </tr>
          <?php } ?>
        </table>
        <ul>
          <li><a href="<?php echo urlFor('/users/vendors/new.php') ?>">Enter New Products</li>
          <li><a href="<?php echo urlFor('/users/vendors/edit.php?id=' . h(u($product['id_prod']))); ?>">Product Information</li>
          <li><a href="<?php echo urlFor('/users/vendors/show.php?id=' . h(u($product['id_prod']))); ?>">Vendor Information</li>
        </ul>
      </div>
    </div>
  </body>
</html>
<?php include(SHARED_PATH . '/users_footer.php') ?>