<?php 
  $vendorId = $_GET['id'];
  require_once('../../../private/initialize.php');
  $pageTitle = 'Edit Vendor Information';
  include(SHARED_PATH . '/users_header.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
  </head>
  
  <body>
    <div id="form-content">
    <a class="back-link" href="<?php echo urlFor('/users/vendors/index.php'); ?>">&laquo; Back to Vendor Main Menu</a>
    <form action="" method="post">
      <input type="text" name="vendor-name" value="">
      <label for="vendor-name"></label>
      <input type="submit" value="Edit Vendor">
    </form>

    </div>
    
  </body>
</html>