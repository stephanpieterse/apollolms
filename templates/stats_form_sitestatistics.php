<?php
/*
 * @author Stephan Pieterse
 * */
?>
<link rel="stylesheet" type="text/css" href="<?php echo SCRIPTS_PATH; ?>/jqplot/jquery.jqplot.css" />
<div>
<span class="bold">Gender Statistics:</span>
<p>
<?php
	$values = stat_getGenderStats();

	echo "Males: " . $values['m'] . " - " . floor($values['m'] / $values['t'] * 100) . "%";
	br();
	echo "Females: " . $values['f'] . " - " . floor($values['f'] / $values['t'] * 100) . "%";

?>
<div id="chartGender" style="height:300px;width:75%; "></div>
<script>
	$(document).ready(function(){
  var data = [
    ['Male', <?php echo $values['m'];?>],['Female', <?php echo $values['f'];?>]
  ];
  var plot1 = jQuery.jqplot ('chartGender', [data],
    {
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      },
      legend: { show:true, location: 'e' }
    }
  );
});
</script>
</p>
<span class="bold">Age Statistics:</span>
<p>
<?php

	$values = stat_getAgeStats();
	
	echo "<18 = " . $values[0];
	br();
	echo "18-25 = " . $values[1];
	br();
	echo "25-40 = " . $values[2];
	br();
	echo ">40 = " . $values[3];
	br();

?>
<div id="chartAges" style="height:300px;width:75%; "></div>
<script>
	$(document).ready(function(){
  var data = [
    ['<18', <?php echo $values[0];?>],['18-25', <?php echo $values[1];?>],['25-40', <?php echo $values[2];?>],['40+', <?php echo $values[3];?>]
  ];
  var plot1 = jQuery.jqplot ('chartAges', [data],
    {
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          showDataLabels: true
        }
      },
      legend: { show:true, location: 'e' }
    }
  );
});
</script>
</p>
<span class="bold">Group Statistics</span>
<p>
	<?php
	
	$groupstats = stat_getGroupStats();
	//var_dump($groupstats);
	$passToGroups = '';
	
	foreach($groupstats as $gs){
		$passToGroups .= '[';
		$passToGroups .= "'" . $gs['NAME'] . "',";
		$passToGroups .=  $gs['TOTALS'];
		$passToGroups .=  '],';
	}
	
	//var_dump($passToGroups);
	?>
	
	<div id="chartGroups" style="height:450px;width:75%; "></div>
<script>
	$(document).ready(function(){
  var data = [
    <?php echo $passToGroups; ?>
  ];
  var plot1 = jQuery.jqplot ('chartGroups', [data],
    {
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          showDataLabels: true
        }
      },
      legend: { show:true, location: 'e' }
    }
  );
});
</script>
</p>
</div>
<h2>NOTE: The accuracy of these statistics depend on the complete and accurate info of the users. These statistics are not guaranteed to be accurate.</h2>
<script language="javascript" type="text/javascript" src="<?php echo SCRIPTS_PATH ?>jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_PATH ?>jqplot/plugins/jqplot.pieRenderer.min.js"></script>
