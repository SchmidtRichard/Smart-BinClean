<?php
session_start();

?>
<?php

if (($_SESSION['youarelogged'])==FALSE)
{
	if (($_SESSION['youareloggedasadmin'])==TRUE)
	{
		echo'
<html lang="en" dir="ltr">

<head>

    <title>Home | BinSmart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
		<style>

			body {
				font-family: Arial, Helvetica, sans-serif;
			}

			.navbar {
				width: 100%;
				text-align: center;
				background-color: #555;
				overflow: auto;
			}
	
	
			.navbar a {
				float: left;
				padding: 12px;
				color: white;
				text-decoration: none;
				font-size: 17px;
			}

			@media screen and (max-width: 700px) {
				.navbar a {
					float: none;
					display: block;
				}
			}

			.row {
				display: flex;
				flex-wrap: wrap;
				padding: 0 4px;
				padding-left: 30px;
			}
			/* Create two equal columns that sits next to each other */

			.column {
				flex: 50%;
				padding: 0 4px;
				padding-left: 30px;
			}	

		</style>

</head>
<body>

    <div class="navbar"><!-- Create the nav on the top -->
	
			<a href="/admin/monitoring_admin.php">
				<i class="fa fa-fw fa-home; glyphicon glyphicon-home"></i><b>Home</b>
			</a>

			<a href="/admin/index_empty_admin.php"><!-- Redicrects to empty -->
				<i class="fa fa-fw fa-search; glyphicon glyphicon-trash"></i>Empty</b>
			</a>

			<a href="/admin/index_half_admin.php"><!-- Redicrects to half full -->
				<i class="fa fa-fw fa-envelope; glyphicon glyphicon-trash"></i>Half-Full</b>
			</a>

			<a href="/admin/index_full_admin.php"><!-- Redicrects to full -->
				<i class="fa fa-fw fa-user; glyphicon glyphicon-trash"></i>Full</b>
			</a>
			<div class="pull-right"><a href="/admin/user_registration/logout.php"><!-- Redicrects to logout -->
					<i class="fa fa-fw fa-user; glyphicon glyphicon-log-out"></i>Logout</b>
				</a></div>

    </div>
    <h1 align="center">
         <font size="6">Half Bins</font>
      </h1>
</body>
</html>';

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

	$sql = "SELECT * FROM realtime WHERE image=\"half\" ORDER BY id ";
    $result = $conn->query($sql);



	echo '<div class="column"><div class="row">';
	echo '<table border="0" width="100%" cellspacing="0" cellpadding="0">';

	$count = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
			$count++;

			//Put int each variable the info taken from the DB for each index number
			$id=$row["id"];
			$type=$row["type"];
			$img=$row["image"];
			$location=$row["location"];
			$issue=$row["issue"];
			$date_variable=$row["date"]; // add date to variable

      //Prints what is in the DB into the page for the specific ID number
			echo '<td><img src="/images/'.$img.'.png">';
			echo '<p align="left">Id: '. $id .'</p>';
			echo '<p align="left">Type: '. $type .'</p>';
			echo '<p align="left">Address: '. $location .'</p>';
			if ($issue)
					echo '<p align="left"><b>Issues: </b><a style="color:red">'. $issue .'</a></p>';
				else
					echo '<p align="left">Issues: none</p>';
			echo '<p align="left">'. $date_variable .'</p></td>';

      //Divide the number of bins by 4 to display 4 for each row on the page

			if ( ($count % 4) === 0 )
			  {
				 echo '</tr></div><div class="row"><tr>';
			  }
        }


    }
	else {
        echo "0 results";
		}
    echo "</div></table>";
	$conn->close();
}
}
else
{
	echo ('<h1>You\'re not the ADMIN</h1>');
	echo '<meta http-equiv="refresh" content="2; URL=/admin/user_registration/logout.php"/>'; //Logs user out when trying to access a not authorized URL
}
?>
<html>
	<head>
		<script type="text/JavaScript">
			function timedRefresh(timeoutPeriod) {
				setTimeout("location.reload(true);",timeoutPeriod);
			}
		</script>
	</head>
	<body onload="JavaScript:timedRefresh(8000);"></body>
</html>
