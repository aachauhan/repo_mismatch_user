<?php
	
	require_once 'auth_file.php';

?>
<html>
	<head><title>Guitar Wars</title></head>
	<body>
		<section>
			<h2>Guitar Wars :: Admin Page</h2>
		</section>
		<hr>
		<section>
			<h3>Maually Delete Scores</h3>
			<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method = "get">
				<label for = "id">ID:</label><input type = "TEXT" name = "id"><br>
				<input type = "submit" value = "DELETE" name = "submit">
			</form>
		</section>
		<?php
			define('GW_UPLOADPATH', 'Image/');
			$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Error connecting DATABASE');
			$sql = "SELECT * FROM guitarwars";
			$result = mysqli_query($dbc, $sql);

			echo "<table>";
			while ($row = mysqli_fetch_array($result)){
				# code...
				echo "<tr><td><hr></td><tr>";
				echo "<tr><td>NAME ".$row['name']."<br></td>";
				echo "<td>SCORE ".$row['score']."<br></td>";
				echo "<td>Approvel Status ".$row['approved']."<br></td>";
				echo "<td>ID ".$row['id']."<br></td></tr>";
				echo '<tr><td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" /></td></tr>';
				echo '<tr><td><a href="guitarwars_removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . $row['approved'] . '">Remove</a></td>';
				echo '<td><a href="guitarwars_approved.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . $row['approved'] . '">Approve</a></td></tr>';
			}
			echo "</table>";
			mysqli_close($dbc);
		?>
		<!-- php -->
		<?php
			$id = $_GET['id'];
			if (!empty($id)) {
				# code...
				$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Error connecting to DATABASE');
				$sql = "DELETE FROM guitarwars WHERE id = $id";
				mysqli_query($dbc,$sql);
				echo " DELETED Successfully <br>";
			}
			else{
				echo "Id field is empty";
			}
		?>
	</body>
</html>