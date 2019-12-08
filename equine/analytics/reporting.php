<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */
?>

<head>
<!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        </head>
        <body>
        <!-- Plotly chart will be drawn inside this DIV -->
        <div id="myDiv"></div>
        <script>
	var x = [];
	for (var i = 0; i < 500; i ++) {
	    x[i] = Math.random();
	}

	var trace = {
	    x: x,
	    type: 'histogram',
	  };
	var data = [trace];
	Plotly.newPlot('myDiv', data, {}, {showSendToCloud: true});
        </script>
        </body>
