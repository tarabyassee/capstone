<?php 
require_once('../private/initialize.php');
$pageTitle = 'User Menu';

include(SHARED_PATH . '/publicHeader.php');
?>

<main id="vendors-main" role="main">

  <label for="searchInput">Search for a Product:</label>
  <input type="text" id="searchInput" placeholder="Enter a product name">
  

  <label for="searchCategories"></label>
  <select id="searchCategories">
    <option value="1">Animal Products</option>
    <option value="2">Produce</option>
    <option value="3">Plant Starts</option>
    <option value="4">Specialty Food Items</option>
    <option value="5">Non-Food Items</option>
  </select>

  <div id="searchResultTable">
    <table>
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Vendor Name</th>
        </tr>
      </thead>
      <tbody id="results">

      </tbody>
 
    </table>
  </div>
</main>

<?php include(SHARED_PATH . '/publicFooter.php') ?>
