<?php
	ob_start();
	session_start();

	// if (isset($_SESSION['valid']) and isset($_SESSION['username']) and $_SESSION['valid'])
	// 	header('Location: dashboard.html')
	// else

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once('config.php');
		$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME) or die('DB connection failed');
		$user = mysqli_real_escape_string($db, $_POST['email']);
		$pwd = mysqli_real_escape_string($db, $_POST['password']);
		$res = $db->query("SELECT email FROM Users WHERE email = '$user' AND password = '$pwd'");
		$row = $res->fetch_array();
		if ($res->num_rows == 1) {
			header('Location: dashboard.html');
			die();
		} else
			$_GET['login_failed'] = true;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>FinPlatform Login</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-full/css/bootstrap.css">
	<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="lib/bootstrap-full/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="theme-color" content="#7952b3">
</head>
<body>
	<div class="container-narrow">
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li><a href="index.html">Home</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="login.php" id="login-button">Login</a></li>
			</ul>
			<a href="index.html"><h3 class="muted">FinPlatform</h3></a>
		</div>
		<hr>
	</div>
	<main class="text-center form-signin">
		<form action="login.php" method="POST" accept-charset="utf-8">
			<img class="mb-4" src="img/login-logo-res.png" alt="Logo">
			<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

			<?php 
				if ($_GET['login_failed'])
					echo '<div class="alert alert-danger">Login failed.</div>';
			?>

			<div class="form-floating">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
				<label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>

			<div class="checkbox mb-3">
				<label>
				<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
		</form>
		<p class="mt-5 mb-3 text-muted">&copy; Angelone & Coppe 2021</p>
	</main>
</body>
</html>
