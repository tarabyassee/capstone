'use strict';

document.addEventListener("DOMContentLoaded", function(){
  document.getElementById("searchCategories").addEventListener('change', async function() {
    var categoryId = this.value;
    try {
      var products = await fetchProducts(categoryId);
      displayProducts(products);
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  });

  async function fetchProducts(categoryId) {
    var url = "http://localhost/ashevilleTailgateMarket/private/fetchProducts.php";
    var response = await fetch(`${url}?categoryId=${encodeURIComponent(categoryId)}`)
    if (!response.ok) {
      throw new Error('Failed to fetch products');
    }
    return await response.json();
  };

  function displayProducts(products) {
    var resultsTable = document.getElementById("results");
    resultsTable.innerHTML = '';

    products.forEach(function(product) {
      var row = document.createElement("tr");
      var productNameCell = document.createElement("td");

      productNameCell.textContent = product.product_name_prod;

      row.appendChild(productNameCell);

      resultsTable.appendChild(row);
    })

  }

})