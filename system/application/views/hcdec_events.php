<?php

?>
<div class='contentBox'>
<!--
	if the user is seeing this page at all it's because they have manage_calendar
	permissions.  this is a standard add/list/edit page
	
	Add an event

	date	start - end		name		location	
	
  -->
  <div style='float:left;margin-right:20px;margin-top:10px;margin-bottom:10px;'>
  <img src="/images/eventsLabel.png">
  </div>
  <div style='float:left;margin-top:10px;margin-bottom:10px'>
  <a href="/hcdec/addevent">Add an Event</a>
  </div>
  <div style='clear:both'></div>
  <?php
  if(count($events)<1)
  	echo "No events scheduled"; 
  else
  {
	echo "<form method=post action=\"/hcdec/deleteSelectedEvents\">";
	echo "<input type=submit value=\"Delete Selected\">";
  	echo "<table border=0 width=95% align=center cellpadding=2 cellspacing=0>";
  	echo "<tr align=left valign=top>";
  	echo "<th></th>";
  	echo "<th></th>";
  	echo "<th>Status</th>";
  	echo "<th>Date</th>";
  	echo "<th>Duration</th>";
  	echo "<th>What</th>";
  	echo "<th>Location</th>";
  	echo "<th>Tags</th>";
  	echo "</tr>";
  	
  	foreach($events as $event)
  	{
  		echo "<tr align=left valign=top>";
  		echo "<td><input type=checkbox name=eventsToDelete[] value={$event['id']}></td>";
  		echo "<td><a href=\"/hcdec/editevent/id/{$event['id']}\">Edit</a>";
	  	echo "<td>{$event['status']}</td>";
  		echo "<td>{$event['date']}</td>";
	  	echo "<td>{$event['startTime']} - {$event['endTime']}</td>";
	  	echo "<td>{$event['title']}</td>";
	  	echo "<td>{$event['location']}</td>";
	  	echo "<td>{$event['tags']}</td>";
	  	echo "</tr>";
  	}
  	echo "</table>";
  	echo "</form>";
  }
  ?>
</div>