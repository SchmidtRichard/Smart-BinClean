<!--
Richard Schmidt de Almeida
National College of Ireland
Bsc (Honours) in Computing - IoT Stream
Software Project - May 2020
Smart BinClean Project
-->

<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
    </head>
<?php

//Info to connect to the DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

//The parameters taken from the index.html to authenticate
$usr = $_POST["username"];
$passwd = $_POST["password"];

//Check if the above two parameters have been inserted into the fields
if($usr && $passwd)
{
	//Connect to the DB
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Query to check if the user exists in the DB
	$sql = "SELECT * FROM users	WHERE username='$usr'";
	$result = $conn->query($sql);

	//If the results is more than zero, the user exists and it will pass on checking the password if match
	if ($result->num_rows != 0)
    {
		$row = $result->fetch_assoc();//Doing the association of the data DB
        $dbpassword = $row['password']; //get the password stored in DB

		$admin_or_not = $row['admin_rights'];//Check if it an admin or not (yes or no)

		//If the password in the DB matches the one entered
		if($passwd === $dbpassword)
		{

				if($admin_or_not == 'yes' )
					{

						$_SESSION['youareloggedasadmin'] = TRUE;//Creates a session for the admin logged in. Key for the session -> youareloggedasadmin the key is passed to the admin php pages
						$_SESSION['youarelogged'] = FALSE;//sets standard user as false for the session
						echo 'Authentified as a ADMIN';
						echo '<meta http-equiv="refresh" content="1; URL=/admin/monitoring_admin.php"/>';//Admin is sent to here
						exit;
					}
				else
				{
					$_SESSION['youareloggedcaadmin'] = FALSE;//Sets the admin user as false for the session
					$_SESSION['youarelogged'] = TRUE;//Creates a session for the standard user logged in. Key for the session -> youarelogged the key is passed to the standard user php pages
					echo 'Authentified as a USER';
				//means there is an authetified user
					echo '<meta http-equiv="refresh" content="1; URL=/users/monitoring.php"/>';//Standard user is sent to here
					exit;
				}

		}
			else
				{
					//password dont match error
					$_SESSION['youareloggedcaadmin'] = FALSE;
					$_SESSION["youarelogged"] = FALSE;
					error();
				}
	}
	else
			{
				//The username don't exist in DB
				$_SESSION['youareloggedcaadmin'] = FALSE;
				$_SESSION["youarelogged"] = FALSE;
				error();
			}
}
else
		{
			//One of the fields don't contain text
			$_SESSION['youareloggedcaadmin'] = FALSE;
			$_SESSION["youarelogged"] = FALSE;
            error();
		}

//Function to prompt the user if the details entered are wrong
function error()
	{
		?>
		<script>
			alert("Please insert correct user and password");
		</script>
		<?php
		$url='/';
		echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$url.'">';
	}
  
//Close DB connection
$conn->close();
?>
</html>
