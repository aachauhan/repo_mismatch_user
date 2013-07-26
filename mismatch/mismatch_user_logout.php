<?php
	//if the user call logout then simply set the cookie a time in past
	if (isset($_COOKIE['uid'])) {
		setcookie('uid', '', time() - 3600);
		setcookie('username', '', time() - 3600);
	}
	// Redirect to the home page
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/mismatch_index.php';
	header('Location: ' . $home_url);
?>