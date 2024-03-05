<?php
session_start();
if (!isset($pageTitle)) {
  $pageTitle = 'AAA';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?></title>
  <link rel="stylesheet" media="all" href="<?php echo urlFor('stylesheets/styles.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/0a06179f50.js" crossorigin="anonymous"></script>

</head>

<body>
  <div id="wrapper">
    <header role="banner">
      <img id="logo" src="<?php echo urlFor('/images/avlTM100.png') ?>">
    </header>
    <nav role="navigation" class="items">
      <ul id="navbar">
        <div id="userMenu">
        <?php
          if (isset($_SESSION["loggedusername"])) {
            echo "<li><a href='" . urlFor('/users/profile.php') . "'>Profile</a></li>";
            echo "<li><a href='" . urlFor('/users/logout.php') . "'>Logout</a></li>";
          } else {
            echo "<li><a href='" . urlFor('/users/login.php') . "'>Login</a></li>";
            echo "<li><a href='" . urlFor('/users/signup.php') . "'>Sign Up</a></li>";
          }
          ?>
        </div>
        <div id="menu">
          <li><a href="">Home</a></li>
          <li><a href="search.html">Search</a></li>
          <li><a href="vendors.html">Vendors</a></li>
          <li><a href="contact.html">Contact</a></li>
        </div>
      </ul>
    </nav>

  </div>