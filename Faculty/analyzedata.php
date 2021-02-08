<?php
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Analysing Attendance - Data Trends</h4>

	<section class="container grey-text">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">
	      google.charts.load('current', {'packages':['corechart']});
	      google.charts.setOnLoadCallback(drawChart);

		    $r1 = ['DATE', 'Number of Students Present'];
			$r2 = ['07-12-2020',17];
			$r3 = ['08-12-2020',15];
			$r4 = ['14-12-2020',14];
			$r5 = ['15-12-2020',16];
			$r6 = ['21-12-2020',13];
			$r7 = ['22-12-2020',16];

	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	            $r1,$r2,$r3,$r4,$r5,$r6,$r7
	        ]);

	        var options = {
	       	  width: 500,
	  	      height: 260,
	  	      // x="161",
	  	      // y="96"
	  	      // chartArea:{left:0,top:0,width:"50%",height:"50%"}
	          title: 'Number of Students present based on date',
	          curveType: 'function',
	          legend: { position: 'bottom' }
	        };

	        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	        chart.draw(data, options);
	      }
	    </script>
	</section>
	<section>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		  <script type="text/javascript">
		    google.charts.load("current", {packages:['corechart']});
		    google.charts.setOnLoadCallback(drawChart);

		    function drawChart() {
		      var data = google.visualization.arrayToDataTable([
		  		['DATE', 'Number of Students Present'],
				['07-12-2020',17],
				['08-12-2020',15],
				['14-12-2020',14],
				['15-12-2020',16],
				['21-12-2020',13],
				['22-12-2020',16]
		      ]);

		      var view = new google.visualization.DataView(data);
		      view.setColumns([0,1]);

		      var options = {
		        title: "Number of Students Present based on Date",
		        width: 500,
	  	      	height: 260,
		        bar: {groupWidth: "75%"},
		        legend: { position: "none" },
		      };
		      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
		      chart.draw(view, options);
		  }
		</script>
	</section>

	    
	  <body>
	  	<div style="position:relative;width:100%">
	    	<div id="curve_chart" style="position:absolute;top:40px;left:160px;"></div>
	    	<div id="columnchart_values" style="margin-left: 700px; padding-top:40px"></div>
	    </div>
	   </body>
	
	<!-- <?php include('../templates/footer.php') ?> -->

</html>