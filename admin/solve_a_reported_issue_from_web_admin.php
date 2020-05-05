<?php

//Takes the info from monitoring_admin.php
$id = $_POST['id'];
$issue = $_POST['issue'];

//Info for DB connectivity
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Checks if id exists
$sql = "SELECT * FROM realtime WHERE id='$id'";	
$result = $conn->query($sql);

//Checks if id exists
if ($result->num_rows != 0)
{
	if ($issue==='yes')
	{
	//Delete issue based on id
		$sql = "UPDATE realtime SET issue = '' WHERE id = '$id';";

		if ($conn->query($sql) === TRUE) {
			echo '<h1>Issue at bin ' . $id. ' has been marked as been solved!</h1>';
				echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
				exit;
			}
	}	
	
	if ($issue==='no')
	{
			//If issue has not been address, keeps it as it is
			echo '<h1>You\'ve specified that the issue is not solved!</h1>';
			echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
			exit;
		}
}		

//Error if ID does not exist
else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	  echo "<h1><p style=\"color:red;\">ID does not exist in database!</p></h1>	
				Please choose another ID!";
		echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';
		exit;
}
//Close connection with DB
$conn->close();
?>