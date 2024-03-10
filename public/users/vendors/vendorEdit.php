<?php 
  require_once('../../../private/initialize.php');

  include(SHARED_PATH . '/usersHeader.php');

  if(!isset($_GET['id'])) {
    redirectTo(urlFor('/users/vendors/index.php'));
  }

  $pageTitle = "Edit Vendor";

  $vendorId = $_GET['id'];
  
  if(isPostRequest()) {
    updateVendor($vendorId);
  } else {
    $vendor = getVendorInformation($vendorId);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit Vendor</title>
  </head>
  
  <body>
    <div id="content">
      <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>

      <h1>Edit Vendor</h1>
      <h2>Vendor Name</h2>
      <form action="<?php echo urlFor('/users/vendors/vendorEdit.php?id=' . h(u($vendorId))); ?>" method="post">
        <label for="vendor_name_ven">Vendor Name</label>
        <input type="text" name="vendor_name_ven" value="<?php echo h($vendor['vendor_name_ven']); ?>">

        <label for="vendor_description_ven">Vendor Description</label>
        <input type="textarea" name="vendor_description_ven" value="<?php echo h($vendor['vendor_description_ven']); ?>">

        <label for="stall_number_ven">Stall Number</label>
        <input type="text" name="stall_number_ven" value="<?php echo h($vendor['stall_number_ven']); ?>">

        <input type="submit" value="Edit Vendor"/>
      </form>

    </div>
<?php   include(SHARED_PATH . '/usersFooter.php'); ?>