<?php
		//Interacts with the Python resp library in order to update the status of the bins displayed on the page using the IP address and the URL

		//Using get or post methods, we took the information from URL, based on parameters below: id and image, in order to update the DB from Raspberry with the python code
		//using http://SERVER IP/admin/update_with_raspberry.php?id=2&image=full

		function getParameter($par, $default = null){
			if (isset($_GET[$par]) && strlen($_GET[$par])) return $_GET[$par];
			elseif (isset($_POST[$par]) && strlen($_POST[$par]))
				return $_POST[$par];
			else return $default;
		}

//the parameters the php expect to be seen in the URL.
// & - ampersand - used to separate the parameters

$id = getParameter("id");
$image = getParameter("image");

//information for connecting to DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

// Create connection
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
