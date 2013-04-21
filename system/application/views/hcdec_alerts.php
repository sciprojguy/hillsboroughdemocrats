<tr>
	<td colspan=2 style='background-color:#888888'>
	<table border=0 cellpadding=4 width=100%>
	<?php
	// if($perms['add_alerts'])
	echo "<tr><td colspan=6><a href=\"/hcdec/addalert\">Add Action Alert</a><p></td></tr>";
	foreach($alerts as $alert)
	{
		echo "<tr style='color:white;font-family:Helvetica,Arial,Sans-serif;font-size:11pt'>";
		// id
		// type
		echo "<td colspan=2>{$alert['type']}</td>";
		// short_title
		echo "<td><a href=\"/hcdec/editalert/{$alert['id']}\">{$alert['short_title']}</a></td>";
		// action_url
		// start_date_time
		echo "<td>{$alert['start_date_time']}</td>";
		// end_date_time
		echo "<td>{$alert['end_date_time']}</td>";
		// status
		echo "<td>{$alert['status']}</td>";
		//if($perms['edit_alerts']) 
		echo "</tr>";
	}
	?>
	</table>
	</td>
</tr>