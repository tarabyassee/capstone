<?php
  require_once('initialize.php');

  if(isset($_POST["submit"])) {

    $username = $_POST["username"];
    $pwd = $_POST['pwd'];

  if (emptyInputLogin($username, $pwd) !== false) {
    header("Location: ../public/users/login.php?error=emptyInput");
    exit();
  }

  loginUser($db,$username, $pwd);
  } 
  else {
    header("Location: ../public/users/login.php");
    exit();
  }
