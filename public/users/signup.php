<?php 
  $pageTitle = 'Home';
  require_once('../../private/initialize.php');
  require_once('../../private/shared/publicHeader.php');
?>
  
    <body>
      <h1>Sign Up</h1>
      <section>
        <form id="user-login" action="../../private/processSignup.php" method="post">
          <label for="fname">*First Name:</label>
          <input type="text" name="fname" id="fname" required><br>

          <label for="lname">*Last Name:</label>
          <input type="text" name="lname" id="lname" required><br>

          <label for="phone">*Phone:</label>
          <input type="tel" name="phone" id="phone" required><br>

          <fieldset>
            <legend>Phone Type</legend>
            <input type="radio" id="1" name="phonetype">
            <label for="1">Cell Phone</label>

            <input type="radio" id="2" name="phonetype">
            <label for="2">Home Phone</label>

            <input type="radio" id="3" name="phonetype">
            <label for="3">Work Phone</label>

          </fieldset>

          <label for="email">*Email Address</label>
          <input type="email" id="email" name="email" placeholder="email@abc.com" required>
          
          <label for="username">*Username</label>
          <input type="text" id="username" name="username" required>

          <label for="pwd">*Password</label>
          <input type="password" id="pwd" name="pwd" required>

          <label for="pwd">*Re-enter Password</label>
          <input type="password" id="pwdrepeat" name="pwdrepeat" required>

          <button type="submit" name="submit">Sign Up!</button>
        </form>
      </section>

    </body>
  </div>
</html>
