<?php
	session_start();
	unset($_SESSION['user_id']);
	session_destroy();
	if (!isset($_SESSION['user_id']));
		header('location:index.php');
	die();
?>