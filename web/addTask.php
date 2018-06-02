<?php
	require "db_connect.php";
	$db = db_connect();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Weekly Planner</title>
	<?php 
		if (isset($_SESSION['dark_theme']) && $_SESSION['dark_theme'])
			echo "<link rel='stylesheet' href='dark-theme.css' />";
		else 
			echo "<link rel='stylesheet' href='light-theme.css' />";
	?>
</head>
<body>
	<div class="header">
	<h1>Add Task</h1>
	<?php
		include 'nav.php';
	?>
	</div>
	<div class="content">
	<?php
		include 'addTaskForm.php';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			addTask($db, $_SESSION['user_id'], $_POST['taskName'], $_POST['taskDetails'], $_POST['taskDueDate'], $_POST['taskDuration']);

		}
		
		function addTask($db, $id, $name, $details, $dueDate, $duration){
			$sql = 'INSERT INTO tasks (user_id, task_name, task_details, due_date, task_duration) VALUES (:user_id, :task_name, :task_details, :due_date, :task_duration)';
			$stmt = $db->prepare($sql);
			
			$stmt->bindValue(':user_id', $id);
			$stmt->bindValue(':task_name', $name);
			$stmt->bindValue(':task_details', $details);
			$stmt->bindValue(':due_date', $dueDate);
			$stmt->bindValue(':task_duration', $duration);
			$stmt->execute();
		}
	?>
	</div>
</body>
</html>