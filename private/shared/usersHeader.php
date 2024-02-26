<?php
   
  if(!isset($pageTitle)) {$pageTitle = 'AAA';} 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('stylesheets/users.css') ?>">
    <script src="<?php echo urlFor('js/script.js')?>"></script>
  </head>
  
  <body>
    <header>
      <h1>User</h1>
    </header>
    <nav>
      <ul>
        <li><a href="<?php echo urlFor('/users/index.php'); ?>">Main Menu</a></li>
      </ul>
    </nav>