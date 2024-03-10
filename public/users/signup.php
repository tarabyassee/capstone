<?php
$pageTitle = 'Home';
require_once('../../private/initialize.php');
require_once('../../private/shared/publicHeader.php');

?>
<div id="signup-content">
  <h1>Sign Up</h1>
  <p>Fields marked with an * are required.</p>
  <section>
    <form id="signup" action="../../private/processSignup.php" method="post" role="form">
      <label for="fname">*First Name:</label>
      <input type="text" name="fname" id="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"><br>

      <label for="lname">*Last Name:</label>
      <input type="text" name="lname" id="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"><br>
      <label for="phone">*Phone:</label>
      <input type="tel" name="phone" id="phone"><br>

      <fieldset>
        <legend>Phone Type</legend>
        <input type="radio" value="1" id="1" name="phonetype">
        <label for="1">Cell Phone</label>

        <input type="radio" value="2" id="2" name="phonetype">
        <label for="2">Home Phone</label>

        <input type="radio" value="3" id="3" name="phonetype">
        <label for="3">Work Phone</label>
      </fieldset>

      <label for="email">*Email Address</label>
      <input type="email" id="email" name="email" placeholder="email@abc.com"><br>

      <label for="username">*Username</label>
      <input type="text" id="username" name="username"><br>

      <label for="pwd">*Password</label>
      <input type="password" id="pwd" name="pwd"><br>

      <label for="repwd">*Re-enter Password</label>
      <input type="password" id="repwd" name="pwdrepeat"><br>

      <button type="submit" name="submit">Sign Up!</button>
    </form>
  </section>
</div>

<?php
if (isset($_GET["error"])) {
  if ($_GET["error"] == "nomatch") {
    echo "<p>Passwords don't match</p>";
  } else if ($_GET["error"] == "usernameTaken") {
    echo "<p>This username already exists. Please choose another.</p>";
  } else if ($_GET["error"] == "none") {
    echo "<p>Congratulations! You have signed up.</p>";
  }
}
?>

<?php include_once('../../private/shared/publicFooter.php'); ?>