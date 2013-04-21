<?php
	$this->load->helper('form');
	$statuses = array('new'=>'New', 'active'=>'Active', 'inactive'=>"Inactive");
	$statusMenu = form_dropdown('status', $statuses, $newsitem['status']);
	$titleField = form_input(array('name'=>'title', 'size'=>64, 'value'=>$newsitem['title']));
	$linkField = form_input(array('name'=>'link', 'size'=>80, 'value'=>$newsitem['link']));
	$idField = "";
	if(isset($newsitem['id']))
		$idField = form_hidden('id', $newsitem['id']);
	$promoteCb = form_checkbox('front_page', true, $newsitem['front_page']);
?>
<!--
	1. status popup - "active", "inactive"
	2. title
	3. mailchimp link
	4. "promote to first page" checkbox that updates the date
  -->
<div class="contentBox">
<div style='color:red'>
<?php
	if(isset($errors['title']))
		echo implode(", ", $errors['title']);
	if(isset($errors['link']))
		echo implode(", ", $errors['link']); 
?>
</div>
	<form method=post action="/hcdec/<?= $action ?>">
	<?= $idField ?>
	Status:<br>
	<?= $statusMenu ?><p/>
	Title:<br>
	<?= $titleField ?><p/>
	Link:<br>
	<?= $linkField ?><p/>
	<?= $promoteCb ?> Promote to front page
	<p/>
	<input type=reset value=" Clear ">&nbsp;
	<input type=submit value=" Submit ">
	</form>
</div>