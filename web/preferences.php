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
		foreach ($db->query("SELECT * FROM user_preferences WHERE user_id='" . $_SESSION['user_id'] . "'") as $row)
		{
			$_SESSION['dark_theme'] = $row['dark_theme'];
			$_SESSION['start_on_mon'] = $row['start_on_mon'];
		}
		//user_id here will be a session variable, hard coded as 1 for now
		echo "<form method>";
			echo '<p>Theme: <br />'; ; 
			echo '<label>Dark Theme</lable><input type="checkbox" name="theme" value="dark" ';
			if ($_SESSION['dark_theme']) echo 'checked';
			echo ' />';
			'</p>';
			
			echo '<p>Start On: <br />'; 
			echo '<label>Start On Mon</label><input type="checkbox" name="start_day" value="mon" ';
			if ($_SESSION['start_on_mon']) echo 'checked';
			echo ' />';
			'</p>';
			echo "<input type='submit' value='Save Changes' />";
		echo "</form>";
	?>
	</div>
</body>
</html>