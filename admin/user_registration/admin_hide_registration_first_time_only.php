
<html>
    <head>
        <title>User registration page</title>
    </head>
</html>
<!DOCTYPE html>

<!-- Used when we create the admin for the first time - it is from modal form in the monitoring_admin.php -->

<?php
	echo '<html>
		<body>
				<div id="Centru">
					<br><h3 align="center">Admin recording page!</h3>
					<hr>
					<p><i>Please complete user data to be registered:</i><p>
					<form action="/admin/user_registration/register_user_in_db.php" method="post">
						Name: <br><input type="text" name="Name">
					   <br><br>User name:<br><input type="text" name="Username">
					   <br><br>Passwork:<br><input type="password" name="password1">
					   <br>Retype your password:<br><input type="password" name="password2" >
					   <br><br>Email:<br><input type="text" name="mail" >
             <br>Admin rights?<br>Yes: <input type="checkbox" id="admin" name="admin" value="yes">    No: <input type="checkbox" id="admin" name="admin" value="no">
					   <br><br><input type="submit" name="reg" value="Register!" />
					</form>

				</div>
		</body>
	</html>';


?>
