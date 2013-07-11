<html>
	<head>
		<title>Guitar Wars</title>
	</head>
	<body>
		<?php
		$id = $_GET['id'];
		$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars');
		$sql = "UPDATE  `guitarwars`.`guitarwars` SET  `approved` =  '1' WHERE  `guitarwars`.`id` = $id";
		$result = mysqli_query($dbc, $sql);
		echo $id." is updated successfully";
		?>
	</body>
</html>