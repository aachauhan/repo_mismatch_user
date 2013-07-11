<?php
		//------------------------------------------------------------
		
		$dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Error connecting to DATABASE');
		$sql = "INSERT INTO guitarwars VALUES (0, now(), '$name', '$score', '$screenshot', '$approved')";
		mysqli_query($dbc, $sql, $img);
		
		//------------------------------------------------------------

		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
        $screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
        $screenshot_type = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['type']));
        $target = GW_UPLOADPATH . $screenshot;
        $approved = '0';
?>