<html>
	<head>
		<title>MisMatch:|:[:]:|:Register</title>
	</head>
	<!-- Body START -->
	<body>
		<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<table>
				<th><h3>Rgisteration Information</h3></th>
					<section>
						<tr>
							<td>
								<label for="username">Username: </label>
							</td>
							<td><input type="text" name="uname" /><br>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="upass">Password: </label>
							</td>
							<td>
								<input type="password" name="upass" /><br>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="rupass">Re-Password: </label>
							</td>
							<td>
								<input type="password" name="rupass" /><br>
							</td>
						</tr>
					</section>

				<th><h3>Personal Information</h3></th>
					
					<section>
						<tr>
							<td>
								<label for="fname">First Name: </label>
							</td>
							<td>
								<input type="text" name="fname" /><br>
							</td>
						</tr>

						<tr>
							<td>
								<label for="lname">Last Name: </label>
							</td>
							<td>
								<input type="text" name="lname" /><br>
							</td>
						</tr>

						<tr>
							<td>
								<label for="gender">Gender: </label>
							</td> 
							<td>
								Male<input type="radio" name="gender" value="M" checked="checked" /> Female<input type="radio" name="gender" value="F" /><br>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="birth_date">Birth-Date (mm/dd/yyyy): </label>
							</td>
							<td>
								<input type="Date-local" name="birth_date" /><br>
							</td>
						</tr>

						<tr>
							<td>
								<label for="city">City: </label>
							</td>
							<td>
								<input type="text" name="city" /><br>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="state">State: </label>
							</td>
							<td>
								<input type="text" name="state" /><br>
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
		define('GW_UPLOADPATH', 'Image/');
		if (isset($_POST['submit'])) {
			# code...
			$uname = $_POST['uname'];
			$password = $_POST['upass'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$gender = $_POST['gender'];
			$birth_date = $_POST['birth_date'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$profile_pic = $_FILES['profile_pic']['name'];
			$profile_pic_type = $_FILES['profile_pic']['type'];
			$target = GW_UPLOADPATH . $profile_pic;

			if (!empty($uname) || !empty($password) || !empty($fname) || !empty($lname) || !empty($gender) || !empty($birth_date) || !empty($city) || !empty($state) || !empty($profile_pic) || $password == $_POST['rupass']) {
				//check if username is unique
				$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user')or die('ERROR CONNECTING DATABASE');
				$query = "SELECT * FROM user_info where username = '$uname'";
				$data = mysqli_query($dbc, $query);
				if (mysqli_num_rows($data) == 0) {

					if ($profile_pic_type == 'image/gif' || $profile_pic_type == 'image/jpeg' || $profile_pic_type == 'image/png') {
						# code...
						$img = move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);

						//connection
						/*$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user')or die('ERROR CONNECTING DATABASE');*/
						$sql = "INSERT INTO user_info VALUES (0, now(), '$fname', '$lname', '$gender', '$birth_date', '$city', '$state', '$profile_pic', SHA('$password'), '$uname')";
						$res = mysqli_query($dbc, $sql, $img);

						//confimation
							
					}
					# code...
					else{
						echo "Enter all the information correct";
					}
				}
					else{
						echo "Username is taken try Again";
					}
			}
			else{
				echo "Enter all the information correct";
			}

			$uname = "";
			$password = "";
			$fname = "";
			$lname = "";
			$gender = "";
			$birth_date = "";
			$city = "";
			$state = "";
			$profile_pic = "";
		}
		?>
		Go to <a href="mismatch_index.php">Index</a>.
	</body>
</html>