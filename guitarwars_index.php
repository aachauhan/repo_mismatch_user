<html>
	<!-- Head -->
	<head>
		<title>Guitar wars</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<!-- Body -->
	<body>
		<h2>Welcome Guitar warriors, If you have something to beat these score then post it <a href="guitarwars_addscore.php">here</a>.</h2>
		<hr>
		<?php
			define('GW_UPLOADPATH', 'Image/');
			//connect to database..
			$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Eror connecting to DATABASE');
			//reterive the data..
			$query = "SELECT * FROM guitarwars WHERE approved = '1' ORDER BY score DESC, name ASC";
			$result = mysqli_query($dbc, $query);
			$i = 0;

			echo "<table>";

			while ($row = mysqli_fetch_array($result)) {
				if ($i==0) {
					echo "<tr><td class='topscoreheader'>Top Score: ".$row['score'];

				}
				echo "<tr>";
				echo "<td>";
				echo "Score ".$row['score']."<br>";
				echo "Name: ".$row['name']."<br>";
				echo "Id: ".$row['id']."<br>";
				echo "date ".$row['date']."<br>";
				echo "screenshot ".$row['screenshot']."<br>";
				echo '<img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" /></td></tr>';
				$i++;
			}

			echo "</table>";
			mysqli_close($dbc);
		?>
	</body>
</html>