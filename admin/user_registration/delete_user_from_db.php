<?php
//takes the info from monitoring_admin.php modal
$usr = $_POST['username'];
$email = $_POST['email'];

//info for DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//if the field with username has been completed, it moves on
$sql = "SELECT * FROM users WHERE username='$usr'&& email = '$email'";	
$result = $conn->query($sql);
	
if ($result->num_rows != 0)
{
			//Delete username based on id
		$sql = "DELETE FROM users WHERE username = '$usr' && email = '$email'";

		if ($conn->query($sql) === TRUE) {
			echo '<h1>The user ' . $usr. ' has been deleted successfully!</h1>';
				echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
				exit;
			}	
}
	
else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			  echo "<h1><p style=\"color:red;\">The username/email adress does not exist in database!</p></h1>	
						Please choose another username or email adress!";
				echo '<meta http-equiv="refresh" content="5; URL=/admin/monitoring_admin.php"/>';
				exit;
		}
$conn->close();
?>