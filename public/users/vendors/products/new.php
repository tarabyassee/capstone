<?php 
  require_once('../../../../private/initialize.php');
  require_once('../../../../private/fetchItems.php');

  $pageTitle = "Add Product";

  include(SHARED_PATH . '/usersHeader.php'); 
  ?>

<div id="content">
  <a class="backlink" href="<?php echo urlFor('/users/vendors/index.php');?>">&laquo; Back to List</a>
  
  <h1>Add Product</h1>
  <h2>Choose the category of products you wish to add:</h2>
  
  <form action="<?php echo urlFor('users/vendors/products/create.php');?>" method="post">
    <select id="categoryDropdown" name="categoryId">
      <?php 
            $categories = getCategories();
            echo "<option value='' disabled selected>Choose a category:</option>";
            foreach($categories as $category) {
              echo "<option value='{$category['id_cat']}'>{$category['category_name_cat']}</option>";
            }
      ?>
    </select>
    <dl>
      <dt>Product Name</dt>
      <dd><input type="text" name="productName" value=""></dd>
    </dl>
    <dl>
      <dt></dt>
    </dl>
      
        <input type="submit" value="Add product">
  </form>
</div>
  </body>
</html>