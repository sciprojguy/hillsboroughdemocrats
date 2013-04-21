<?php
/*
 */
	$this->load->helper('form');

	# $offices needs to be loaded in the controller and available by name 
	$officesPopup = form_dropdown('office', $offices, $candidate['office']);
	$deleteCB = "";
	if(isset($canDelete) && true==$canDelete)
	{
		$deleteCB = form_checkbox('delete', 'Y')." Delete";
	}
	
	$hidden = "";
	if(isset($candidate['id']))
		$hidden = form_hidden('id', $candidate['id']);
	$lastNameField = form_input(array(
		'name'=>'lastName', 'id'=>'lastName', 'size'=>32 ), 
		$candidate['lastName']);
		
	$firstNameField = form_input(
		array('name'=>'firstName', 'id'=>'firstName', 'size'=>32), 
		$candidate['firstName']);
		
	$middleNameField = form_input(
		array('name'=>'middleName', 'id'=>'middleName', 'size'=>32), 
		$candidate['middleName']);
	
	$yesOrNo = array('N'=>'No', 'Y'=>'Yes');
	
	$hasFiledField = form_dropdown('filed', $yesOrNo, $candidate['filed']);
	
	$filedDateField = form_input(
		array('name'=>'filedDate', 'id'=>'filedDate', 'class'=>'tcal', 'size'=>10, 'style'=>'color:black'), 
		$candidate['filedDate']);
		
	$qualified = form_dropdown('qualified', $yesOrNo, $candidate['qualified']);
	
	$qualTypes = array('petition'=>'Petition', 'fee'=>'Filing Fee');
	$qualifiedHow = form_dropdown('qualifiedHow', $qualTypes, $candidate['qualifiedHow']);
	
	$qualifiedDateField = form_input(
		array('name'=>'qualifiedDate', 'id'=>'qualifiedDate', 'class'=>'tcal', 'size'=>10, 'style'=>'color:black'), 
		$candidate['qualifiedDate']);
		
	$withdrawn = form_dropdown('withdrawn', $yesOrNo, $candidate['withdrawn']);
	
	$withdrawnDate = form_input(
		array('name'=>'withdrawnDate', 'id'=>'withdrawnDate', 'class'=>'tcal', 'size'=>10, 'style'=>'color:black'), 
		$candidate['withdrawnDate']);
	
	$webSiteField = form_input(
		array('name'=>'webSite', 'id'=>'webSite', 'size'=>80), 
		$candidate['webSite']);
	
	$emailField = form_input(
		array('name'=>'email', 'id'=>'email', 'size'=>80), 
		$candidate['email']);
	
	$contact = form_input(
		array('name'=>'contact', 'id'=>'contact', 'size'=>48), 
		$candidate['contact']);
	
	$contactAddressField = form_input(
		array('name'=>'contact_address', 'id'=>'contactAddress', 'size'=>80), 
		$candidate['contact_address']);
	
	$contactPhoneField = form_input(
		array('name'=>'contact_phone', 'id'=>'contactPhone', 'size'=>16), 
		$candidate['contact_phone']);
	
	$pictureField = form_upload(
		array('name'=>'picture', 'id'=>'picture', 'size'=>32), 
		$candidate['picture']);

	$largePictureField = form_upload(
		array('name'=>'large_picture', 'id'=>'large_picture', 'size'=>32), 
		$candidate['large_picture']);
		
	$bioField = form_textarea(array('name'=>'short_bio', 'rows'=>3, 'cols'=>60, 'value'=>$candidate['short_bio']));
	
	$blurbField = form_textarea(array('name'=>'campaign_statement', 'rows'=>3, 'cols'=>60, 'value'=>$candidate['campaign_statement']));
	
	?>
<div class='contentBox'>
<form method=post enctype="multipart/form-data" action="<? $action ?>">
<?=$hidden?>
<div style='float:left; padding-left:8px;padding-right:8px;'>

