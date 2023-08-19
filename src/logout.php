<?php
/* logout */

session_start();
$_SESSION = array(); // unset all
//unset($_SESSION['loggedin']);
session_destroy();
header('location: login.php');
die();
?>
