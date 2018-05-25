<?php
	require "db_connect.php";
	$db = db_connect();
	require "login_register.php";
	
	//probably add session variables here
?>
<!DOCTYPE html>
<html>
<head>
<title>Weekly Planner</title>
</head>
<body>

	<?php 
	
		$display = $_POST['displayName'];
		$email = $_POST['email'];
		$pwHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
		
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['login'])) {
				//$user_id = loginUser($email, $pwHash, $display);
				echo "Logged in<br />";
			} else {
				//$user_id = registerUser($email, $pwHash, $display);
				echo "Registered<br />";
			}
		}
	
		
	?>
	<div class="header">
		<h1>Welcome, <?php echo $display ?></h1>
	</div>
	<?php
	
	?>
</body>
</html>
