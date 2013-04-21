<!-- list of members.  this is publicly available and has the normal Add/Edit for people with
	manage_members role auth -->
<?php 
$canEdit = in_array("manage_members", $user['roles']);
?>
<div class="contentBox">
<img src="/images/membersLabel.png">
<?php
if($canEdit) 
	echo "<a href=\"/hcdec/addmember\">Add a member</a>"; 
?>
<table border=0 cellpadding=4 cellspacing=0>
<?php 
if(count($members)<1)
	echo "<tr><td>No members to display</td></tr>";
else
{
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>Precinct</th>";
	echo "<th>Type</th>";
	echo "<th>Term<br>Began</th>";
	echo "<th>Member<br>Status</th>";
	echo "<th>Contact</th>";
	echo "<th>Username</th>";
	echo "<th>Account<br>Status</th>";
	echo "</tr>";
	
	foreach($members as $member)
	{
		echo "<tr>";
		
		echo "<td>";
		if($canEdit)
			echo "<a href=\"/hcdec/editmember/id/{$member['id']}\">{$member['lastName']}, {$member['firstName']} {$member['middleName']}";
		else 
			echo "<a href=\"/hcdec/viewmember/id/{$member['id']}\">{$member['lastName']}, {$member['firstName']} {$member['middleName']}";
		echo "</td>";
		
		echo "<td>{$member['precinct']}</td>";
		echo "<td>{$member['type']}</td>";
		echo "<td>{$member['term_began']}</td>";		
		echo "<td>{$member['status']}</td>";
		
		echo "<td>Phone:{$member['phone']}<br>Email:{$member['email']}</td>";
		
		echo "<td>";
		if($canEdit)
		{
			if(isset($member['username']) && !empty($member['username']))
				echo "<a href=\"/hcdec/edituser/id/{$member['id']}\">{$member['username']}</a>";
			else
				echo "<a href=\"/hcdec/adduser\">Add User Account</a>";
		}
		else 
			echo "{$member['username']}";
		echo "</td>";
		echo "<td>{$member['user_status']}</td>";
		
		echo "</tr>";
	}
}
?>
</table>
</div>
