<div class="contentBox">
	<?php 
	if(in_array('manage_clubs', $user['roles']))
	{
		echo "<a style='padding-left:4px;text-decoration:none;color:blue;font-size:10pt' href=\"/hcdec/newcluborcaucus\">Add Club Or Caucus</a><p>";
	}
	
	$columns = 0;
	foreach($clubs as $club)
	{
		$div = $this->load->view('clubOrCaucus', $club, true);
		echo $div;
		$columns++;
		if($columns>2)
		{
			echo "<div style='clear:both'></div>";
			echo "<div style='width:100%;height:2px;background-color:#DDDDDD'></div>";
			$columns = 0;
		}
	}
	?>
</div>
