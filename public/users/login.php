<?php 
  $pageTitle = 'Login';
  require_once('../../private/initialize.php');
  require_once('../../private/shared/publicHeader.php');
?>
  
    <body>
      <h1>Log In</h1>
      <section>
        <form id="user-login" action="../../private/processLogin.php" method="post">
          <label for="name">*Username</label>
          <input type="text" id="name" name="name" placeholder="Username/Email...">

          <label for="pwd">*Password</label>
          <input type="password" id="pwd" name="pwd" placeholder="Password..." required>

          <button type="submit" name="submit">Log in</button>
        </form>
      </section>

    </body>
  </div>
</html>
