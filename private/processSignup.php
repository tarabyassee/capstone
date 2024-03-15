<?php
  require_once('initialize.php');

  if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $phonetype = $_POST['phonetype'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

    $errors = [];

    if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
      $errors[] = "All fields are required";
    }

    if (invalidUsername($username)) {
      $errors[] = "Invalid username";
    }

    if (invalidEmail($email)) {
      $errors[] = "Invalid email";
    }

    if (pwdMatch($pwd, $pwdRepeat)) {
      $errors[] = "Passwords don't match.";
    }

    if (usernameExists($db, $username, $email)) {
      $errors[] = "Username is taken. Choose another.";
    }

    if (!empty($errors)) {
      $errorMessage = implode(",", $errors);
      header("Location: ../public/users/signup.php?error=$errorMessage");
    } else {
      createUser($db, $fname, $lname, $phone, $phonetype, $email, $username, $pwd, $pwdRepeat);
    }

  } else {
    header("Location: ../public/index.php");
    exit();
  }