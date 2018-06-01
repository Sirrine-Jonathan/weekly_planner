<?php
	echo "<script>" .
			"function logout(){ document.location.href = 'logout.php' }" . 
		"</script>";
		
	echo "<div class='header'>" . 
		 "<h1>Welcome</h1>" . 
		 "<div><input type='button' value='Log out' onclick='logout()' /></div>";
	
	echo "<div><h3>User Tasks</h3>";
	
		foreach ($db->query("SELECT * FROM tasks WHERE user_id='" . $_SESSION['user_id'] . "'") as $row)
		{
			
			echo '<p><b>' . $row['task_name'] . '</b></p>';
			echo '<p>' . 'Due: ' . $row['due_date'] . '</p>';
			echo '<p>' . 'Details: ' . $row['task_details'] . '</p>';
		}

	echo "</div>";
	
?>

