<?php
$pageTitle = 'Home';
require_once('../../private/initialize.php');
require_once('../../private/shared/publicHeader.php');

$errors = [];
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$phonetype = isset($_POST['phonetype']) ? $_POST['phonetype'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
$pwdRepeat = isset($_POST['pwdrepeat']) ? $_POST['pwdrepeat'] : '';

if (isset($_POST['submit'])) {
    if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $errors[] = "All fields are required";
    }

    if (invalidUsername($username)) {
        $errors[] = "Invalid username";
    }

    if (invalidEmail($email)) {
        $errors[] = "Invalid email";
    }

    if (pwdMatch($pwd, $pwdRepeat)) {
        $errors[] = "Passwords don't match.";
    }

    if (usernameExists($db, $username, $email)) {
        $errors[] = "Username is taken. Choose another.";
    }

    if (empty($errors)) {
        createUser($db, $fname, $lname, $phone, $phonetype, $email, $username, $pwd, $pwdRepeat);
    }
}
?>

<div id="signup-content">
    <h1>Sign Up</h1>
    <p>Fields marked with an * are required.</p>
    <section>
        <?php if (!empty($errors)) { ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo h($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>

        <form id="signup" action="<?php echo urlFor('/users/signup.php'); ?>" method="post" role="form">
            <label for="fname">*First Name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo h($fname); ?>"><br>

            <label for="lname">*Last Name:</label>
            <input type="text" name="lname" id="lname" value="<?php echo h($lname); ?>"><br>
            <label for="phone">*Phone:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo h($phone); ?>"><br>

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
            <input type="email" id="email" name="email" placeholder="email@abc.com" value="<?php echo h($email); ?>"><br>

            <label for="username">*Username</label>
            <input type="text" id="username" name="username" value="<?php echo h($username); ?>"><br>

            <label for="pwd">*Password</label>
            <input type="password" id="pwd" name="pwd"><br>

            <label for="repwd">*Re-enter Password</label>
            <input type="password" id="repwd" name="pwdrepeat"><br>

            <button type="submit" name="submit">Sign Up!</button>
        </form>
    </section>
</div>

<?php include_once('../../private/shared/publicFooter.php'); ?>
