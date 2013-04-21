<?php
class Member extends Model {

	function Member()
	{
		parent::Model();
	}
	
	function memberTypes()
	{
		return array(
			'appointed'=>'Appointed',
			'elected'=>'Elected',
			'automatic'=>'Automatic'
		);
	}
	
	function statusValues()
	{
		return array(
			'applied'=>'Applied',
			'verified'=>'Verified',
			'sworn'=>'Sworn In',
			'probation'=>'Probation',
			'removed'=>'Removed'
		);
	}
	
	function emptyMember()
	{
		return array(
			'firstName'=>'',
			'middleName'=>'',
			'lastName'=>'',
			'salutation'=>'',
			'type'=>'',
			'street'=>'',
			'city'=>'',
			'state'=>'FL',
			'zip'=>'',
			'precinct'=>0,
			'dob'=>'',
			'email'=>'',
			'phone'=>'',
			'term_began'=>'',
			'status'=>'',
			'status_date'=>'',
			'notes'=>'',
			'sex'=>'not_given'
		);
	}
	
	function validateMember( $memberInfo )
	{
		$errors = array();
		
		# check member name - first and last names are required
		if(!isset($memberInfo['firstName']) || empty($memberInfo['firstName']))
			$errors['firstName'][] = 'First name cannot be blank';
		if(!isset($memberInfo['lastName']) || empty($memberInfo['lastName']))
			$errors['lastName'][] = 'Last name cannot be blank';
		
		# check address - must be given.
		if(!isset($memberInfo['street']) || empty($memberInfo['street']))
			$errors['street'][] = 'Street Address cannot be blank';
		if(!isset($memberInfo['city']) || empty($memberInfo['city']))
			$errors['city'][] = 'City cannot be blank';
#		if(!isset($memberInfo['state']) || empty($memberInfo['state']))
#			$errors['state'] = 'State cannot be blank';
		if(!isset($memberInfo['zip']) || empty($memberInfo['zip']))
			$errors['zip'][] = 'Zip code cannot be blank';
		
		# check DOB - required
		if(!isset($memberInfo['dob']) || empty($memberInfo['dob']))
			$errors['dob'][] = 'Date of Birth cannot be blank';
		else
		if($memberInfo['dob'] == '0000-00-00')
			$errors['dob'][] = 'Date of Birth cannot be zero';
		else
		{
			# check DOB - if given, does it have to be today - 18 years? yes,
			# since they have to sign a loyalty oath
		}
		
		# check precinct - it has to be nonblank/nonzero
		if(!isset($memberInfo['precinct']) || empty($memberInfo['precinct']))
		{
			$errors['precinct'][] = 'Precinct# must not be empty';
		}
		
		return $errors;
	}
	
	# member_id, name, type, status, precinct#
	function getMembers()
	{
		$results = array();
		$this->db->select('members.id, firstName, middleName, lastName, salutation, members.type, members.status, members.status_date, precinct, phone, members.email, term_began, users.username, users.status as user_status');
		$this->db->from('members');
		$this->db->join('users', 'users.member_id = members.id', 'left');
		$this->db->where('members.status != "removed"');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	# member_id, name, type, status, precinct#
	function getMembersWithStatus($status)
	{
		$results = array();
		$this->db->select('id','firstName','middleName','lastName','saluation','type','status','status_date','precinct','term_began');
		$this->db->from('members');
		$this->db->join('users', 'users.member_id = members.id', 'left');
		$this->db->where(array('members.status' => $status));
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	# member_id, name, type, status, precinct#
	function getMembersOfType($type)
	{
		$results = array();
		$this->db->select('id','firstName','middleName','lastName','saluation','type','status','status_date','precinct','term_began');
		$this->db->from('members');
		$this->db->join('users', 'users.member_id = members.id', 'left');
		$this->db->where(array('type'=>$type));
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		return $results;
	}

	# all member info
	function getMember( $memberId )
	{
		$results = array();
		$this->db->select('members.*, users.username');
		$this->db->from('members');
		$this->db->join('users', 'users.member_id = members.id', 'left');
		$this->db->where(array('members.id'=>$memberId));
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$results['memberInfo'] = $r->row_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	# add a new member
	function addMember( $memberInfo )
	{
		$results = array();
		$errors = $this->validateMember($memberInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('members', $memberInfo);
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
	
	# update an existing member
	function updateMember( $memberInfo, $memberId )
	{
		$results = array();
		$errors = $this->validateMember($memberInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->update('members', $memberInfo, array('id'=>$memberId));
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
	
	#delete a member - this is here FTSOC, since we will probably want to keep records going back a ways
	function deleteMember( $memberId )
	{
		$results = array();
		
		return $results;
	}
}