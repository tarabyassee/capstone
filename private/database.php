<?php

require_once('dbCredentials.php');

function dbConnect() {
  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  return $connection;
}

function dbDisconnect($connection) {
  if(isset($connection)) {
    mysqli_close($connection);
  }
}

function dbEscape($connection, $string) {
  return mysqli_real_escape_string($connection, $string);
}

function confirmResultSet($resultSet) {
  if (!$resultSet) {
    exit("Database query failed.");
  }
}

?>