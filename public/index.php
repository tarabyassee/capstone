<?php 
#dbhost = 'localhost';
#dbuser = 'utco4gqngodjp';
#dbpass = 'ilovefood';
#dbname = 'dbokjjlxzzmhf6';

function dbConnect() {
  $dbhost = 'localhost';
  $dbuser = 'foodfanatic';
  $dbpass = 'ilovefood';
  $dbname = 'avl_tailgate_market';
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  return $connection;
}

function dbDisconnect($connection) {
  if(isset($connection)) {
    mysqli_close($connection);
  }
}

$db = dbConnect();

function findAllCategories($db) {
  $sql = "SELECT * FROM product_category_cat";
  $result = mysqli_query($db, $sql);
  return $result;
}

$categorySet = findAllCategories($db);

$categories = [];
while($category = mysqli_fetch_assoc($categorySet)) {
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
      <caption>Data from product_category_name</caption>
      <tr>
        <th>Category ID</th>
        <th>Category Name</th>
      </tr>
      <?php foreach($categories as $category) { ?>
        <tr>
          <td><?php echo $category['id_cat']; ?></td>
          <td><?php echo $category['category_name_cat']; ?></td>
        </tr>
      <?php } ?>
      </table>
  </body>
</html>
