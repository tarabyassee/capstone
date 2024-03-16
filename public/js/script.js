'use strict';

document.addEventListener("DOMContentLoaded", function() {
  var searchProductsInput = document.getElementById("searchInput");
  var suggestionsContainer = document.getElementById("suggestions");
  var minLength = 3;

  searchProductsInput.addEventListener('input', async function() {
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
  });

async function fetchProductSuggestions(searchTerm) {
  var url = "http://localhost/ashevilleTailgateMarket/private/fetchSearchTerm.php";
  var response = await fetch(`${url}?searchTerm=${encodeURIComponent(searchTerm)}`)
  if (!response.ok) {
    throw new Error('Failed to fetch product suggestions');
  }
  return await response.json();
}

function displaySuggestions(suggestions) {
  suggestionsContainer.innerHTML = "";

  suggestions.forEach(function(suggestion) {
      var suggestionElement = document.createElement("div");
      suggestionElement.textContent = suggestion.product_name_prod;
      suggestionElement.addEventListener('click', function() {
      searchProductsInput.value = suggestion.product_name_prod;
      clearSuggestions();
      });
      suggestionsContainer.appendChild(suggestionElement);
    });
  }

  function clearSuggestions() {
    suggestionsContainer.innerHTML = "";
  }
})