<?php

	if (isset($_POST['username'])) {
		//include 'connect.php';
		include 'include/util.php';
		
		$username = cleanse($_POST['username']);
		$password = cleanse($_POST['password']);
		
		$sql = "SELECT password FROM admin WHERE username='$username'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if (empty($row)) {
			header("Location: index.php?cb=fuser");
		} else {
			$passwd = $row['password'];
			
			if (password_verify($password, $passwd)) {
				$sql = "SELECT * FROM admin WHERE username='$username'";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_assoc($result);
				
				$_SESSION['login_id'] = $row['id'];
				$_SESSION['login_user'] = $row['username'];
				$_SESSION['login_name'] = $row['name'];
				
				slog($_SESSION['login_name'] . " logged in");
				header('Location: index.php?cb=login');
			} else {
				header("Location: index.php?cb=fpass");
			}
		}
	}

?>

<h1>Login</h1>
<div class="login">
	<?php
	
		if (isset($_GET['cb'])) {
			if ($_GET['cb'] == 'fpass') {
				echo("<h4 class='red'>Incorrect password</h4>");
			} else if ($_GET['cb'] == 'fuser') {
				echo("<h4 class='red'>That username does not exist</h4>");
			}
		}
	
	?>
	<form action="index.php" method="post" autocomplete="off">
		<input type="text" id="username" name="username" placeholder="Username" /><br />
		<input type="password" id="password" name="password" placeholder="Password"/><br />
		<input type="submit" value="Login"/>
	</form>
</div>