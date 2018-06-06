<?php
    require "db_connect.php";
    $db = db_connect();
    if (isset($_GET['task'])){
        $task_id = $_GET['task'];
			$sql = 'DELETE FROM tasks WHERE task_id = :task_id';
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':task_id', $task_id);
			$stmt->execute();
    }
    header('location:index.php');
?>

