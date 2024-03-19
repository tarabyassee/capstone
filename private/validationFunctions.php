<?php 
  function isBlank($value) {
    return !isset($value) || trim($value) === '';
  }

  function has_presence($value) {
    return !isBlank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

/************Functions I added *********/

function invalidUsername($username) {
  $result = false;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username )) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email) {
  $result = false;
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result = false;
  if($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function usernameExists($db, $username, $email) {
  $sql = "SELECT * FROM user_usr WHERE username_usr = ? OR email_usr = ? ;";
  $stmt = mysqli_stmt_init($db);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../public/users/signup.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

function createUser($db, $fname, $lname, $phone, $phonetype, $email, $username, $pwd) {
  // $sql_select = "SELECT id_phn FROM phone_type_phn WHERE type_phn = ? ";
  // $stmt_select = mysqli_stmt_init($db);

  // if(!mysqli_stmt_prepare($stmt_select, $sql_select)) {
  //   header("Location: ../public/users/signup.php?error=selectStmtFailed");
  //   exit();
  // }

  // mysqli_stmt_bind_param($stmt_select, "s", $phonetype);
  // mysqli_stmt_execute($stmt_select);

  // if(mysqli_stmt_error($stmt_select)) {
  //   header("Location: ../public/users/signup.php?error=stmtSelectError");
  //   exit();
  // }

  // $result = mysqli_stmt_get_result($stmt_select);
  // $row = mysqli_fetch_assoc($result);
  // $id_phn_usr = $row['id_phn'];

  $sql_insert = "INSERT INTO user_usr (first_name_usr, last_name_usr, phone_number_usr, id_phn_usr, email_usr, username_usr, password_hashed_usr) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($db);

  if (!mysqli_stmt_prepare($stmt, $sql_insert)) {
    header("Location: ../public/users/signup.php?error=stmtFailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
  mysqli_stmt_bind_param($stmt, "sssisss", $fname, $lname, $phone, $phonetype, $email, $username, $hashedPwd);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("Location: ../index.php");
}

function emptyInputLogin($username, $pwd) {
  if(empty($username) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function loginUser($db, $username, $pwd) {
  $usernameExists = usernameExists($db, $username, $username);

  if ($usernameExists === false) {
    header("Location: ..login.php?error=wronglogin");
    exit();
  }
  $pwdHashed = $usernameExists['password_hashed_usr'];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false) {
    header("Location:../public/users/login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION["loggeduserid"] = $usernameExists['id_usr'];
    $_SESSION["loggedusername"] = $usernameExists['username_usr'];
    $_SESSION["loggedfname"] = $usernameExists['first_name_usr'];
    $_SESSION["isAdmin"] = $usernameExists['is_admin'];

    if ($_SESSION["isAdmin"] == 1) {
      header("Location: ../public/users/admins/index.php");
      exit();
    } else {
      header("Location: ../public/users/vendors/index.php");
      exit();
    }
  }
}

function createProduct($db, $fname, $lname, $phone, $phonetype, $email, $username, $pwd) {
  $sql_select = "SELECT id_phn FROM phone_type_phn WHERE type_phn = ? ";
  $stmt_select = mysqli_stmt_init($db);

  if(!mysqli_stmt_prepare($stmt_select, $sql_select)) {
    header("Location: ../public/users/signup.php?error=selectStmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt_select, "s", $phonetype);
  mysqli_stmt_execute($stmt_select);

  if(mysqli_stmt_error($stmt_select)) {
    header("Location: ../public/users/signup.php?error=stmtSelectError");
    exit();
  }

  $result = mysqli_stmt_get_result($stmt_select);
  $row = mysqli_fetch_assoc($result);
  $id_phn_usr = $row['id_phn'];

  $sql_insert = "INSERT INTO user_usr (first_name_usr, last_name_usr, phone_number_usr, id_phn_usr, email_usr, username_usr, password_hashed_usr) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($db);

  if (!mysqli_stmt_prepare($stmt, $sql_insert)) {
    header("Location: ../public/users/signup.php?error=stmtFailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
  mysqli_stmt_bind_param($stmt, "sssisss", $fname, $lname, $phone, $id_phn_usr, $email, $username, $hashedPwd);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("Location: ../public/users/signup.php?error=none");
}