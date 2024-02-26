<?php
  if(isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $phonetype = $_POST["phonetype"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'initialize.php';
    require_once 'validationFunctions.php';

    if (invalidUsername($username) !== false) {
      header("Location: ../public/users/signup.php?error=invalidUsername");
      exit();
    }

    if (invalidEmail($email) !== false) {
      header("Location: ../public/users/signup.php?error=invalidEmail");
      exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
      header("Location: ../public/users/signup.php?error=nomatch");
      exit();
    }
    if (usernameExists($conn, $username, $email) !== false) {
      header("Location: ../public/users/signup.php?error=usernameTaken");
      exit();
    }

    createUser($conn, $fname, $lname, $phone, $phonetype, $email, $username, $pwd, $pwdRepeat);


  } else {
    header("Location: ../public/index.php");
    exit();
  }