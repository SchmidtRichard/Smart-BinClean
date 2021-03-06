<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

<?php

//POST method to get the info sent from the modal to this page
$id = $_POST['id'];
$type=$_POST['type'];
$location=$_POST['location'];

// The necessary info to connect to the DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

if ($id<>0)
{
	// Open connectivity between PHP and DB
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	date_default_timezone_set("Europe/Dublin");
	$date = date('Y-m-d H:i:sP');

	//Insert the new bin (id, location, status, and date) into the DB and set the bin as empty at first
	$sql = "INSERT INTO realtime (id,type,location,image,issue,date) VALUES ('$id','$type','$location','empty','','$date');";

	// Header for the message after insertion into the DB
	echo"<header><h1>";

	if ($conn->query($sql) === TRUE) {
		echo "<h1>New bin record successfully recorded in DB!</h1>";
		echo '<meta http-equiv="refresh" content="1; URL=/admin/monitoring_admin.php"/>';
		exit;
	} else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
		  echo "<p style=\"color:red;\">ID already exist in database!</p>
					<br>Please choose another ID!";
			echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';
			exit;
	}
}
else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
		  echo "<p style=\"color:red;\">Please choose another ID</p>";
			echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';
			exit;
}

echo"</h1></header>";

$conn->close();//Close connectivity between PHP and DB
$url='/index.php';
echo '<META HTTP-EQUIV=REFRESH CONTENT="3; '.$url.'">';//Waits 3 seconds after insertion and sends user back to index.php
?>
