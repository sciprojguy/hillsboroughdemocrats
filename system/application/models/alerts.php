<?php
class Alerts extends Model {

	function Alerts()
	{
		parent::Model();
	}
	
	function emptyAlert()
	{
		return array(
			"type"=>"action",
			"short_title"=>"",
			"action_url"=>"",
			"start_date_time"=>date('Y-m-d'),
			"end_date_time"=>date('Y-m-d'),
			"status"=>"new",
			"description"=>""
		);
	}
	
	function validateAlert($alert)
	{
		$errors = array();

		if(!isset($alert['short_title']) || empty($alert['short_title']))
			$errors['short_title'][] = "Title cannot be empty";
			
		if($alert['end_date_time'] < $alert['start_date_time'])
			$errors['end_date_time'][] = "Alert cannot be scheduled to finish before it begins";
		return $errors;
	}
	/*
	function changedFields( $alert, $alertId )
	{
		$changes = array();
		$selectFields = implode( ", ", array_keys($alert) );
		$this->db->select($selectFields);
		$r = $this->db->get_where('alerts', array('id'=>$alertId));
		if($r)
		{
			$row = $r->row_array();
			
			foreach( $alert as $key=>$value )
			{
				if($row[$key] != $value)
					$changes[$key] = $value;
			}
		}
		return $changes;
	}
	*/
	function getAllAlerts()
	{
		$this->db->order_by("start_date_time", "desc");
		$r = $this->db->get('alerts');
		$alerts = array();
		if($r)
		{
			foreach($r->result_array() as $row)
				$alerts[] = $row;
			$r->free_result();
		}
		return $alerts;
	}
	
	function getNewAndActiveAlerts()
	{
		$this->db->order_by("start_date_time", "desc");
		$this->db->where("status in ('new','active')");
		$r = $this->db->get('alerts');
		$alerts = array();
		if($r)
		{
			foreach($r->result_array() as $row)
				$alerts[] = $row;
			$r->free_result();
		}
		return $alerts;
	}
	
	# meant to get the summary info for the ticker - type, name, url
	function getCurrentAlerts()
	{
		$now = date('Y-m-d');
		$alerts = array();
		$this->db->select('id, type, short_title, action_url, start_date_time, end_date_time, status');
		$this->db->where("date(start_date_time) <= '$now' AND date(end_date_time) >= '$now' AND status = 'active'");
		$r = $this->db->get('alerts');
		if($r) 
		{
			foreach($r->result_array() as $row)
				$alerts[] = array(
					'id'=>$row['id'],
					'type'=>$row['type'],
					'short_title'=>$row['short_title'],
					'action_url' => $row['action_url']
				);
			$r->free_result();
		}
		return $alerts;
	}
	
	function addAlert( $alertInfo )
	{
		$errors = $this->validateAlert($alertInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$alertInfo['start_date_time'] .= " 00:00:00";
			$alertInfo['end_date_time'] .= " 11:59:59";
			$results = array();
			$r = $this->db->insert('alerts', $alertInfo);
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
	
	function getAlertForId( $alertId )
	{
		$results = array();
		$r = $this->db->get_where('alerts', array('id'=>$alertId) );
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'ERROR';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function setAlertInfo( $alertInfo, $alertId )
	{
		$errors = $this->validateAlert($alertInfo);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$alertInfo['start_date_time'] .= " 00:00:00";
			$alertInfo['end_date_time'] .= " 11:59:59";
			$results = array();
			$r = $this->db->update('alerts', $alertInfo, array('id'=>$alertId));
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
	
	function removeAlert( $alertId )
	{
	}
}