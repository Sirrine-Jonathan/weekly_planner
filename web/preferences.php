<?php 
	require "db_connect.php";
	$db = db_connect();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>preferences</title>
</head>
<body>
	<h3>User Preferences</h3>
	<?php
		//user_id here will be a session variable, hard coded as 1 for now
		foreach ($db->query("SELECT * FROM user_preferences WHERE user_id='" . $_SESSION['user_id'] . "'") as $row)
		{
			echo '<p>Dark Theme: ' . (($row['dark_theme']) ? 'True':'False') . '</p>';
			echo '<p>Start on Mon: ' . (($row['start_on_mon']) ? 'True':'False') . '</p>';
		}
	?>
	</div>
</body>
</html>