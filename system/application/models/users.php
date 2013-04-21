<?php
class Users extends Model {
	
	function Users() 
	{
		parent::Model();
	}

	function loginUser( $username, $password_enc )
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName, m.salutation, u.status, u.status_dt');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$this->db->where( "username = '$username' AND enc_passwd = '".md5($password_enc)."'" );
		$r = $this->db->get();
		if($r)
		{
			if($r->num_rows()>0)
			{
				$results['user'] = $r->result_array();
				$results['status'] = 'OK';
			}
			else
			{
				$results['status'] = 'INVALID';
			}
		}
		else
		{
			$results['status'] = 'DBERR';
			$results['message'] = $this->db->_error_message();
		}
		return $results;
	}
	
	function validateUser( $userInfo ) 
	{
		$errors = array();
		# possible errors - 
			# a. user already exists
			# b. no such member id
			# c. first name and last name are required
			# d. invalid user type
		return $errors;
	}
	
	function possibleRoles()
	{
		$r = $this->db->get('roles');
		if($r)
			return $r->result_array();
		else
			return array();
	}
	
	function addUser( $userInfo )
	{
		$results = array();
		$errors = $this->validateUser($userInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('users', $userInfo);
			if($r)
			{
				$results['status'] = 'OK';
			}
			else
			{
				$results['status'] = 'DB';
			}
		}
		return $results;
	}
	
	function getUser( $userId )
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$this->db->where(array('u.id'=>$userId));
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['user'] = $r->row_array();
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
	#TODO
	# 1. if $userInfo['password'] is nonblank, encode it and change it.  if it is blank,
	#    remove it from $userInfo[]
	# 2. capture and set status date
	function updateUser( $userInfo, $userId )
	{
		$results = array();
		$errors = $this->validateUser($userInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->update('users', $userInfo, array('id'=>$userId));
			if($r)
			{
				$results['status'] = 'OK';
			}
			else
			{
				$results['status'] = 'DB';
			}
		}
		return $results;
	}
	
	function getAllUsers()
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getUserRoles( $userid )
	{
		$results = array();
		$this->db->where("user_id = $userid");
		$r = $this->db->get('user_roles');
		if($r)
		{
			$results['status'] = 'OK';
			$roles = array();
			foreach ($r->result_array() as $row)
				$roles[] = $row['role_name'];
			$results['rows'] = $roles;
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function setRolesForUser( $roles, $userid )
	{
		$results = array();
		$this->db->where("user_id = $userid");
		$r = $this->db->get('user_roles');
		if($r)
		{
			foreach( $roles as $role_name )
			{
				$row = array( 'user_id' => $userid, 'role_name' => $role_name );
				$r = $this->db->insert('user_roles');
				if($r)
				{
					$results['status'] = 'OK';
				}
				else
				{
					$results['status'] = 'DB';
				}
			}
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function getActiveUsers()
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$this->db->where("u.status = 'active'");
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getInactiveUsers()
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$this->db->where("u.status = 'inactive'");
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getSuspendedUsers()
	{
		$results = array();
		$this->db->select('u.id, u.member_id, u.type as userType, m.type as memberType, u.username, u.status, m.firstName, m.middleName, m.lastName');
		$this->db->from('users u');
		$this->db->join('members m', 'u.member_id = m.id');
		$this->db->where("u.status = 'suspended'");
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
		}
		return $results;
	}
	
}