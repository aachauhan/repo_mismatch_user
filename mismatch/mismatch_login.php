<?php
	if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
		
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Mismatch"');
		exit('<h3>Mismatch</h3><br />Sorry you must enter your username andd password to view this page.');

	}
	// connect to database

	$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');

	//Grab the user Input data
	$uname = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
	$upass = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

	//look for the password in database
	$query = "SELECT Id, username From user_info Where username = '$uname' And password = SHA('$upass')";
	$data = mysqli_query($dbc, $query);

	if (mysqli_num_rows($data) == 1) {
		
		$row = mysqli_fetch_array($data);
		$username = $row['username'];
		$user_id = $row['Id'];

	}
	else{
		//Password and Username is incorrect
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Mismatch"');
		exit('<h3>Mismatch</h3><br />Sorry you must enter your username andd password to view this page.');
	}
	//Confirm the successful Log-In
	echo('<p class="login">You are logged in as ' . $username . '.</p>');
?>