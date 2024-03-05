'use strict';

alert();
document.addEventListener('DOMContentLoaded', () => {

  async function fetchCategories() {
    try {
      const response = await fetch("categories.php")
      .then(response => response.text())
      .then(data => {
        document.getElementById("categoryDropdown").innerHTML = data;
      })
      .catch(error => console.error(error));
  }}

  const selectElement = document.getElementById("categoryDropdown");
  const checkboxContainer = document.getElementById("checkboxContainer");

  selectElement.addEventListener("change", function() {
    const selectedCategory = this.value;
    fetchProducts(selectedCategory);
  });

  function fetchProducts(categoryId) {
    checkboxContainer.innerHTML = "";
    fetch("products.php?category=" + categoryId)
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          console.error("Error fetching categories", response.statusText);
        }
      })
      .then(data => {
        data.forEach(product => {
          const checkboxLabel = document.createElement("label");
          checkboxLabel.classList.add("checkbox-label");
          checkboxLabel.textContent = product.name;

          const checkboxInput = document.createElement("input");
          checkboxInput.type = "checkbox";
          checkboxInput.name = "products[]";
          checkboxInput.value = product.id;

          checkboxContainer.appendChild(checkboxLabel);
          checkboxContainer.appendChild(checkboxInput);
          checkboxContainer.appendChild(document.createElement("br"));
        });
      })
      .catch(error => console.error(error));
  }
})
