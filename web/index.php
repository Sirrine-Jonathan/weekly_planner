<?php
	require "db_connect.php";
	$db = db_connect();
	session_start();
	$loggedin = (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
?>
<!DOCTYPE html>
<html>
<head>
<title>Next Due Date</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel='stylesheet' href='baseStyle.css' />
	<?php 
		if (isset($_SESSION['dark_theme']) && $_SESSION['dark_theme']){
			echo "<link rel='stylesheet' href='dark-theme.css' />";
		} else {
			echo "<link rel='stylesheet' href='light-theme.css' />";
		}
	?>
</head>
<body>
	<div class="header jumbotron">
		<h1>Next Due Date</h1>
		<?php 
			if ($loggedin){
				include 'nav.php';
			}
		?>
	</div>
	<div class="content" id="main_display">
	<?php
		// check if user is logged in
		if ($loggedin){
			include 'content.php';
		} else {
			include 'signupForm.php';
			if (isset($_SESSION['error']) && $_SESSION['error']){
				echo $_SESSION['err_msg'];
				$_SESSION['error'] = false;
			}
		}
	?>
	</div>

</body>
</html>
