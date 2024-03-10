<?php 
require_once('../../../private/initialize.php');

$pageTitle = 'Admin Menu';

require_once('../../../private/shared/usersHeader.php'); 
?>
    <div id="content">
      <h1>Admin Page</h1>
    </div>
    <?php 

  if(isset($_SESSION["loggeduserid"])) {
    echo "<h2>Hello there, " . $_SESSION["loggedusername"] . "</h2>";
    $userId = $_SESSION["loggeduserid"];
    $vendors = getAllVendors();
  } else {
    redirectTo(urlFor('../public/index.php'));
  }
  ?>
  
  <body>
    <div id="admin-content">
      <div id="menu">
        <?php 
            if($vendors) { ?> 
              <table>
                <caption>Vendor Information</caption>
                <tr>
                  <th>Vendor ID</th>
                  <th>Name</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>

                <?php foreach ($vendors as $vendor) { ?>
                  <tr>
                    <td><?php echo $vendor['id_ven']?></td>
                    <td><?php echo $vendor['vendor_name_ven']?></td>
                    <td><a class="action" href="<?php echo urlFor('/users/admins/viewVendor.php?id=' . h(u($vendor['id_ven']))); ?>">View</a></td>
                    <td><a class="action" href="<?php echo urlFor('/users/admins/editVendor.php?id=' . h(u($vendor['id_ven']))); ?>">Edit</a></td>
                    <td><a class="action" href="<?php echo urlFor('/users/admins/deleteVendor.php?id=' . h(u($vendor['id_ven']))); ?>">Delete</a></td>
                  </tr>
                <?php } ?>
              </table>
        <?php 
            } else {
              echo '<p>No vendor information found.<p>';
            }
        ?>
        

<?php include(SHARED_PATH . '/usersFooter.php') ?>
    