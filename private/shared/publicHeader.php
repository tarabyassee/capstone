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
  <script src="<?php echo urlFor($jsFile)?>" defer></script>

</head>

<body>
  <div id="wrapper">
    <header role="banner">
      <img id="logo" src="<?php echo urlFor('/images/avlTM100.png') ?>" alt="logo" width="161" height="177">
    </header>
    <nav role="navigation" class="items">
      <input type="checkbox" id="menu-checkbox">
      <label for="menu-checkbox" id="menu-trigger">&#9776;</label>
      <div id="menus">
        <div id="userMenu">
          <ul>
            <?php
            if (isset($_SESSION["loggedusername"])) {
              echo "<li><a href='" . urlFor('/users/vendors/index.php') . "'>Profile</a></li>";
              echo "<li><a href='" . urlFor('../private/processLogout.php') . "'>Logout</a></li>";
            } else {
              echo "<li><a href='" . urlFor('/users/login.php') . "'>Login</a></li>";
              echo "<li><a href='" . urlFor('/users/signup.php') . "'>Sign Up</a></li>";
            }
            ?>
          </ul>
        </div>
        <div id="menu">
          <ul>
            <li><a href="<?php echo urlFor('index.php') ?>">Home</a></li>
            <li><a href="<?php echo urlFor('search.php') ?>">Search</a></li>
            <li><a href="<?php echo urlFor('vendors.php') ?>">Vendors</a></li>
            <li><a href="<?php echo urlFor('contact.html') ?>">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var menuCheckbox = document.getElementById('menu-checkbox');
    var userMenu = document.getElementById('userMenu');
    var menu = document.getElementById('menu');
    menuCheckbox.addEventListener('change', function() {
      if (menuCheckbox.checked) {
        userMenu.style.display = 'block';
        menu.style.display = 'block';
      } else {
        userMenu.style.display = 'none';
        menu.style.display = 'none';
      }
    });
  });

</script>
