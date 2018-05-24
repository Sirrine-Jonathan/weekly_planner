<?php
	//require_once('db_connect.php');
	//require_once('login_register.php');
	//$db = db_connect();
?>
<!DOCTYPE html>
<html>
<head>
<title>Weekly Planner</title>
</head>
<body>

	<?php 
	
		$display = $_post['displayName'];
		$email = $_POST['email'];
		$pwHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
		
		echo $display . ' ' . $email . ' ' . $pwHash;
		/*
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['login'])) {
				$user_id = loginUser($email, $pwHash, $display);
			} else {
				$user_id = registerUser($email, $pwHash, $display);
			}
		}
		*/
		
	?>
	<div class="header">
		<h1>Welcome, </h1>
	</div>
</body>
</html>
