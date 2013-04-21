<?php
	$this->load->helper('form');
	$startDateField = form_input(array('id'=>'startDate', 'name'=>'startDate','class'=>'tcal','size'=>10,'value'=>$startDate));
	$endDateField = form_input(array('id'=>'endDate', 'name'=>'endDate','class'=>'tcal','size'=>10,'value'=>$endDate));
	$precinctField = form_input(array('id'=>'precinct', 'name'=>'precinct', 'size'=>4, 'value'=>$precinct));
?>
<script type='text/javascript'>
function refineVolunteerListing() {
	var startDateField = document.getElementById('startDate');
	var endDateField = document.getElementById('endDate');
	var precinctField = document.getElementById('precinct');
	var newLocationURL = '/hcdec/volunteers/startDate/'+startDateField.value+'/endDate/'+endDateField.value+'/precinct/'+precinctField.value;
	alert(newLocationURL);
}
</script>
<div class='contentBox'>

<div style='padding-top:8px; margin-left:8px;float:left'>
	<img src="/images/volunteersLabel.png">
</div>

<div style='padding-top:8px; margin-left:8px;float:left'>
	<!-- Signups from <=$startDateField?> to <=$endDateField?> in precinct <=$precinctField?> -->
	<!-- link button to download volunteers -->
	<a href='/hcdec/downloadvolunteers'><img src="/images/downloadButton.png"></a>
</div>

<div style='clear:both'>
</div>

<div style='width:100%;overflow:auto'>
<?php
if(count($volunteers)>0)
{
	echo "<table border=0 cellpadding=2 width=100%>";
	echo "<tr>";
	echo "<th style='text-align:left'>Precinct</th>";
	echo "<th style='text-align:left'>Name</th>";
	echo "<th style='text-align:left'>Address</th>";
	echo "<th style='text-align:left'>Phone</th>";
	echo "<th style='text-align:left'>Email</th>";
	echo "</tr>";
	$rowNum = 0;
	foreach( $volunteers as $volunteer )
	{
		echo "<tr>";
		echo "<td>{$volunteer['precinct']}</td>";
		echo "<td>{$volunteer['name']}</td>";
		echo "<td>{$volunteer['street']}, {$volunteer['city']} {$volunteer['zip']}<br>";
		echo "<td>{$volunteer['phone']}</td>";
		echo "<td>{$volunteer['email']}</td>";
		echo "</tr>";
	}
}
# Download as CSV

?>
</div>
</div>