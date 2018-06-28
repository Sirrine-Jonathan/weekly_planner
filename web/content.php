<?php
		
	echo "<div id='content_div'>";

	echo "<div class='logout_div'>" .
	     "<input type='button' class='btn' value='Log out' onclick='logout()' />" .
	     "</div>";

    // get the row id where it exists
    $sql = 'SELECT * FROM tasks WHERE user_id=:user_id ORDER BY due_date ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $phpData = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo "<div>";

		foreach ($phpData as $row){
			echo '<div class="task_div" data-id="' . $row['task_id'] . '" style="border-color:' . $row['color'] . '">';
			echo '<span class="remove_task" onclick="remove_task(event)">&times;</span>';
			echo '<p class="task_name" onclick="toggleDetails(event)"><b>' . $row['task_name'] . '</b></p>';
			echo '<div class="details" style="display: block"><p>' . 'Due: ' . $row['due_date'] . '</p>';
			echo '<p>' . 'Duration: ' . $row['task_duration'] . ' minute(s), ' . ($row['task_duration'] / 60) . ' hour(s)</p>';
			echo '<p>' . 'Details: ' . $row['task_details'] . '</div></p>';
			echo '</div>';
		}

	echo "</div>";
?>
<script type="text/javascript">



window.onload = function () {

	// get data from php and postgres
	var data = <?php echo json_encode($phpData) ?>;
	var basics = [];
	/*
https://canvasjs.com/
	*/
	
	data.forEach((task) => {
		basics.push({
			name: task['task_name'],
			x: (new Date(task['due_date']).getTime()),
			y: task['task_duration'] / 60,
			z: 10
			//color: task['color']
		});
		console.log(task);
	})

	var chart = new CanvasJS.Chart("bubbleChart", {
		animationEnabled: true,
		title:{
			text: "Upcoming Tasks"
		},
		axisX: {
			title:"Unix Timestamp"
		},
		axisY: {
			title:"Task Duration"
		},
		legend:{
			horizontalAlign: "legend"
		},
		data: [{
			xValueType: "dateTime",
			type: "bubble",
			showInLegend: true,
			legendText: "legend text",
			legendMarkerType: "circle",
			legendMarkerColor: "grey",
			toolTipContent: "<b>{ name }</b><br/>X value: { x }<br/> Y value: {y}<br/> Z value: {z}",
			dataPoints: basics
		}]
	});
	chart.render();

}


    function toggleDetails(e){
        let div = e.target;
        while (!div.classList.contains('task_div')){
            div = div.parentElement;
        }
        let details = div.querySelector(".details");
        if (details.style.display == "none")
            details.style.display = "block";
        else
            details.style.display = "none";
    }




	// build display
	const C_WIDTH = document.querySelector("#content_div").offsetWidth;
	const C_HEIGHT = (C_WIDTH / 2);
    const RADIUS = C_HEIGHT / (basics.length + 3);
    const I_WIDTH = C_WIDTH - RADIUS;
    const I_HEIGHT = C_HEIGHT - RADIUS;
	
	var c = document.createElement('canvas');
	c.setAttribute("id", "tasks_display");
	c.setAttribute("width", C_WIDTH);
	c.setAttribute("height", C_HEIGHT);
	c.setAttribute("style", "border:2px solid black");
	document.querySelector("#main_display").appendChild(c);
	var ctx = c.getContext("2d");
	

	let reach = I_WIDTH / basics.length;
	let x = RADIUS;
	
	let min = basics[0].value;
	let max = basics[basics.length - 1].value;
	let range = max - min;
	let cincher = range * (I_HEIGHT / C_HEIGHT);
	cinch();

	function cinch(){
	    min -= cincher;
	    max += cincher;
	    range = max - min;
	}

	basics.forEach((task) => {
		let ratio = (task.value - min) / range;
		let offset_x = (RADIUS / 2);
		let offset_y = (RADIUS / 2);

        let rgba = hexToRgba(task.color);
		ctx.strokeStyle = rgba;
		let darkTheme = '<?php if ($_SESSION["dark_theme"]){echo "true";} else {echo "false";} ?>';
		console.log(darkTheme);
		ctx.fillStyle = (darkTheme) ? brighten(rgba, 50):lighten(rgba);
		ctx.beginPath();
		ctx.arc(x + offset_x, (ratio * I_HEIGHT) + offset_y, RADIUS, 0, 2 * Math.PI);
		ctx.stroke();
		ctx.fill();

        // debug
        //ctx.fillText("x: " + (x + offset_x) + " y: " + (ratio * I_HEIGHT) + offset_y, x, (ratio * I_HEIGHT) + offset_y + 10);
        ctx.font = (RADIUS * .16) + 'px sans-serif';
        ctx.fillStyle = "#000000";
        ctx.fillText(task.name, x + offset_x - (ctx.measureText(task.name).width / 2), (ratio * I_HEIGHT) + offset_y);

		x += reach;
	});

	function hexToRgba(hex){
        var c;
        if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
            c= hex.substring(1).split('');
            if(c.length== 3){
                c= [c[0], c[0], c[1], c[1], c[2], c[2]];
            }
            c= '0x'+c.join('');
            return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
        }
        throw new Error('Bad Hex');
    }

    function lighten(rgba){
        let arr = rgba.split('');
        arr[arr.length - 2] = '0.5';
        rgba = arr.join('');
        return rgba;
    }

    function brighten(rgba, amt){
        let patt = new RegExp(/,|\(|\)/,'g');
        let arr = rgba.split(patt);
        console.log(arr);
        let r = raise(parseInt(arr[1]), amt);
        let g = raise(parseInt(arr[2]), amt);
        let b = raise(parseInt(arr[3]), amt);
        arr[1] = r;
        arr[2] = g;
        arr[3] = b;
        rgba = "rgba(" + arr[1] + "," + arr[2] + "," + arr[3] + ",1)";
        return rgba;
    }

    function raise(num, amt){
        if (num + amt > 255)
            return 255;
        return num + amt;
    }

</script>


