<?php

	include 'include/protect.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Scores</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<meta lang="en" charset="utf-8" />
</head>

<?php

	include 'include/connect.php';
	include 'include/util.php';
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		include 'edit_bowler.php';
		die();
	}

?>

<body>
	<h1>Edit Scores</h1>
	<?php include 'include/header.php'; ?>
	<div class="center">
		<?php
		
			if (isset($_GET['cb'])) {
				if ($_GET['cb'] == "sedit") {
					echo("<h4 class='green'>Successfully update bowler information</h4>");
				} else if ($_GET['cb'] == "sdelete") {
					echo("<h4 class='green'>Successfully deleted bowler information</h4>");
				}
			}
		
		?>
		<a class="button" href="config_scores.php">Go Back</a>
	</div>
	<?php
		
		echo("<table>");
		echo("<tr>
			<th>Name</th>
			<th>Score</th>
			<th>League</th>
			<th>Type</th>
			<th>Edit</th>
		</tr>");
		
		$sql = "SELECT * FROM scores";
		$result = mysqli_query($db, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			echo("<tr>");
			echo("<td>" . $name . "</td>");
			echo("<td>" . $score . "</td>");
			echo("<td>" . getLeagueName($league) . "</td>");
			echo("<td>" . getScoreType($type) . "</td>");
			echo("<td><a class='edit' href='?id=" . $id . "'>Edit</a></td>");
			echo("</tr>");
		}
		
		echo("</table>");
	
	?>
</body>
</html>