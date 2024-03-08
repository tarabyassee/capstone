<?php
require_once('initialize.php');

if(isset($_POST["submit"])) {

    $username = $_POST["username"];
    $pwd = $_POST['pwd'];

  loginUser($db, $username, $pwd);
  } 
else {
    redirectTo(urlFor('login.php'));
  }
