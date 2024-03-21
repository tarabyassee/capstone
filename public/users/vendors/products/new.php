<?php 
  require_once('../../../../private/initialize.php');
  require_once('../../../../private/fetchItems.php');
  include_once(SHARED_PATH . '/usersHeader.php');

  $pageTitle = "Add Product";

  if(isset($_SESSION["loggeduserid"])) {
    echo "<h1>Hello there, " . $_SESSION["loggedusername"] . "</h1>";
    $userId = $_SESSION["loggeduserid"];
    $vendorIdSet = getVendorId($userId);
    $vendorId = $vendorIdSet['id_ven'];

    if(isset($_session['productSet'])) {
      $productSet = $_SESSION['productSet'];
    }

  } else {
    echo "<p id='vendorRedirect'>Please sign up to be a vendor.</p>";
    redirectTo(urlFor('/index.php'));
  }



  ?>

<div id="content">
  <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>
  
  <h1>Add Product</h1>
  <h2>Choose the category of products you wish to add:</h2>
  
  <form action="<?php echo urlFor('../private/fetchProducts.php');?>" method="post">
    <label for="category">Select a Category</label>
    <select id="categoryDropdown" name="categoryId">
      <option value="1">Animal</option>
      <option value="2">Produce</option>
      <option value="3">Plant Starts</option>
      <option value="4">Specialty Prepared Foods</option>
      <option value="5">Non-Food Items</option>
    </select>

    <input type="submit" value="Get products">
  </form>

  <?php 

  ?>
</div>
<?php include(SHARED_PATH . '/usersFooter.php'); ?>