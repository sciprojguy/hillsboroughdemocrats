<?php
class Candidates extends Model {

	function Candidates()
	{
		parent::Model();
	}
	
	function emptyCandidate()
	{
		return array(
			"office"=>0,
			"lastName"=>"",
			"firstName"=>"",
			"middleName"=>"",
			"filed"=>"N",
			"filedDate"=>"",
			"qualified"=>"N",
			"qualifiedDate"=>"",
			"qualifiedHow"=>"",
			"webSite"=>"",
			"email"=>"",
			"contact"=>"",
			"contact_address"=>"",
			"contact_phone"=>"",
			"withdrawn"=>"N",
			"withdrawnDate"=>"",
			"picture"=>"",
			"short_bio"=>"",
			"campaign_statement"=>"",
			"large_picture"=>""
		);
	}
	
	function validateCandidate($candidate)
	{
		$todaysDate = date('Y-m-d');
		
		$errors = array();

		# validate.  need to also check and see whether
		# candidate already exists - check first, middle and last
		# names and fail on *that*.
		/*
		
		if('N' == $candidate['filed'])
			$errors['filed'][] = 'Candidate must have filed.';
		if(!isset($candidate['filedDate']) || empty($candidate['filedDate']))
			$errors['filedDate'][] = 'Date of filing cannot be empty';
		else
		if($todaysDate < $candidate['filedDate'])
			$errors['filedDate'][] = 'Date of filing cannot be in the future';
		*/
		
		if(!isset($candidate['firstName']) || empty($candidate['firstName']))
			$errors['firstName'][] = 'First name is required';
			
		if(!isset($candidate['lastName']) || empty($candidate['lastName']))
			$errors['lastName'][] = 'Last name is required';
			
		# now look for 
		
		# validation:
		# 1. filed date cannot be invalid
		# 2. first and last name are required
		# 3. first and last name cannot match existing candidate
		# 4. qualified date cannot be invalid
		# 5. qualified date cannot be prior to filed date
		# 6. if withdrawn is 'Y', withdrawn date must not be blank.
		# 7. contact is required
		# 8. phone# is required
		if(!isset($candidate['contact']) || empty($candidate['contact']))
			$errors['contact'][] = 'Contact is required';
		
		return $errors;
	}
	/*
	function changedFields( $candidate, $candidateId )
	{
		$changes = array();
		$r = $this->db->get_where('candidates', array('id'=>$candidateId));
		if($r)
		{
			$row = $r->row_array();
			
			foreach( $candidate as $key=>$value )
			{
				if($row[$key] != $value)
					$changes[$key] = $value;
			}
		}
		return $changes;
	}
	*/
	function addCandidate( $candidate )
	{
		$results = array();
		
		$errors = $this->validateCandidate( $candidate );
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('candidates', $candidate);
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
	
	function updateCandidate( $candidate, $candidate_id )
	{
		$results = array();
		$errors = $this->validateCandidate( $candidate );
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->update('candidates', $candidate, array('id'=>$candidate_id));
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
	
	function getCandidate( $id ) 
	{
		$results = array();
		$this->db->where(array('id'=>$id));
		$r = $this->db->get('candidates');
		if($r)
		{
			$results['status'] = 'OK';
			$row = $r->row_array();
			$results['row'] = $row;
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}

	function getCandidateForView($id)
	{
		$results = array();
		$this->db->select('candidates.*, offices.id as office_id, offices.level, offices.sortOrder, offices.title, firstName, middleName, lastName, picture, large_picture, webSite, filed, filedDate, qualified, qualifiedDate, short_bio, campaign_statement');
		$this->db->from('candidates');
		$this->db->join('offices', 'candidates.office = offices.id');
		$this->db->where(array('candidates.id'=>$id));
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$rr = $r->row_array();
			$results['row'] = $rr;
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		$r->free_result();
		
		return $results;
	}
	
	function deleteCandidate( $id ) 
	{
		$results = array();
		$this->db->where(array('id'=>$id));
		$r = $this->db->delete('candidates');
		if($r)
		{
			$results['status'] = 'OK';
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function listActiveCandidates()
	{
		$results = array();
		$this->db->where('(filed="Y" or qualified="Y") AND (withdrawn<>"N")');
		$r = $this->db->get('candidates');
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
	
	function listCandidatesForOffice( $officeId )
	{
		$results = array();
		$this->db->where("office=$officeId AND (filed='Y' or qualified='Y') AND (withdrawn<>'N')");
		$r = $this->db->get('candidates');
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
	
	# should really be grouped by level and office, viz
	# $candidates[level][office] -> candidate info
	function listCandidates()
	{
		$results = array();
		$this->db->select('offices.id as office_id, offices.level, offices.title, firstName, middleName, lastName, picture, filed, filedDate, qualified, qualifiedDate');
		$this->db->from('candidates');
		$this->db->join('offices', 'candidates.office = offices.id');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$candidates = array();
			foreach( $r->result_array() as $row )
			{
				$level = $row['level'];
				$title = $row['title'];
				$candidates[$level][$title][] = $row;
			}
			$r->free_result();
			$results['rows'] = $candidates;
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function listCandidatesGroupedByOffice()
	{
		$results = array();
		$this->db->select('offices.id as office_id, offices.level, offices.title, firstName, middleName, lastName, picture, filed, filedDate, qualified, qualifiedDate');
		$this->db->from('candidates');
		$this->db->order_by('level');
		$this->db->join('offices', 'candidates.office = offices.id');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$candidates = array();
			foreach( $r->result_array() as $row )
			{
				$office = $row['office_id'];
				$candidates[$office][] = $row;
			}			
			$results['rows'] = $candidates;
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function listCandidatesGroupedByLevel()
	{
		$results = array();
		$this->db->select('offices.level, offices.title, firstName, middleName, lastName, picture, filed, filedDate, qualified, qualifiedDate');
		$this->db->from('candidates');
		$this->db->order_by('level');
		$this->db->join('offices', 'candidates.office = offices.id');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$candidates = array();
			foreach( $r->result_array() as $row )
			{
				$cur_level = $row['level'];
				$candidates[$cur_level][] = $row;
			}			
			$results['rows'] = $candidates;
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;		
	}
	
	function listCandidatesGroupedByLevelAndOffice()
	{
		$results = array();
		$this->db->select('candidates.id, offices.id as office_id, offices.level, offices.sortOrder, offices.title, firstName, middleName, lastName, picture, webSite, filed, filedDate, qualified, qualifiedDate');
		$this->db->from('candidates');
		$this->db->order_by('offices.sortOrder, office_id, lastName, firstName');
		$this->db->join('offices', 'candidates.office = offices.id');
		$r = $this->db->get();
		if($r)
		{
			$results['status'] = 'OK';
			$candidates = array();
			foreach( $r->result_array() as $row )
			{
				$cur_level = $row['level'];
				$cur_office = $row['title'];
				$candidates[$cur_level][$cur_office][] = $row;
			}			
			$results['rows'] = $candidates;
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;		
	}
}
?>