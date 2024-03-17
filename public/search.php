<?php 
require_once('../private/initialize.php');
$pageTitle = 'User Menu';

include(SHARED_PATH . '/publicHeader.php');
?>

<main id="vendors-main" role="main">
  <form id="searchForm">
    <label for="searchInput">Enter a Product:</label>
    <input type="text" id="searchInput" placeholder="Enter a product name">

    <input type="submit" value="Search for Vendors" id="submitBtn">

  </form>

  <div id="suggestion"></div>

  <div id="searchVendors"></div>

  <div id="searchVendorsContainer" class="vendor-list"></div>

</main>

<?php include(SHARED_PATH . '/publicFooter.php') ?>
