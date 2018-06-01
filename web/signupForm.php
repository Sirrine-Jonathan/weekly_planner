<?php

echo "<form method='POST' action='login.php'>" . 
	"<h3>Log In / Sign In</h3>" .
	"<input type='text' id='displayNameInput' name='displayName' placeholder='Display Name' /><br />" . 
	"<input type='text' id='emailInput' name='email' placeholder='email@provider.com' /><br />" . 
	"<input type='password' id='passwordInput' name='password' placeholder='password' /><br />" . 
	"<input type='submit' name='login' value='Log In' />" . 
	"<input type='submit' name='register' value='Register' />" . 
	"</form>";

?>