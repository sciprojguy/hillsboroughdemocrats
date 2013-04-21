<?php
	sscanf($event['date'], "%d-%d-%d", &$yyyy, &$mm, &$dd);
	$tm = mktime(0, 0, 0, $mm, $dd, $yyyy);
	
	$d = date("l, F j Y ", $tm);
?>
<div class='contentBox'>
<div style='height:24px;width:100%;background-color:lightgray;text-left;padding-left:8px;font-size:14pt;'>
<?= "$d - {$event['title']}" ?>
</div>
<div style='font-size:12pt'><p/>
<?php
	if(isset($event['description']) && !empty($event['description']))
	{
		echo "Description: {$event['description']}<p/>";
	} 
?>
Location: <?= $event['location'] ?><p/>
Starting Time: <?= $event['startTime'] ?><br> 
Ending Time: <?= $event['endTime'] ?><p/>
Tags: <?= $event['tags'] ?><p/>

<a href="/hcdec/downloadevent/id/<?= $event['id']?>">Sync with calendar</a>
<!-- put tags in as well -->
</div>
</div>