<?php
	$this->load->helper('form');
	
	$types = array(
		'general_meeting'=>'General Meeting',
		'committee_meeting'=>'Committee Meeting',
		'club_meeting'=>'Club Meeting',
		'caucus_meeting'=>'Caucus Meeting',
		'fundraiser'=>'Fundraiser', 
		'rally'=>'Rally'
	);
	
	$statuses = array(
		'submitted'=>'Submitted',
		'approved'=>'Approved',
		'rejected'=>'Rejected',
		'canceled'=>'Canceled'
	);
	
	$tags = array(
		'general', 'publicity', 'steering', 'platform', 'finance', 'affirm_action',
		'campaign', 'IT', 'membership', 'credentials' , 'legal', 'legislative', 
		'JJ', 'fundraising', 'houseparty', 'signs', 'protest', 'budget', 'training',
		'GOTV','rally','candidate','environment'
	);
	
	$occursEvery = array('the 1st','the 2nd','the 3rd','the 4th','the 5th','every','every other');
	$occursDay = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	$occursMonth = array('once','every month','every other month');
	$rangeStartDate = form_input(array('name'=>'date1', 'id'=>'date1', 'size'=>10, 'class'=>'tcal', 'style'=>'color:black', ''));
	$rangeEndDate = form_input(array('name'=>'date2', 'id'=>'date2', 'size'=>10, 'class'=>'tcal', 'style'=>'color:black', ''));
	
	$eventIdHidden = "";
	if(isset($id))
		$eventIdHidden = form_hidden('id', $id);
		
	$eventTypeMenu = form_dropdown('type', $types, array('style'=>'font-size:12pt'));
	$eventStatusMenu = form_dropdown('status', $statuses, $event['status'], array('style'=>'font-size:12pt'));
	$eventDate = form_input(array('name'=>'date', 'id'=>'date', 'size'=>10, 'class'=>'tcal', 'style'=>'color:black', 'value'=>$event['date']));
	$eventStarts = form_input(array('name'=>'startTime', 'id'=>'startTime', 'size'=>8, 'style'=>'font-family:Helvetica,Arial,Sans-serif;font-size:12pt', 
	'onblur'=>'"validateDatePicker(this)"', 
	'value'=>$event['startTime']));
	$eventEnds = form_input(array('name'=>'endTime', 'id'=>'endTime', 
	'style'=>'font-family:Helvetica,Arial,Sans-serif;font-size:12pt', 'size'=>8, 
	'onblur'=>'"validateDatePicker(this)"', 
	'value'=>$event['endTime']));
	$eventTitle = form_input(array('name'=>'title', 'size'=>60, 'value'=>$event['title']));
	$eventDescription = form_textarea(array('name'=>'description', 'rows'=>5, 'cols'=>60, 'value'=>$event['description']));
	$eventContact = form_input(array('name'=>'contact', 'size'=>60, 'value'=>$event['contact']));
	$eventPhone = form_input(array('name'=>'contact_phone', 'size'=>16, 'value'=>$event['contact_phone']));
	$eventEmail = form_input(array('name'=>'contact_email', 'size'=>60, 'value'=>$event['contact_email']));
	$eventLocation = form_textarea(array('name'=>'location', 'rows'=>5, 'cols'=>60, 'value'=>$event['location']));
	$eventMapLink = form_input(array('name'=>'maplink', 'size'=>80, 'value'=>$event['maplink']));
	
	$occursEveryField = form_dropdown('occursEvery',$occursEvery, '', array('style'=>'font-size:12pt'));
	$occursDayField = form_dropdown('occursDay',$occursDay, '', array('style'=>'font-size:12pt'));
	$occursMonthField = form_dropdown('occursMonth',$occursMonth, '', array('style'=>'font-size:12pt'));
	
	$tagCheckboxes = array();
	if(isset($event['tags']))
		$tagArray = explode(",", $event['tags']);
	else
		$tagArray = array();
	
	foreach($tags as $tag)
	{
		$cb = form_checkbox(array('name'=>'tags[]'), $tag, in_array($tag, $tagArray));
		$tagCheckboxes[] = "&nbsp;$cb$tag&nbsp;";
	}
	
	if($action == 'addevent') 
		$img = "addEventLabel.png"; 
	else 
		$img = "editEventLabel.png"
