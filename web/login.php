<?php
	require_once('db_connect.php');
	//$db = db_connect();
	//require_once('login_register.php');
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
		<h1>Welcome, <?php echo $display ?></h1>
	</div>
</body>
</html>
