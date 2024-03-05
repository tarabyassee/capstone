<?php
require_once "initialize.php";
session_start();
session_unset();
session_destroy();
$redirectUrl = urlFor('/index.php');
header("Location: $redirectUrl");
exit();