?>

<div class='contentBox'>
	<img style='border:2px solid white' src="/images/<?=$img?>">
	<div style='width:98%;margin-left:auto;margin-right:auto;height:1px;background-color:gray;magin-top:4px;margin-bottom:4px'></div>
	<form method=POST action="/hcdec/<?=$action?>">
	<?= $eventIdHidden ?>
	<div style='float:left;margin-right:12px;width:19%'>
	Type:<br>
	<?= $eventTypeMenu ?>
	</div>
	
	<div style='float:left;margin-right:12px;width:19%'>
	Status:<br>
	<?= $eventStatusMenu ?>
	</div>
	
	<div style='float:left;margin-right:8px;width:19%'>
	<span style='color:red'>
	<?php 
	if(isset($errors['date']))
		echo implode(", ", $errors['date'])."<br>";
	?>
	</span>
	Date:<br>
	<?= $eventDate ?>
	</div>
	
	<div style='float:left;vertical-align:bottom;margin-right:8px;width:19%'>
	<span style='color:red'>
	<?php 
	if(isset($errors['startTime']))
		echo implode(", ", $errors['startTime'])."<br>";
	?>
	</span>
	Starts At:<br>
	<?= $eventStarts ?>
	<IMG SRC="/images/timepicker.gif" BORDER="0" ALT="Pick a Time!" ONCLICK="selectTime(this,startTime)">
	</div>
	
	<div style='float:left;width:19%'>
	<span style='color:red'>
	<?php 
	if(isset($errors['endTime']))
		echo implode(", ", $errors['endTime'])."<br>";
	?>
	</span>
	Ends At:<br>
	<?= $eventEnds ?>
	<IMG SRC="/images/timepicker.gif" BORDER="0" ALT="Pick a Time!" ONCLICK="selectTime(this,endTime)">
	</div>
	
	<div style='clear:both;height:12px'></div>
	Occurs the <?= $occursEveryField ?> <?= $occursDayField ?> <?= $occursMonthField ?>
	<div style='clear:both;height:12px'></div>
	
	<div style='float:left;width:48%'>
		<span style='color:red'>
		<?php 
		if(isset($errors['title']))
			echo implode(", ", $errors['title'])."<br>";
		?>
		</span>
		Title:<br>
		<?= $eventTitle ?>
		<br>
		<span style='color:red'>
		<?php 
		if(isset($errors['location']))
			echo implode(", ", $errors['location'])."<br>";
		?>
		</span>
		Location:<br>
		<?= $eventLocation ?>
		<br>
		Description:<br>
		<?= $eventDescription ?>
		<br>
		Location address (for mapping):<br>
		<?= $eventMapLink ?>
	</div>
			
	<div style='float:left;width:48%'>
	
		<span style='color:red'>
		<?php 
		if(isset($errors['contact']))
			echo implode(", ", $errors['contact'])."<br>";
		?>
		</span>
		Contact:<br>
		<?= $eventContact ?><br>
		
		<span style='color:red'>
		<?php 
		if(isset($errors['contact_phone']))
			echo implode(", ", $errors['contact_phone'])."<br>";
		?>
		</span>
		Phone:<br>
		<?= $eventPhone ?><br>
		
		Email:<br>
		<?= $eventEmail ?><br><br>
		
		Tags:<br>
		<?php 
		$num = 0;
		foreach($tagCheckboxes as $cb)
		{
			echo "<div style='float:left'>$cb</div>";
		}
		echo "<div style='clear:both'></div>";
		?>	
	</div>
	
	<div style='clear:both;height:12px'></div>
	
	<div style='width:20%;margin-left:auto;margin-right:auto'>
	<input type=reset value="Clear">&nbsp;<input type=submit value="Submit">
	</div>
	</form>
</div>