<style>
.levelDiv {
	float:left;
	height:180px;
	width:100px;
	background-color:white;
	margin-left: 8px;
	margin-bottom: 8px;
	text-align:center;
}

.candidateDiv {
	float:left;
	text-align:center;
	margin-left: 8px;
	margin-bottom: 8px;
	height:180px;
	width:120px;
	background-color:white;
	border: solid 1px lightgray;
}

.candidateDivLink {
	text-decoration:none;
	font-size:9pt;
}

.candidateBackground {
	background-color:lightgray;
	width:100%;
	height:100%;
}

</style>

<div class='contentBox'>
<img src="/images/candidatesLabel.png">
<?php
function leveldiv( $level )
{
/*
  +----------+
  | picture  |
  | label    |
  +----------+
  
  picture is /images/$level.png
 */
	$div = "<div class='levelDiv'>";
	$div .= "<strong>$level</strong><br>";
	$div .= "<img src=\"/images/candidates/$level.png\">";
	$div .= "</div>";
	return $div;
}

function candidatediv( $office, $candidate, $editable )
{
	$div = "<div class='candidateDiv'>";
	$div .= "<div style='width:100px;margin-left:auto;margin-right:auto;margin-top:2px;margin-bottom:2px;font-size:8pt;color:black;'><em>$office</em></div>";
	$imgsrc = "nopicture.png";
	if(isset($candidate['picture']) && '' != $candidate['picture'])
		$imgsrc = $candidate['picture'];
	$div .= "<img src=\"/images/candidates/$imgsrc\"><br>";
	
	if($editable)
	{
		# edit link
		$div .= "<a href=\"/hcdec/editcandidate/id/{$candidate['id']}\">";
		$div .= "<div style='font-size:10pt;padding-left:4px;padding-right:4px;'>{$candidate['firstName']} {$candidate['lastName']}</div>";
		$div .= "</a>";
	}
	else
	{
#		$div .= "<a href=\"/hcdec/viewcandidate/id/{$candidate['id']}\">";
		$div .= "<div style='font-size:10pt;padding-left:4px;padding-right:4px;'>{$candidate['firstName']} {$candidate['lastName']}</div>";
#		$div .= "</a>";
	}
	
	if(isset($candidate['webSite']) && '' != $candidate['webSite'])
		$div .= "<div style='padding-left:4px;padding-right:4px;'><a style='font-size:8pt' href=\"{$candidate['webSite']}\">Web Site</a></div>";
	$div .= "</div>";
	return $div;
}

$canEdit = false;
if(isset($user['roles']) && in_array("manage_candidates", $user['roles']))
	$canEdit = true;

if($canEdit)
	echo "<a href=\"/hcdec/newcandidate\">Add A Candidate</a>";
echo "<p/>";

foreach( $candidates as $level => $offices )
{
	# format and output a level div
	echo "<div style='clear:both'></div>";
	echo leveldiv( $level );
	foreach( $offices as $office => $candidates_array )
	{
		# format and output an office div? no.
		foreach( $candidates_array as $candidate )
		{
			# format and output a candidate div
			echo candidatediv( $office, $candidate, $canEdit );
		}
	}
}

?>
</div>