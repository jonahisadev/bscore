<?php
	include 'include/protect.php'
?>

<h1>Scoreboard Config</h1>
<?php include 'include/header.php' ?>
<div class="center">
	<?php
		include 'include/util.php';
	
		if (isset($_GET['cb'])) {
			if ($_GET['cb'] == 'cpass') {
				echo("<h4 class='green'>Password changed successfully!</h4>");
			} else if ($_GET['cb'] == 'login') {
				echo("<h4 class='green'>Welcome, " . $_SESSION['login_name'] . "!</h4>");
			} else if ($_GET['cb'] == 'cuser') {
				echo("<h4 class='green'>User added succsessfully!</h4>");
			} else if ($_GET['cb'] == 'sruser') {
				echo("<h4 class='green'>User removed successfully!</h4>");
			}
		}
	?>
	<a class="button" href="config_scores.php">Configure Scores</a><br />
	<?php
		if ($_SESSION['login_user'] == $ADMIN) {
			echo("<a class='button' href='add_user.php'>Add User</a><br />");
			echo("<a class='button' href='remove_user.php'>Remove User</a><br />");
			echo("<a class='button' href='view_log.php'>View Log</a><br />");
		}
	?>
	<a class="button" href="change_pass.php">Change Password</a><br />
	<a class="button" href="end.php">Log Out</a>
	<script src="script.js" type="text/javascript"></script>
</div>