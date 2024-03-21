'use strict';

document.addEventListener("DOMContentLoaded", function() {
  var searchProductsInput = document.getElementById("searchInput");
  var suggestionContainer = document.getElementById("suggestion");
  var searchForm = document.getElementById("searchForm");
  var searchVendors = document.getElementById("searchVendors");

  searchProductsInput.addEventListener('input', handleInput);
  searchForm.addEventListener('submit', handleSubmit);

  async function handleInput() {
    console.log('handleinput triggered');
    var searchTerm = this.value.trim();
    if (searchTerm.length === 0) {
      clearSuggestions();
      return;
    }
    try {
      var suggestions = await fetchProductSuggestions(searchTerm);
      displaySuggestions(suggestions);
    } catch(error) {
      console.error('error fetching product suggestions', error);
    }
  }
  
  async function fetchProductSuggestions(searchTerm) {
    var url = "http://localhost/ashevilleTailgateMarket/private/fetchSearchTerm.php";
    var response = await fetch(`${url}?searchTerm=${encodeURIComponent(searchTerm)}`)
    if (!response.ok) {
      throw new Error('Failed to fetch product suggestions');
    }
    return await response.json();
  }

  function handleSubmit(event) {
    event.preventDefault();
    var productName = document.getElementById("searchInput").value.trim();
    if (productName.length === 0) {
      console.error('Product name cannot be empty');
      return;
    }
    fetchVendors(productName);
  }

  async function fetchVendors(productName) {
    console.log('fetch vendors called with product name');
    var url = "http://localhost/ashevilleTailgateMarket/private/fetchVendors.php";
    var fullUrl = `${url}?productName=${encodeURIComponent(productName)}`;

    try {
      var response = await fetch(fullUrl);
      if (!response.ok) {
        throw new Error('failed to fetch vendors');
      }
      var vendors = await response.json();
      displayVendors(vendors);
    } catch(error) {
      console.error('error fetching vendors (this is the catch)', error);
    }
  }

  function displayVendors(vendors) {
    searchVendors.innerHTML="";
    vendors.forEach(function(vendor) {
      var vendorDiv = document.createElement("div");
      vendorDiv.textContent = vendor.vendor_name_ven;
      searchVendors.appendChild(vendorDiv);
    });
  }

  function displaySuggestions(suggestions) {
    suggestionContainer.innerHTML = "";
    suggestions.forEach(function(suggestion) {
      var option = document.createElement("option");
      option.value = suggestion.product_name_prod;
      option.textContent = suggestion.product_name_prod;
      suggestionContainer.appendChild(option);
    });
  }

  function clearSuggestions() {
    suggestionContainer.innerHTML = "";
  }
});