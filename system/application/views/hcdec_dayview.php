<div class='contentBox'>
<?php

$parts = explode('-',$date);
$mo = $parts[1];
$yr = $parts[0];
$dy = $parts[2];

$fdate = mktime(0,0,0,$mo,$dy,$yr);

$dayOfWeek = date('l', $fdate);
$monthName = date('F', $fdate);
$dayOfMonth = date('d', $fdate);
$year = date('Y', $fdate);
$formatted_date = "Events for $dayOfWeek, $monthName $dayOfMonth $year";
echo "<div style='height:24px;width:100%;background-color:lightgray;text-align:center;font-size:14pt;'>$formatted_date</div>";
# Saturday, May 5 2012
# 
# 10:00am - 5:00pm Hillsborough County Democratic Caucus
# 6:15am
foreach($events as $event)
{
	# two divs - one for the start/end and another for the title/location/tags
	echo "<div style='margin-top:4px;'>";
	echo "<div><em>Event:</em> <a href=\"/hcdec/eventdetail/id/{$event['id']}\">{$event['title']}</a>";
	echo "<div><em>Location:</em> {$event['location']}</div>";
	echo "<div><em>Duration:</em> {$event['startTime']} - {$event['endTime']}</div>";
	echo "</div>";
}
?>
</div>