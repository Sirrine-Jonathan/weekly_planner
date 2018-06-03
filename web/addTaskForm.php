<?php

	echo "<form method='POST' action='addTask.php'>" . 
		"<input type='text' id='taskNameInput' name='taskName' placeholder='Task Name' /><br />" . 
		"<input type='datetime-local' id='taskDueDate' name='taskDueDate' placeholder='Due Date' /><br />" . 
		"<input type='number' id='taskDurationInput' name='taskDuration' placeholder='Task Duration in Minutes' /><br />" . 
		"<textarea id='taskDetailsInput' name='taskDetails' rows='10' cols='100' ></textarea><br />" .
		"<input type='submit' class='btn' value='Add Task' />" . 
	"</form>";

?>