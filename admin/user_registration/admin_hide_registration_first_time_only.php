
<html>
    <head>
        <title>User Registration Page</title>
    </head>
</html>
<!DOCTYPE html>

<!-- Used when we create the admin for the first time -->

<?php

	echo '<html>
		<body>
				<div id="Centru">
					<br><h3 align="center">Admin recording page!</h3>
					<hr>
					<p><i>Please Fill in Form:</i><p>

          <!-- post - passes info entered to - rigister_user_in_db.php -->
					<form action="/admin/user_registration/register_user_in_db.php" method="post">

						Name: <br><input type="text" name="Name">
					   <br><br>User name:<br><input type="text" name="Username">
					   <br><br>Password:<br><input type="password" name="password1">
					   <br>Retype your password:<br><input type="password" name="password2" >
					   <br><br>Email:<br><input type="text" name="mail" >
             <br>Admin rights?<br>Yes: <input type="checkbox" id="admin" name="admin" value="yes">    No: <input type="checkbox" id="admin" name="admin" value="no">
					   <br><br><input type="submit" name="reg" value="Register!" />
					</form>

				</div>
		</body>
	</html>';

?>
