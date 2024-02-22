'use strict';

document.getElementById('categoryDropdown').addEventListener('change', function() {
  var categoryId = this.value;
  fetchProducts(categoryId);
});

function fetchProducts(categoryId) {
  fetch('fetch_products.php?category_id=' + categoryId)
  var products = [];
  renderCheckboxes(products);
}