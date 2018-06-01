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
			$row['
		}
		//user_id here will be a session variable, hard coded as 1 for now
		echo "<form method>";
			echo '<p>Theme: '; 
			$darkTheme = (($row['dark_theme']) ? true:false); 
			echo '<input type="radio" name="theme" value="dark" ';
			if ($darkTheme) echo 'selected';
			echo ' /';
			echo '<input type="radio" name="theme" value="light" ';
			if (!$darkTheme) echo 'selected';
			echo ' />' . 
			'</p>';
			
			echo '<p>Start On: '; 
			$startOnMon = (($row['start_on_mon']) ? true:false); 
			echo '<input type="radio" name="start_day" value="mon" ';
			if ($startOnMon) echo 'selected';
			echo ' />';
			echo '<input type="radio" name="start_day" value="sun" ';
			if (!$startOnMon) echo 'selected';
			echo ' />' . 
			'</p>';
			
			echo "<input type='submit' value='Save Changes' />";
		echo "</form>";
	?>
	</div>
</body>
</html>