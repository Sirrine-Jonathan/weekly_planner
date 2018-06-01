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
</head>
<body>
	<h3>User Preferences</h3>
	
	<?php
		include 'nav.php';
		
		$preferencesUpdated = false;
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				if (isset($_POST['theme']) && isset($_POST['start_day'])){
					$result = updatePreferences($db, $_POST['theme'], $_POST['start_day']);
					if ($result){
						echo "prefernces saved";
						$preferencesUpdated = true;
					}
				}
			} catch (Exception $ex) {
				echo $ex.getMessage();
			};

		}

		if (isset($_SESSION['user_id'])){
			foreach ($db->query("SELECT * FROM user_preferences WHERE user_id='" . ((int) $_SESSION['user_id']) . "'") as $row)
			{
				$_SESSION['dark_theme'] = $row['dark_theme'];
				$_SESSION['start_on_mon'] = $row['start_on_mon'];
				echo "sesson variables updated";
			}
		}
		
		echo "<form method='POST' action='preferences.php'>";
			echo '<p>' . 
			'<label>Dark Theme</lable><input type="checkbox" name="theme" value="dark" ';
			if ($_SESSION['dark_theme']) echo 'checked';
			echo ' />' . 
			'</p>';
			
			echo '<p>' .
			'<label>Start On Mon</label><input type="checkbox" name="start_day" value="mon" ';
			if ($_SESSION['start_on_mon']) echo 'checked';
			echo ' />' .
			'</p>';
			
			echo "<p><input type='submit' value='Save Changes' /></p>";
		echo "</form>";
		if ($preferencesUpdated){
			echo "<p>Preferences Saved</p>";
		}
	?>
	

	</div>
</body>
</html>