<!--  office level errors -->
<?php
 if(isset($errors['filed']))
 {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['filed']);
 	echo "</div>";
 }

  if(isset($errors['filedDate']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['filedDate']);
 	echo "</div>";
  }
  
  if(isset($errors['qualified']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['qualified']);
 	echo "</div>";
  }
  
  if(isset($errors['qualifiedDate']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['qualifiedDate']);
 	echo "</div>";
  }
  
  if(isset($errors['withdrawnDate']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['withdrawnDate']);
 	echo "</div>";
  }
  ?>
 
 Office<br><?= $officesPopup ?>
 </div>
  
 <div style='float:left; padding-right:8px;'>
 Filed<br><?= $hasFiledField ?>
 </div>
   
 <div style='float:left; padding-right:8px;'>
 Filed On<br><?= $filedDateField ?>
 </div>
 
 <div style='float:left; padding-right:8px;'>
 Qualified<br><?= $qualified ?>
 </div>
 
 <div style='float:left; padding-right:8px;'>
 By<br><?= $qualifiedHow ?>
 </div>
 
 <div style='float:left; padding-right:8px;'>
 On<br><?= $qualifiedDateField ?>
 </div>
 
 <div style='float:left; padding-right:8px;'>
 Withdrawn<br><?= $withdrawn ?>
 </div>
 
 <div style='float:left'>
 On<br><?= $withdrawnDate ?>
 </div>
 
<div style='clear:both'></div>

<?=$deleteCB?>
  <!--  candidate level errors -->
<?php 

  if(isset($errors['firstName']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['firstName']);
 	echo "</div>";
  }

  if(isset($errors['lastName']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['lastName']);
 	echo "</div>";
  }

  if(isset($errors['email']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['email']);
 	echo "</div>";
  }

  if(isset($errors['webSite']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['webSite']);
 	echo "</div>";
  }

  if(isset($errors['contact']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['contact']);
 	echo "</div>";
  }

  if(isset($errors['contact_phone']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['contact_phone']);
 	echo "</div>";
  }

  if(isset($errors['contact_address']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['contact_address']);
 	echo "</div>";
  }

  if(isset($errors['picture']))
  {
 	echo "<div style='width:100%;color:red'>";
 	echo join("<br>", $errors['picture']);
 	echo "</div>";
  }
  
  ?>

<div style='height:30px;font-weight:bold'>
	Candidate Information
</div>
 
<div style='float:left;padding-left:8px;'>

	<div style='float:left'>
	First Name<br><?= $firstNameField ?>
	</div>

	<div style='float:left'>
	Middle Name<br><?= $middleNameField ?>
	</div>

	<div style='float:left'>
	Last Name<br><?= $lastNameField ?>
	</div>

	<div>
	Email<br><?= $emailField ?>
	</div>

	<div>
	Web Site<br><?= $webSiteField ?>
	</div>

	Contact<br><?= $contact ?><br>
	Address<br><?= $contactAddressField ?><br>
	Phone<br><?= $contactPhoneField ?><p/>
	
	Short Candidate Bio:<br><?= $bioField ?><br>
	Short Campaign Statement:<br><?= $blurbField ?><br>
</div>

<div style='width:360px;height:320px;float:left;margin-left:16px;border: solid gray 1px'>
	<div style='width:100%;text-align:center'>
	Pictures for Website
	</div>
	<div style='float:left;width:180px;'>
		Thumbnail
		<div style='width:84px;height:120px;border: solid red 1px'>
			<img src="/images/candidates/<?= $candidate['picture'] ?>">
		</div>
		<?= $pictureField ?>
	</div>
	
	<div style='float:left;width:180px;'>
		Larger
		<div style='width:168px;height:240px;border: solid red 1px'>
			<img src="/images/candidates/<?= $candidate['large_picture'] ?>">
		</div>
		<?= $largePictureField ?>
	</div>
	
	<div style='clear:both'></div>
	
</div>

<div style='clear:both;height:16px;'></div>

<div style='width:100%;text-align:center'>
<input type=reset value=" Clear ">&nbsp;
<input type=submit value=" Submit ">
</div>

<div style='clear:both;height:16px;'></div>

</form>
</div>