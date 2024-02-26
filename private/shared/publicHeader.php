<?php
if(!isset($pageTitle)) {$pageTitle = 'AAA';} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('stylesheets/styles.css') ?>">
    <script src="https://kit.fontawesome.com/0a06179f50.js" crossorigin="anonymous"></script>
    <script src="<?php echo urlFor('js/script.js')?>" defer></script>
  </head>
  
  <body>
    <header>
      <img id="logo" src="<?php echo urlFor('/images/avlTM100.png')?>">
    </header>
    <div class="sidenav">
      <input class="clicker" type="image" src="images/hamburgerMenu.png" value="Menu" width="100" height="100">
      <nav role="navigation" class="items">
        <ul>
          <li><a href="<?php echo urlFor('/users/login.php'); ?>">Login</a></li>
          <li><a href="<?php echo urlFor('/users/Apply.php'); ?>">Apply</a></li>
          <li><a href="">Home</a></li>
          <li><a href="search.html">Search</a></li>
          <li><a href="vendors.html">Vendors</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
    <div id="wrapper">