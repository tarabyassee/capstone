<?php 
  require_once('../../../../private/initialize.php');
  $jsFile = 'js/newScript.js';
  include_once(SHARED_PATH . '/usersHeader.php');

  $pageTitle = "Add Product";

  if(isset($_SESSION["loggeduserid"])) {
    echo "<h1>Hello there, " . $_SESSION["loggedusername"] . "</h1>";
    $userId = $_SESSION["loggeduserid"];
    $vendorIdSet = getVendorId($userId);
    $_SESSION["vendorId"] = $vendorIdSet['id_ven'];
    echo "<p>Vendor id is: " . $_SESSION["vendorId"] . "</p>";
  } else {
    echo "<p id='vendorRedirect'>Please sign up to be a vendor.</p>";
    redirectTo(urlFor('/index.php'));
  }
  ?>

<div id="content">
  <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>
  
  <h1>Add Product</h1>
  <h2>Choose the category of products you wish to add:</h2>
  
  <form id="categoryForm" method="get">
    <label for="categoryId">Select a Category</label>
    <select id="categoryId" name="categoryId">
      <option value="1">Animal</option>
      <option value="2">Produce</option>
      <option value="3">Plant Starts</option>
      <option value="4">Specialty Prepared Foods</option>
      <option value="5">Non-Food Items</option>
    </select>
    <input type="submit" id="fetchProductsBtn" value="Get products">
  </form>
  
  <section id="productSection">
    <form id="productForm">
    </form>
  </section>

</div>
<?php include(SHARED_PATH . '/usersFooter.php'); ?>