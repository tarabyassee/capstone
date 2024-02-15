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
    </div>

<?php include(SHARED_PATH . '/users_footer.php') ?>