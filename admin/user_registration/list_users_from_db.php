<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

	<html lang="en" dir="ltr">

	<head>

		<title>List Users | BinSmart</title>
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
		</style>

	</head>
	<body>

		<div class="navbar"><!-- Create the nav on the top -->

				<a href="/admin/monitoring_admin.php">
					<i class="fa fa-fw fa-home; glyphicon glyphicon-home"></i><b> Home</b>
				</a>

				<a href="/admin/index_empty_admin.php"><!-- Redicrects to empty -->
					<i class="fa fa-fw fa-search; glyphicon glyphicon-trash"></i> Empty</b>
				</a>

				<a href="/admin/index_half_admin.php"><!-- Redicrects to half full -->
					<i class="fa fa-fw fa-envelope; glyphicon glyphicon-trash"></i> Half-Full</b>
				</a>

				<a href="/admin/index_full_admin.php"><!-- Redicrects to full -->
					<i class="fa fa-fw fa-user; glyphicon glyphicon-trash"></i> Full</b>
				</a>

				<div class="pull-right"><a href="/admin/user_registration/logout.php"><!-- Redicrects to logout -->
					<i class="fa fa-fw fa-user; glyphicon glyphicon-log-out"></i> Logout</b>
				</a></div>

			  <!-- Button to Open the Modal -->
			  <div class="pull-right"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete existing user</button></div>

			  <!-- The Modal -->
			  <div class="modal" id="deleteModal">
				<div class="modal-dialog">
				  <div class="modal-content">

					<!-- Modal body -->
					<div class="modal-body">
					  <h3 align="left">Delete user form:</h3>

								<form action="/admin/user_registration/delete_user_from_db.php" method="post"><!-- Redirects here to delete user -->
								   <br><br>Username:<br><input type="text" name="username">
								   <br><br>Email:<br><input type="text" name="email" >
								   <br><br><input type="submit" name="reg" value="Delete user!" />
								</form>
					</div>

				  </div>
				</div>
			  </div>

			  <!-- Button to Open the Modal -->
			  <div class="pull-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#regModal">Register new user</button></div>

			  <!-- The Modal -->
			  <div class="modal" id="regModal">
				<div class="modal-dialog">
				  <div class="modal-content">

					<!-- Modal body -->
					<div class="modal-body">
					  <h3 align="left">User registration form:</h3>

								<form action="/admin/user_registration/register_user_in_db.php" method="post"><!-- Redirects here to register new user -->
									Name: <br><input type="text" name="Name">
								   <br><br>User name:<br><input type="text" name="Username">
								   <br><br>Password:<br><input type="password" name="password1">
								   <br>Retype your password:<br><input type="password" name="password2" >
								   <br><br>Email:<br><input type="text" name="mail" ><br>
								   <br>Admin rights?<br>Yes: <input type="checkbox" id="admin" name="admin" value="yes">    No: <input type="checkbox" id="admin" name="admin" value="no">
								   <br><br><input type="submit" name="reg" value="Register user!" />
								</form>
					</div>

				  </div>
				</div>
			  </div>

		</div>


		<h1 align="center">All Registered Users in the DB:</font></h1>

	</body>
<?php

	// The necessary info to connect to the DB
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bin";

		// Open connectivity between PHP and DB
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

	  //We select all users
		$sql = "SELECT * FROM users;";
		$result = $conn->query($sql);//Saves the $sql results into the $result array

	  //Arrange the users been displayed as a matrix with rows and column
		echo '<br><br><table border="2" width="50%" cellspacing="0" cellpadding="0" style="margin: 0 auto;">';
		echo '<tr><td><p align="center">Name</p></td><td><p align="center">Username</p></td><td><p align="center">Email</p></td><td><p align="center">Admin rights?</p></td></tr>';

		//Gets the $result and check if not 0, then interate through the records into the db (id, name, username, email)
		if ($result->num_rows > 0) {

			// output data of each row
			while($row = $result->fetch_assoc()) {//fecthing each interaction in the DB

		  //Put int each variable the info taken from the DB for each index number
				$name=$row["name"];
				$username=$row["username"];
				$email=$row["email"];
				$admin_rights=$row["admin_rights"];

		  //Prints what is in the DB into the page for the specific ID number
				echo '<td><p align="center">'. $name .'</p></td>';
				echo '<td><p align="center">'. $username .'</p></td>';
				echo '<td><p align="center">'. $email .'</p></td>';
				echo '<td><p align="center">'. $admin_rights .'</p></td></tr>';
			}
		}
		else {
			//If there are no bins to be displayed
			echo "0 results";
			}
		echo "</table>";
		$conn->close();//Close connectivity between PHP and DB
?>
