<?php 
  require_once('../../../private/initialize.php');
  $pageTitle = 'Vendors';
  include(SHARED_PATH . '/usersHeader.php');

  if(isset($_SESSION["loggeduserid"])) {
    echo "<h1>Hello there, " . $_SESSION["loggedusername"] . "</h1>";
    $userId = $_SESSION["loggeduserid"];

    $vendorIdSet = getVendorId($userId);
    $vendorId = $vendorIdSet['id_ven'];

    $vendorInfo = getVendorInformation($vendorId);
    $products = findAllProductsByVendorId($vendorId);
  } else {
    redirectTo(urlFor('/index.php'));
  }
  
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
        <?php 
            if($vendorInfo) { ?> 
              <table>
                <caption>Vendor Information</caption>
                <tr>
                  <th>Vendor ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Stall Number</th>
                  <th>Edit</th>
                  <th>&nbsp</th>
                </tr>

                <tr>
                  <td><?php echo $vendorInfo['id_ven']?></td>
                  <td><?php echo $vendorInfo['vendor_name_ven']?></td>
                  <td><?php echo $vendorInfo['vendor_description_ven']?></td>
                  <td><?php echo $vendorInfo['stall_number_ven']?></td>
                  <td><a class="action" href="<?php echo urlFor('/users/vendors/vendorEdit.php?id=' . h(u($vendorInfo['id_ven']))); ?>">Edit</a></td>
                </tr>
              </table>
        <?php 
            } else {
              echo '<p>No vendor information found for this user.<p>';
            }
        ?>
        <table>
          <caption>Product Information</caption>
          <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>View</th>
            <th>Delete</th>
          </tr>

          <?php 
            if(!empty($products)) { 
              foreach($products as $product) { ?>
                <tr>
                  <td><?php echo $product['id_prod']?></td>
                  <td><?php echo $product['product_name_prod']?></td>
                  <td><?php echo $product['category_name_cat']?></td>
                  <td><a class="action" href="<?php echo urlFor('/users/vendors/products/show.php?id=' . h(u($product['id_prod']))); ?>">View</a></td>
                  <td><a class="action" href="<?php echo urlFor('/users/vendors/products/delete.php?id_prod=' . h(u($product['id_prod'])) . 'id_ven=' . h(u($vendorId))); ?>">Delete</a></td>
                </tr>

          <?php 
              }
            } else {
                echo '<p>No products found for this vendor<p>';
              } 
          ?>
        </table>
        
      </div>
    </div>

<?php include(SHARED_PATH . '/usersFooter.php') ?>