<meta http-equiv="refresh" content="5" >
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	function drawChart() {
      // Create our data table out of JSON data loaded from server.
		var dataamp = new google.visualization.DataTable();
		dataamp.addColumn('datetime', 'Time');
		dataamp.addColumn('number', 'Va');
		dataamp.addColumn('number', 'Vb');
		dataamp.addColumn('number', 'Vc');
		<?php foreach($chart as $chartitem): ?>
		//var d = new Date();
		dataamp.addRow([(new Date(<?php echo $chartitem['timestamp']; ?>)),<?php echo $chartitem['va']; ?>,<?php echo $chartitem['vb']; ?>,<?php echo $chartitem['vc']; ?>]);
		<?php endforeach; ?>
		var optionsamp = {	'title':'Amplitude'};
        var chart = new google.visualization.LineChart(document.getElementById('chart_amp'));
        chart.draw(dataamp,optionsamp); //amplitude
		
		var dataang = new google.visualization.DataTable();
		dataang.addColumn('datetime', 'Time');
		dataang.addColumn('number', 'Va');
		dataang.addColumn('number', 'Vb');
		dataang.addColumn('number', 'Vc');
		<?php foreach($chart as $chartitem): ?>
		//var d = new Date();
		dataang.addRow([(new Date(<?php echo $chartitem['timestamp']; ?>)),<?php echo $chartitem['vaa']; ?>,<?php echo $chartitem['vba']; ?>,<?php echo $chartitem['vca']; ?>]);
		<?php endforeach; ?>
		var optionsang = {	'title':'Angle'};
        var charta = new google.visualization.LineChart(document.getElementById('chart_ang'));
        charta.draw(dataang,optionsang); //Angle
    }
    </script>
  </head>
  <body>
    <div id="chart_amp" style="width: 1100px; height: 250px;"></div>
	<div id="chart_ang" style="width: 1100px; height: 250px;"></div>
  </body>
</html>