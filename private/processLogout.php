<?php
session_start();
session_unset();
session_destroy();
header("Location:../public/users/logout.php");
exit();