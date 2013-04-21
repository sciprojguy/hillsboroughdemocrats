<?php
	$memberStr = "";
	if(isset($salutation) && !empty($salutation)) $memberStr = "Welcome, $salutation";
	else if(isset($firstName) && !empty($firstName)) $memberStr = "Welcome, $firstName";
 ?>
<div class="memberIdentity">
	Welcome, <?= $memberStr?>
	<br>
	<a href="/home/logout" class="plainLink">Log Out</a>
</div>