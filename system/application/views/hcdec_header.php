<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hillsborough County Democratic Party</title>
	<style>
	body {
		background-color:lightgray;
	}
	
	.body_copy {
	font-family: Georgia;
	font-size: 10pt;
	}
	</style>	
	<link rel="stylesheet" media="screen" type="text/css" href="http://test.local/css/test.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="http://test.local/css/site.css" />
	<link rel="stylesheet" type="text/css" href="/js/tcal.css" />
	<script type="text/javascript" src="/js/tcal.js"></script> 
</head>
<body>

<table class="header" cellpadding=0 cellspacing=0 height="600px">

	<!-- masthead -->
	<tr valign=top>
		<td>
			<!-- banner image -->
			<a href="/home/index"><img src="/images/home_03.gif" alt="" border="0"></a>
		</td>
		<td bgcolor="#1B4565">
			<div style='width:100%; height:100%; color:white;text-align:center;font-family:Helvetica;'>
				Make A Difference!
			</div>
			<div style='width:100%;height:100px;text-align:center;color:white;font-family:Helvetica;'>
		<?php
			if(isset($user['id']))
			{
				if(isset($user['salutation']) && !empty($user['saluation']))
					$greeting = "Welcome, ".$user['salutation'];
				else
				if(isset($user['firstName']))
					$greeting = "Welcome, ".$user['firstName'];
				
				echo "<p>$greeting<p>";
				echo "<a class=\"plain_link\" href=\"/home/logout\">Log out</a>";
			}
			else
			{
				echo "<a class=\"plain_link\" href=\"/home/member\">Log in</a>";
			}
		 ?>
			</div>
		</td>
	</tr>
	
	<tr>
	<td colspan=2>
	<?php
		$this->load->model('alerts');
		$alerts = $this->alerts->getCurrentAlerts();
		if(count($alerts)>0)
		{
			$tickerContentArray = array();
			foreach($alerts as $alert) 
			{
				$shortTitle = $alert['short_title'];
				$actionURL = $alert['action_url'];
				$tickerContentArray[] = "<a class=\"bannerURL\" href=\"$actionURL\">$shortTitle</a>";
			}
			$tickerContentHTML = implode("&nbsp;*&nbsp;", $tickerContentArray);
	 ?>
		<DIV ID="TICKER" STYLE="overflow:hidden; width:951px; background-color: lightgray; text-color:#900000"  onmouseover="TICKER_PAUSED=true" onmouseout="TICKER_PAUSED=false">
			<?php echo $tickerContentHTML ?>
		</DIV>
		<script type="text/javascript" src="/js/webticker_lib.js" language="javascript"></script>
	<?php
		}
	?>
	</td>
	</tr>
	
	<!-- menu -->
	<tr>
		<td colspan=2>
		<table border=0 align=left>
			<tr>
				<td><a href="/home/index" class="menu_item">Home</a>&nbsp;&nbsp;</td>
				<td><a href="/home/aboutus" class="menu_item">About Us</a>&nbsp;&nbsp;</td>
				<td><a href="/home/candidates" class="menu_item">Candidates</a>&nbsp;&nbsp;</td>
				<td><a href="/home/officials" class="menu_item">Elected Officials</a>&nbsp;&nbsp;</td>
				<td><a href="/home/resources" class="menu_item">Resources</a>&nbsp;&nbsp;</td>
				<td><a href="/home/clubsandcaucuses" class="menu_item">Clubs &amp; Caucuses</a>&nbsp;&nbsp;</td>
				<td><a href="/home/contactus" class="menu_item">Contact Us</a>&nbsp;&nbsp;</td>
				<td><a href="/home/member" class="menu_item">Member</a>&nbsp;&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	
