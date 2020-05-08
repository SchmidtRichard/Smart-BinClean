<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

<?php
//This is for the admin session, create a new session which will carry the info of the admin authentication - brownser cache
session_start();//Takes the live session from the login.php

?>
<?php

if (($_SESSION)&&($_SESSION['youarelogged'])==FALSE)//Check if the session has been created previously and if it is not a standard user
{
	if (($_SESSION['youareloggedasadmin'])==TRUE)//Check if it is an admin
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



					<!-- Button to Open the Modal to add the Bin -->
					  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">Add Bin</button>

					  <!-- The Modal -->
					  <div class="modal" id="myModal1">
						<div class="modal-dialog">
						  <div class="modal-content">

							<!-- Modal Header Title -->
							<div class="modal-header">
							  <h4 class="modal-title">Add bin</h4>
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">

							<!-- Calls insert_new_bin.php -->
								  <form action="/admin/insert_new_bin.php" method="post"><!-- Takes the info inserted and send through data.php to then be stored into the DB -->
												ID: <br><input type="text" name="id"><br><br>
												Bin type:
												  <select id="type" name="type">
													<option value="Mixed Recycling">Mixed Recycling</option>
													<option value="Organic Waste">Organic Waste</option>
													<option value="General Waste">General Waste</option>
											      </select><br>
												<br>Location: <br><input type="text" name="location">
												<br><br><input type="submit" name="reg" value="Insert in database"/>
								  </form>
							</div>

						  </div>
						</div>
					  </div>



					  <!-- Button to Open the Modal to Edit Bin -->
					  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Edit Bin</button>
					  <!-- The Modal -->
					  <div class="modal" id="myModal2">
						<div class="modal-dialog">
						<div class="modal-content">

							<!-- Modal Header Title -->
							<div class="modal-header">
							  <h4 class="modal-title">Edit</h4>
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">


									<!-- Takes the info inserted and send through update_bin_info_from_web_admin.php to then be stored into the DB -->
								  <form action="/admin/update_bin_info_from_web_admin.php" method="post">

												ID: <br><input type="text" name="id"><br><br>
												Bin type:
												  <select id="type" name="type">
													<option value="Mixed Recycling">Mixed Recycling</option>
													<option value="Organic Waste">Organic Waste</option>
													<option value="General Waste">General Waste</option>
												  </select><br>
												<br>Location: <br><input type="text" name="location">
												<br><br><input type="submit" name="reg" value="Update the database!"/>
								  </form>
							</div>
						  </div>
						</div>
					  </div>


					<!-- Button to Open the Modal - Delete Bin -->
				  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal3">Del Bin</button>

				  <!-- The Modal -->
				  <div class="modal" id="myModal3">
				  <div class="modal-dialog">
					<div class="modal-content">

					<!-- Modal Header Title -->
					<div class="modal-header">
					  <h4 class="modal-title">Delete bin</h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">


						<!-- Takes the info inserted and send through delete_from_web_admin.php to then be stored into the DB -->
						<form action="/admin/delete_from_web_admin.php" method="post">

							  ID: <br><input type="text" name="id">

							  <br><br><input type="submit" name="reg" value="Delete Bin"/>
						</form>
					</div>

					</div>
				  </div>
				  </div>



				  <!-- Button to Open the Modal - Report a Issue -->
				  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal4">Solve a Reported Issue</button>

				  <!-- The Modal -->
				  <div class="modal" id="myModal4">
				  <div class="modal-dialog">
					<div class="modal-content">

					<!-- Modal Header Title -->
					<div class="modal-header">
					  <h4 class="modal-title">Solve a reported issue</h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">


						<!-- Takes the info inserted and send through solve_a_reported_issue_from_web_admin.php to then be stored into the DB -->
						<form action="/admin/solve_a_reported_issue_from_web_admin.php" method="post">


							  ID: <br><input type="text" name="id">
							  <br><br>Solve an issue? Yes: <input type="checkbox" id="issue" name="issue" value="yes">   No:  <input type="checkbox" id="issue" name="issue" value="no">
							  <br><br><input type="submit" name="reg" value="Submit Report"/>
						</form>
					</div>

					</div>
				  </div>
				  </div>

			  <!-- Button to Open the Modal - Delete / List Users -->
			  <div class="pull-right"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete Existing User</button></div>


			  <!-- The Modal -->
			  <div class="modal" id="deleteModal">
				<div class="modal-dialog">
				  <div class="modal-content">

					<!-- Modal body -->
					<div class="modal-body">

									<!-- Takes the info inserted and send through list_users_from_db.php  -->
					  			<form action="/admin/user_registration/list_users_from_db.php"><input type="submit" value="List all users created if you forget the username" /></form>

								<h3 align="left">Delete user form:</h3>


								<!-- Sends to delete_user_from_db.php -->
								<form action="/admin/user_registration/delete_user_from_db.php" method="post">


								   <br><br>Username:<br><input type="text" name="username">
								   <br><br>Email:<br><input type="text" name="email" >
								<br><br><input type="submit" name="reg" value="Delete User!" />
								</form>
					</div>
					<div class="modal-footer">


					</div>
				  </div>
				</div>
			  </div>


			  <!-- The Modal
			  <div class="modal" id="listModal">
				<div class="modal-dialog">
				  <div class="modal-content">


					    <a href="/admin/user_registration/list_users_from_db.php" class="btn btn-info" role="button">List all users created</a>

				  </div>
				</div>
			  </div>



			  <!-- Button to Open the Modal - Register New User -->
			  <div class="pull-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#regModal">Register New User</button></div>

			  <!-- The Modal -->
			  <div class="modal" id="regModal">
				<div class="modal-dialog">
				  <div class="modal-content">

					<!-- Modal body -->
					<div class="modal-body">
					  <h3 align="left">User registration form:</h3>

								<form action="/admin/user_registration/register_user_in_db.php" method="post">
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
		<h1 align="center">
			 <font size="6">City Center Bins</font>
		  </h1>
	</body>
	</html>';

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

	  //Put in sql variable, the results of the SELECT query
		$sql = "SELECT * FROM realtime ORDER BY id";
		$result = $conn->query($sql);//Saves the $sql results into the $result array

	  //Arrange the bins been displayed as a matrix with rows and columsn, without borders
		echo '<br><br><div class="column"><div class="row">';
		echo '<table border="0" width="80%">';

		$count = 0;
		//Gets the $result and check if not 0, then interate through the records into the db (id, image, location, date)
		if ($result->num_rows > 0) {

			// output data of each row
			while($row = $result->fetch_assoc()) {//fecthing each interaction in the DB
				$count++;

		  //Put into each variable the info taken from the DB for each index number
				$id=$row["id"];
				$type=$row["type"];
				$img=$row["image"];
				$location=$row["location"];
				$issue=$row["issue"];
				$date_variable=$row["date"]; // add date to variable

		  //Prints what is in the DB into the page for the specific ID number
				echo '<td><img src="/images/'.$img.'.png">';
				echo '<p align="left">ID: '. $id .'</p>';
				echo '<p align="left">Type: '. $type .'</p>';
				echo '<p align="left">Address: '. $location .'</p>';

				//If there is an issue
				if ($issue)
					echo '<p align="left"><b>Issues: </b><a style="color:red">'. $issue .'</a></p>';
				else
					echo '<p align="left">Issues: none</p>';

				echo '<p align="left">Updated at: '. $date_variable .'</p></td>';

		  //Divide the number of bins by 4 to display 4 for each row on the page
				if ( ($count % 4) === 0 )
				  {
					echo '</tr></div><div class="row"><tr>';
				  }
			}
		}
		else {
			//If there are no bins to be displayed
			echo "0 results";
			}
		echo "</div></table>";
		$conn->close();//Close connectivity between PHP and DB
	}
}
else
{
	echo ('<h1>You\'re not the ADMIN!</h1>');
	echo '<meta http-equiv="refresh" content="2; URL=/admin/user_registration/logout.php"/>'; //Logs user out when trying to access a not authorized URL
}
?>
<html>
	<head>
		<script type="text/JavaScript">
    //Function to refresh the page automatically every 100 seconds
			function timedRefresh(timeoutPeriod) {
				setTimeout("location.reload(true);",timeoutPeriod);
			}
		</script>
	</head>
	<body onload="JavaScript:timedRefresh(100000);"></body>
</html>
