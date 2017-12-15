<?php
	include 'include/protect.php';

	if(isset($id)) {
		$sql = "SELECT * FROM scores WHERE id='$id'";
		$result = mysqli_query($db, $sql);
		$data = mysqli_fetch_assoc($result);
	}
	
	if (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$score = $_POST['score'];
		$league = $_POST['league'];
		$type = $_POST['type'];
		
		$sql = "UPDATE scores SET name='$name', score='$score', league='$league', type='$type' WHERE id='$id'";
		if (!mysqli_query($db, $sql)) {
			header("Location: ?id=" . $id . "?cb=fedit");
		} else {
			slog($_SESSION['login_name'] . " updated bolwer to [" . $name . ", " . $score . ", " . getLeagueName($league) . ", " . getScoreType($type) ."]");
			header("Location: edit_scores.php?cb=sedit");
		}
	}
	
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql = "DELETE FROM scores WHERE id='$id'";
		if (!mysqli_query($db, $sql)) {
			header("Location: ?id=" . $id . "?cb=fdelete");
		} else {
			slog($_SESSION['login_name'] . " deleted bowler [" . $_POST['name'] . ", " . $_POST['score'] . "]");
			header("Location: edit_scores.php?cb=sdelete");
		}
	}

?>

<body>
	<h1>Edit Score</h1>
	<?php include 'include/header.php' ?>
	<div class="center">
		<?php
		
			if (isset($_GET['cb'])) {
				if ($_GET['cb'] == 'fedit') {
					echo("<h4 class='red'>Failed to update bowler info</h4>");
				} else if ($_GET['cb'] == 'fdelete') {
					echo("<h4 class='red'>Failed to delete bowler info</h4>");
				}
			}
			
		?>
		<form action="" method="post" autocomplete="off">
			<input type="text" name="name" placeholder="Display Name" <?php echo("value='" . $data['name'] . "'") ?> />
			<input type="text" name="score" size="6" placeholder="Score" <?php echo("value='" . $data['score'] . "'") ?> />
			<select name="league">
				<option value="1" <?php if ($data['league'] == 1) { echo("selected"); } ?>>Men</option>
				<option value="2" <?php if ($data['league'] == 2) { echo("selected"); } ?>>Women</option>
				<option value="3" <?php if ($data['league'] == 3) { echo("selected"); } ?>>Youth M</option>
				<option value="4" <?php if ($data['league'] == 4) { echo("selected"); } ?>>Youth F</option>
			</select>
			<select name="type">
				<option value="1" <?php if ($data['type'] == 1) { echo("selected"); } ?>>Game</option>
				<option value="2" <?php if ($data['type'] == 2) { echo("selected"); } ?>>Series</option>
			</select><br />
			<input type="submit" name="edit" value="Edit Bowler"/>
			<input type="submit" name="delete" value="Delete Bowler" />
			<input type="hidden" name="id" <?php echo("value='" . $data['id'] . "'"); ?>/>
		</form>
		<a class="button" href="edit_scores.php">Go Back</a>
	</div>
</body>
</html>