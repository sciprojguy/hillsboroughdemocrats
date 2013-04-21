<?php
class Offices extends Model {

	var $_offices = array();
	
	function Offices()
	{
		parent::Model();
	}

	function listOffices()
	{
		$results = array();
		$this->db->order_by('sortOrder');
		$r = $this->db->get('offices');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
			foreach( $r->result_array() as $row )
			{
				$office_id = $row['id'];
				$office_title = $row['title'];
				$results['rows'][$office_id] = $office_title;
			}
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function listOfficesByLevel()
	{
		$results = array();
		$this->db->order_by('sortOrder');
		$r = $this->db->get('offices');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = array();
			foreach( $r->result_array() as $row )
			{
				$office_level = $row['level'];
				$results['rows'][$office_level][] = $row;
			}
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
		}
		return $results;
	}
	
	function local()
	{
		
	}
	
	function county()
	{
		
	}
	
	function state()
	{
		
	}
	
	function federal()
	{
		
	}
	
	function president()
	{
		
	}
}
?>