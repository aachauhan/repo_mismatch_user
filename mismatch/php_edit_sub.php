<?php
			define('GW_UPLOADPATH', 'Image/');
			
			$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');
			$sql = " SELECT * FROM user_info WHERE username = '$username'";
			$result = mysqli_query($dbc, $sql);
			if (mysqli_num_rows($result) == 1) {
			
				while ($row = mysqli_fetch_array($result)) {
				# code...
					echo '<tr><td><img src="' . GW_UPLOADPATH . $row['profile_pic'] . '" alt="Score image" /></td></tr>';
					$firstname = $row['first_name'];
					$lastname = $row['last_name'];
					$birthdate = $row['birth_date'];
					$city = $row['city'];
					$state = $row['state'];
				}
			}
		?>