<?php

class Reservations extends Model {

	function Reservations()
	{
		parent::Model();
	}
	
	function emptyReservation()
	{
		$res = array(
			"id"=>-1,
			"type"=>"",
			"status"=>"",
			"confirmationNumber"=>"",
			"underName"=>"",
			"details"=>"",
			"invoiceAmt"=>0.0,
			"balanceDue"=>0.0
		);		
	}
	
	function validReservation( $resinfo )
	{
		$errors = array();
		
		if(!isset($resinfo) || !is_array($resinfo))
			$errors['resinfo'][] = "Invalid array";
		
		if(!isset($resinfo["type"]) || empty($resinfo["type"]))
			$errors['type'][] = "Reservation type is missing";
		
		if(!isset($resinfo['status']) || empty($resinfo['status']))
			$errors['status'][] = "Reservation status is missing";
		
		if(!isset($resinfo['confirmationNumber']) || empty($resinfo['confirmationNumber']))
			$errors['confirmationNumber'][] = "Confirmation number is missing";
		
		if(!isset($resinfo['underName']) || empty($resinfo['underName']))
			$errors['underName'][] = "Reservation name is missing";
			
		return $errors;
	}
	
	function generateConfirmationNumber()
	{
		return uniqid();
	}
	
	function addReservation( $resinfo )
	{
		$r = array('status'=>'OK');
		$errors = $this->validReservation($resinfo);
		if(count($errors)<1)
		{
			$this->db->insert('reservations',$resinfo);
		}
		else 
		{
			$r = array('status'=>'FAILED_VALIDATION');
		}
		return $r;
	}
	
	function getReservations()
	{
		$r = array();
		$rows = $this->db->get('reservations');
		if($rows)
		{
			$r['status'] = 'OK';
			$r['rows'] = $rows->result_array();
		}
		else
		{
			$r['status'] = 'DB_FAIL';
			$r['rows'] = array();
		}
		return $r;
	}
	
	function reservationForId( $id, $resinfo )
	{
	}
	
	function updateReservationForId( $id, $resinfo )
	{
	}
	
	function cancelReservation( $id )
	{
	}
}