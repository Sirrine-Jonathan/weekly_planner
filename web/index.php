<?php
	require "db_connect.php";
	$db = db_connect();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Weekly Planner</title>
</head>
<body>
	<div class="header">
		<h1>Weekly Planner</h1>
	</div>
	<?php
	
		// check if user is logged in
		if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
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
