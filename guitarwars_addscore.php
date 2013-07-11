<!DOCTYPE html>
<html>
  <!-- Head -->
  <head><title>Guitar Wars</title></head>

  <!-- Body -->
  <body>
    <?php

    define('GW_UPLOADPATH', 'Image/');

      if (isset($_POST['submit'])) {
        
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screenshot = $_FILES['screenshot']['name'];
        $screenshot_type = $_FILES['screenshot']['type'];
        $target = GW_UPLOADPATH . $screenshot;
        $approved = '0';

        //validation
        if (!empty($name) && !empty($score) && is_numeric($score) && !empty($screenshot)) {
          if ($screenshot_type == 'image/gif' || $screenshot_type == 'image/jpeg' || $screenshot_type == 'image/png') {
            # code...
          $img = move_uploaded_file($_FILES['screenshot']['tmp_name'], $target);
          echo $screenshot_type;
          
            //connection
          $dbc = mysqli_connect('localhost', 'root', 'root', 'guitarwars') or die('Error connecting to DATABASE');
          $sql = "INSERT INTO guitarwars VALUES (0, now(), '$name', '$score', '$screenshot', '$approved')";
          mysqli_query($dbc, $sql, $img);

          //Confirmation
            echo "Thanks for adding your score ".$name."<br>"." Your score is ".$score."<br>"."Go back to <a href='guitarwars_index.php'>High scores</a>"." Your screenshot "."<br>".'<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score image" />';
        }
        else{
          echo "File type not supported. Only JPEG, PNG, GIF files are supported";
        }
      }
        
        else{
          echo "Please Enter all the information correctly";
        }

        $name="";
        $score="";
        $screenshot="";
/*        mysqli_close($dbc);*/
      
      }
    ?>
    
    <hr>
    <form enctype="multipart/form-data" method = "Post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for = "name">Name:</label><input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
      <label for = "score">Score:</label><input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
      <label for = "screenshot">Screenshot:</label><input type="file" id="screenshot" name="screenshot" /><br />
      <input type="submit" value="Add" name="submit" />
    </form>
    <hr>
    <hr>

  </body>
</html>