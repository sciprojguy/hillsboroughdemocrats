<?php 
class Kennedykingdinner extends Controller {

	var $flash_message = null;
	
	function Kennedykingdinner()
	{
		parent::Controller();
		session_start();
	}
	
	function kennedykingdinner()
	{
		$this->load->view('hcdec_kkdinner_main');
	}
	
	function tickets()
	{
		$this->load->view('hcdec_kkdinner_tickets');
	}
	
	function sponsorships()
	{
		$this->load->view('hcdec_kkdinner_sponsorship');
	}
}
