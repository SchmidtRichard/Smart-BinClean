<?php
//Info for the PHP of how to connect to DB
$usr = "root";
$psw = "";
$dbname = "bin";
$servername = "localhost";

//info taken from form of user creation in monitoring_admin.php
$name = $_POST['Name'];
$username = $_POST['Username'];
$password = $_POST['password1'];
$password1 = $_POST['password2'];
$email = $_POST['mail'];
$admin_rights = $_POST['admin'];

// Connect to DB
$conn = new mysqli($servername, $usr, $psw, $dbname);

//Send a query to check if that username already exist, before creation.
$sql = "SELECT * FROM users	WHERE username='$username'";
$result = $conn->query($sql);

// if there are no results from the above querry, it will continue into creation of the new user
if ($result->num_rows == 0)
{
    //we're checking if all those fields has been completed during html form
    if ($name && $username && $password && $password1 && $email && $admin_rights)
    {
        //this is the step when we check if the email entered is a valid email address e.i. @gmail.com also checks the dot(.)
        if (preg_match('/^[0-9A-Za-z\.-_]+@[0-9A-Za-z-]+\.[A-Za-z]{2,4}$/', $email))
        {
            //Check if the password created match
            if ($password == $password1)
            {
                //insert those info into DB
                $sql = "INSERT INTO users values('','$name','$username','$password','$email','$admin_rights')";
                $conn->query($sql);
                account_created(); //CAlls the function to pop-out the information that user has been created succesfully
                
            }
            else
            {
?>
								<script>
									alert("The passwords don't match each other!");
								</script>
<?php
                redirect();
            }
        }
        else
        {
?>
						<script>
						alert("The email is not completed well!");
						</script>
                        <?php
            redirect();
        }
    }

    else
    {
?>
                    <script>
					alert("Error: All fields should be completed!");
                    </script>
					<?php
        redirect();
    }
}
else
{
?>
                    <script>
					alert("Username already exist! Choose another username!");
				    </script>
<?php
    redirect();
}

//Redirects back to the login page
function redirect()
{
    $url = '/admin/monitoring_admin.php';
    echo '<META HTTP-EQUIV=REFRESH CONTENT="0; ' . $url . '">';
}

function account_created()
{
?>
		<script>
			alert("The account has been created successfully!");
		</script>
		</html>
		<?php
    $url = '/admin/monitoring_admin.php';
    echo '<META HTTP-EQUIV=REFRESH CONTENT="0; ' . $url . '">';

}
//Closes the connection with the DB
$conn->close();
?>
