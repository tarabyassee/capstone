<?php 
require_once('../private/initialize.php');
$pageTitle = 'User Menu';

include(SHARED_PATH . '/publicHeader.php');
?>

<main id="vendors-main" role="main">

  <label for="searchInput">Search for a Product:</label>
  <input type="text" id="searchInput" placeholder="Enter a product name">

  <div id="suggestions"></div>

</main>

<?php include(SHARED_PATH . '/publicFooter.php') ?>
