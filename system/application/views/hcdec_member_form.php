<!--
	id
	firstName
	middleName
	lastName
	salutation
	dob
	sex (add on actual site)
	type
	street
	city
	state
	zip
	precinct
	email
	term_began
	status
	status_date
	notes
	
fields in this form:

	Member type: (ELECTED, APPOINTED, AUTOMATIC, NON_MEMBER (for interns))
	Member name: first, middle, last
	Member sex: (Male, Female, Not specified)
	Member address:
	Member email:
	Member phone:
	Member DOB:
	Member status:
	Member status notes:
  -->
  
<?php
$this->load->helper('form');

$sexOptions = array('male'=>'Male', 'female'=>'Female', 'not_given'=>'Not Specified');
$memberTypes = array('elected'=>'Elected', 'appointed'=>'Appointed', 'automatic'=>'Automatic', 'nonmember'=>'Non-Member');
$statusValues = array('applied'=>'Applied', 'active'=>'Active', 'inactive'=>'Inactive', 'removed'=>'Removed');

# now build the actual fields

$memberIdHidden = "";
if($action == 'editmember')
	$memberIdHidden = form_hidden('id', $member['id']);

$typeField = form_dropdown('type', $memberTypes, $member['type']);
$statusField = form_dropdown('status', $statusValues, $member['status']);
$termBeganField = form_input(array('name'=>'term_began', 'class'=>'tcal', 'size'=>10, 'value'=>$member['term_began']));

$firstNameField = form_input(array('name'=>'firstName', 'size'=>20, 'value'=>$member['firstName']));
$middleNameField = form_input(array('name'=>'middleName', 'size'=>20, 'value'=>$member['middleName']));
$lastNameField = form_input(array('name'=>'lastName', 'size'=>32, 'value'=>$member['lastName']));
$addressField = form_input(array('name'=>'street', 'size'=>40, 'value'=>$member['street']));
$cityField = form_input(array('name'=>'city', 'size'=>40, 'value'=>$member['city']));
$zipField = form_input(array('name'=>'zip', 'size'=>10, 'value'=>$member['zip']));
$precinctField = form_input(array('name'=>'precinct', 'size'=>5, 'value'=>$member['precinct']));
$phoneField = form_input(array('name'=>'phone', 'size'=>16, 'value'=>$member['phone']));
$emailField = form_input(array('name'=>'email', 'size'=>80, 'value'=>$member['email']));
$dobField = form_input(array('name'=>'dob', 'class'=>'tcal', 'size'=>10, 'value'=>$member['dob']));
$sexField = form_dropdown('sex', $sexOptions, $member['sex']);
$notesField = form_textarea(array('name'=>'notes', 'rows'=>4, 'cols'=>60, 'value'=>$member['notes']));

?>
<style>
.popupField {
	float:left;
	margin-right:16px;
}

.inputField {
	float:left;
	margin-right:16px;
}
</style>
<div class="contentBox">
<!-- add title graphic - MEMBER -->
<!-- add a spot up here for errors as well -->

<form method=POST action='/hcdec/<?= $action ?>'>
<?= $memberIdHidden ?>
<!-- top row - add a div with float left divs -->

<div class='popupField'>
Type:<br>
<?= $typeField ?>
</div>

<div class='popupField'>
Status:<br>
<?= $statusField?>
</div>

<div class='popupField'>
Term Began:<br>
<?= $termBeganField ?>
</div>

<div class='popupField'>
Precinct:<br>
<?= $precinctField ?>
</div>

<div class='popupField'>
Notes:<br>
<?= $notesField ?>
</div>

<div style='clear:both'></div>

<!-- name row -->
<div class='inputField'>
First Name:<br>
<?= $firstNameField ?>
</div>

<div class='inputField'>
Middle Name:<br>
<?= $middleNameField ?>
</div>

<div class='inputField'>
Last Name:<br>
<?= $lastNameField ?>
</div>

<div class='inputField'>
Sex:<br>
<?= $sexField ?>
</div>

<div class='inputField'>
Date of Birth:<br>
<?= $dobField ?>
</div>

<div style='clear:both'></div>
<!-- address row -->

<div class='inputField'>
Street Address:<br>
<?= $addressField ?>
</div>

<div class='inputField'>
City:<br>
<?= $cityField ?>
</div>

<div class='inputField'>
Zip:<br>
<?= $zipField ?>

</div>

<div style='clear:both'></div>

<!-- contact info row - email, phone -->
<div class='inputField'>
Email:<br>
<?= $emailField ?>
</div>

<div class='inputField'>
Phone:<br>
<?= $phoneField ?>
</div>
<div style='clear:both;height:16px;'></div>

<!-- submit button -->
<input type=submit value=" Submit ">
</form>
</div>