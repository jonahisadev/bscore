<?php
	include 'include/protect.php';
	
	if ($_SESSION['login_user'] != $ADMIN) {
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<meta lang="en" charset="utf-8" />
</head>

<?php

	if (isset($_POST['username'])) {
		include 'include/connect.php';
		include 'include/util.php';
		
		// Check for empty fields
		if (empty($_POST['username']) || empty($_POST['name']) || empty($_POST['password'])) {
			header("Location: ?cb=empty");
		}
		
		// Clean data and hash password
		$username = cleanse($_POST['username']);
		$name = cleanse($_POST['name']);
		$password = cleanse($_POST['password']);
		$passwd = password_hash($password, PASSWORD_DEFAULT);
		
		// Check for duplicate username
		$sql = "SELECT COUNT(*) AS total FROM admin WHERE admin.username='$username'";
		$result = mysqli_query($db, $sql);
		$data = mysqli_fetch_assoc($result);
		if (intval($data['total']) != 0) {
			//die("exists: " . $data['total']);
			header("Location: ?cb=exists");
		}
		else {
			// Add User
			$sql = "INSERT INTO admin (username, password, name) VALUES ('$username', '$passwd', '$name')";
			if (!mysqli_query($db, $sql)) {
				die("Error adding user: " . mysqli_error($db));
			} else {
				slog($_SESSION['login_name'] . " added user " . $name . " (" . $username . ")");
				header("Location: index.php?cb=cuser");
			}
		}
	}

?>

<body>
	<h1>Add User</h1>
	<?php include 'include/header.php' ?>
	<div class="login">
		<?php
			
			if (isset($_GET['cb'])) {
				if ($_GET['cb'] == 'empty') {
					echo("<h4 class='red'>Please fill out all text fields</h4>");
				} else if ($_GET['cb'] == 'exists') {
					echo("<h4 class='red'>That username already exists</h4>");
				}
			}
			
		?>
		<form action="" method="post" autocomplete="off">
			<input type="text" id="username" name="username" placeholder="Username" /><br />
			<input type="text" id="name" name="name" placeholder="Name" /><br />
			<input type="password" id="password" name="password" placeholder="Password" /><br />
			<input type="submit" value="Add User"/>
		</form>
		<a class="button" href="index.php">Go Back</a>
	</div>
</body>