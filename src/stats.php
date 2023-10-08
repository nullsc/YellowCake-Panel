<?php 
/* YellowCake stealer panel project
August 2021
statistics page - test
*/
require_once('./includes/auth.php'); 
include_once('./includes/functions.php'); 
require_once('connect.php'); // does all the db connection
require_once('config.php');
?>

<!doctype html>
<html lang="en">
<head>
	<title>YellowCake Stats</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<style>
	<?php
	$test = array(25, 25, 30, 20); //100%
	$colors = array("black", "yellow", "orange", "green", "blue");
	//echo createChart("test-id", 100, $test, $colors);
	?>
	</style>
</head>
<body>

  <!-- Top menu -->
<?php include_once('./includes/header.php') ?>

<div class="top-text">
	<p>See all panel statistics</p>

</div>

<?php
		// general stats, same as index page


		//$sql = "SELECT id, program, url, user, pass, pc, postdate, ip FROM logs";
		$result = mysqli_query($conn, "SELECT * FROM logs");
		
		//$distinctLogs = "SELECT COUNT(DISTINCT pc) FROM logs";
		$distinct = mysqli_query($conn, "SELECT COUNT(DISTINCT pc) FROM logs");
		$total = mysqli_fetch_row($distinct);
		
		//$lastLog = "SELECT postdate FROM logs ORDER BY id DESC LIMIT 1"; // get the last entry
		$mostRecent = mysqli_query($conn, "SELECT postdate FROM logs ORDER BY id DESC LIMIT 1");
		$lastLog = mysqli_fetch_assoc($mostRecent);
?>

<div class="stats-info">

	<div class="stat-box">
		<h3>Settings</h3>
		<?php 
		echo '<p>Safemode: '.(($safemode) ? '<span class="green-txt">ON</span>': '<span class="red-txt">OFF</span>').'</p>'; 
		echo '<p>Logs per Page: '.$logsPerPage.'<p>';
		?>
	</div>
	<div class="stat-box">
		<!-- <h2>Logs</h2> -->
		<h3>Total Logs</h3>
		<?php echo '<p>'.mysqli_num_rows($result).'</p>'; ?>
	</div>
	<div class="stat-box">
		<h3>Last Log</h3>
		<!-- <p>Today</p> -->
		<?php echo '<p>'.$lastLog['postdate'].'</p>'; ?>
	</div>
	<div class="stat-box">
		<h3>Total Users</h3>
		<?php echo '<p>'.$total[0].'</p>'; ?>
	</div>
	<div class="stat-box">
		<h3>Test pie chart</h3>
		<?php echo '<div id="test-id"></div>'; ?>
	</div>
	
</div>

	<footer>
		<p>Panel 2021</p>
		<p>Made with: html, css, javascript, php & sql.</p>
	</footer>

	<script src="js/script.js"></script>

</body>
</html>
<?php
mysql_close($conn);
?>
