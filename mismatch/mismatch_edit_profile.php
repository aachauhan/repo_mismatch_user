<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>MisMatch:|:[:]:|:Edit Profile</title>
</head>
	<body>
		<?php
			//header and Nav bar
			require 'mismatch_header.php';
			require 'mismatch_navbar.php';
			//define
			define('GW_UPLOADPATH', 'Image/');
			$uid = $_SESSION['user_id'];
			
			if (isset($_POST['submit'])) {
				# code...
				$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');
				$firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
				$lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
				$birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
				$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
				$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
				/*$old_picture = mysqli_real_escape_string($dbc, trim($_POST['old_picture']));*/
	    		$new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
	    		$new_picture_type = $_FILES['new_picture']['type'];
	    		$target = GW_UPLOADPATH . $new_picture;

	    		//move and upoad new profile picture
	    		if (!empty($new_picture)) {
	    			# code...
	    			if ($new_picture_type == 'image/jpeg' || $new_picture_type == 'image/png' || $new_picture_type == 'image/gif') {
	    				# code...
	    				$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');
	    				$img = move_uploaded_file($_FILES['new_picture']['tmp_name'], $target);
	    				$query = "UPDATE user_info SET first_name = '$firstname', last_name = '$lastname', birth_date = '$birthdate', city = '$city', state = '$state' profile_pic = '$new_picture' where Id = '$uid'";
	    				mysqli_query($dbc, $query, $img);
	    				echo "Data is updated with Profile Picture";
	    			}
	    			else{
	    				echo "Only JPEG, PNG, GIF files are supported";
	    			}
	    		}
	    		
	    		else{
	    			$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');
	    			echo $firstname;
	    			$sql = "UPDATE user_info SET first_name = '$firstname', last_name = '$lastname', birth_date = '$birthdate', city = '$city', state = '$state' WHERE Id = '$uid'";
	    			mysqli_query($dbc, $sql);
	    			echo "Only data is updated";
	    		}
				/*$firstname = '';
				$lastname = '';
				$birthdate = '';
				$city = '';
				$state = '';*/
	    	}
		?>
		
		<!-- Form start -->
		<form enctype="multipart/form-data" method = "post" action = "<?PHP echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>Edit Personal Information</legend>
					<label for = "firstname">Firstname</label>
						<input type = "text" name = "firstname" value = "<?php if (!empty($firstname)) echo $firstname; ?>" /><br />
					<label for = "lastname">Lastname</label>
						<input type = "text" name = "lastname" value = "<?php if (!empty($lastname)) echo $lastname; ?>" /><br />
					<label for = "birthdate" >Birthdate</label>
						<input type = "text" name = "birthdate" value = "<?php if (!empty($birthdate)) echo $birthdate; ?>" /><br />
					<label for = "city">City</label>
						<input type = "text" name = "city" value = "<?php if (!empty($city)) echo $city; ?>" /><br />
					<label for = "state">State</label>
						<input type = "text" name = "state" value = "<?php if (!empty($state)) echo $state; ?>" /><br />
					<label for = "new_picture">New Picture</label>
						<input type = 'file' name = 'new_picture'><br />
			</fieldset>
			<input type = 'submit' name = 'submit' value = "submit">
		</form>
		<a href="mismatch_index.php">Index</a>
	</body>
</html>