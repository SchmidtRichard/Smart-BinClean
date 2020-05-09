<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

<?php
		//Interacts with the Python resp library in order to update the status of the bins displayed on the page using the IP address and the URL
		//Using get or post methods, we took the information from URL, based on parameters below: id and image, in order to update the DB from Raspberry with the python code
		//using http://SERVER IP/admin/update_with_raspberry.php?id=2&image=full


		//If there is any parameter like id=2 or image=full
		//Defaul gets null, returning nothing (nothing has been detected in the paramenters of the PHP url)

		//Example from the python code ---> resp=req.get("IP/admin/update_with_raspberry.php?id=%d&image=half" % trash_id)
		function getParameter($par, $default = null){
			if (isset($_GET[$par]) && strlen($_GET[$par])) return $_GET[$par];//Return the parameter
			elseif (isset($_POST[$par]) && strlen($_POST[$par]))//Return the same parameter
				return $_POST[$par];
			else return $default;
		}

//the parameters the php expect to be seen in the URL.
// & - ampersand - used to separate the parameters
$id = getParameter("id");
$image = getParameter("image");

// The necessary info to connect to the DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

//Open connectivity between PHP and DB
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Query to update the image status taken from the Python code
$sql = "UPDATE realtime SET image = '$image' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
