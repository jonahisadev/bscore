<!DOCTYPE html>
<html>
<head>
	<title>Bowler Scores</title>
	<link href="css/scores.css" type="text/css" rel="stylesheet" />
	<meta lang="en" charset="utf-8" />
</head>

<?php

	include 'include/connect.php';
	include 'include/util.php';

?>

<body>
	<!-- <h1 id="title">Scoreboard</h1> -->
	<section class="half">
		<div class="left">
			<h2>Men</h2>
			<section class="half">
				<div class="left">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='1' AND type='1'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<h3>Game</h3>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
				<div class="right">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='1' AND type='2'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<h3>Series</h3>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
			</section>
		</div>
		<div class="right">
			<h2>Women</h2>
			<section class="half">
				<div class="left">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='2' AND type='1'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<h3>Game</h3>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
				<div class="right">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='2' AND type='2'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<h3>Series</h3>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
			</section>
		</div>
	</section>
	<h2>Youth</h2>
	<section class="half">
		<div class="left">
			<section class="half">
				<div class="left">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='3' AND type='1'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
				<div class="right">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='3' AND type='2'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
			</section>
		</div>
		<div class="right">
			<section class="half">
				<div class="left">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='4' AND type='1'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
				<div class="right">
					<?php
					
						$sql = "SELECT list FROM top WHERE league='4' AND type='2'";
						$result = mysqli_query($db, $sql);
						$row = mysqli_fetch_assoc($result);
						$ids = explode(",", $row['list']);
						
						$names = array();
						$scores = array();
						foreach ($ids as $x) {
							$id = intval($x);
							$sql = "SELECT * FROM scores WHERE id='$id'";
							$result = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($result)) {
								extract($row);
								array_push($names, $name);
								array_push($scores, $score);
							}
						}
					
					?>
					<section class="half">
						<div class="left2">
							<?php
								for ($i = 0; $i < count($names); $i++) {
									echo("<h4>" . $names[$i] . "</h4>");
								}
							?>
						</div>
						<div class="right2">
							<?php
								for ($i = 0; $i < count($scores); $i++) {
									echo("<h4>" . $scores[$i] . "</h4>");
								}
							?>
						</div>
					</section>
				</div>
			</section>
		</div>
	</section>
	<div class="center">
		<?php include 'include/footer.php' ?>
	</div>
</body>
</html>