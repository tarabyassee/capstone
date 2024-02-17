<?php require_once('../../private/initialize.php');?>
<?php $pageTitle = 'User Menu'?>

<?php include(SHARED_PATH . '/users_header.php') ?>
    <div id="content">
      <div id="menu">
        <h2>Menu</h2>
        <ul>
          <li><a href="admins/index.php">Administrators</li>
          <li><a href="vendors/index.php">Vendors</li>
        </ul>
      </div>

      <table border=1>
      <caption>Products</caption>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Category Name</th>
      </tr>
      <?php foreach($categories as $category) { ?>
        <tr>
          <td><?php echo $category['id_cat']; ?></td>
          <td><?php echo $category['category_name_cat']; ?></td>
        </tr>
      <?php } ?>
      </table>
    </div>

<?php include(SHARED_PATH . '/users_footer.php') ?>