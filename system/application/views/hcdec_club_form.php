<?php

	$types = array( "club"=>"Club", "caucus"=>"Caucus" );
	$statuses = array( "new"=>"New", "active"=>"Active", "closed"=>"Closed" );
	$contactTypes = array( "organizer"=>"Organizer", "president"=>"President" );
	
	$typePopup = form_dropdown("type", $types, $type);
	$statusPopup = form_dropdown("status", $statuses, $status);
	$contactTypePopup = form_dropdown("contactType", $contactTypes, $contactType);
	
	$nameField = form_input(array('name'=>'name', 'id'=>'name', 'size'=>64, 'maxlen'=>64, 'value'=>"$name"));
	$meetsField = form_textarea(array('name'=>'meets', 'id'=>'meets', 'rows'=>3, 'cols'=>60, 'maxlen'=>255, 'value'=>"$meets"));
	$contactField = form_input(array('name'=>'president', 'id'=>'president', 'size'=>64, 'maxlen'=>64, 'value'=>"$president"));
	$phoneField = form_input(array('name'=>'contact_phone', 'id'=>'contact_phone', 'size'=>16, 'maxlen'=>16, 'value'=>"$contact_phone"));
	$emailField = form_input(array('name'=>'contact_email', 'id'=>'contact_email', 'size'=>80, 'maxlen'=>255, 'value'=>"$contact_email"));
	$clubUrlField = form_input(array('name'=>'club_url', 'id'=>'club_url', 'size'=>80, 'maxlen'=>255, 'value'=>"club_url"));
		
	?>
<div class="form">
<form method=post action="/admin/editcluborcaucus">
	<div style='float:left'>
		Type:<br>
		<?= $typePopup ?>
	</div>
	<div style='float:left'>
		Status:<br>
		<?= $statusPopup ?><p>
	</div>
	<div style='clear:both'></div>
	<div>
		Name:<br>
		<?= $nameField ?>
	</div>
	<div>
		Meets:<br>
		<?= $meetsField ?><p>
	</div>
	<div>
		<?= $contactTypePopup ?>:<br>
		<?= $contactField ?><p>
	</div>
	<div>
		Contact Type:<br>
		<?= $contactTypePopup ?><p>
	</div>
	<div>
		Contact Phone:<br>
		<?= $contactPhoneField ?><p>
	</div>
	<div>
		Contact Email:<br>
		<?= $contactEmailField ?><p>
	</div>
	<div>
		Web Site:<br>
		<?= $webSiteField ?><p>
	</div>
	<input type=submit value=" Apply ">
</form>
</div>