<?php
  require_once('../../../../private/initialize.php');
  
  if(!isset($_GET['id_prod']) || !isset($_GET['id_ven'])) {
    redirectTo(urlFor('/users/vendors/index.php'));
  }
  
  $id = filter_input(INPUT_GET, 'id_prod', FILTER_SANITIZE_NUMBER_INT);
  $id_ven = filter_input(INPUT_GET, 'id_ven', FILTER_SANITIZE_NUMBER_INT);
  
  $deletedProduct = deleteProductFromVendor($id, $id_ven);
  
  if(isPostRequest()) {
    
  }
  
  include(SHARED_PATH . '/usersHeader.php');
  
  $pageTitle = "Delete Vendor's Product";
?>
<div id="content">
  <a class="back-link" href="<?php echo urlFor('/users/vendors/index.php'); ?>"> Back to Vendor</a>

  <div class="vendor product delete">
    <h2>Delete Vendor's Product</h2>
    <p>Are you sure you want to delete this product from your list?</p>
    <?php 
    $product = findProductsById($id);
    echo $product['product_name_prod'];
    ?>
  </div>
</div>

include(SHARED_PATH . '/usersFooter.php');

