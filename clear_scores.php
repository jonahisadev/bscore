<?php

	include 'include/protect.php';
	if ($_SESSION['login_user'] != $ADMIN) {
		header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>You Sure?</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<meta lang="en" charset="utf-8" />
</head>

<?php

	if (isset($_POST['yes'])) {
		include 'include/connect.php';
		include 'include/util.php';
		
		$sql = "TRUNCATE TABLE scores";
		if (!mysqli_query($db, $sql)) {
			header("Location: config_scores.php?cb=fclear");
		}
		
		for ($i = 0; $i < 8; $i++) {
			$sql = "UPDATE top SET list='' WHERE id='$i'";
			if (!mysqli_query($db, $sql)) {
				header("Location: config_scores.php?cb=fclear");
			}
		}
		
		slog($_SESSION['login_name'] . " cleared the bowler table");
		header("Location: config_scores.php?cb=sclear");
	}

?>

<body>
	<div class="center">
		<h1>You Sure?</h1>
		<?php include 'include/header.php' ?>
		<h3>Do you want to clear <b>ALL</b> scores?</h3>
		<form action="" method="post">
			<input type="submit" name="yes" value="Yes" />
		</form>
		<a href="config_scores.php" class="button">No</a>
	</div>
</body>
</html>