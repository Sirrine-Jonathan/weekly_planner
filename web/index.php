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
</head>
<body>
	<div class="header">
		<h1>Next Due Date</h1>
		<?php 
			if ($loggedin){
				include 'nav.php';
			}
		?>
	</div>
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

</body>
</html>
