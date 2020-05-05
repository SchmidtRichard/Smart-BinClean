<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Password recovery page</title>
    </head>
		<br>
		<br>
		Insert data necessary to recover your password:
		 <form action="/admin/user_registration/passwordrecovery.php" method="post" ><br>
                            <input type="text" name="usr" placeholder="username"><br>
                            <input type="text" name="email" placeholder="email">
                            <input type="submit" name="sub"  value="Recover your password!" >
                        </form>
<?php
//info for DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bin";

//if the info has been inserted into the fields
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	//it gets the input from the fields 
	$usr = $_POST["usr"];
	$email = $_POST["email"];

	if($usr && $email)  //if those fields has been completed
	{
		//connect to DB
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		//send querry
		$sql = "SELECT * FROM users	WHERE username='$usr'";
		$result = $conn->query($sql);
	
		//check if the query response with username
		if ($result->num_rows != 0)
		{
			$row = $result->fetch_assoc();

						
						$dbpassword = $row['password'];//we took the password from DB
						$dbemail = $row['email']; //we took the email from DB
						$pdo = null;
				

					if(strcmp($email, $dbemail) === 0 ) //if email from DB match with the email that user input into the html field
					{

								   echo "<br><br><strong>Your password is:</strong> $dbpassword";
								   echo "<br>";
							echo "</div>";
							?>
							<br>
							<form action="/" method="post">
							<input type="submit" value="&larr; Back to login page!" >
							</form>
							<?php
					}
					 else
					{
						error(); //calls error function
					}
			}
			 else
					{
					error(); //calls error function
					}
	}
}

function error() //this will pop-up saying you didn't provided the good info.
{
	?>
				<script>
					alert( "Wrong information provided!" );
				</script>
	<?php
	$url='/';//sends back to the login.html
	echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$url.'">';//Refresh the page to go into index.html
}
?>
</html>
