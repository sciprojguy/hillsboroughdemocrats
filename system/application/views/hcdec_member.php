	<?php
	/***
	 things to add to this page:
	 
	 1) profile with edit button
	 	profile includes name, precinct, address, email/phone, dob, sex
	 	profile pic (optional)
	 	status (current, expired) and as-of date
	 	type (elected, appointed) and date
	 	committee assignments with button to add new ones
	 */ 
	?>
<div class="contentBox">

<style>
.navLinkStyle {
	color:blue;
	font-family:Helvetica,Arial,sans-serif;
	text-decoration:none
}
</style>

<div style='float:left;width:20%'>
<?php
	var_dump($member);
	# check the assigned roles to populate the left-hand nav menu.
	
	if(isset($user['roles']))
	{
		$navMenu = "<br><span style='color:blue;font-family:Helvetica,Arial,sans-serif;'>Navigation</span><br><br>";
		$roles = $user['roles'];
		
		$navMenu .= anchor("/hcdec/submitevent", "Submit A Calendar Event", "style='font-size:10pt;text-decoration:none'" )."<br>";
		if(in_array('manage_alerts',$roles))
			$navMenu .= anchor( "/hcdec/alerts", "Manage Alerts", "style='font-size:10pt;text-decoration:none'" )."<br>";
		if(in_array('manage_volunteers',$roles))
			$navMenu .= anchor( "/hcdec/volunteers", "Get Volunteers", "style='font-size:10pt;text-decoration:none'" )."<br>";
			
		if(in_array('manage_news',$roles))
			$navMenu .= anchor( "/hcdec/news", "Manage News", "style='font-size:10pt;text-decoration:none'" )."<br>";
			
		if(in_array('manage_clubs',$roles))
			$navMenu .= anchor( "/hcdec/clubsandcaucuses", 
				"Manage Clubs and Caucuses", 
				"style='font-size:10pt;text-decoration:none''" 
			)."<br>";
			
		if(in_array('manage_calendar',$roles))
			$navMenu .= anchor( "/hcdec/listevents", 
				"Manage Calendar", 
				"style='font-size:10pt;text-decoration:none'" 
			)."<br>";
									
		if(in_array('manage_candidates',$roles))
			$navMenu .= anchor( "/hcdec/candidates", 
				"Manage Candidates", 
				"style='font-size:10pt;text-decoration:none'" 
			)."<br>";
			
		if(in_array('manage_users',$roles))
			$navMenu .= anchor( "/hcdec/users", 
				"Manage Users", 
				"style='font-size:10pt;text-decoration:none'" 
			)."<br>";
			
		if(in_array('manage_members',$roles))
			$navMenu .= anchor( "/hcdec/members", 
				"Manage Members", 
				"style='font-size:10pt;text-decoration:none'" 
			)."<br>";
			
		if(in_array('manage_officials',$roles))
			$navMenu .= anchor( "/hcdec/officials", 
				"Manage Officials", 
				"style='font-size:10pt;text-decoration:none'" 
			)."<br>";
			
		
		echo $navMenu;
	}
 ?>
</div>	
	<div style='width:50%;float:left'>
	<!--
		next up comes the following divs:
		
		+----------------+
		| messages       |
		+----------------+
		| tagged events  |
		+----------------+
		| profile/edit   |
		+----------------+
		
	  -->
	  <div style='width:100%'>
	  	<!-- tagged events for this user -->
	  	Events
	  	<?php
	  	# [Events                 (n total)]
	  	# +----------------- tag ---------------------+
	  	# date	
	  	# 	time	title 
	  	# 	time	title 
	  	# 	time	title
	  	#                                        all... 
	  	# +-------------------------------------------+
	  		  	?>
	  </div>
	  <div style='width:100%'>
	  	<!-- profile & edit button for this user 
	  	Name: <first> <middle> <last>
	  	Precinct: <precinct>  Address: <street>, <city>, <zip>
	  	DOB: mm/dd/yyyy  
	  	Phone: (xxx) xxx-xxxx    Email: xxxx@mmmm.yy
	  	-->
  	<?php 
  	?>
	  </div>
	</div>
	<div style='width:30%;float:left'>
		My Profile <a href="/hcdec/editmyprofile">Edit</a><br>
		<div style='height:4px'>&nbsp;</div>
			<span style='font-size:9pt'><em>Name</em><br></span>
			<?php echo "{$member['firstName']} {$member['middleName']} {$member['lastName']}"; ?><br>
			<div style='height:4px'>&nbsp;</div>
			<span style='font-size:9pt'><em>Address</em><br></span>
			<?php echo "{$member['street']}"; ?><br>
			<?php echo "{$member['city']} {$member['state']}"?>
			<div style='height:4px'>&nbsp;</div>
			<span style='font-size:9pt'><em>Contact Info</em><br></span>
			<?php echo "{$member['email']}"; ?><br>
			<?php echo "{$member['phone']}"; ?><br>
			<div style='height:4px'>&nbsp;</div>
			<span style='font-size:9pt'><em>Membership</em><br></span>
			<?php echo "Type: {$member['type']}"; ?><br>
			<?php echo "Precinct: {$member['precinct']}"; ?><br>
			
		</div>
	</div>
