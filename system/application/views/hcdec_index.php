<?php
if(isset($flashMessage))
{
	echo "<div style='width:100%;background-color:lightgray'>$flashMessage</div>";
} 
?>
<div class='contentBox'>

<div style='clear:all;padding-left:4px;padding-right:4px;padding-left:16px;background-color:lightblue;width:100%;height:2px;'> </div>
<div style='width:670px;height:80%;float:left;background-color:white;margin-right:8px;'>
<div style='width:100%'>
	<div style='width:100%;padding:4px 4px 4px 4px;margin-left:auto;margin-right:auto'>
		<div style='margin-left:54px;margin-right;center'>
 			 <iframe width="560" height="315" src="http://www.youtube.com/embed/GpdoHwhhCf0" frameborder="0" allowfullscreen></iframe>
 		</div>
		<p/>
		Our party was founded on the conviction that wealth and privilege shouldn’t be an entitlement to
		rule and the belief that the values of hardworking families are the values that should guide us.<p/>
	
		Democrats believe that we're greater together than we are on our own—that this country
		succeeds when everyone gets a fair shot, when everyone does their fair share, when everyone
		plays by the same rules.<p/>		
		<p/>		
		<p/>		
		<p/>		
		<p/>		
		<p/>		
		Learn more about our Party, what we believe and what we will do to help move our County, our State, 
		and our Nation FORWARD.<p/>
		<div style='padding-left:8px; padding-right:8px'>
		<ul>
			<li><a href="http://i2.cdn.turner.com/cnn/2012/images/10/23/jobs.plan.booklet.pdf">
		Read President Obama's Plan for the Second Term.</a></li>
			<li><a href="http://www.hillsboroughcountydemocrats.org/pdf/HCDEC%20Platform-FINAL%20Apr2012-r2.pdf">The Hillsborough County Democratic Party Platform</a></li>
			<li><a href="http://www.hillsboroughcountydemocrats.org/pdf/Principles%20for%20the%20Hillsborough%20County%20Democratic%20Party.pdf">Our Principles</a></li>
			<li><a href="http://www.floridadems.org/sites/fladems/files/FDP%202012%20Platform%20-%20Final.pdf">The Florida Democratic Party Platform</a></li>
			<li><a href="http://assets.dstatic.org/dnc-platform/2012-National-Platform.pdf">The National Democratic Party Platform</a></li>
		</ul>
		</div>
	</div>
	<div style='padding:4px 4px 4px 4px'>
	</div>
</div>

</div>

<div style='float:left;width:150px; height:100%; background-color:white;padding-left:8px;'>

	<!-- spacer div -->
	<div style='height:4px'></div>
	
	<br><strong>Sign Up For Updates</strong><br>
	
	<div style='float:left'>
		<div style="text-align:left; font-size:x-small;width:299px;">
		<script type="text/javascript" src="http://www.formstack.com/forms/js.php?1309388-0Rrbm2HzzF-v3&jsonp">
		</script>
		<noscript>
			<a href="http://www.formstack.com/forms/?1309388-0Rrbm2HzzF" title="Online Form">Online Form - Constant Contact List Signup</a>
		</noscript>
		</div>
		<div style="text-align:right; font-size:x-small;">
			<a href="http://www.formstack.com/try-formstack?utm_source=h&utm_medium=jsembed&utm_campaign=fa&fa=h,1309388" ></a>
		</div>
	</div>
	
	<!-- spacer div -->
	<div style='height:16px'></div>

	<!-- donate link 
		<div style='width:299px;margin-left:auto;margin-right:auto'>
			<form action="https://Simplecheckout.authorize.net/payment/CatalogPayment.aspx" 
				method="post" name="form1" target="_blank">
			  <input type="hidden" name ="LinkId" value ="dd7e22ac-1d8a-4b17-9340-12f3a0050027" />
			  <input type="image" name="imageField" id="imageField" src="/images/donateButton.png" style='width:299px'>
			</form>
		</div> -->
		
	<!-- volunteer link -->
		<div style='width:249px;margin-right:auto'>
			<a href="/hcdec/volunteer">
			<img src="/images/volunteer.png" width="299" height="40" border="0">
			</a>
		</div>
		
	
	<!-- spacer div -->
	<div style='height:16px'></div>
	
	<!-- Google calendar -->
	<div style='width:100%;height:329px;margin-left:auto;margin-right:auto;'>
	<div style='width:249px;text-align:center;padding-bottom:8px;font-weight:bold;'>Upcoming Events</div>
	<?= $events_content ?>	
	<p/>
		<div style='text-align:center;width:100%;'>
		<a href="/hcdec/calendar">Full	Calendar &gt;&gt;&gt;</a>
		</div> 
	</div>

	<div style='height:16px'></div>
	
	<!-- Facebook etc links -->
	<a href="https://www.facebook.com/pages/Hillsborough-County-Democratic-Party/134328246608491">
	<img border=0 src="/images/Facebook-Logo-32x32.png"></a>
	&nbsp;
	<a href="https://twitter.com/#!/hillsdems"><img border=0 src="/images/twitter_logo.png"></a>
	<p/>
	<div style='width:309px'>
	<strong>GET INVOLVED!</strong>
	<ul>
		<li><a href="http://www.voterfocus.com/hosting/hillsborough/?urllength=5000&showurl=https%3A//www.voterfocus.com/ws/Pfinder/printvapp4.php?county=hillsborough">REGISTER TO VOTE</a></li>
		<li><a href="http://votehillsborough.org/?id=3">FIND YOUR PRECINCT</a></li>
		<li><a href="mailto:credentials@hillsdems.org">BECOME A MEMBER</a></li>
		<li><a href="/hcdec/volunteer">VOLUNTEER</a></li>
		<li><a href="http://www.voterfocus.com/hosting/hillsborough/ew_pages/Candidate%20Services/Precinct%20Committeemen%20and%20Women.pdf">BECOME A PRECINCT COMMITTEEMAN OR COMMITTEEWOMAN</a>
	</ul>
	</div>
	<!-- make this a fixed height w/overflow and get all items promoted to front page -->
	<div style='font-weight:bold;width:309px; height: 120px; overflow:auto; padding-left:8px;padding-right:8px;'>
		<?= $news_content ?>   
	</div>
</div>

<div style='clear:both;height:1px;width:100%;background-color:white;'>
</div>

</div>