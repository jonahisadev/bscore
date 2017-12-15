<?php

	include 'include/util.php';

	session_start();
	slog($_SESSION['login_name'] . " logged out");
	unset($_SESSION["login_user"]);
	session_destroy();
	header('Location: index.php');

?>