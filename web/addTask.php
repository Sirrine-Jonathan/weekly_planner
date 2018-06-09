<?php
	require "db_connect.php";
	$db = db_connect();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Weekly Planner</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel='stylesheet' href='styles/baseStyle.css' />
	<?php 
		if (isset($_SESSION['dark_theme']) && $_SESSION['dark_theme'])
			echo "<link rel='stylesheet' href='styles/dark-theme.css' />";
		else 
			echo "<link rel='stylesheet' href='styles/light-theme.css' />";
	?>
</head>
<body>
	<div class="header jumbotron">
	<h1>Add Task</h1>
	<?php
		include 'nav.php';
	?>
	</div>
	<div class="content">
	<?php
		include 'forms/addTaskForm.php';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			addTask($db, $_SESSION['user_id'], $_POST['taskName'], $_POST['taskDetails'], $_POST['taskDueDate'], $_POST['taskDuration']);

		}
		
		function addTask($db, $id, $name, $details, $dueDate, $duration){
			$sql = 'INSERT INTO tasks (user_id, task_name, task_details, due_date, task_duration, color) VALUES (:user_id, :task_name, :task_details, :due_date, :task_duration, :color)';
			$stmt = $db->prepare($sql);

			// Generate a color
            function random_color_part() {
                return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
            }

            function random_color() {
                return "#" . random_color_part() . random_color_part() . random_color_part();
            }

            $color = random_color();

			$stmt->bindValue(':user_id', $id);
			$stmt->bindValue(':task_name', $name);
			$stmt->bindValue(':task_details', $details);
			$stmt->bindValue(':due_date', $dueDate);
			$stmt->bindValue(':task_duration', $duration);
            $stmt->bindValue(':color', $color);
            try {
			    $stmt->execute();
			    echo '"' . $name . '" added';
            } catch (PDOException $ex) {
                $msg = $ex->getMessage();
                $code = $ex->getCode();
                if ($code == 22007)
                    $msg = "You forgot something";
                echo $msg;
            }
		}
	?>
	</div>
</body>
</html>