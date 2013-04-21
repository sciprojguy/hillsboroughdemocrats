<?php
	$this->load->helper('form');
	
	$statuses = array('submitted'=>'Submitted', 'active'=>'Active', 'cancel'=>'Cancelled');
	
	$newitemid = "";
	if(isset($newsitem['id']))
		$newsitemid = form_hidden("id", $newsitem['id']);
	
	$statusMenu = form_dropdown('status', $statuses, $newsitem['status']);
	$titleField = form_input(array('name'=>'title', 'size'=>80, 'value'=>$newsitem['title']));
	$linkField = form_input(array('name'=>'link', 'size'=>80, 'value'=>$newsitem['value']));
?>
<div class="contentBox">
<form method=post action="/hcdec/<?=$action?>">
<div style='color:red'>
<?php
if(isset($errors['title']))
{
	echo implode("<br>", $errors['title']);
} 
if(isset($errors['link']))
{
	echo implode("<br>", $errors['link']);
}
?>
</div>
Status:<br>
<?= $statusMenu ?><p/>
Title:<br>
<?= $titleField ?><p/>
Link:<br>
<?= $linkField ?><p/>
<input type="reset" value="Clear">&nbsp;<input type=submit value=" Submit ">
</form>
</div>