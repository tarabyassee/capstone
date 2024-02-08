<?php 
function db_connect() {
  $dbhost = 'localhost';
  $dbuser = 'foodfanatic';
  $dbpass = 'ilovefood';
  $dbname = 'avl_tailgate_market';
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  return $connection;
}

function db_disconnect($connection) {
  if(isset($connection)) {
    mysqli_close($connection);
  }
}

$db = db_connect();

function find_all_categories($db) {
  $sql = "SELECT * FROM product_category_cat";
  $result = mysqli_query($db, $sql);
  return $result;
}

$category_set = find_all_categories($db);

$categories = [];
while($category = mysqli_fetch_assoc($category_set)) {
  $categories[] = $category;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Asheville Tailgate Market</title>
  </head>
  
  <body>
    <h1>Asheville Tailgate Market</h1>
    <table border=1>
      <tr>
        <th>Category ID</th>
        <th>Category Name</th>
      </tr>
      <?php foreach($categories as $category) { ?>
        <tr>
          <td><?php echo $category['id_cat']; ?></td>
          <td><?php echo $category['product_category_name_cat']; ?></td>
        </tr>
      <?php } ?>
      </table>
  </body>
</html>

