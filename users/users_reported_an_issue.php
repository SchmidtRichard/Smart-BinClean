<?php
//toook the data from monotoring.php modal
$id = $_POST['id'];
$issue=$_POST['issue'];

//set info for DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Select from DB the id in order to check if this exist
$sql = "SELECT * FROM realtime WHERE id='$id'";	
$result = $conn->query($sql);
	
if ($result->num_rows != 0)	 //if id exists, move on
{
	if ($issue) //if the issue has been completed
	{
		//Update DB with the issue
		$sql = "UPDATE realtime SET issue = '$issue' WHERE id = '$id';";

		if ($conn->query($sql) === TRUE) {
			echo '<h1>Your issue for bin ' . $id. ' has reported successfully</h1>';
			echo '<meta http-equiv="refresh" content="2; URL=/users/monitoring.php"/>';
			exit;
		} 
	}
	else // the issue missing from the field
	{
		echo '<h1>Please type the issue!</h1>';
		exit;
	} 
}
else { //There is no id as been specified, in the DB.
    echo '<h1>The chosen bin ID ' . $id. ' is not recorded in DB!</h1>';
	echo '<meta http-equiv="refresh" content="3; URL=/users/monitoring.php"/>';
	exit;
}
//close connection DB
$conn->close();
?>