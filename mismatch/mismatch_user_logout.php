<?php
	//if the user call logout then simply set the cookie a time in past
	session_start();
	if (isset($_SESSION['user_id'])) {
		# code...
		$_SESSION = array();
		
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 3600);
		}
	}
	
	session_destroy();

	setcookie('user_id', '', time() - 3600);
	setcookie('username', '', time() - 3600);
	// Redirect to the home page
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/mismatch_index.php';
	header('Location: ' . $home_url);
?>
<html>
</html>