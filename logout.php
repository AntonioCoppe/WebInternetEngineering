<?php
	ob_start();
	session_start();
	unset($_SESSION['user']);
	session_destroy();
	header('Location: index.html');
	die();
?>
