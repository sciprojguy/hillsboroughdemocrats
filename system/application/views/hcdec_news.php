<div class='contentBox'>

	<div style='width:54%;float:left;overflow:auto;margin-top:4px;'>
	<img src="/images/news.jpg" width="242">
	<?php 
		$editable = in_array('manage_news', $user['roles']);
		if($editable)
		{
			echo "&nbsp;<a href=\"/hcdec/newnewsitem\">Add News Item</a><p>";
		}
		foreach( $newsItems as $newsItem )
		{
			if($editable)
			{
				echo "<a href=\"/hcdec/editnewsitem/id/{$newsItem['id']}\">{$newsItem['title']}</a><br>";
			}
			else
				echo "<a href=\"{$newsItem['link']}\">{$newsItem['title']}</a><br>";
		}
	?>
	<!--
<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=53eb95fcce&e=c9085e6ea5">April 15, 2012 - <strong>LATEST NEWS</strong> from the Hillsborough Democratic Party</a><br>   
<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=f8e9ce3baf">April 8, 2012 <strong>"Two Announcements"</strong></a> <br>
<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=b8430ab229&e=c9085e6ea5">April 1, 2012 - <strong>LATEST NEWS</strong> from the Hillsborough Democratic Party</a><br>  
<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=e918c6cba2&e=c9085e6ea5">March 18, 2012 - <strong>LATEST NEWS</strong> from the Hillsborough Democratic Party</a><br>
<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=1e6b9e5f28&e=c9085e6ea5">March 4, 2012 - <strong>LATEST NEWS</strong> from the Hillsborough Democratic Party</a><br>
  -->	
		<?php
		
		
		/*
		foreach( $newsitems as $newsitem )
		{
			# for first entry, it's LATEST NEWS from the HCDEC
			# for each one after, it's M/D/YYYY Issue
			if(in_array('manage_news', $user['roles']))
			{
				# echo "Edit" link
			}
			
			echo "<a href=\"{$newsitem['link']}\"></a>";
		} 
		*/
		?>
	</div>
	<div style='width:45%;float:right;margin-left:10px;margin-top:4px;'>
		<script src="http://widgets.twimg.com/j/2/widget.js"></script>
		<script>
		new TWTR.Widget({
		  version: 2,
		  type: 'profile',
		  rpp: 10,
		  interval: 2000,
		  width: 400,
		  height: 450,
		  theme: {
		    shell: {
		      background: '#1b4565',
		      color: '#ffffff'
		    },
		    tweets: {
		      background: '#ffffff',
		      color: '#000000',
		      links: '#e88c3c'
		    }
		  },
		  features: {
		    scrollbar: true,
		    loop: false,
		    live: false,
		    hashtags: true,
		    timestamp: true,
		    avatars: true,
		    behavior: 'all'
		  }
		}).render().setUser('@FlaDems').start();
		</script>
	</div>
	<div style='clear:both'></div>
	<!-- 
	<table width="100%" border="0" cellspacing="0">
		<tr>
			<td align="center">
				<table width="100%" border="0" cellspacing="0">
		        	<tr>
		          		<td width=45%>
		          			<img src="/images/news.jpg" width="242"><p>
							<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&i<br>d=48d56c9772&e=5fee208d2e">1.22.2012 - 
							<u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u>
							</a>
		            		<p><a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=f6eb652fc1&e=5fee208d2e">1.8.2012 - <strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</a>
		            		<p><a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=65745ffeb5&e=5fee208d2e">12.11.2011 - <u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u></a>
		            		<p><a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=abcb992d84&e=5fee208d2e" target="_blank">10.15.2011 - </a><a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=40840c1809&e=7f54258285" target="_blank"><u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u></a>
		            		<p><a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=20b3f83c37&e=" target="_blank">10.1.2011 - </a><a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=40840c1809&e=7f54258285" target="_blank"><u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u></a>
		            		<p><a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=20b3f83c37&e=" target="_blank">9.16.2011 -</a> <a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=d063ea94c0&e=c9085e6ea5" target="_blank"><u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u></a>
		            		<p><a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=20b3f83c37&e=" target="_blank">9.2.2011 - <u><strong>LATEST NEWS </strong>from the Hillsborough Democratic Party</u></a><u></u><br>
		              		<br>
		              		<a href="http://us1.campaign-archive1.com/?u=bbf641b7b3417d834ef8dd1dc&id=9c69667f9f&e=5fee208d2e" target="_blank">8.15.2011 - Democrats Call on Mark Sharpe to Resign from BOCC</a>
		              		<br> 
                  			<span id=":zq">
                  			<a href="http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=ad228531d2&e=5fee208d2e" target="_blank">8.10.2011 - ACTION ALERT - Defend Kevin Beckner Against New Attack NOW!</a>
                  			</span></p>
                  </td>
                  <td align=right>
                  	<div style='margin-left:10px'>
					<script src="http://widgets.twimg.com/j/2/widget.js"></script>
					<script>
					new TWTR.Widget({
					  version: 2,
					  type: 'profile',
					  rpp: 10,
					  interval: 2000,
					  width: 400,
					  height: 450,
					  theme: {
					    shell: {
					      background: '#1b4565',
					      color: '#ffffff'
					    },
					    tweets: {
					      background: '#ffffff',
					      color: '#000000',
					      links: '#e88c3c'
					    }
					  },
					  features: {
					    scrollbar: true,
					    loop: false,
					    live: false,
					    hashtags: true,
					    timestamp: true,
					    avatars: true,
					    behavior: 'all'
					  }
					}).render().setUser('@FlaDems').start();
					</script>
					</div>
				</td>
	        </tr>
		</table>
		</td></tr>
   </table>		
    -->        
</div>