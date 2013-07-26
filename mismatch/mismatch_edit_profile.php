<?php
	require_once 'mismatch_login.php';
?>
<html>
	<head>
		<title>MisMatch:|:[:]:|:Register</title>
	</head>
	<!-- Body START -->
	<body>
		<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<table>
				<th><h3>Personal Information</h3></th>
					
					<section>
						<tr>
							<td>
								<label for="fname">First Name: </label>
							</td>
							<td>
								<?php $dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user'); $sql = " SELECT * FROM user_info WHERE username = '$username'"; $result = mysqli_query($dbc, $sql); if (mysqli_num_rows($result) == 1) { while ($row = mysqli_fetch_array($result)) { $firstname = $row['first_name']; } } echo "<input type='text' name='first_name' value = '$firstname' /><br>"; ?>
							</td>
						</tr>

						<tr>
							<td>
								<label for="lname">Last Name: </label>
							</td>
							<td>
								<?php $dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user'); $sql = " SELECT * FROM user_info WHERE username = '$username'"; $result = mysqli_query($dbc, $sql); if (mysqli_num_rows($result) == 1) { while ($row = mysqli_fetch_array($result)) { $lastname = $row['last_name']; } } echo "<input type='text' name='last_name' value = '$lastname' /><br>"; ?>
							</td>
						</tr>
					
						<tr>
							<td>
								<label for="birth_date">Birth-Date (mm/dd/yyyy): </label>
							</td>
							<td>
								<?php $dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user'); $sql = " SELECT * FROM user_info WHERE username = '$username'"; $result = mysqli_query($dbc, $sql); if (mysqli_num_rows($result) == 1) { while ($row = mysqli_fetch_array($result)) { $birthdate = $row['birth_date']; } } echo "<input type='text' name='birth_date' value = '$birthdate' /><br>"; ?>
							</td>
						</tr>

						<tr>
							<td>
								<label for="city">City: </label>
							</td>
							<td>
								<?php $dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user'); $sql = " SELECT * FROM user_info WHERE username = '$username'"; $result = mysqli_query($dbc, $sql); if (mysqli_num_rows($result) == 1) { while ($row = mysqli_fetch_array($result)) { $city = $row['city']; } } echo "<input type='text' name='city' value = '$city' /><br>"; ?>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="state">State: </label>
							</td>
							<td>
								<?php $dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user'); $sql = " SELECT * FROM user_info WHERE username = '$username'"; $result = mysqli_query($dbc, $sql); if (mysqli_num_rows($result) == 1) { while ($row = mysqli_fetch_array($result)) { $state = $row['state']; } } echo "<input type='text' name='state' value = '$state' /><br>"; ?>
							</td>
						</tr>

						<tr>
							<td>
								<label for="profile_pic">Upload your picture: </label>
							</td>
							<td>
								<input type="file" name="profile_pic" /><br>
							</td>
						</tr>
						
						<tr>
							<td><input type="submit" value="Submit" name="submit" /></td>
						</tr>
					</section>
			</table>
		</form>

		<!-- PHP Scipt START -->
		<?php
		require 'php_edit_sub.php';
		?>
		Go to <a href="mismatch_index.php">Index</a>.
	</body>
</html>
