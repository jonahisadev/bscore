<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	if (!isset($_SESSION['login_id'])) {
		header("Location: index.php");
	}
	
	$ADMIN = "admin";

?>