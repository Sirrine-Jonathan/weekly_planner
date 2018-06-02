<?php
	echo "<script>" .
			"function logout(){ document.location.href = 'logout.php' }" . 
		"</script>";
		
	echo "<div>" . 
		 "<div><input type='button' class='btn' value='Log out' onclick='logout()' /></div>";
	
	echo "<div><h3>User Tasks</h3>";

			// get the row id where it exists
		$sql = 'SELECT * FROM tasks WHERE user_id=:user_id';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id', $_SESSION['user_id']);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo '<p><b>' . $row['task_name'] . '</b></p>';
			echo '<p>' . 'Due: ' . $row['due_date'] . '</p>';
			echo '<p>' . 'Duration: ' . $row['task_duration'] . ' hours</p>';
			echo '<p>' . 'Details: ' . $row['task_details'] . '</p>';
		}

	echo "</div>";
	
?>

