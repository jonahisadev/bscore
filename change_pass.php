<?php
	include 'include/protect.php'
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<meta lang="en" charset="utf-8" />
</head>

<?php
	
	if (isset($_POST['cpass'])) {
		include 'include/connect.php';
		include 'include/util.php';
		
		$cpass = cleanse($_POST['cpass']);
		$npass = cleanse($_POST['npass']);
		$user = $_SESSION['login_user'];
		
		if ($cpass == $npass) {
			die("Current and new password are the same. <a href=''>Go Back</a>");
		}
		
		$sql = "SELECT password FROM admin WHERE username='$user'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if (password_verify($cpass, $row['password'])) {
			$n = password_hash($npass, PASSWORD_DEFAULT);
			$sql = "UPDATE admin SET password='$n' WHERE username='$user'";
			if (!mysqli_query($db, $sql)) {
				die("Could not change password: " . mysqli_error($db));
			} else {
				header("Location: index.php?cb=cpass");
			}
		} else {
			die("Incorrect current password. <a href=''>Go Back</a>");
		}
	}

?>

<body>
	<h1>Change Password</h1>
	<?php include 'include/header.php' ?>
	<div class="center">
		<form action="" method="post">
			<input type="password" id="cpass" name="cpass" placeholder="Current Password" /><br />
			<input type="password" id="npass" name="npass" placeholder="New Password" /><br />
			<input type="submit" value="Change Password" />
		</form>
		<a class="button" href="index.php">Go Back</a>
	</div>
</body>
</html>