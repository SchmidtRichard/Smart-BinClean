<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

<?php

//Takes the id parameter from monitoring_admin.php
$id = $_POST['id'];

//Info for DB to stabiblish the connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Open connectivity between PHP and DB
$conn = new mysqli($servername, $username, $password, $dbname);

//Query if the ID exist in order to be updated or not
$sql = "SELECT * FROM realtime WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows != 0)
{

	//Delete bin based on id
	$sql = "DELETE FROM realtime WHERE id = '$id'";

	if ($conn->query($sql) === TRUE) {
		echo '<h1>Bin ' . $id. ' has deleted successfully!</h1>';
			echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';
			exit;
		}
}

else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	  echo "<h1><p style=\"color:red;\">ID does not exist in database!</p></h1>
				Please choose another ID!";
		echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';//Sends back to monitoring_admin.php
		exit;
}
//Close the connection
$conn->close();
?>
