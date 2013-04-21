<div class="contentBox">
<table border=0 cellpadding=3 cellspacing=0 width="100%">
<tr align=left>
<th>User Type</th>
<th>Username</th>
<th>Status</th>
<th>Member Type</th>
<th>Member Name</th>
<th></th>
</tr>
<?php
foreach( $users as $user )
{
	echo "<tr>";
	echo "<td>{$user['userType']}</td>";
	echo "<td>{$user['username']}</td>";
	echo "<td>{$user['status']}</td>";
	echo "<td>{$user['memberType']}</td>";
	echo "<td>{$user['lastName']}, {$user['firstName']}</td>";
	echo "<td><a href=\"/hcdec/edituser/id/{$user['id']}\">Edit</a></td>";
	echo "</tr>";
}
?>
</table>
</div>