<?php
session_start();
  if(!isset($pageTitle)) {$pageTitle = 'User';} 

?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('stylesheets/users.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a06179f50.js" crossorigin="anonymous"></script>

  </head>

  <body>
    <div id="wrapper">
      <header role="banner">
        <img id="logo" src="<?php echo urlFor('/images/avlTmLogo160.png') ?>">
      </header>
      <nav role="navigation" id="usersNavigation">
        <ul id="userMenuLoggedIn">
          <?php
            if (isset($_SESSION["loggedusername"])) {
              echo "<li><a href='" . urlFor('/users/vendors/index.php') . "'>Profile</a></li>";
              echo "<li><a href='" . urlFor('../private/processLogout.php') . "'>Logout, " . $_SESSION["loggedusername"] . "</a></li>";
              echo "<li><a href='" . urlFor('/index.php') . "'>Main Home Page</a></li>";
            }
            ?>
        </ul>
      </nav>