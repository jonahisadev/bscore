<!DOCTYPE html>
<html>
<head>
	<title>Bowlers Scoreboard Config</title>
	<meta lang="en" charset="utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<?php
		session_start();
		include 'include/connect.php';
	
		if (empty($_SESSION['login_user'])) {
			include 'login.php';
		} else {
			include 'config.php';
		}
	?>
	<?php include 'include/footer.php' ?>
</body>
</html>