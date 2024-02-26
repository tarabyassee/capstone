'use strict';

const clicker = document.querySelector(".clicker");
clicker.addEventListener("click", (e) => {
  e.stopPropagation();
  document.body.classList.toggle("active")
});

const menuItems = document.querySelectorAll(".items a");
menuItems.forEach(item => {
  item.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
  });
});

document.getElementById('categoryDropdown').addEventListener('change', function() {
  var categoryId = this.value;
  fetchProducts(categoryId);
});

function fetchProducts(categoryId) {
  fetch('fetch_products.php?category_id=' + categoryId)
  var products = [];
  renderCheckboxes(products);
}

