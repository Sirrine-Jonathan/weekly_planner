window.onload = function () {

	var chart = new CanvasJS.Chart("bubbleChart", {
		animationEnabled: true,
		title:{
			text: "Upcoming Tasks"
		},
		axisX: {
			title:"X Axis"
		},
		axisY: {
			title:"Y Axis"
		},
		legend:{
			horizontalAlign: "legend"
		},
		data: [{
			type: "bubble",
			showInLegend: true,
			legendText: "legend text",
			legendMarkerType: "circle",
			legendMarkerColor: "grey",
			toolTipContent: "<b>{ name }</b><br/>X value: { x } yrs<br/> Y value: {y}<br/> Z value: {z}",
			dataPoints: [
				{ x: 78.7, y: 1.84, z:320.896, name: "US" },
				{ x: 69.1, y: 2.44, z: 258.162, name: "Indonesia" },
				{ x: 74.7, y: 1.78, z: 225.962, name: "Brazil" },
				{ x: 76.9, y: 2.21, z: 125.890, name: "Mexico" },
				{ x: 53, y: 5.59, z: 181.181, name: "Nigeria" },
				{ x: 70.9, y: 1.75, z: 144.096, name: "Russia" },
				{ x: 83.8, y: 1.46, z:127.141, name: "Japan" },
				{ x: 82.5, y: 1.83, z:23.789, name: "Australia" },
				{ x: 71.3, y: 3.31, z: 93.778, name: "Egypt" },
				{ x: 81.6, y: 1.81, z:65.128, name: "UK" },
				{ x: 62.1, y: 4.26, z: 47.236, name: "Kenya" },
				{ x: 69.6, y: 4.51, z: 36.115, name: "Iraq" },
				{ x: 60.7, y: 4.65, z: 33.736, name: "Afganistan" },
				{ x: 52.7, y: 6, z: 27.859, name: "Angola" },
				{ x: 68.4, y: 2.94, z: 101.716, name: "Philippines" },
				{ x: 70, y: 2.17, z: 28.656, name: "Nepal" },
				{ x: 71.2, y: 1.51, z: 45.154, name: "Ukrain" },
				{ x: 83.4, y: 1.62, z: 46.447, name: "Spain" },
				{ x: 64.6, y: 4.28, z: 99.873, name: "Ethiopia" },
				{ x: 74.6, y: 1.5, z: 68.65, name: "Thailand" },
				{ x: 74.2, y: 1.88, z: 48.228, name: "Colombia" },
				{ x: 74.44, y: 2.34, z: 31.155, name: "Venezuela" },
				{ x: 57.4, y: 2.34, z: 55, name: "South Africa" },
				{ x: 59.2, y: 3.86, z: 15.77, name: "Zimbabwe" },
				{ x: 55.9, y: 4.63, z: 22.834, name: "Cameroon"}
			]
		}]
	});
	chart.render();

}