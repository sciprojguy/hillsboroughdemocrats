<div class="eventsBoxContainer">
	<div class="eventsBoxTitle">
		Your Messages
	</div>
	<table border=0 cellpadding=2 width="100%">
		<tr>
			<th>Type</th>
			<th>Date</th>
			<th>Sender</th>
			<th>Title</th>
		</tr>
<?php
	if(count($messages)>0)
	{
		foreach( $messages as $message )
		{
			$row_html = "<tr>";
			$row_html .= "<td align=left>{$message['type']}</td>";
			$row_html .= "<td align=left>{$message['date']}</td>";
			$row_html .= "<td align=left>{$message['sender']}</td>";
			$row_html .= "<td align=left>{$message['title']}</td>";
			$row_html .= "</tr>\n";
			echo $row_html;
		}
	}
	else
	{
		echo "<tr><td colspan=4>No messages</td></tr>";
	}
?>
	</table>
</div>