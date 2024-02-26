<?php
  if(isset($_POST["submit"])) {
    echo "it works!";
  } else {
    header("Location: ../public/index.php");
    exit();
  }