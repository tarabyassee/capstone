<?php 
  $pageTitle = 'Login';
  require_once('../../private/initialize.php');
  require_once('../../private/shared/usersHeader.php');
?>
  
    <body>
      <h1>Log In</h1>
      <section>
        <form id="user-login" action="../../private/processLogin.php" method="post">
          <label for="name">*Username</label>
          <input type="text" id="name" name="username" placeholder="Username/Email..." required>

          <label for="pwd">*Password</label>
          <input type="password" id="pwd" name="pwd" placeholder="Password..." required>

          <button type="submit" name="submit">Log in</button>
        </form>
        <?php
          if(isset($_GET["error"])) {
            if($_GET["error"] == "nomatch") {
              echo "<p>Passwords don't match</p>";
            }
            else if($_GET["error"] == "wronglogin") {
              echo "<p>Incorrect login information</p>";
            }
          }
        ?>
      </section>

    </body>
  </div>
</html>
<?php require_once('../../private/shared/usersFooter.php'); ?>
