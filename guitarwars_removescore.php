<?php
	
	require_once 'auth_file.php';

?>
<html>
	<head><title>Guitar Wars</title></head>
	<body>
		<?php
			$id = $_GET['id'];
			echo $id;
			$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Error connecting to DATABASE');
			$sql = "DELETE FROM guitarwars WHERE id = $id";
			mysqli_query($dbc, $sql);
			echo "DELETED Successfully <br>";
			echo "<a href='guitarwars_admin.php'><< BACK to Admin page</a>";
		?>
	</body>
</html>