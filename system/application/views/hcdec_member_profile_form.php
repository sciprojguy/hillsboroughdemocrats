<?php
	$this->load->helper('form');
	# stuff members can edit for themselves:
	# name (first, middle, last, salutation), address, precinct#, DOB, email, site password
	$firstNameField = form_input(array('name'=>'firstName', 'size'=>25, 'value'=>$member['firstName']));
	$middleNameField = form_input(array('name'=>'middleName', 'size'=>25, 'value'=>$member['middleName']));
	$lastNameField = form_input(array('name'=>'lastName', 'size'=>35, 'value'=>$member['lastName']));
#	$salutationField = form_input(array('name'=>'salutation', 'size'=>25, 'value'=>$member['salutation']));
	$streetField = form_input(array('name'=>'street', 'size'=>35, 'value'=>$member['street']));
	$cityField = form_input(array('name'=>'city', 'size'=>25, 'value'=>$member['city']));
	$zipField = form_input(array('name'=>'zip', 'size'=>15, 'value'=>$member['zip']));
	$precinctField = form_input(array('name'=>'precinct', 'size'=>10, 'value'=>$member['precinct']));
	#TODO add a "sex" field
	$dobField = form_input(array('name'=>'dob', 'size'=>25, 'value'=>$member['dob']));
	$emailField = form_input(array('name'=>'email', 'size'=>65, 'value'=>$member['email']));
	$phoneField = form_input(array('name'=>'phone', 'size'=>18, 'value'=>$member['phone']));
	?>

<div class='contentBox'>
	<!-- error div-->
	<form method="POST" action="/hcdec/editmyprofile">
	<div style='color:red;width:100%'>
	<?php
	if(isset($errors['firstName']))
	{ 
		echo join("<br>", $errors['firstName']);
	}
	
	if(isset($errors['middleName']))
	{ 
		echo join("<br>", $errors['middleName']);
	}
	
	if(isset($errors['lastName']))
	{ 
		echo join("<br>", $errors['lastName']);
	}
	?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Last Name:<br>
		<?= $lastNameField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		First Name:<br>
		<?= $firstNameField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Middle Name:<br>
		<?= $middleNameField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Date of Birth:<br>
		<?= $dobField ?>
	</div>
	<div style='clear:both'></div>
	<div style='color:red;width:100%'>
	<?php
	if(isset($errors['precinct']))
	{ 
		echo join("<br>", $errors['precinct']);
	}
	
	if(isset($errors['street']))
	{ 
		echo join("<br>", $errors['street']);
	}
	
	if(isset($errors['city']))
	{ 
		echo join("<br>", $errors['city']);
	}
	
	if(isset($errors['zip']))
	{ 
		echo join("<br>", $errors['zip']);
	}
	?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Precinct:<br>
		<?= $precinctField ?>
	</div>
	<!-- error div-->
	<div style='color:red;width:100%'>
	</div>
	<div style='float:left;padding-right:8px;'>
		Street Address:<br>
		<?= $streetField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		City:<br>
		<?= $cityField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Zip:<br>
		<?= $zipField ?>
	</div>
	<div style='clear:both'></div>
	<!-- error div-->
	<div style='color:red;width:100%'>
	</div>
	<div style='float:left;padding-right:8px;'>
		Phone:<br>
		<?= $phoneField ?>
	</div>
	<div style='float:left;padding-right:8px;'>
		Email:<br>
		<?= $emailField ?>
	</div>
	<div style='clear:both'></div>
	<input type=submit value=" Apply ">	
	</form>
</div>
