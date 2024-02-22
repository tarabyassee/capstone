<?php 
  require_once('../../../../private/initialize.php');
  require_once('../../../../private/fetchItems.php');

  $productId = $_GET['id'] ?? '';
  $pageTitle = "Add Product";

  include(SHARED_PATH . '/users_header.php'); 
?>

<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
    <script src="public/js/script.js" defer></script>
    <link rel="stylesheet" src="public/stylesheets/users.css">
  </head>
  
  <body> -->
    <div id="content">
      <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>

      <h1>Add Products</h1>
      <h2>Choose the category of products you wish to add:</h2>

      <!-- insert a list of checkboxes that is sorted by category -->
      <form action="/ashevilleTailgateMarket/private/fetchItems.php"  method="get" >
        <select id="categoryDropdown" name="categoryId">
          <?php 
            $categories = getCategories();
            foreach($categories as $category) {
              echo "<option value='{$category['id_cat']}'>{$category['category_name_cat']}</option>";
            }
          ?>
        </select>
        <div id="checkboxContainer">
          
        </div>
        <input type="submit" value="See Products">
      </form>



    </div>
  </body>
</html>