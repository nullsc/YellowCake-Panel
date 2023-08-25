<?php
/* auth.php
check if a user is logged in
*/

session_start();

/* if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) { // not logged in
	echo 'Not logged in';
	header('Location: login.php');
	die();
} */

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { // logged in
	
} else {
	header('Location: login.php'); // not logged in
	die();
}

?>
