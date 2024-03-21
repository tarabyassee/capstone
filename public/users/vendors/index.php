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
    echo "<p id='vendorRedirect'>Please sign up to be a vendor.</p>";
    redirectTo(urlFor('/index.php'));
  }
  ?>

    <div id="content">
      <div id="menu">
        <h2> Vendor Menu</h2>
        <?php 
            if($vendorInfo) { ?>
              <div id="vendorCard">
                <h3>Vendor Name: <?php echo $vendorInfo['vendor_name_ven']?></h3>
                <p>Description: <?php echo $vendorInfo['vendor_description_ven']?></p>
                <p>Stall Number: <?php echo $vendorInfo['stall_number_ven']?></p>
                <div>
                  <a class="action" href="<?php echo urlFor('/users/vendors/vendorEdit.php?id=' . h(u($vendorInfo['id_ven']))); ?>">Edit</a>
                </div> 
              </div>
        <?php 
            } else {
              echo '<p>No vendor information found for this user.<p>';
            }
        ?>
        <h2>Products</h2>
        <div id="productCard">
          <?php 
            if($products) { 
              foreach($products as $product) { ?>
                <div id="products">
                  <h3>Product Name: <?php echo $product['product_name_prod']?></h3>
                  <p>Product Category: <?php echo $product['category_name_cat']?></p>
                  <div>
                    <a class="action" href="<?php echo urlFor('/users/vendors/products/     delete.php?id_prod=' . h(u($product['id_prod'])) . '&id_ven=' . h(u      ($vendorId))); ?>">Delete</a>
                  </div>
                </div>
            <?php
              }
            ?>
        </div>
            <?php 
              } else {
              echo '<p>No product information found for this vendor.<p>';
              }
            ?> 
  
        
      </div>
    </div>

<?php include(SHARED_PATH . '/usersFooter.php') ?>