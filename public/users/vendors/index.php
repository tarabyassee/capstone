<?php require_once('../../../private/initialize.php');?>
<?php $pageTitle = 'Vendors'?>

<?php include(SHARED_PATH . '/users_header.php') ?>
    <div id="content">
      <div id="menu">
        <h2> Vendor Menu</h2>
        <ul>
          <li><a href="<?php echo urlFor('/users/vendors/new.php') ?>">Enter New Products</li>
          <li><a href="<?php echo urlFor('/users/vendors/edit.php?id=' . h(u($subject['id_prod']))); ?>">Product Information</li>
          <li><a href="<?php echo urlFor('/users/vendors/show.php?id=' . h(u($subject['id_prod']))); ?>">Vendor Information</li>
        </ul>
      </div>
    </div>

<?php include(SHARED_PATH . '/users_footer.php') ?>