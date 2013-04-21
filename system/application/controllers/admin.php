<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('admin_header');
		$this->load->view('admin_index');
		$this->load->view('admin_footer');
	}
	
# user management
	function users()
	{
		$this->load->view('admin_header');
		$this->load->model('users');
		$results = $this->users->getAllUsers();
		if($results['status'] == 'OK')
		{
			$page_params = array('users'=>$results['rows']);
			$this->load->view('admin_users', $page_params);
		}
		else
		{
			# error page
		}
		$this->load->view('admin_footer');
	}
	
	function edituser()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$params = $this->uri->uri_to_assoc(3);
			# look up user for $params['mid']
			$this->load->view('admin_header');
			$this->load->view('admin_activateuserform');
			$this->load->view('admin_footer');
		}
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			# try to update user using $_POST
			# if okay, redirect to '/admin/users'
			# if not okay, reload form with error messages
			$this->load->view('admin_header');
			$this->load->view('admin_activateuserform');
			$this->load->view('admin_footer');
		}
	}
	
#member management
	function members()
	{
		$this->load->view('admin_header');
		# admin_members - list of members with edit links
		$this->load->model('member');
		$results = $this->member->getMembers();
		if($results['status'] == 'OK')
		{
			$params = array('members'=>$results['rows']);
			$this->load->view('admin_members', $params);
		}
		$this->load->view('admin_footer');
	}
	
	function addmember()
	{
		# admin_header
		# admin_member_form
		# admin_footer
	}
	
	function editmember()
	{
		$params = $this->uri->uri_to_assoc(3);
		# admin_header
		# admin_member_form
		# admin_footer
	}
	
# role management
	function roles()
	{
	}
	
	function addrole()
	{
	}
	
	function editrole()
	{
		$params = $this->uri->uri_to_assoc(3);
	}
	
	function deleterole()
	{
		$params = $this->uri->uri_to_assoc(3);
	}	
	
# Action Alerts - this all needs to go in /admin
	function alerts()
	{
		$header_params = array('page'=>'member');
		$this->load->view('hcdec_header', $header_params);
		
		$this->load->model('alerts');
		$alerts = $this->alerts->getNewAndActiveAlerts();
		$body_params = array('alerts'=>$alerts);
		$this->load->view('hcdec_alerts', $body_params);
		$this->load->view('hcdec_footer');
	}
	
	# note - these need to go into the admin controller
	function addalert()
	{
		$this->load->model('alerts');
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$header_params = array('page'=>'addalert');
			$this->load->view('hcdec_header', $header_params);
			
			$alert = $this->alerts->emptyAlert();
			$form_params = array('page'=>'addalert', 
				'button' => 'Add',
				'alert'=>$alert, 
				'action'=>'/admin/addalert');
			$this->load->view('hcdec_alert_form', $form_params);
			$this->load->view('hcdec_footer');
		}
		else
		{
			# debugging note - let the model do the validation and if there are errors, return them from addAlert().
			# then we can check the status and either repost the form with appropriate errors (like scheduling an alert
			# to run in the past, or an end date < start date) and re-present the form.  if there are no errors, redirect.
			# scheme to use is this - if there are errors, then in $form_params there is an "errors" entry that carries
			# $errors.  That assoc array is keyed by form field name (which is the same as the db column name) and carries
			# an array of errors that field generated.  They can then be processed into a list and displayed in each
			# field for the user.
			$r = $this->alerts->addAlert( $_POST );
			if($r['status'] == 'OK')
				redirect('/admin/alerts');
			else
			if($r['status'] == 'VALIDATION')
			{
				$header_params = array('page'=>'addalert');
				$this->load->view('hcdec_header', $header_params);
				
				$form_params = array(
						'page'=>'addalert', 
						'button' => 'Add',
						'errors'=>$r['errors'],
						'alert'=>$_POST,
						'action'=>'/admin/addalert'
				);
				$this->load->view('hcdec_alert_form', $form_params);
				$this->load->view('hcdec_footer');
			}
			else
			if($r['status'] == 'DB')
			{
				# display error page
			}
			else
			{
				# display error page
			}
		}
	}
	
	function editalert()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$id = -1;
			$parms = $this->uri->uri_to_assoc(3);
			if(isset($parms['id'])) $id = $parms['id'];
			$this->load->model('alerts');
			$r = $this->alerts->getAlertForId($id);
			if($r['status'] == 'OK')
			{
				$header_params = array('page'=>'editalert');
				$this->load->view('hcdec_header', $header_params);
				if(!isset($r['errors'])) $r['errors'] = array();
				$form_params = array(
						'page'=>'editalert', 
						'id'=>$id,
						'button' => 'Apply',
						'errors'=>$r['errors'],
						'alert'=>$r['rows'][0],
						'action'=>'/admin/editalert'
				);
				$this->load->view('hcdec_alert_form', $form_params);
				$this->load->view('hcdec_footer');
			}
			else
			{
			}
		}
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
				$this->load->model('alerts');
				$r = $this->alerts->setAlertInfo( $_POST, $_POST['id'] );
				//var_dump($r);
				redirect('/admin/alerts');
		}
	}
	
	function deletealert()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			# display confirmation page
		}
		else
		{
			# delete alert and redirect to /home/alerts
		}
	}
	
# manage clubs and caucuses
	function clubsandcaucuses()
	{
		
	}
	
	function addcluborcaucus()
	{
		
	}
	
	function editcluborcaucus()
	{
		if($_SERVER['REQUEST_METHOD']=='GET')
		{
			$params = $this->uri->uri_to_assoc(3);
			if(isset($params['id']) && !empty($params['id']))
			{
				
			}
		}
		else
		{
			
		}
	}
	
# manage resources
	function resources()
	{
		
	}
	
	function addresource()
	{
		
	}
	
	function editresource()
	{
		
	}
	
# manage news
	 
}

/* End of file admin.php */
/* Location: ./system/application/controllers/welcome.php */