<?php

	include 'include/protect.php';
	if ($_SESSION['login_user'] != $ADMIN) {
		header("Location: index.php");
	}
	include 'include/util.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Scores</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<meta lang="en" charset="utf-8" />
</head>
<body>
	<h1>View Log</h1>
	<?php include 'include/header.php' ?>
	<div class="center">
		<a class="button" href="index.php">Go Back</a><br />
		<textarea id="log" rows="30" readonly><?php printLog(); ?></textarea>
	</div>
	<script src="script.js" type="text/javascript" onload="loadLog()"></script>
</body>
</html>