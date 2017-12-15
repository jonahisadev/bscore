<?php
	include 'include/protect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Configure Scores</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<meta lang="en" charset="utf-8" />
</head>

<?php

	// Add Score
	if (isset($_POST['add'])) {
		include 'include/connect.php';
		include 'include/util.php';
		
		$name = cleanse($_POST['name']);
		$score = cleanse($_POST['score']);
		$league = intval(cleanse($_POST['league']));
		$type = intval(cleanse($_POST['type']));
		
		if (($type == 1) && (intval($score) > 300)) {
			header("Location: ?cb=hs");
		}
		
		$sql = "INSERT INTO scores (name, score, league, type) VALUES ('$name', '$score', '$league', '$type')";
		if (!mysqli_query($db, $sql)) {
			die("Could not add score! <a href=''>Go Back</a>");
		} else {
			slog($_SESSION['login_name'] . " added bowler " . $name . " with score of " . $score . " as a " . getLeagueName($league) . " " . getScoreType($type) . " score");
			header("Location: ?cb=sadd");
		}
	}
	
	// Calculate Top Scores
	else if (isset($_POST['calc'])) {
		include 'include/connect.php';
		include 'include/util.php';
		
		$MAX_SCORES = 10;
		
		for ($a = 1; $a <= 4; $a++) {
			for ($b = 1; $b <= 2; $b++) {
				
				// Sort the scores and ID's
				$sql = "SELECT * FROM scores WHERE league='$a' AND type='$b'";
				$result = mysqli_query($db, $sql);
				$scores = array();
				while ($row = mysqli_fetch_assoc($result)) {
					extract($row);
					array_push($scores, new ScoreData($id, intval($score)));
				}
				if (count($scores) == 0) {
					continue;
				}
				usort($scores, array("ScoreData", "cmp_obj"));
				
				// Create list
				$list = "";
				$count = count($scores);
				if ($count > $MAX_SCORES) {
					$count = $MAX_SCORES; 
				}
				for ($i = 0; $i < $count; $i++) {
					$list .= $scores[$i]->id;
					if ($i != $MAX_SCORES - 1) {
						$list .= ',';
					}
				}
				echo($list);
				
				// Update top scores
				$sql = "UPDATE top SET list='$list' WHERE league='$a' AND type='$b'";
				if (!mysqli_query($db, $sql)) {
					die("Error updating top list: " . mysqli_error($db));
				}
				
				// Delete the rest of the items
				if (count($scores) > $MAX_SCORES) {
					for ($i = $MAX_SCORES; $i < count($scores); $i++) {
						$s = $scores[$i]->id;
						$sql = "DELETE FROM scores WHERE id='$s'";
						if (!mysqli_query($db, $sql)) {
							die("Error deleting lower scores: " . mysqli_error($db));
						}
					}
				}
			}
		}
		
		slog($_SESSION['login_name'] . " calculated the top scores");
		header("Location: ?cb=scalc");
	}
		
	// Edit Scores
	else if (isset($_POST['edit'])) {
		header("Location: edit_scores.php");
	}	
	
	// Clear Scoreboard
	else if (isset($_POST['clear'])) {
		header("Location: clear_scores.php");
	}
	
	// Go Back
	else if (isset($_POST['back'])) {
		header("Location: index.php");
	}

?>

<h1>Configure Scores</h1>
<?php include 'include/header.php' ?>
<div class="center">
	<?php

		if (isset($_GET['cb'])) {
			if ($_GET['cb'] == 'hs') {
				echo("<h4 class='red'>The entered value was too high for a game</h4>");
			} else if ($_GET['cb'] == 'sadd') {
				echo("<h4 class='green'>Score added successfully!</h4>");
			} else if ($_GET['cb'] == 'scalc') {
				echo("<h4 class='green'>Scoreboard updated successfully!</h4>");
			} else if ($_GET['cb'] == 'fclear') {
				echo("<h4 class='red'>Scoreboard failed to clear: " . mysqli_error($db) . "</h4>");
			} else if ($_GET['cb'] == 'sclear') {
				echo("<h4 class='green'>Scoreboard cleared successfully!</h4>");
			}
		}

	?>
	<h3>Add Score</h3>
	<form action="" method="post" autocomplete="off">
		<input type="text" name="name" placeholder="Display Name" />
		<input type="text" name="score" size="6" placeholder="Score"/>
		<select name="league">
			<option value="1">Men</option>
			<option value="2">Women</option>
			<option value="3">Youth M</option>
			<option value="4">Youth F</option>
		</select>
		<select name="type">
			<option value="1">Game</option>
			<option value="2">Series</option>
		</select><br />
		<input type="submit" name="add" value="Add Score"/>
	</form>
	<h3>Other Options</h3>
	<form action="" method="post">
		<input name="edit" type="submit" value="Edit Scores" />
		<input name="calc" type="submit" value="Update Scoreboard" />
		<?php
			
			if ($_SESSION['login_user'] == $ADMIN) {
				echo "<input name='clear' type='submit' value='Clear Scoreboard' />";
			}
			
		?>
		<input name="back" type="submit" value="Go Back" />
	</form>
</div>
</html>