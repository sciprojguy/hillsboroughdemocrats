<?php
class Volunteers extends Model {

	function Volunteers()
	{
		parent::Model();
	}

	function emptyVolunteer()
	{
		return array(
			'name'=>'',
			'precinct'=>'',
			'street'=>'',
			'city'=>'',
			'zip'=>'',
			'phone'=>'',
			'email'=>'',
			'best_contact_method'=>'phone',
			'best_time_and_days'=>'',
			'registered_dem_hillsborough'=>'N',		
			'member_of_hillsborough_dec'=>'N',		
			'volunteered_with_hillsborough_dec'=>'N',		
			'volunteered_other_orgs'=>'N',
			'which_ones'=>'',

		// checkbox items - interests
			'phone_banking'=>NULL,		
			'vol_recruitment'=>NULL,		
			'vol_scheduling'=>NULL,		
			'data_entry'=>NULL,		
			'fundraising_host'=>NULL,		
			'canvassing'=>NULL,		
			'event_coordinator'=>NULL,		
			'booth_volunteer'=>NULL,		
			'candidate_support'=>NULL,		
			'precinct_assistance'=>NULL,		
			'high_traffic_canvassing'=>NULL,		
			'neighborhood_team_leader'=>NULL,		
			'write_to_elected_officials'=>NULL,		
			'community_outreach'=>NULL,		
			'other'=>NULL,		
			'other_what'=>'',

		// checkbox items - committees
			'cmte_affirmative_action'=>NULL,
			'cmte_campaign_precinct'=>NULL,
			'cmte_bylaws'=>NULL,
			'cmte_credentials'=>NULL,
			'cmte_membership'=>NULL,
			'cmte_finance'=>NULL,
			'cmte_legislative'=>NULL,
			'cmte_platform'=>NULL,
			'cmte_publicity'=>NULL,
			'cmte_it'=>NULL,
			'cmte_legal'=>NULL,
			'cmte_labor'=>NULL
		);
	}

	function validateVolunteer( $volunteer )
	{
		$errors = array();
		if(!isset($volunteer['name']) || empty($volunteer['name']))
		$errors['name'] = "We need your name.";
		if(!isset($volunteer['precinct']) || empty($volunteer['precinct']))
		$errors['precinct'] = "We need your precinct #.";
		if(!isset($volunteer['street']) || empty($volunteer['street']))
		$errors['street'] = "We need your address.";
		if(!isset($volunteer['city']) || empty($volunteer['city']))
		$errors['city'] = "We need your city.";
			
		if('phone' == $volunteer['best_contact_method'])
		{
			if(!isset($volunteer['phone']) || empty($volunteer['phone']))
			$errors['phone'] = "We need your phone#";
		}

		if('email' == $volunteer['best_contact_method'])
		{
			if(!isset($volunteer['email']) || empty($volunteer['email']))
			$errors['email'] = "We need your email address";
		}

		if(!isset($volunteer['best_time_and_days']) || empty($volunteer['best_time_and_days']))
		$errors['best_time_and_days'] = 'We need to know the best days/times to reach you.';
			
		return $errors;
	}

	function addVolunteer( $volunteer )
	{
		$results = array();
		$errors = $this->validateVolunteer($volunteer);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
			return $results;
		}

		$volunteer['requestTimestamp'] = date('Y-m-d h:i:s');
		$volunteer['ip'] = $_SERVER['REMOTE_ADDR'];

		$r = $this->db->insert('volunteers', $volunteer);
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

	function getVolunteers()
	{
		$results = array();
		$r = $this->db->get('volunteers');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
			foreach( $r->result_array() as $row )
			$results['rows'][] = $row;
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}

	function getVolunteersForCriteria( $criteria )
	{
		$results = array();
		
		$critArray = array();
		if(isset($criteria['startDate']))
			$critArray[] = "date(dateandtime) >= '{$criteria['startDate']}'";
		if(isset($criteria['endDate']))
			$critArray[] = "date(dateandtime) <= '{$criteria['endDate']}'";
		if(isset($criteria['precinct']))
			$critArray[] = "precinct = {$criteria['precinct']}";
			
		if(count($critArray)>0)
		{
			$critStr = implode(" AND ", $critArray);		
			$this->db->where($critStr);
		}
		
		$r = $this->db->get('volunteers');
		if($r)
		{
			$results['status'] = 'OK';
			$rows = array();
			foreach($r->result_array() as $row)
				$rows[] = $row;
			$results['rows'] = $rows;
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}

		return $results;
	}

}
