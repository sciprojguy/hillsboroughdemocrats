<?php
	$this->load->helper('form');
	$dateField = form_input(array(
		'id'=>'date',
		'name'=>'date',
		'value'=>$event['date'],
		'size'=>12,
		'class'=>'tcal'
	));
	
	$startTimeField = form_input(array(
		'id'=>'start_time',
		'name'=>'start_time',
		'value'=>$event['startTime'],
		'size'=>8,
		'ONBLUR'=>'"validateDatePicker(this)"'
	));
	
	$durations = array(
		5 => "5 minutes",
		15=>"15 minutes",
		30=>"30 minutes",
		45=>"45 minutes",
		60=>"1 hour",
		90=>"1.5 hours",
		120=>"2 hours",
		240=>"4 hours",
		480=>"8 hours",
		0=>"Other"
	);
	
	$durationsMenu = form_dropdown('duration_in_minutes', $durations, "");
	
	$event_types = array(
		'general'=>'General Meeting',
		'committee'=>'Committee Meeting', 
		'fundraiser'=>'Fundraiser',
		'press'=>'Press Event',
		'demo'=>'Demonstration',
		'campaign'=>'Campaign Event'
	);
	
	$eventTypeMenu = form_dropdown('type', $event_types, $event['type']);
	
	$titleField = form_input(array(
		'id'=>'title',
		'name'=>'title',
		'size'=>40,
		'value'=>$event['title']
	));
	
	$descriptionField = form_textarea(array(
		'id'=>'description',
		'name'=>'description',
		'rows'=>3, 'cols'=>50, 'maxlength'=>255,
		'value'=>$event['description']
	));
	
	$locationField = form_textarea(array(
		'id'=>'location',
		'name'=>'location',
		'rows'=>3, 'cols'=>50, 'maxlength'=>255,
		'value'=>$event['location']
	));
	
	$statuses = array(
		'submitted' => 'Submitted',
		'approved' => 'Approved',
		'canceled' => 'Canceled',
		'rescheduled' => 'Rescheduled',
		'rejected' => 'Rejected'
	);
	
	$statusMenu = form_dropdown('status', $statuses, $event['status'] );
	
	$contactField = form_input(array(
		'id'=>'contact',
		'name'=>'contact',
		'size'=>32,
		'value'=>$event['contact']
	));
	
	$phoneField = form_input(array(
		'id'=>'contact_phone',
		'name'=>'contact_phone',
		'size'=>16,
		'value'=>$event['contact_phone']
	));
	
	$emailField = form_input(array(
		'id'=>'contact_email',
		'name'=>'contact_email',
		'size'=>50,
		'value'=>$event['contact_email']
	));
	
	$urlField = form_input(array(
		'id'=>'contact_url',
		'name'=>'contact_url',
		'size'=>50,
		'value'=>$event['contact_url']
	));
	
	?>
<form method="POST" action="/hcdec/submitevent">
<div class='form'>
Submit an event to the HCDEC Calendar.<p>
 <div style='float:left;margin-right:10px'>
 	Type<br><?= $eventTypeMenu ?>
 </div>
 
 <div class='formField'>
 	Title<br><?= $titleField ?>
 </div>
 
 <div style='float:left;margin-right:10px'>
 	Date<br><?= $dateField ?>
 </div>
 
 <div style='float:left;margin-right:10px'>
 	Start Time<br>
 	<div style='float:left'>
 	<?= $startTimeField ?>
 	</div>
 	<div style='float:left'>
	<IMG SRC="/images/timepicker.gif" BORDER="0" ALT="Pick a Time!" ONCLICK="selectTime(this,start_time)">
	</div>  
</div>
 
 <div class='formField'>
 	Duration<br><?= $durationsMenu ?>
 </div>
 
 <div style='clear:both'></div>
 
 <div style='float:left;margin-right:10px'>
 	Contact<br><?= $contactField ?>
 </div>
 
 <div style='float:left;margin-right:10px'>
 	Contact Phone<br><?= $phoneField ?>
 </div>

 <div style='float:left;margin-right:10px'>
 	Contact Email<br><?= $emailField ?>
 </div>
 <div style='clear:both'></div>

 <div style='float:left;margin-right:10px'>
 	Description<br><?= $descriptionField ?>
 </div>
 
 <div class='formField'>
 	Location<br><?= $locationField ?>
 </div>
 <div style='clear:both'></div>
 
 <div style='text-align:center'>
	 <input type=reset value=" Clear ">&nbsp;
	 <input type=submit value=" Submit ">
 </div> 
</div>
</form>
