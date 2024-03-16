<?php 
  require_once('initialize.php');

  if(isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
    $suggestionsSet = getProductSuggestions($searchTerm);

    header('Content-Type: application/json');
    echo json_encode($suggestionsSet);
  } else {
    http_response_code(400);
    echo json_encode(array("error" => "search term is required"));
    }

?>