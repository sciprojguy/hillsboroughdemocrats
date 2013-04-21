<?php	
	$identityContent = "";
	if(isset($user['id']))
	{
		$identityContent = "<div style='width:200px;font-family:Helvetica,Arial,sans-serif;font-size:9pt;color:white;text-align:right'>";
		if(isset($user['salutation']) && !empty($user['salutation']))
			$identityContent .= "Welcome, {$user['salutation']} &#149; ";
		else
			$identityContent .= "Welcome, {$user['firstName']} {$user['lastName']} &#149; ";
		$identityContent .= "<a style='font-family:Helvetica;font-size:9pt;color:white;text-decoration:none;' href=\"/hcdec/logout\">Logout</a>";
		$identityContent .= "</div>";
	}
	else
	{
//FIXME this is only hidden until we finish rolling out the site with members and everything
/*
		$identityContent = "<div style='text-align:left;width:250px;font-family:Helvetica,Arial,sans-serif;font-size:9pt;color:white'>";
		$identityContent .= "<form method=POST action=/hcdec/login>";
		$identityContent .= "Username: <input type=text name=username size=15><br>";
		$identityContent .= "Password: <input type=password name=password size=15>&nbsp;<button type=submit style='width:50px;font-size:8pt'Log In>Log In</button>";
		$identityContent .= "</form>";
		$identityContent .= "</div>";
*/
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Hillsborough County Democratic Party</title>
	<link rel="stylesheet" media="screen" type="text/css" href="/css/site.css" />
	<!-- for JS calendar -->
	<link rel="stylesheet" type="text/css" href="/js/tcal.css" />
	<script type="text/javascript" src="/js/tcal.js"></script> 
	<SCRIPT LANGUAGE="JavaScript" SRC="/js/timepicker.js"></SCRIPT>
</head>
<body style='background-color:black'>

<div class="pageContainer">

	<div class="header">
	
		<div style='width:75%;float:left;align:left'>
			<img style='float:left; margin: 4px 4px 4px 4px' src="/images/banner.png">
		<div style='float:left'>
			<?= $identityContent ?>
		</div>
			
		</div>
		<div style='width:25%;float:right'>
			<div style='width:200px;height:30px;margin-left:4px'>
			<form action="https://Simplecheckout.authorize.net/payment/CatalogPayment.aspx" 
				method="post" name="form1" target="_blank">
			  <input type="hidden" name ="LinkId" value ="dd7e22ac-1d8a-4b17-9340-12f3a0050027" />
			  <input type="image" name="imageField" id="imageField" src="/images/donateButton.png" style='width:250px'>
			</form>
		</div>	
		</div>
	</div>
	<?php
	# move this into the controller
		$this->load->model('alerts');
		$alerts = $this->alerts->getCurrentAlerts();
	# but leave this here
		if(count($alerts)>0)
		{
			$tickerContentArray = array();
			foreach($alerts as $alert) 
			{
				$shortTitle = $alert['short_title'];
				$actionURL = $alert['action_url'];
				$tickerContentArray[] = "<a class=\"tickerLink\" href=\"$actionURL\">$shortTitle</a>";
			}
			$tickerContentHTML = implode(" &#149; ", $tickerContentArray);
	 ?>
	<table width=100% border=0 cellpadding=0>
	<tr>
		<td width=100%>
		<div ID="TICKER" 
			STYLE="overflow:hidden; background-color:lightblue; margin-bottom:1px; padding-top:0; height:24px;width:1016px;text-decoration:none;"  onmouseover="TICKER_PAUSED=true" onmouseout="TICKER_PAUSED=false">
			<?= $tickerContentHTML ?>
		</div>
	<?php
		}
	?>
	<script type="text/javascript" src="/js/webticker_lib.js"></script>
	</td>
	</tr>
	</table>
	
	<div style='height:8px'></div>
	
	<!-- move this into its own view -->
	<div class="menu">
		<a href="/hcdec/index" class="menuItem" id="index" title="Home page">Home</a> &nbsp;
		<a href="/hcdec/aboutus" class="menuItem" id="aboutus" title="Officers, Committees, Principles and Platform">About Us</a>&nbsp;
		<!--  
		<a href="/hcdec/kennedykingdinner" class="menuItem" id="aboutus" title="Kennedy/King Dinner">Kennedy/King</a>&nbsp;
		 --> 
		<a href="/hcdec/candidates" class="menuItem" id="candidates">Candidates</a> &nbsp;
		<a href="/hcdec/officials" class="menuItem" id="officials">Officials</a> &nbsp;
		<a href="/hcdec/clubsandcaucuses" class="menuItem" id="clubsandcaucuses">Clubs &amp; Caucuses</a>&nbsp; 
		<a href="/hcdec/resources" class="menuItem" id="resources">Resources</a> &nbsp;
		<a href="/hcdec/news" class="menuItem" id="news">News</a> &nbsp;
		<a href="/hcdec/contactus" class="menuItem" id="contactus">Contact Us</a> 
	<?php 
		if(isset($user['id']))
		{
		?>
		<a href="/hcdec/myhcdec" class="menuItem" id="myhcdec">My HCDEC</a> 
	<?php
		 } 
		?>
	</div>
	
	<div class="contentBoxContainer">
		<div class="mainColumn">
		<?= $content ?>
		</div>
	</div>
	
</div>
</body>
</html>