<div class="contentBox">
<?php
	$this->load->helper('form');
	
	# fields in this form:
	#
	# username
	# password  [x] set password
	# account status popup
	# roles checkbox grid (generated)
	#
	# [Apply]
	#
	
	$statuses = array('A'=>'Active', 'S'=>'Suspended', 'R'=>'Removed');
	$f_status = form_dropdown('status', $statuses, $user['status']);
	
	$f_username = form_input(array('name'=>'username','size'=>'40', 'value'=>$user['username']));
	$f_password = form_input(array('name'=>'password','value'=>'','size'=>'40'));
	# will have a "set password" chkbox as well.
	
	/*
	 
	 1. get all possible roles
	 2. for each role in that list
	 	a. if user record contains this role, make checked checkbox
	 	b. else make unchecked checkbox
	 
	 */
	
	$checkboxes = array();
	$allRoles = $this->users->possibleRoles();
	foreach($allRoles as $id=>$value)
	{
		$role_name = $value['role_name'];
		$role_label = $value['role_description'];
		
		$checked = false;
		if(in_array($role_name, $roles))
		{
			$checked = true;
		}
		
		$chkbox = form_checkbox(array('name'=>$role_name), "'$role_name'", $checked)." ".
			$role_label;
		$checkboxes[] = $chkbox;
	}
?>
<form method="POST" action="/hcdec/edituser">
<strong>Username:</strong><br>
<?= $f_username ?><p/>
<strong>Password:</strong><br>
<?= $f_password ?> <input type=checkbox name="set_passwd"> Set Password<p/>
<strong>User Roles/Access Permissions</strong><br>
<?= join('<br>', $checkboxes); ?>
<p/>
<input type=submit value=" Apply ">
</form>
</div>