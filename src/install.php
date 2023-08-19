<?php
// mysql procedural way
// remove after install
require_once("connect.php"); // does all the db connection

$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

if (!$conn) {
	echo 'Database Error';
	die("Connection failed: ". mysqli_error());
}

$table = "CREATE TABLE IF NOT EXISTS logs (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
program VARCHAR(30) NOT NULL,
url VARCHAR(30) NOT NULL,
user VARCHAR(100),
pass VARCHAR(100),
pc VARCHAR(100) NOT NULL,
postdate VARCHAR(30),
ip VARCHAR(30)
)";

if (mysqli_query($conn, $table)) {
	echo 'Table logs created';
} else {
	echo 'Table logs not created';
}
$date = date('d-m-Y H:i:s');

$input = "INSERT INTO logs (program, url, user, pass, pc, postdate, ip) 
VALUES ('1', 'example.com', 'admin', 'password', 'admin@pc', ('$date'), '127.0.0.1');
"; 
$input .= "INSERT INTO logs (program, url, user, pass, pc, postdate, ip) 
VALUES ('3', 'example.com', 'admin', 'pass3', 'user@pc', ('$date'), '127.0.0.1');
";

if (mysqli_multi_query($conn, $input)) { //mysqli_query($conn, $input)
	echo 'Test input created';
} else {
	echo 'Test input not created';
}
mysqli_close($conn);

?>
