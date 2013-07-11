<?php
	$username = 'admin';
	$password = 'admin';
	if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER']!=$username || $_SERVER['PHP_AUTH_PW']!=$password ) {
		header('HTTP/1.1 401 Unauthorized');	
		header('WWW-Authenticate: Basic realm="Enter Username and Password"');
		exit('<h2>Guitarwars</h2><hr>Sorry, you must enter a valid Username and Password to see this password');
	}

?>