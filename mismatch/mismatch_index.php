<?php
	session_start();
?>
<html>
	<head>
		<title>MisMatch:|:[:]:|:Homepage</title>
	</head>
	<body>
		<?php
			require 'mismatch_header.php';
			require 'mismatch_navbar.php';
			if (!isset($_SESSION['user_id'])) {
				# code...
				if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
					# code...
					$_SESSION['username'] = $_COOKIE['username'];
					$_SESSION['user_id'] = $_COOKIE['user_id'];
				}

			}
			if (isset($_SESSION['username'])) {
				echo '&#10084; <a href="mismatch_view_profile.php">View Profile</a><br />';
				echo '&#10084; <a href="mismatch_edit_profile.php">Edit Profile</a><br />';
			}
		define('GW_UPLOADPATH', 'Image/');
		$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user') or die('Error Connecting Database');
		$sql = "SELECT * FROM user_info";
		$result = mysqli_query($dbc, $sql);

		//Data Retreivel
		echo "<table>";
		while ($row = mysqli_fetch_array($result)) {
			# code...
			echo '<tr><td><img src="' . GW_UPLOADPATH . $row['profile_pic'] . '" alt="Score image" /></td></tr>';
			echo "<tr><td>Name ".$row['first_name']." ".$row['last_name']."</td></tr>";
			echo "<tr><td>Gender ".$row['gender']."</td></tr>";
			echo "<tr><td>Birth Date ".$row['birth_date']."</td></tr>";
			echo "<tr><td>City ".$row['city']."</td></tr>";
			echo "<tr><td>State ".$row['state']."</td></tr>";
			echo "<tr><td><hr></tr></td>";
		}
		?>
	</body>
</html>