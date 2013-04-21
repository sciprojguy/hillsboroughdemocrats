<!--
  -->
<?php

	$this->load->helper('form');
	
	$tickerTypes = array("alert"=>"Alert", "note"=>"Note", "news"=>"News");
	$tickerStatuses = array("new"=>"New", "active"=>"Active", "cancel"=>"Cancelled", "hold"=>"On Hold");
	
	# now generate the form fields
	$typeMenu = form_dropdown('type', $tickerTypes, $alert['type'], "");
	$statusMenu = form_dropdown('status', $tickerStatuses, $alert['status'], "");
	$startDateField = form_input( array(
		'id'=>'start_date_time',
		'name'=>'start_date_time',
		'size'=>10,
		'value'=>$alert['start_date_time'],
		'style'=>"'color:white'",
		'class'=>'tcal'
	) );
	
	$endDateField = form_input( array(
		'id'=>'end_date_time',
		'name'=>'end_date_time',
		'size'=>10,
		'value'=>$alert['end_date_time'],
		'class'=>'tcal'
	) );
	
 	$titleField = form_input( array(
		'id'=>'short_title',
		'name'=>'short_title',
		'size'=>60,
		'maxlength'=>255,
		'class'=>'input_field',
		'value'=>$alert['short_title']
	) );
	
	$descriptionField = form_textarea( array(
		'id'=>'description',
		'name'=>'description',
		'rows'=>5,
		'cols'=>60,
		'class'=>'input_field',
		'value'=>$alert['description']
	) );
	
	$actionURLField = form_input( array(
		'id'=>'action_url',
		'name'=>'action_url',
		'value'=>$alert['action_url']
	) );

	$titleErrors = "";
	$descriptionErrors = "";
	$startDateErrors = "";
	$endDateErrors = "";
	$typeErrors = "";
	$statusErrors = "";
	$actionURLErrors = "";
	
	if(isset($errors))
	{	
		if(isset($errors['type']))
		{
			$typeErrors = implode("<br>", $errors['type']);
		}
		
		if(isset($errors['status']))
		{
			$statusErrors = implode("<br>", $errors['status']);
		}
		
		if(isset($errors['start_date_time']))
		{
			$startDateErrors = implode("<br>", $errors['start_date_time']);
		}
		
		if(isset($errors['end_date_time']))
		{
			$endDateErrors = implode("<br>", $errors['end_date_time']);
		}
		
		if(isset($errors['short_title']))
		{
			$titleErrors = implode("<br>", $errors['short_title']);
		}
	}
	else
	{
		# no errors
	}
 ?>
<div style='contentBox'>
		<form method=post action=<?= $action ?>>
			<table border=0 cellpadding=0 align=center width=80%>
				<tr>
					<td colspan=4>
						<span style='color:white;font-family:Helvetica'>
						Action Alert Ticker Item.  This item will display in the site's
						news ticker starting on the Start Displaying date and ending on the 
						End Displaying date.  The Title will be displayed.  Clicking on the 
						Title will send the browser to the Action URL.
						</span>
						<p/>
					</td>
				</tr>
				<tr>
					<td>
						<span style='color:red;font-family:Helvetica'><?= $typeErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>Type:</span><br>
						<?php echo $typeMenu; ?>
						<p>
					</td>
					<td>
						<span style='color:red;font-family:Helvetica'><?= $statusErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>Status:</span><br>
						<?php echo $statusMenu; ?>
						<p>
					</td>
					<td>
						<span style='color:red;font-family:Helvetica'><?= $startDateErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>Start Displaying:</span><br>
						<?php echo $startDateField ?><p>
					</td>
					<td>
						<span style='color:red;font-family:Helvetica'><?= $endDateErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>End Displaying:</span><br>
						<?php echo $endDateField ?><p>
					</td>
				</tr>
				<tr>
					<td colspan=3>
						<span style='color:red;font-family:Helvetica'><?= $titleErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>Title:</span><br>
						<?= $titleField ?>
						<p/>
						<span style='color:white;font-family:Helvetica'>Description:</span><br>
						<span style='color:red;font-family:Helvetica'><?= $descriptionErrors ?></span><br>
						<?= $descriptionField ?>
						<p/>
						<span style='color:red;font-family:Helvetica'><?= $actionURLErrors ?></span><br>
						<span style='color:white;font-family:Helvetica'>URL:</span><br>
						<?= $actionURLField ?>
						<p/>
					</td>
				</tr>
				<tr>
				<td colspan=3 align=right>
				<?php if(isset($id)) echo "<input type=hidden name=id value=\"$id\">";?>
			<input type=reset value=" Clear ">&nbsp;&nbsp;<input type=submit value=" <?= $button ?> ">
			</td>
			</tr>
			</table>
		</form>

</div>