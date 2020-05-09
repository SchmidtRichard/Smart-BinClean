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

// The necessary info to connect to the DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
if ($id)
{
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Select all based on the id
	$sql = "SELECT * FROM realtime WHERE id='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows != 0)
	{

		//Delete issue based on id
			$sql = "UPDATE realtime SET issue = '' WHERE id = '$id';";

			if ($conn->query($sql) === TRUE) {
				echo '<h1>Issue at bin ' . $id. ' has been marked as been solved!</h1>';
					echo '<meta http-equiv="refresh" content="2; URL=/admin/monitoring_admin.php"/>';//Logs user out when trying to access a not authorized URL
					exit;
				}
	}

	else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
		  echo "<h1><p style=\"color:red;\">ID does not exist in database!</p></h1>
					Please choose another ID!";
			echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';//Logs user out when trying to access a not authorized URL
			exit;
	}
}
else
{
	echo "<h1><p style=\"color:red;\">Please complete the ID field!</p></h1>";
			echo '<meta http-equiv="refresh" content="3; URL=/admin/monitoring_admin.php"/>';//Logs user out when trying to access a not authorized URL
			exit;
}
$conn->close();
?>
