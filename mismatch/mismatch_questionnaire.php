<?php
	session_start();
?>
<html>
	<!-- Head Start -->
	<HEAD>
		<title>
			MisMatch:|:[:]:|:Questionnaire
		</title>
	</HEAD>
	<!-- Body Start -->
	<body>
		<!-- PHP script start -->
		<?php
			require 'mismatch_header.php';
			require 'mismatch_navbar.php';
			if (!isset($_SESSION['user_id'])) {
				# code...
				echo "Please <a href='mismatch_cookie_login.php'>Login</a> to view this page";
				exit();
			}
			//CONNECT TO DATABASE
			$dbc = mysqli_connect('localhost', 'root', 'root', 'mismatch_user');

			//if this user has never answered the questionnaire, insert empty responses into the database

			$u_Id = $_SESSION['user_id'];
			$query = "SELECT * FROM mismatch_response where Id = '$u_Id'";
			$data = mysqli_query($dbc, $query);
			
			if (mysqli_num_rows($data)==0) {
				# code...
				$query = "SELECT topic_id FROM mismatch_topic ORDER BY category_id, topic_id";
				$data = mysqli_query($dbc, $query);
				$topicIDs = array();
				while ($row=mysqli_fetch_array($data)) {
				# code...
					array_push($topicIDs, $row['topic_id']);
				}
				
				//enter empty response row into the response table, one per topic
				foreach ($topicIDs as $topicID) {
					# code...
					$query = "INSERT INTO mismatch_response (Id, topic_id) VALUES ('$u_Id', '$topic_id')";
					mysqli_query($dbc, $query);
				}
			}

				// If the questionnaire form has been submitted, write the form responses to the database
				if (isset($_POST['submit'])) {
					// Write the questionnaire response rows to the response table
				 	foreach ($_POST as $response_id => $response) {
						$query = "UPDATE mismatch_response SET response = '$response' WHERE response_id = '$response_id'";
						mysqli_query($dbc, $query);
					}
					echo '<p>Your responses have been saved.</p>';
				}

				// Grab the response data from the database to generate the form
				$query = "SELECT response_id, topic_id, response FROM mismatch_response WHERE Id = '$u_Id'";
				$data = mysqli_query($dbc, $query);
				$responses = array();
				while ($row = mysqli_fetch_array($data)) {
					// Look up the topic name for the response from the topic table
					$query2 = "SELECT name, category_id FROM mismatch_topic WHERE topic_id = '" . $row['topic_id'] . "'";
					$data2 = mysqli_query($dbc, $query2);
					if (mysqli_num_rows($data2) == 1) {
						$row2 = mysqli_fetch_array($data2);
						$row['topic_name'] = $row2['name'];
						$row['category_name'] = $row2['category'];
						array_push($responses, $row);
					}
				}
		?>
		<fieldset>
			<legend>Appearance</legend>
			<table width="40%">
				
				<tr>
					<td>
						<label><b>Tattoos</b></label>
					</td>

					<td>
						Love:<input type="radio" value="1" name="tattoo">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="tattoo">
					</td>
				</tr>

				<tr>
					<td>
						<LABEL><b>Gold Chains</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="goldchains">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="goldchains">
					</td>

				</tr>

				<tr>
					
					<td>
						<LABEL><b>Body Piercing</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="piercing">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="piercing">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Cowboy Boots</b></LABEL>
					</td>
				
					<td>
						Love:<input type="radio" value="love" name="boots">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="boots">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Long Hair</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="hair">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="hair">
					</td>

				</tr>
			</table>
		</fieldset>

		<fieldset>
			<legend>Entertainment</legend>
			<table width="33%">
				
				<tr>
					<td>
						<label><b>Reality TV</b></label>
					</td>

					<td>
						Love:<input type="radio" value="1" name="realitytv">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="realitytv">
					</td>
				</tr>

				<tr>
					<td>
						<LABEL><b>Professional Wrestling</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="wrestling">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="wrestling">
					</td>

				</tr>

				<tr>
	
					<td>
						<LABEL><b>Horror Movies</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="movies">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="movies">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Easy Listening Music</b></LABEL>
					</td>
				
					<td>
						Love:<input type="radio" value="1" name="music">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="music">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>The Opera</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="opera">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="opera">
					</td>

				</tr>
			</table>
		</fieldset>

		<fieldset>
			<legend>Food</legend>
			<table width="46%">
				
				<tr>
					<td>
						<label><b>Sushi</b></label>
					</td>

					<td>
						Love:<input type="radio" value="1" name="sushi">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="sushi">
					</td>
				</tr>

				<tr>
					<td>
						<LABEL><b>Spam</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="spam">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="spam">
					</td>

				</tr>

				<tr>
					
					<td>
						<LABEL><b>Spicy Food</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="spicy">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="spicy">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Sandwich</b></LABEL>
					</td>
				
					<td>
						Love:<input type="radio" value="1" name="sandwich">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="sandwich">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Martinis</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="martinis">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="martinis">
					</td>

				</tr>
			</table>
		</fieldset>
		
		<fieldset>
			<legend>People</legend>
			<table width="43.5%">
				
				<tr>
					<td>
						<label><b>H. Stern</b></label>
					</td>

					<td>
						Love:<input type="radio" value="1" name="hstern">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="hstern">
					</td>
				</tr>

				<tr>
					<td>
						<LABEL><b>B. Gates</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="bgates">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="bgates">
					</td>

				</tr>

				<tr>
					
					<td>
						<LABEL><b>B. Streisand</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="streisand">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="streisand">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>H. Hefner</b></LABEL>
					</td>
				
					<td>
						Love:<input type="radio" value="1" name="hefner">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="hefner">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>M. Stewart</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="stewart">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="stewart">
					</td>

				</tr>
			</table>
		</fieldset>
		
		<fieldset>
			<legend>Activities</legend>
			<table width="42%">
				
				<tr>
					<td>
						<label><b>Yoga</b></label>
					</td>

					<td>
						Love:<input type="radio" value="1" name="yoga">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="yoga">
					</td>
				</tr>

				<tr>
					<td>
						<LABEL><b>Weightlifting</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="weightlifting">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="weightlifting">
					</td>

				</tr>

				<tr>
					
					<td>
						<LABEL><b>Cube puzzles</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="puzzles">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="puzzles">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Karaoke</b></LABEL>
					</td>
				
					<td>
						Love:<input type="radio" value="1" name="karaoke">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="karaoke">
					</td>

				</tr>

				<tr>

					<td>
						<LABEL><b>Hiking</b></LABEL>
					</td>

					<td>
						Love:<input type="radio" value="1" name="hiking">
					</td>
					
					<td>
						Hate:<input type="radio" value="2" name="hiking">
					</td>

				</tr>
			</table>
		</fieldset>
		<input type="submit" value="Save Questionnaire" name="submit" />
	</body>
</html>