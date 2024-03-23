'use strict';
document.addEventListener('DOMContentLoaded', function() {
  var categoryForm = document.getElementById('categoryForm');
  var productForm = document.getElementById('productForm');


  categoryForm.addEventListener('submit', handleSubmit);


  async function handleSubmit(event) {
    event.preventDefault();
    try {
      const categoryId = document.getElementById('categoryId').value;
      var products = await fetchProducts(categoryId);
      displayProducts(products);
    } catch (error) {
      console.error('error fetching products (this is the catch)', error);
    }
  }

  async function fetchProducts(categoryId) {
    var url = "http://localhost/ashevilleTailgateMarket/private/fetchProducts.php";
    var response = await fetch(`${url}?categoryId=${encodeURIComponent(categoryId)}`)
      if (!response.ok) {
        throw new Error('Failed to fetch products');
      }
      var products = await response.json();
      return products;
  }

  function displayProducts(products) {
    console.log("Displaying products:", products);
    productForm.innerHTML = '';
    products.forEach(product => {
      var checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.value = product.id_prod;
      checkbox.id = product.id_prod;
      var label = document.createElement('label');
      label.textContent = product.product_name_prod;
      label.htmlFor = checkbox.id;
      productForm.appendChild(checkbox);
      productForm.appendChild(label);
      productForm.appendChild(document.createElement('br'));
    });
    var inputBtn = document.createElement('input');
    inputBtn.type = 'submit';
    inputBtn.id = 'submitProductsVendor';
    inputBtn.value = 'Add Products';
    productForm.appendChild(inputBtn);
  }


  productForm.addEventListener('submit', submitProducts)
  async function submitProducts(event) {
    event.preventDefault();

    var selectedProducts = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
    var url = "http://localhost/ashevilleTailgateMarket/private/submitProducts.php";

    try {
      const response = await fetch(`${url}`, { 
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ productIds: selectedProducts })
      });

      if (!response.ok) {
          throw new Error('Failed to submit products');
      }

      console.log('Products submitted successfully');

    } catch (error) {
      console.error('Error submitting products:', error);
      }
  }

  }
)
