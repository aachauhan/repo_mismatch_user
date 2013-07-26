<?php
	//empty error message
	$error_log = "";

	//Check if the user is logged in
	if (!isset($_COOKIE['user_id'])) {
		if (isset($_POST['submit'])) {
			
			//connect to database
			$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');

			//grab the data
			$u_name = mysqli_real_escape_string($dbc, trim($_POST['u_name']));
			$u_pass = mysqli_real_escape_string($dbc, trim($_POST['u_pass']));

			if (!empty($u_name) && !empty($u_pass)) {
				
				$query = "SELECT Id, username FROM user_info WHERE username = '$u_name' and password = SHA('$u_pass') ";
				$data = mysqli_query($dbc, $query);

				if (mysqli_num_rows($data) == 1) {
					// The log-in is OK so set the user ID and username cookies, and redirect to the home page $row = mysqli_fetch_array($data);
					$row = mysqli_fetch_array($data);
					setcookie('uid', $row['Id']);
					setcookie('username', $row['username']);
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/mismatch_index.php';
					header('Location: ' . $home_url);
				}
				else{
					// The username/password are incorrect so set an error message
					$error_log = 'Sorry, you must enter a valid username and password to log in.';
				}
			}
			else {
				// The username/password weren't entered so set an error message
				$error_log = 'Sorry, you must enter your username and password to log in.';
			}
		}
	}
?>
<html>
	<head>
		<title>Mismatch - Log In</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h3>Mismatch - Log In</h3>
		<?php
			// If the cookie is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (empty($_COOKIE['user_id'])) {
				echo '<p class="error">' . $error_log . '</p>';
		?>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>Log In</legend>
			
				<label for="username">Username:</label>
				<input type = 'text' id='username' name = 'u_name' value = " <?php if (!empty($user_username)) echo $user_username; ?> " /> <br />

				<label for="password">Password:</label>
				<input type="password" id="password" name="u_pass" />
			</fieldset>

			<input type="submit" value="Log In" name="submit" />
		</form>
		<?php
			}
			else {
				// Confirm the successful log in
				echo('<p class="login">You are logged in as ' . $_COOKIE['username'] . '.</p>');
			}
		?>
	</body>
</html>