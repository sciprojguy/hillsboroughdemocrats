<?php
/*
 * 'u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
 * inputs: $user, $roles, $possible_roles
 * 
 * member name (text only)
 * 
 * [username] 
 * [empty password box for resets]
 * [status menu - new, active, inactive, locked]
 * 
 * roles
 * [ ] role_name	[ ] role_name	[ ] role_name	[ ] role_name
 * [x] role_name	[ ] role_name	[ ] role_name	[ ] role_name
 * ...
 * [submit]
 */

	$statusValues = array('new'=>'New', 'active'=>'Active', 'inactive'=>'Inactive', 'locked'=>'Locked');
	$usernameField = form_input(array('name'=>'username', 'size'=>40, 'value'=>$user['username']));
	$passwordField = form_input(array('name'=>'password', 'size'=>40, 'value'=>''));
	
	$roleGrid = '';
	foreach( $possible_roles as $possible_role )
	{
		$checked = false;
		if(in_array($possible_role['role_name'], $roles))
			$checked = true;
		$roleGrid .= 
			"<div>" . 
			form_checkbox('roles', $possible_role['role_name'], $checked) .
			" {$possible_role['role_name']}</div>";
	}