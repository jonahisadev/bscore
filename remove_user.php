<?php

	include 'include/protect.php';
	if ($_SESSION['login_user'] != $ADMIN) {
		header("Location: index.php");
	}

?>

<?php

	include 'include/connect.php';
	include 'include/util.php';

	if (isset($_POST['remove'])) {
		$username = cleanse($_POST['username']);
		
		if ($username != $ADMIN) {
			$sql = "SELECT COUNT(*) AS total FROM admin WHERE admin.username='$username'";
			$result = mysqli_query($db, $sql);
			$data = mysqli_fetch_assoc($result);
			if (intval($data['total']) == 0) {
				header("Location: ?cb=fexist");
			} else {
				$sql = "DELETE FROM admin WHERE username='$username'";
				if (!mysqli_query($db, $sql)) {
					header("Location: ?cb=fuser");
				} else {
					slog($_SESSION['login_name'] . " removed user " . $username);
					header("Location: index.php?cb=sruser");
				}
			}
		} else {
			header("Location: ?cb=admin");
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Remove User</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<meta lang="en" charset="utf-8" />
</head>
<body>
	<h1>Remove User</h1>
	<?php include 'include/header.php' ?>
	<div class="center">
		<?php
		
			if (isset($_GET['cb'])) {
				if ($_GET['cb'] == 'admin') {
					echo("<h4 class='red'>Unable to remove admin account</h4>");
				} else if ($_GET['cb'] == 'fuser') {
					echo("<h4 class='red'>Unable to remove user: " . mysqli_error($db) . "</h4>");
				} else if ($_GET['cb'] == 'fexist') {
					echo("<h4 class='red'>That user does not exist</h4>");
				}
			}
		
		?>
		<form action="" method="post" autocomplete="off">
			<input type="text" name="username" placeholder="Username" /><br />
			<input type="submit" name="remove" value="Remove User" />
		</form>
		<a class="button" href="index.php">Go Back</a>
	</div>
</body>
</html>