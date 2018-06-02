<?php 
	require "db_connect.php";
	require "updatePreferences.php";
	$db = db_connect();
	session_start();
	
	if (!isset($_SESSION['dark_theme']))
		$_SESSION['dark_theme'] = false;
	if (!isset($_SESSION['start_on_mon']))
		$_SESSION['start_on_mon'] = true;
?>
<!DOCTYPE html>
<html>
<head>
	<title>preferences</title>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			try {
				$dark = (isset($_POST['theme'])) ? 't':'f';
				$mon = (isset($_POST['start_day'])) ? 't':'f';
				$result = updatePreferences($db, $dark, $mon);
			} catch (Exception $e){
				echo $e->getMessage();
			}
		}

		if (isset($_SESSION['user_id'])){
			foreach ($db->query("SELECT * FROM user_preferences WHERE user_id='" . ((int) $_SESSION['user_id']) . "'") as $row)
			{
				$_SESSION['dark_theme'] = ($row['dark_theme'] == 't');
				$_SESSION['start_on_mon'] = ($row['start_on_mon'] == 't');
			}
		}	

		if (isset($_SESSION['dark_theme']) && $_SESSION['dark_theme'])
			echo "<link rel='stylesheet' href='dark-theme.css' />";
		else 
			echo "<link rel='stylesheet' href='light-theme.css' />";
	?>
</head>
<body>
	<div class="header">
	<h1>User Preferences</h1>
	
	<?php
		include 'nav.php';
	?>
	</div>
	<div class="content">
	<?php

		
		echo "<form method='POST' action='preferences.php'>";
			echo '<p>' . 
			'<label>Dark Theme</lable><input type="checkbox" name="theme"';
			if ($_SESSION['dark_theme']) echo 'checked';
			echo ' />' . 
			'</p>';
			
			echo '<p>' .
			'<label>Start On Mon</label><input type="checkbox" name="start_day"';
			if ($_SESSION['start_on_mon']) echo 'checked';
			echo ' />' .
			'</p>';
			
			echo "<p><input type='submit' value='Save Changes' /></p>";
		echo "</form>";
	?>
	</div>
</body>
</html>