
<script>
    function remove_task(e){
        let remove = confirm("are you sure you want to delete this task?");
        if (remove){
            let task_id = e.target.parentElement.dataset.id;
            window.location.href = "removeTask.php?task=" + task_id;
        }
    }
</script>
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
		$phpData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		//while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		foreach ($phpData as $row){
			echo '<div class="task_div" data-id="' . $row['task_id'] . '" style="border-color:' . $row['color'] . '">';
			echo '<span class="remove_task" style="float: right; color: red; cursor: pointer;"' .
			' onclick="remove_task(event)">&#x274C</span>';
			echo '<p><b>' . $row['task_name'] . '</b></p>';
			echo '<p>' . 'Due: ' . $row['due_date'] . '</p>';
			echo '<p>' . 'Duration: ' . $row['task_duration'] . ' hours</p>';
			echo '<p>' . 'Details: ' . $row['task_details'] . '</p>';
			echo '</div>';
		}
		
	echo "</div>";
?>
<?php echo "<canvas  id='tasks_display' width='200' height='100'></canvas>"; ?>
<script type="text/javascript">

	// get data from php and postgres
	var data = <?php echo json_encode($phpData) ?>;
	var basics = [];
	data.forEach((task) => {
		basics.push({
			name: task['task_name'],
			value: (new Date(task['due_date'])).getTime(),
			color: task['color']
		});
	})
	
	// soonest timestamp first
	basics = basics.sort(function(a, b) {
		return b.value < a.value;
	});
	
	// build display
	const RADIUS = 5;
	const OFFSET = RADIUS * 4;
	const C_HEIGHT = 300 - OFFSET;
	const C_WIDTH = (C_HEIGHT * 2) - OFFSET;
	
	var c = document.createElement('canvas');
	c.setAttribute("id", "tasks_display");
	c.setAttribute("width", C_WIDTH + OFFSET);
	c.setAttribute("height", C_HEIGHT + OFFSET);
	c.setAttribute("style", "border:2px solid black");
	document.querySelector("#main_display").appendChild(c);
	var ctx = c.getContext("2d");
	
	let drop = C_HEIGHT / basics.length;
	let reach = C_WIDTH / basics.length;
	let x = OFFSET / 2;
	
	let min = basics[0].value;
	let max = basics[basics.length - 1].value;
	let range = max - min;
	console.log("Max: " + max);
	console.log("Min: " + min);
	console.log("Range: " + range);
	
	
	basics.forEach((task) => {
		let offset = task.value - min;
		let ratio = offset / range;
		ctx.strokeStyle = task.color;
		ctx.beginPath();
		ctx.arc(x + (OFFSET / 2), (ratio * C_HEIGHT) + (OFFSET / 2), RADIUS, 0, 2 * Math.PI);
		ctx.stroke();
		x += reach;
	});

</script>

