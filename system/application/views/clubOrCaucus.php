<!--
 name
 description (if present)
 president (if present)
 meets (if present)
 contact phone (if present)
 contact email (if present)
 url (if present) 
  -->
<div class="clubOrCaucus">
	<?php
	if(in_array('manage_clubs', $user['roles']))
	{
		# emit Edit link /hcdec/editcluborcaucus/id/$id
		echo "<a style='text-decoration:none;color:blue;font-size:10pt' href=\"/hcdec/editcluborcaucus/id/$id\">Edit</a>&nbsp;";
	}
	if(isset($name) && !empty($name))
		echo "<strong>$name</strong><br>";
	if(isset($description) && !empty($description)) 
		echo "$description<br>"; 
	if(isset($president) && !empty($president)) 
		echo "<strong>President:</strong> $president<br>"; 
	if(isset($contact_phone) && !empty($contact_phone)) 
		echo "<strong>Phone:</strong>$contact_phone<br>"; 
	if(isset($contact_email) && !empty($contact_email)) 
		echo "<strong>Email:</strong> <a style='text-decoration:none;color:blue;font-size:10pt' href=\"mailto:$contact_email\">$contact_email</a><br>"; 
	if(isset($club_url) && !empty($club_url)) 
		echo "<strong>Web Site:</strong> <a style='text-decoration:none;color:blue;font-size:10pt' href=\"$club_url\">$club_url</a><br>"; 
	if(isset($meets) && !empty($meets)) 
		echo "<strong>Meets:</strong> $meets<br>";
	if(in_array('manage_clubs', $user['roles']))
	{
		# emit Edit link /hcdec/editcluborcaucus/id/$id
		echo "<em>$status</em><br>";
	}
	?>
</div>