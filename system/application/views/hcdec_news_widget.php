News
<div style='height:70px;overflow:auto'>
<?php
if(count($newsItems)>0)
{
	echo "<ul style='margin-top:0px'>";
	foreach($newsItems as $newsItem)
		echo "<li><a href=\"{$newsItem['link']}\">{$newsItem['title']}</a></li>";
	echo "</ul>";
}
?>
</div>
