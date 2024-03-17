'use strict';

document.addEventListener("DOMContentLoaded", function() {
  var searchProductsInput = document.getElementById("searchInput");
  var suggestionContainer = document.getElementById("suggestion");
  var minLength = 3;
  var searchForm = document.getElementById("searchForm");
  var searchVendors = document.getElementById("searchVendors");

  searchProductsInput.addEventListener('input', handleInput);
  suggestionContainer.addEventListener('click', handleSuggestionClick);
  searchForm.addEventListener('submit', handleSubmit);

  async function handleInput() {
    console.log('handleinput triggered');
    var searchTerm = this.value.trim();
    if (searchTerm.length < minLength) {
      clearSuggestions();
      return;
    }
    if (!/^[a-zA-Z]+$/.test(searchTerm)) {
      console.error('search term must contain only letters');
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

  async function handleSuggestionClick(event) {
    event.preventDefault();
    var suggestion = event.target;
    if(!suggestionContainer.contains(suggestion)) return;
    searchProductsInput.value = suggestion.textContent;
    clearSuggestions();
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
      var suggestionElement = document.createElement("div");
      suggestionElement.textContent = suggestion.product_name_prod;
      suggestionElement.addEventListener('click', function() {
        searchProductsInput.value = suggestion.product_name_prod;
        clearSuggestions();
      });
      suggestionContainer.appendChild(suggestionElement);
    });
  }
  function clearSuggestions() {
    suggestionContainer.innerHTML = "";
  }
});