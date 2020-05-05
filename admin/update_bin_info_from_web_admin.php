<?php

//Gets the info sent from monitoring_admin.php modal
$id = $_POST['id'];
$type=$_POST['type'];
$location=$_POST['location'];

//Connect to DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Query if the ID exist in order to be updated or not
$sql = "SELECT * FROM realtime WHERE id='$id'";	
$result = $conn->query($sql);

if ($result->num_rows != 0)	
{
	if ($id & $location & $type)
	{
		//Query to update the type and location based on id of an individual bin
		$sql = "UPDATE realtime SET type = '$type' , location = '$location' WHERE id = '$id';";

		if ($conn->query($sql) === TRUE) {
			echo '<h1>Bin ' . $id. ' has updated successfully with its type and location</h1>';
			echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
			exit;
		} 
	}
		else
		{
				//Query to update the type based on id of an individual bin
				$sql = "UPDATE realtime SET type = '$type' WHERE id = '$id';";
			
				if ($conn->query($sql) === TRUE) {
				echo '<h1>Bin <a style="color:red">' . $id. '</a> has updated successfully with <a style="color:red">' .$type.' </a>type</h1>';
				echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
				exit;
				}
		}
}
//Error if the ID does not exist, sends back to the page where user was
else {
    echo '<h1>The chosen bin ID ' . $id. ' is not recorded in DB!</h1>';
	echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';
	exit;
}

//Close connection
$conn->close();
?>