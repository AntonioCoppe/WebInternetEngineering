<?php
	ob_start();
	session_start();

	if (isset($_SESSION['user']))
		header('Location: dashboard.html');

	elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once('config.php');
		$stmt = $db->prepare("INSERT INTO Users VALUES (?, ?, ?, ?)");

		$name = mysqli_real_escape_string($db, $_POST['name']);
		$surname = mysqli_real_escape_string($db, $_POST['surname']);
		$user = mysqli_real_escape_string($db, $_POST['email']);
		$pwd = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($name))
			$_GET['mn'] = true;

		if (empty($surname))
			$_GET['ms'] = true;

		if (! $_GET['mn'] and ! $_GET['ms']) {
			$stmt->bind_param('ssss', $user, $pwd, $name, $surname);
			if (! $stmt->execute())
				$_GET['ue'] = true;
			else {
				$_SESSION['user'] = $user;
				header('Location: dashboard.html');
			}
		}	
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
		<img class="mb-4" src="img/login-logo-res.png" alt="Logo">
		<h1 class="h3 mb-3 fw-normal">Register now!</h1>

		<?php
			if ($_GET['ue'])
				echo "<div class=\"alert alert-danger\">User '$user' already exists.</div>";
			else {
				if ($_GET['mn'])
					echo "<div class=\"alert alert-danger\">Name is missing.</div>";
				if ($_GET['ms'])
					echo "<div class=\"alert alert-danger\">Surname is missing.</div>";
			}
		?>
		<form action="signup.php" method="POST" accept-charset="utf-8">
			<div class="form-floating">
				<input type="text" class="form-control" name="name" id="nameInputForm" placeholder="Mario" required>
				<label for="nameInputForm">Name</label>
			</div>
			<div class="form-floating">
				<input type="text" class="form-control" name="surname" id="surnameInputForm" placeholder="Rossi" required>
				<label for="surnameInputForm">Surname</label>
			</div>
			<div class="form-floating">
				<input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
				<label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>

			<button class="w-100 btn btn-lg btn-success" type="submit">Sign in</button>
		</form>
	</main>
	<footer>
		&copy; Angelone & Coppe 2021
	</footer>
</body>
</html>
