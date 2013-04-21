<!--
loops thru events passed in and formats them.  title gets a link

/hcdec/eventdetail/id/<id> -- will include links to add to calendar or email to you.

dates are assumed to be arrays of events in ascending order of time grouped by date.
need to write that page as well.  can include a map?

 -->
<div class='dateWidget'>
<?php
	foreach($event_dates as $event_date=>$events)
	{
		# echo div for date - bold, link to /hcdec/eventsfordate/yyyy-mm-dd
		# get day of wk label?
		$parts = explode(' ',$event_date);
		$firstEvent = $events[0];
		$formatted_date = "{$firstEvent['dayofweek']}, {$firstEvent['moname']} {$firstEvent['dateday']}, {$firstEvent['yr']}";
		# Saturday, May 5 2012
		# dayofweek, moname, dateday, yr
		echo "<div class='dateWidgetDayLabel'><a href=\"/hcdec/daysevents/date/{$parts[1]}\">{$formatted_date}</a></div>";
		foreach($events as $event)
		{
			# echo div for event - start time, title as link to /hcdec/eventdetail/id/<id>
			# alt link with description?  yes
			echo "<div class='dateWidgetEvent'>";
			echo "{$event['startTime']} ";
			echo "<a class='dateWidgetLink' href=\"/hcdec/eventdetail/id/{$event['id']}\">{$event['title']}</a>";
			echo "</div>";
		}
	}
?>
</div>