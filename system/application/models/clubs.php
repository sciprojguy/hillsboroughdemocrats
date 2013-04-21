<?php
class Clubs extends Model {

	function Clubs()
	{
		parent::Model();
	}

	function emptyClubOrCaucus()
	{
		return array(
			'name'=>'',
			'description'=>'',
			'president'=>'',
			'meets'=>'',
			'contact_phone'=>'',
			'contact_email'=>'',
			'club_url'=>'',
			'status'=>'new',
			'notes'=>'',
			'type'=>''
		);
	}
	
	function validateClubOrCaucus( $clubOrCaucus )
	{
		$errors = array();
		
		if(!isset($clubOrCaucus['name']) || empty($clubOrCaucus['name']))
			$errors['name'][] = 'Name is required';
		#if(!isset($clubOrCaucus['meets']) || empty($clubOrCaucus['meets']))
		#	$errors['meets'][] = 'Time/Place of meeting is required';
		#if(!isset($clubOrCaucus['contact_phone']) || empty($clubOrCaucus['contact_phone']))
		#	$errors['contact_phone'][] = 'Contact Phone# is required';
		#if(!isset($clubOrCaucus['president']) || empty($clubOrCaucus['president']))
		#	$errors['president'][] = 'President/Organizer is required';
			
		return $errors;
	}
	
	function getClubsAndCaucuses()
	{
		$results = array();
		$r = $this->db->get('clubs');
		if($r)
		{
			$results['rows'] = $r->result_array();
			$results['status'] = 'OK';
		}
		else
		{
			$results['rows'] = array();
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function getActiveClubsAndCaucuses()
	{
		$results = array();
		$r = $this->db->get_where('clubs', array('status'=>'active'));
		if($r)
		{
			$results['rows'] = $r->result_array();
			$results['status'] = 'OK';
		}
		else
		{
			$results['rows'] = array();
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function getClubOrCaucus($clubid)
	{
		$results = array();
		$r = $this->db->get_where('clubs', array('id'=>$clubid));
		if($r)
		{
			$results['club'] = $r->row_array();
			$results['status'] = 'OK';
			$r->free_result();
		}
		else
		{
			$results['rows'] = array();
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function addClubOrCaucus( $ccInfo )
	{
		$results = array();
		$errors = $this->validateClubOrCaucus($ccInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('clubs', $ccInfo);
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
	
	function updateClubOrCaucus( $ccInfo, $ccId )
	{
		$results = array();
		$errors = $this->validateClubOrCaucus($ccInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->update('clubs', $ccInfo, array('id'=>$ccId));
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
	
	# COPY this to other models - candidates, etc.
	function changes( $rowid, $ccInfo ) {
		$differences = array();
		if(isset($rowid)) {
			$r = $this->db->get_where('clubs', array('rowid'=>$rowid));
			if($r)
			{
				$ccStored = $r->row_array();
				foreach( $ccStored as $column=>$value)
				{
					if(isset($ccStored[$column]) && $ccStored[$column] != $ccInfo[$column])
					{
						$differences[$column] = $value;
					}
				}
			}
		}
		return $differences;
	}
}