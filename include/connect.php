<?php 

	$db = mysqli_connect("localhost", "root", "", "bowling");
	if (!$db) {
		die("Could not connect to database!");
	}

?>