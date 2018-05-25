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
	<div>
	<h3>User Preferences</h3>
	<?php
		//user_id here will be a session variable, hard coded as 1 for now
		foreach ($db->query("SELECT * FROM user_preferences WHERE user_id='1'") as $row)
		{
			echo '<p>Dark Theme: ' . $row['dark_theme'] . '</p>';
			echo '<p>Start on Mon: ' . $row['start_on_mon'] . '</p>';
		}
	?>
	</div>
	<div>
	<h3>User Tasks</h3>
	<?php
	
		foreach ($db->query("SELECT * FROM tasks WHERE user_id='1'") as $row)
		{
			echo '<p><b>' . $row['task_name'] . '</b></p>';
			echo '<p>' . $row['due_date'] . '</p>';
			echo '<p>' . $row['task_details'] . '</p>';
		}
	?>
	</div>
</body>
</html>
