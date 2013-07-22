<html>
	<head>
		<title>MisMatch:||:LogIn</title>
		<link rel="stylesheet" type="text/css" href="">
	</head>
	<body>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<section>
				<label for="uname">Username: </label><input type="text" name="uname" id="uname" /><br>
				<label for="upass">Password: </label><input type="password" name="upass" id="upass" /><br>
				<input type="submit" value="LogIn" name="submit" />
			</section>
		</form>
		<a href="mismatch_user_register.php">Want to Register</a>
		<!-- PHP SCRIPT -->
		<?php
		if (isset($_POST['submit'])) {
			
			$password = $_POST['upass'];
			$dbc = mysqli_connect('localhost','root','root','mismatch_user');
			$sql = "SELECT * FROM where password = SHA('$password')";
			mysqli_query($dbc, $sql);
			echo "Hello";

		}
		?>
	</body>
</html>