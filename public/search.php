<?php 
require_once('../private/initialize.php');
$pageTitle = 'User Menu';

include(SHARED_PATH . '/publicHeader.php');
?>

<main id="searchPage" role="main">
  <form id="searchForm">
    <label for="searchInput">Enter a Product:</label>
    <input type="text" list="suggestion" id="searchInput" placeholder="Enter a product name">

    <input type="submit" value="Search for Vendors" id="submitBtn">

  </form>

  <datalist id="suggestion"></datalist>

  <div id="searchVendors"></div>

</main>

<?php include(SHARED_PATH . '/publicFooter.php') ?>
