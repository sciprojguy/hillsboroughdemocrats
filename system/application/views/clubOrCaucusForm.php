<?php
	$this->load->helper('form');

	$activeStatuses = array('new'=>'New', 'active'=>'Active', 'inactive'=>'Inactive', 'suspend'=>'Suspended');
	
	if(isset($club['id']))
		$idField = form_hidden('id', $club['id']);
	else
		$idField = "";

	$statusField = form_dropdown('status', $activeStatuses, $club['status']);
	$nameField = form_input(array( 'name'=>'name', 'size'=>50, 'value'=>$club['name'] ));
	$descriptionField = form_textarea(array('rows'=>2, 'cols'=>60, 'name'=>'description', 'value'=>$club['description']));
	$presidentField = form_input(array( 'name'=>'president', 'size'=>50, 'value'=>$club['president'] ));
	$phoneField = form_input(array( 'name'=>'contact_phone', 'size'=>16, 'value'=>$club['contact_phone'] ));
	$emailField = form_input(array( 'name'=>'contact_email', 'size'=>50, 'value'=>$club['contact_email'] ));
	$urlField = form_input(array( 'name'=>'club_url', 'size'=>50, 'value'=>$club['club_url'] ));
	$meetsField = form_textarea(array('rows'=>2, 'cols'=>60, 'name'=>'meets', 'value'=>$club['meets']));

?>

<div class='contentBox'>

	<form method=POST action='/hcdec/<?=$action?>'>
		<?=$idField?>
		
		Status:<br>
		<?=$statusField;?>
		<p/>
		
		<!-- don't forget the error fields - these are required -->
		<?php
		if(isset($errors['name']) && count($errors['name'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['name'])."</div>";
		} 
		?>
		
		Name:<br>
		<?=$nameField?>
		<p/>
		
		<?php
		if(isset($errors['description']) && count($errors['description'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['description'])."</div>";
		} 
		?>
		
		Description:<br>
		<?=$descriptionField?>
		<p/>
		
		<?php
		if(isset($errors['president']) && count($errors['president'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['president'])."</div>";
		} 
		?>
		
		President/Organizer:<br>
		<?=$presidentField?>
		<p/>
		
		<?php
		if(isset($errors['meets']) && count($errors['meets'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['meets'])."</div>";
		} 
		?>
		
		Meets:<br>
		<?=$meetsField?>
		<p/>
		
		<?php
		if(isset($errors['contact_phone']) && count($errors['contact_phone'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['contact_phone'])."</div>";
		} 
		?>
		
		Contact Phone:<br>
		<?=$phoneField?>
		<p/>
		
		<!--  these are optional but they can still have validation errors -->
		
		<?php
		if(isset($errors['contact_email']) && count($errors['contact_email'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['contact_email'])."</div>";
		} 
		?>
		
		Email:<br>
		<?=$emailField?>
		
		<p/>
		<?php
		if(isset($errors['club_url']) && count($errors['club_url'])>0)
		{
			echo "<div class='errors'>".implode('<br>', $errors['club_url'])."</div>";
		} 
		?>
		
		Web Site / Facebook URL:<br>
		<?=$urlField?><p/>
		
		<input type=reset value=' Clear '>&nbsp;<input type=submit value=' Submit '>
		
	</form>
	
</div>