<?php
# incoming - $candidate - need to know which is the incumbent
	$candidateName = $candidate['firstName'];
	if(isset($candidate['middleName'])) $candidateName .= ' '.$candidate['middleName'];
	$candidateName .= $candidate['lastName'];
?>
<div class='candidate'>
	<div class='candidatePic'>
		<img src="/images/candidates/<?= $candidate['picture']?>">
	</div>
	<div class='candidateName'>
		<?= $candidateName ?>
	</div>
	<div class='candidateContact'>
	</div>
	<div class='candidateMore'>
	</div>
</div>