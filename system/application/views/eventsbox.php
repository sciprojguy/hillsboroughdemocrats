<div class="eventsBoxContainer">
	<div class="eventsBoxTitle">
	Upcoming Events
	</div>
<?php
	foreach( $events as $day=>$daysevents )
	{
		$bannerdate = $daysevents[0]['date'];
		$bannerdatetime = date_timestamp_get(date_create_from_format('Y-m-d', $bannerdate));
		$testDate = date('m/d/Y', $bannerdatetime);
		$dayOfWeek = date('D', $bannerdatetime);
		$monthName = date('M', $bannerdatetime);
		$dayOfMonth = date('d', $bannerdatetime);
		$year = date('Y', $bannerdatetime);
		echo "<div style='text-align:center;background-color:lightgreen'>$dayOfWeek $monthName $dayOfMonth, $year</div>";
		foreach( $daysevents as $event )
		{
			echo "{$event['start_time']} {$event['title']}<br>";
		}
	}
?>
</div>