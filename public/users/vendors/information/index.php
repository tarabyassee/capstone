<?php 

require_once('../../../../private/initialize.php');
$pageTitle = "Vendor Information";
$id_user = $_GET['id_usr'] ?? '1';


$user = getUserVendorInformation($id_user);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
  </head>
  
  <body>
  <table border=1>
      <caption>Products</caption>
      <tr>
        <th>Vendor Id ID</th>
        <th>User First Name</th>
        <th>Vendor Name</th>
      </tr>

        <tr>
          <td><?php echo $user['id_ven']; ?></td>
          <td><?php echo $user['first_name_usr']; ?></td>
          <td><?php echo $user['vendor_name_ven']; ?></td>
        </tr>

      </table>
    </div>
  </body>
</html>