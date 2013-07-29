<?php
	session_start();
?>
<html>
	<head>
		<title>MisMatch:|:[:]:|:View Profile</title>
	</head>
	<body>
		<?php
			require 'mismatch_header.php';
			require 'mismatch_navbar.php';
			define('GW_UPLOADPATH', 'Image/');
			$username = $_SESSION['username'];
			//Database Connection
			$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');
			$sql = " SELECT * FROM user_info WHERE username = '$username'";
			$result = mysqli_query($dbc, $sql);
			if (mysqli_num_rows($result) == 1) {
				echo "<table>";
				while ($row = mysqli_fetch_array($result)) {
				# code...
					echo "<tr><td><hr></tr></td>";
					echo '<tr><td><img src="' . GW_UPLOADPATH . $row['profile_pic'] . '" alt="Score image" /></td></tr>';
					echo "<tr><td>Name ".$row['first_name']." ".$row['last_name']."</td></tr>";
					echo "<tr><td>Gender ".$row['gender']."</td></tr>";
					echo "<tr><td>Birth Date ".$row['birth_date']."</td></tr>";
					echo "<tr><td>City ".$row['city']."</td></tr>";
					echo "<tr><td>State ".$row['state']."</td></tr>";
			}
	}
		?>
	</body>
</html>