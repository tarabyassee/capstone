<?php
  require_once('../../private/initialize.php');
  require_once('../../private/shared/usersHeader.php');
  require_once('../../private/processLogout.php');
?>

      <main>
        <h1>You are logged out.</h1>
        <li><a href="<?php echo urlFor('../public/index.php');?>">Main Page</a></li>
      </main>

<?php require_once('../../private/shared/usersFooter.php');
