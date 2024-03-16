'use strict';

document.addEventListener("DOMContentLoaded", function() {
  var searchProductsInput = document.getElementById("searchInput");
  var suggestionContainer = document.getElementById("suggestion");
  var minLength = 3;

  searchProductsInput.addEventListener('input', handleInput);
  suggestionContainer.addEventListener('click', handleSuggestionClick);

  async function handleInput() {
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

  async function handleSuggestionClick(event) {
    var suggestion = event.target;
    if(!suggestionContainer.contains(suggestion)) return;
    searchProductsInput.value = suggestion.textContent;
    clearSuggestions();
    
    try {
      var vendors = await fetchVendorsByProductName(suggestion.textContent);
      console.log(vendors);
    } catch (error) {
      console.error('error fetching vendors', error)
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
  async function fetchVendorsByProductName(productName) {
    try {
    var url = "http://localhost/ashevilleTailgateMarket/private/fetch.php";
    var response = await fetch(`${url}?productName=${encodeURIComponent(productName)}`);
    if (!response.ok) {
        throw new Error('Failed to fetch vendors');
      }
      return await response.json();
    } catch(error) {
      throw new Error('error fetching vendors: '+ error.message);
    }
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