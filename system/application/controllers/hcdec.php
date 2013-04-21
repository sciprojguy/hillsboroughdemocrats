<?php

require_once('iCalcreator-2.12/iCalcreator.class.php');
error_reporting(E_ALL);
ini_set("display_errors", 1); 

function setFlashMessage( $msg )
{
	$_SESSION['flashMsg'] = $msg;
}

function extractFlashMessage()
{
	if(isset($_SESSION['flashMsg']))
	{
		$msg = $_SESSION['flashMsg'];
		unset($_SESSION['flashMsg']);
		return "<div style='color:red;background-color:lightgray'>$msg</div>";
	}
	else
		return "";
}

class Hcdec extends Controller {

	var $flash_message = null;
	
	function Hcdec()
	{
		parent::Controller();
		session_start();
	}
		
# main page for the site.
	function index()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();

		# get any flash messages
		$this->flash_message = extractFlashMessage();
		
		# load model for calendar widget and display events
		$this->load->model('events');		
		$r = $this->events->getApprovedEventsForFrontPage(date('m'), date('Y'));
		$events = $r['rows'];
		$events_content = $this->load->view('hcdec_events_widget', array('event_dates'=>$events), true);

		# load model for news and get latest event
		$news_content = "";
		$this->load->model('news');
		$r = $this->news->getFrontPageEntries();
		if($r['status'] == 'OK')
		{
			$newsItems = $r['rows'];
			# format $r['row'] and assign to $news_content
			#$news_content = "<a href=\"{$newsItem['link']}\">{$newsItem['title']}</a>";
			$news_content = $this->load->view('hcdec_news_widget', array('newsItems'=>$newsItems), true);		
		}
		
		# LATER - load model for articles and get front page articles
		
		# NOW - put it all together for front page
		$content = $this->load->view('hcdec_index', 
			array('flashMessage'=>$this->flash_message, 
					'events_content'=>$events_content,
					'news_content'=>$news_content,
					 ), true);
			
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
# "about us" page
	function aboutus()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
			
		$content = $this->load->view('hcdec_aboutus', '', true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
# "candidates" page - lists candidates for office - public
	function candidates()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();

		$params = array();
		$this->load->model('candidates');
		$r = $this->candidates->listCandidatesGroupedByLevelAndOffice();
		if($r['status'] == 'OK')
		{
			$params = array('candidates'=>$r['rows'], 'user'=>$userInfo);
			$content = $this->load->view('hcdec_candidates.php', $params, true);
		}
		else
		if($r['status'] == 'DB')
		{
			$content = "Our database is not feeling very well.  Please check back later.";
		}
		/*
		$content = "<div class='contentBox'><div style='width:80%;padding-top:16px;margin-left:auto;margin-right:auto'>Candidates page is under construction until redistricting is settled.</div></div>";
		*/
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
	/*function viewcandidate()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		$this->load->model('candidates');
			
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$params = $this->uri->uri_to_assoc(3);
			if(!isset($params['id']))
			{
				setFlashMessage("No such candidate");
				redirect("/hcdec/candidates");
			}
				
			$r = $this->candidates->getCandidateForView($params['id']);
			if($r['status'] != 'OK')
			{
				setFlashMessage("Candidate database error");
				redirect("/hcdec/candidates");
			}
			$params = array('user'=>$userInfo, 'candidate'=>$r['row'], 'canDelete'=>true );
			$content = $this->load->view('hcdec_candidate', $params, true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
	}*/
	
# add/edit candidates - "manage_candidates" role required
	function newcandidate()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		# if user is not logged in, redirect w/message
		if(!isset($userInfo['id']))
		{
			redirect("/hcdec/candidates");
			return;
		}

		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_candidates', $userInfo['roles']))
		{
			redirect("/hcdec/candidates");
			return;
		}
		
		$this->load->model('candidates');
		$candidate = $this->candidates->emptyCandidate();
		
		if("GET" == $_SERVER['REQUEST_METHOD'])
		{
			$this->load->model('offices');
			$r = $this->offices->listoffices();
			$errors = array();
			$params = array('user'=>$userInfo, 'errors'=>$errors, 'offices'=>$r['rows'], 'candidate'=>$candidate );
			$content = $this->load->view('candidate_form', $params, true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
		else
		if("POST" == $_SERVER['REQUEST_METHOD'])
		{
			if(isset($_POST['deleteThis']))
			{
				
			}
			
			if(isset($_FILES['picture']))
				$_POST['picture'] = $_FILES['picture']['name'];
			else
				$_POST['picture'] = '';
				
			if(isset($_FILES['large_picture']))
				$_POST['large_picture'] = $_FILES['large_picture']['name'];
			else
				$_POST['large_picture'] = '';
				
				
			# check and make sure the candidate info is valid
			$results = $this->candidates->addCandidate( $_POST );
			if($results['status'] == 'OK')
			{
				# if it is, see if we have a picture to move.  these
				# come in via the $_FILES superglobal and there's 
				# one of these just because there's an <input type=file
				# in the form so we have to dig a little deeper.
				if( isset($_FILES['picture']) && 
					isset($_FILES['picture']['name']) &&
					!empty($_FILES['picture']['name']))
				{
					# actually ought to check out $tmp_name to see
					# if it exists on the file system.  if it does,
					# try and move it.  if it does not, no harm no foul.
					
					$docroot = $_SERVER['DOCUMENT_ROOT'];
					$tmp_name = $_FILES['picture']['tmp_name'];
					$filename = $_FILES['picture']['name'];
					$filedest = "$docroot/images/candidates/$filename";
					$moved = copy("$tmp_name", "$filedest");
					if(false == $moved)
					{
						# add flash error message
						setFlashMessage("Could not move picture");	
					}					
				}
								
				if( isset($_FILES['large_picture']) && 
					isset($_FILES['large_picture']['name']) &&
					!empty($_FILES['large_picture']['name']))
				{
					# actually ought to check out $tmp_name to see
					# if it exists on the file system.  if it does,
					# try and move it.  if it does not, no harm no foul.
					
					$docroot = $_SERVER['DOCUMENT_ROOT'];
					$tmp_name = $_FILES['large_picture']['tmp_name'];
					$filename = $_FILES['large_picture']['name'];
					$filedest = "$docroot/images/candidates/$filename";
					$moved = copy("$tmp_name", "$filedest");
					if(false == $moved)
					{
						# add flash error message
						setFlashMessage("Could not move picture");	
					}					
				}				
				redirect( "/hcdec/candidates");
			}
			else
			if($results['status'] == 'VALIDATION')
			{
				# collect errors and present form again
				$candidate = $_POST;
				$this->load->model('offices');
				$offices = $this->offices->listoffices();
				
				$params = array('user'=>$userInfo, 
							'offices'=>$offices, 
							'candidate'=>$candidate,
							'errors'=>$results['errors'] );
				$content = $this->load->view('candidate_form', $params, true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);
			}
			else
			{
				# error page with $results
			}			
		}
	}
	
	function editcandidate()
	{
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		# if user is not logged in, redirect w/message
		if(!isset($userInfo['id']))
		{
			redirect("/hcdec/candidates");
			return;
		}
		
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_candidates', $userInfo['roles']))
		{
			redirect("/hcdec/candidates");
			return;
		}

		$this->load->model('candidates');
			
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$params = $this->uri->uri_to_assoc(3);
			if(!isset($params['id']))
			{
				setFlashMessage("No such candidate");
				redirect("/hcdec/candidates");
			}
				
			$r = $this->candidates->getCandidate($params['id']);
			if($r['status'] != 'OK')
			{
				setFlashMessage("Candidate database error");
				redirect("/hcdec/candidates");
			}
			
			$this->load->model('offices');
			$offices = $this->offices->listoffices();
			
			$params = array('user'=>$userInfo, 'offices'=>$offices, 'candidate'=>$r['row'], 'canDelete'=>true );
			$content = $this->load->view('candidate_form', $params, true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
		else 
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$candidate_id = $_POST['id'];
			if(!isset($candidate_id))
				redirect('/hcdec/candidates');
				
			if(isset($_POST['delete']))
			{
				$this->candidates->deleteCandidate($candidate_id);
				redirect('/hcdec/candidates');
			}

			if(isset($_FILES['picture']) && !empty($_FILES['picture']['name']))
				$_POST['picture'] = $_FILES['picture']['name'];
			if(isset($_FILES['large_picture']) && !empty($_FILES['large_picture']['name']))
				$_POST['large_picture'] = $_FILES['large_picture']['name'];
				
			$results = $this->candidates->updateCandidate( $_POST, $candidate_id);
			if($results['status'] == 'OK')
			{
				if( isset($_FILES['picture']) && 
					isset($_FILES['picture']['name']) &&
					!empty($_FILES['picture']['name']))
				{
					# actually ought to check out $tmp_name to see
					# if it exists on the file system.  if it does,
					# try and move it.  if it does not, no harm no foul.
					
					$docroot = $_SERVER['DOCUMENT_ROOT'];
					$tmp_name = $_FILES['picture']['tmp_name'];
					$filename = $_FILES['picture']['name'];
					$filedest = "$docroot/images/candidates/$filename";					
					$moved = copy("$tmp_name", "$filedest");
					if(false == $moved)
					{
						# add flash error message	
						setFlashMessage("Could not move picture");
					}					
				}
				
				if( isset($_FILES['large_picture']) && 
					isset($_FILES['large_picture']['name']) &&
					!empty($_FILES['large_picture']['name']))
				{
					# actually ought to check out $tmp_name to see
					# if it exists on the file system.  if it does,
					# try and move it.  if it does not, no harm no foul.
					
					$docroot = $_SERVER['DOCUMENT_ROOT'];
					$tmp_name = $_FILES['large_picture']['tmp_name'];
					$filename = $_FILES['large_picture']['name'];
					$filedest = "$docroot/images/candidates/$filename";					
					$moved = copy("$tmp_name", "$filedest");
					if(false == $moved)
					{
						# add flash error message	
						setFlashMessage("Could not move picture");
					}					
				}
				
				redirect( "/hcdec/candidates");
			}
			else
			if($results['status'] == 'VALIDATION')
			{
				# collect errors and present form again
				$candidate = $this->candidates->getCandidate($candidate_id);
				$this->load->model('offices');
				$offices = $this->offices->listoffices();
				
				$params = array('user'=>$userInfo, 
							'offices'=>$offices, 
							'candidate'=>$candidate,
							'errors'=>$results['errors'] );
				$content = $this->load->view('candidate_form', $params, true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);
			}
			else
			{
				# error page with $results
			}
		}
	}
	
# "officials" page - lists Democratic elected officials (partisan office)
	function officials()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		$content = $this->load->view('hcdec_electedofficials', '', true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
# add/edit officials - "manage_officials" role needed
	function newofficial()
	{
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
	function editofficial()
	{
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
# lists Clubs and Caucuses
	function clubsandcaucuses()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array('roles'=>array());

		$this->load->model('clubs');
		
		if(in_array('manage_clubs',$userInfo['roles']))
			$r = $this->clubs->getClubsAndCaucuses();
		else 
			$r = $this->clubs->getActiveClubsAndCaucuses();

		$params['clubs'] = $r['rows'];
		$params['user'] = $userInfo;	
		$content = $this->load->view('hcdec_clubsandcaucuses', $params, true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}

# add/edit clubs or caucuses - "manage_clubs_caucuses" role required
	function newcluborcaucus()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/clubsandcaucuses');
		
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_clubs',$userInfo['roles']))
			redirect('/hcdec/clubsandcaucuses');
					
		$this->load->model('clubs');
		
		if('GET'==$_SERVER['REQUEST_METHOD'])
		{
			# now get an empty club/caucus record and load the form with action 
			# set to 'newcluborcaucus'
			$club = $this->clubs->emptyClubOrCaucus();
			$params = array('user'=>$userInfo, 'club'=>$club, 'action'=>'newcluborcaucus');
			$content = $this->load->view('clubOrCaucusForm', $params, true);
			$params = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template',$params);
		}
		else
		{
			# validate $_POST.  if it passes validation, update it and redirect
			# to /hcdec/clubsandcaucuses.  else, capture errors and redisplay form.
			$r = $this->clubs->addClubOrCaucus($_POST);
			if('OK' == $r['status'])
			{
				redirect('/hcdec/clubsandcaucuses');
			}
			else
			if('VALIDATION' == $r['status'])
			{
				# capture errors and redisplay form
				$errors = $r['errors'];
				$params = array('user'=>$userInfo, 'club'=>$_POST, 'errors'=>$errors, 'action'=>'newcluborcaucus');
				$content = $this->load->view('clubOrCaucusForm', $params, true);
				$params = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $params);
			}	
			else
			{
				# redirect to 'Database is sick' page
			}
		}
	}
	
	function editcluborcaucus()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/clubsandcaucuses');
				
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_clubs',$userInfo['roles']))
			redirect('/hcdec/clubsandcaucuses');
			
		# now take the id from the URI line and use it to get the club/caucus
		# record. if not there, redirect with error
		
		$this->load->model('clubs');
			
		if('GET'==$_SERVER['REQUEST_METHOD'])
		{
			# load the form with action set to 'editcluborcaucus
			$id = -1;
			$arr = $this->uri->segment_array();
			if(isset($arr[4])) $id = $arr[4];
			
			$r = $this->clubs->getClubOrCaucus($id);
			if('OK'==$r['status'])
			{
				# load form and display
				$params = array('user'=>$userInfo, 'club'=>$r['club'], 'action'=>'editcluborcaucus');
				$content = $this->load->view('clubOrCaucusForm', $params, true);
				$params = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template', $params);
			}
			else
			if('DB'==$r['status'])
			{
				# error message teo 'DB is down.  We have been notified'
			}
			else
			{
				# other error msg - 'Unable to edit'
			}
		}
		else
		{
			$r = $this->clubs->updateClubOrCaucus( $_POST, $_POST['id'] );
			if('OK' == $r['status'])
			{
				redirect('/hcdec/clubsandcaucuses');
			}
			else
			if('VALIDATION' == $r['status'])
			{
				$errors = $r['errors'];
				$params = array('user'=>$userInfo, 'club'=>$_POST, 'errors'=>$errors, 'action'=>'editcluborcaucus');
				$content = $this->load->view('clubOrCaucusForm', $params, true);
				$params = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template', $params);
			}
			else
			if('DB' == $r['status'])
			{
				# TODO error page for 'db is sick'
			}
			else 
			{
				# TODO more general error page
			}
		}
	}
	
# lists News
	function news()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array('roles'=>array());
				
		$this->load->model('news');
		
		$r = $this->news->getActiveNewsEntries();
		
		if($r['status'] == 'OK')
			$newsitems = $r['rows'];
		else
			$newsitems = array();

		$params = array('user'=>$userInfo, 'newsItems'=>$newsitems);
		$content = $this->load->view('hcdec_news', $params, true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
# manage News

	function listnewsitems()
	{
		
	}
	
	function newnewsitem()
	{
		$userInfo = $_SESSION['user'];
		if(!isset($userInfo))
			redirect('/hcdec/index');
		if(!in_array('manage_news', $userInfo['roles']))
			redirect('/hcdec/myhcdec');
		
		$this->load->model('news');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$newsItem = $this->news->emptyNewsItem();
			$errors = array();
			$params = array('newsitem'=>$newsItem, 'errors'=>$errors, 'action'=>'newnewsitem');
			$content = $this->load->view('hcdec_news_form', $params, true);
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$r = $this->news->addNewsEntry($_POST);
			if($r['status'] == 'OK')
				redirect('/hcdec/news');
			else
			if($r['status'] == 'VALIDATION')
			{
				$errors = $r['errors'];
				$params = array('newsitem'=>$_POST, 'errors'=>$errors, 'action'=>'newnewsitem');
				$content = $this->load->view('hcdec_news_form', $params, true);
				$this->load->view('public_template', $content);
			}
			else 
			{
				# "database is sick" msg
			}
		}
	}
	
	function editnewsitem()
	{
		$userInfo = $_SESSION['user'];
		if(!isset($userInfo))
			redirect('/hcdec/index');
		if(!in_array('manage_news', $userInfo['roles']))
			redirect('/hcdec/myhcdec');

		$this->load->model('news');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$uri_params = $this->uri->uri_to_assoc(3);
			if(!isset($uri_params['id']))
			{
				setFlashMessage("No such news item");
				redirect('/hcdec/news');
			}
			else
			{
				$id = $uri_params['id'];
				$errors = array();
				$r = $this->news->getNewsEntry($id);
				if($r['status'] == 'OK')
				{
					# load form to edit news item
					$params = array('newsitem'=>$r['row'], 'errors'=>$errors, 'action'=>'editnewsitem');
					$content  = $this->load->view('hcdec_news_form', $params, true);
					$p = array('user'=>$userInfo, 'content'=>$content );
					$this->load->view('public_template', $p);
				}
				else
				{
					setFlashMessage("No such news item");
					redirect('/hcdec/news');
				}
			}
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			if(!isset($_POST['id']))
			{
				setFlashMessage("No such news item");
				redirect('/hcdec/news');
			}
			else
			{
				$id = $_POST['id'];
				$r = $this->news->updateNewsEntry($_POST, $id);
				redirect('/hcdec/news');
			}
		}
	}
	
# Resources - vote by mail, find my precinct, etc.
	function resources()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
				
		$content = $this->load->view('hcdec_resources', '', true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
	function addresource()
	{
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
	function editresource()
	{
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
# Contact us - volunteer, etc.
	function contactus()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
				
		$content = $this->load->view('hcdec_contactus', '', true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
	function donate()
	{
	}
	
	function volunteer()
	{
		$this->load->model('volunteers');
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
					
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			# present blank form
			$volunteer = $this->volunteers->emptyVolunteer();
			
			$params = array("volunteer"=>$volunteer);
			$content = $this->load->view('hcdec_volunteer', $params, true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			# write into volunteer db and send email to megan gerkin
			$results = $this->volunteers->addVolunteer($_POST);
			if($results['status']=='OK')
			{
				# generate volunteer email
				$params = array('volunteer'=>$_POST);
				$email = $this->load->view('volunteerEmail', $params, true);
				# will want to change this to SMTP?
				mail("meghan@wherever.com", "someone volunteered!", $email);
				# redirect to /hcdec/index
				redirect('/hcdec/index');
			}
			else
			if($results['status']=='VALIDATION')
			{
				# reload form with errors displayed
				$errors = $results['errors'];
				$params = array("volunteer"=>$_POST, 'errors'=>$errors);
				$content = $this->load->view('hcdec_volunteer', $params, true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);
			}
			else
			{
				# redirect to error page
				redirect('/hcdec/index');
			}
		}
	}
	
	function recommendations() 
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
				
		$content = $this->load->view('hcdec_recommendations', '', true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
# get volunteers - lists volunteers.  "manage_volunteers" role required
# needs sort/filter criteria:
	# "volunteered since" date
	# precinct #
	# city
	# volunteered for (phone bank, candidate support, etc)
	# committee
	# democrat y/n
	# hcdec y/n
	# volunteered before

	# actually, this should be a POST request
	function volunteers()
	{
		$userInfo = $_SESSION['user'];
		if(!isset($userInfo))
			redirect('/hcdec/index');
		if(!in_array('manage_volunteers', $userInfo['roles']))
			redirect('/hcdec/myhcdec');
			# list the volunteers as rows in HTML table.  parameters for
		# this request: $startDate, $endDate.  if startDate is not
		# given, all volunteer requests are listed up thru endDate.
		# if endDate is not given, all volunteer requests are listed
		# period in one giant scrolling div.  add format = html or csv
		# so we know which view to load

		$arr = $this->uri->uri_to_assoc(3);
		
		$criteria = array();
		$startDate = "";
		if(isset($arr['startDate']))
		{
			$criteria['startDate'] = $arr['startDate'];
			$startDate = $arr['startDate'];
		}
			
		$endDate = "";
		if(isset($arr['endDate']))
		{
			$criteria['endDate'] = $arr['endDate'];
			$endDate = $arr['endDate'];
		}
		
		$precinct = "";
		if(isset($arr['precinct']))
		{
			$criteria['precinct'] = $arr['precinct'];
			$precinct = $arr['precinct'];
		}
			
		# now look up volunteers
		$this->load->model('volunteers');
		#FIXME - change this to use start and end dates and precinct numbers
		$r = $this->volunteers->getVolunteersForCriteria($criteria);
		if($r['status'] == 'OK')
		{
			if(count($r['rows'])>0)
			{
				$params['volunteers'] = $r['rows'];
				$params['startDate'] = $startDate;
				$params['endDate'] = $endDate;
				$params['precinct'] = $precinct;
				$content = $this->load->view('hcdec_volunteers', $params, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				# redirect to page that says 'no volunteers found in that range'
			}
		}
		else
		{
			# error page
		}
	}
	
	function downloadvolunteers()
	{
		# parameters: startDate, endDate, format
		$userInfo = $_SESSION['user'];
		if(!isset($userInfo))
			redirect('/hcdec/index');
		if(!in_array('manage_volunteers', $userInfo['roles']))
			redirect('/hcdec/myhcdec');
			# list the volunteers as rows in HTML table.  parameters for
		# this request: $startDate, $endDate.  if startDate is not
		# given, all volunteer requests are listed up thru endDate.
		# if endDate is not given, all volunteer requests are listed
		# period in one giant scrolling div.  add format = html or csv
		# so we know which view to load

		$arr = $this->uri->uri_to_assoc(3);
		
		$criteria = array();
		$startDate = "";
		if(isset($arr['startDate']))
		{
			$criteria['startDate'] = $arr['startDate'];
			$startDate = $arr['startDate'];
		}
			
		$endDate = "";
		if(isset($arr['endDate']))
		{
			$criteria['endDate'] = $arr['endDate'];
			$endDate = $arr['endDate'];
		}
		
		$precinct = "";
		if(isset($arr['precinct']))
		{
			$criteria['precinct'] = $arr['precinct'];
			$precinct = $arr['precinct'];
		}
			
		$criteria = array();
		# now look up volunteers
		$this->load->model('volunteers');
		$r = $this->volunteers->getVolunteers();
		if($r['status'] == 'OK')
		{
			$params['volunteers'] = $r['rows'];
			$params['startDate'] = $startDate;
			$params['endDate'] = $endDate;
			$params['precinct'] = $precinct;
			$this->load->view('volunteers_spreadsheet', $params);
		}
		else
		{
			# error page
		}
	}

	function calendar()
	{
		if(isset($_SESSION['user']))
			$userInfo = $_SESSION['user'];
		else
			$userInfo = array();
			
		$params = $this->uri->uri_to_assoc(3);
		if(!isset($params['month']) || empty($params['month']))
			$month = date('m')+0;
		else
			$month = $params['month'];
			
		if(!isset($params['year']) || empty($params['year']))
			$year = date('Y');
		else
			$year = $params['year'];
		
		$this->load->model('events');
		$results = $this->events->getApprovedEventsForMonthAndYear( $month, $year );
		if($results['status']=='OK')
		{
			$data = array('events'=>$results['rows'], 'month'=>$month, 'year'=>$year);
			$content = $this->load->view('hcdec_calendar', $data, true);
			
			$p = array('content'=>$content, 'user'=>$userInfo);
		}
		else
		{
			# fetch error page for db			
		}
		
		$this->load->view('public_template.php', $p);
	}
	
	# gives a list of the day's events.
	function daysevents()
	{
		if(isset($_SESSION['user']))
			$userInfo = $_SESSION['user'];
		else
			$userInfo = array();
		$this->load->model('events');
		
		$param = $this->uri->uri_to_assoc(3);
		if(!isset($param['date']))
		{
			setFlashMessage("No such date");
			redirect('/hcdec/index');
		}
		
		$r = $this->events->getApprovedEventsForDate($param['date']);
		if('OK'==$r['status'])
		{
			$parms = array('date'=>$param['date'], 'events'=>$r['rows']);
			$content = $this->load->view('hcdec_dayview', $parms, true);
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		{
			# error page
		}
	}
	
	# gives a larger-format view of a specific event.  includes date, start/end,
	# contact, phone/email, location map and details.  also includes link for adding 
	# to your device calendar.
	 
	function eventdetail()
	{
		if(isset($_SESSION['user']))
			$userInfo = $_SESSION['user'];
		else
			$userInfo = array();
		$this->load->model('events');
		$param = $this->uri->uri_to_assoc(3);
		$id = "";
		if(isset($param['id']))
			$id = $param['id'];
		$r = $this->events->getEvent($id);
		if('OK'==$r['status'] && isset($r['event']['date']))
		{
			$event = $r['event'];
			$parms = array('event'=>$event);
			$content = $this->load->view('hcdec_event_detail', $parms, true);
		}
		else
		{
			$content = "<div class='contentBox'><b>No such event</b></div>";
		}
		$p = array('user'=>$userInfo, 'content'=>$content);
		$this->load->view('public_template', $p);
	}
	
	function downloadevent()
	{
		if(isset($_SESSION['user']))
			$userInfo = $_SESSION['user'];
		else
			$userInfo = array();
		$this->load->model('events');
		$param = $this->uri->uri_to_assoc(3);
		$id = "";
		if(isset($param['id']))
			$id = $param['id'];
		$r = $this->events->getEvent($id);
		if('OK'==$r['status'] && isset($r['event']['date']))
		{
			$event = $r['event'];
			$parms = array('event'=>$event);
			$content = $this->load->view('hcdec_event_ical', $parms, true);
		}
		else
		{
			$content = "<div class='contentBox'><b>No such event</b></div>";
			$this->load->view('public_template', $p);
		}
	}
	
# calendar admin
	function listevents()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		#if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
			redirect('/hcdec/calendar');
			
		$this->load->model('events');
		$r = $this->events->getAllCalendarEvents();
		$content = "";	
		if('OK' == $r['status'])
		{
			$events = $r['rows'];
			$parms = array('events'=>$events);
			$content = $this->load->view('hcdec_events', $parms, true);
		}	
		else
		if('DB' == $r['status'])
		{
			#FIXME - make this a formal page
			$content = "DB error goes here";
		}
		else
		{
			#FIXME - make this a formal page
			$content = "Other error goes here";
		}
		
		$p = array('user'=>$userInfo, 'content'=>$content);
		$this->load->view('public_template', $p);			
	}
	
	function addevent()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		#if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
			redirect('/hcdec/calendar');
			
		$this->load->model('events');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$event = $this->events->emptyEvent();
			$parms = array('event'=>$event, 'action'=>'addevent');
			$content = $this->load->view('hcdec_event_form', $parms, true);
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$r = $this->events->insertEvent($_POST);
			if($r['status'] == 'OK')
			{
				#FIXME - instead, since the user is managing the calendar
				# redirect them to the list of events page (TBD)
				redirect('/hcdec/listevents');
			}
			else
			if($r['status'] == 'VALIDATION')
			{
				$parms = array('event'=>$_POST, 'errors'=>$r['errors'], 'action'=>'addevent');
				$content = $this->load->view('hcdec_event_form', $parms, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				#FIXME error page for DB
			}
		}
	}

	function deleteSelectedEvents()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		#if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
		redirect('/hcdec/calendar');
		
		$this->load->model('events');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
				redirect('/hcdec/listevents');
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			if(!isset($_POST['eventsToDelete']))
				$_POST['eventsToDelete'] = array();
			$r = $this->events->deleteEventsWithIds($_POST['eventsToDelete']);
			if($r['status'] == 'OK')
			{
				#FIXME - instead, since the user is managing the calendar
				# redirect them to the list of events page (TBD)
				redirect('/hcdec/listevents');
			}
			else
			{
				#FIXME error page for DB
			}
		}
		
	}
	
	function editevent()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
			redirect('/hcdec/calendar');
			
		$this->load->model('events');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$param = $this->uri->uri_to_assoc(3);
			$id = "";
			if(isset($param['id']))
				$id = $param['id'];
			$r = $this->events->getEvent($id);
			if('OK'==$r['status'])
			{
				$event = $r['event'];
				$parms = array('event'=>$event, 'action'=>'editevent', 'id'=>$id);
				$content = $this->load->view('hcdec_event_form', $parms, true);
			}
			else
			{
				$content = "<b>No such event</b>";
			}
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$r = $this->events->updateEvent( $_POST, $_POST['id']);
			if('OK'==$r['status'])
			{
				redirect('/hcdec/listevents');
			}
			else
			if('VALIDATION'==$r['status'])
			{
				# redisplay with error msgs
				$errors = $r['errors'];
				$parms = array('event'=>$_POST, 'errors'=>$errors, 'action'=>'editevent');
				$content = $this->load->view('hcdec_event_form', $parms, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				#FIXME db error
			}
		}
	}

	function submittedevents()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
			redirect('/hcdec/calendar');
		
		$this->load->model('events');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$r = $this->events->getSubmitedEvents();
			if('OK' == $r['status'])
			{
				$submittedEvents = $r['rows'];
				$params = array('events'=>$submittedEvents);
				$content = $this->load->view('submitted_events', $submittedEvents, true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template', $p);
			}
			else
			{
				#FIXME add error page
			}
		}
		else
			redirect('/hcdec/calendar');
	}
	
	function reviewevent()
	{
		# if user is not logged in, redirect w/message
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else redirect('/hcdec/calendar');
		
		# if user is logged in but does not have role, redirect w/message
		if(!in_array('manage_calendar',$userInfo['roles']))
			redirect('/hcdec/calendar');
			
		$this->load->model('events');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$param = $this->uri->uri_to_assoc(3);
			# get event.  if no such event, add flash message and redirect
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$errors = $this->events->validate($_POST);
		}
	}
	
# member login
	function login()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET') # will be POST when we roll this all the way out
		{
			$username = "";
			$password = "";
			
			$arr = $this->uri->uri_to_assoc(3);
			if(isset($arr['u']))
				$username = $arr['u'];
			if(isset($arr['p']))
				$password = $arr['p'];
				
			#$username = $_POST['username'];
			#$password = $_POST['password'];
			
			$this->load->model('users');
			$r = $this->users->loginUser($username, $password);
			if($r['status'] == 'OK')
			{
				$uInfo = $r['user'][0];
				$uID = $uInfo['id'];
				$r = $this->users->getUserRoles( $uID );
				if($r['status'] == 'OK')
					$uInfo['roles'] = $r['rows'];
				$_SESSION['user'] = $uInfo;
			}
			else
			{
				# increment "failed login" count for this username
				# model will suspend account after enough tries 
				# add flash message for login error
				# this requires we get an error message.  model
				# should supply in $r['reason'].  how to deal with
				# DoS attacks?  really need to be recording the
				# login attempts as well, with IP address and
				# date/time.  otherwise script kiddies will be
				# making mischief. challenge/response?
				setFlashMessage("Invalid username or password");
			}
			redirect('/hcdec/index');
		}
		else 
		{
			# display login form with error message...
		}
	}
	
	function logout()
	{
		session_destroy();
		redirect('/hcdec/index');
	}
	
#member page
	function myhcdec()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		/*

		# for the moment, user can do a few things in the "my hcdec" page:
		
		# 1. update their profile
		# 2. see their tagged events
		# 3. see their tagged messages
		#
		# and for those with roles
		#
		# 4. see links to let them do their identified tasks
		#
		
		# get events for the current month/year
		# part of user info is now "event_tags" array
		$this->load->model('events');
		$results = $this->events->getUpcomingEvents($userInfo['event_tags']);
		if($results['status']=='OK')
			$events = $results['rows'];
		else
			$events = array();
			
		# get tagged messages
		$this->load->model('messages');
		$r = $this->messages->getTaggedMessages($userInfo['message_tags']);
		if($r['status']=='OK')
			$messages = $['rows'];
		else
			$messages = array();

		*/
		$this->load->model('member');
		$mr = $this->member->getMember( $userInfo['member_id']);
		$events = array();
		$content = $this->load->view( 'hcdec_member', 
				array('user'=>$userInfo, 'member'=>$mr['memberInfo'], 'events'=>$events), true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		
		$this->load->view('public_template.php', $p);
	}
	
# administrative links
	function users()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		$this->load->model('users');
		$results = $this->users->getAllUsers();
		if($results['status'] == 'OK')
		{
			$page_params = array('users'=>$results['rows']);
			$content = $this->load->view('list_users', $page_params, true);
		}
		else
		{
			$content = "Unable to get list of users just now";
		}
		
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);
	}
	
	function edituser()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
		$content = "";
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$this->load->model('users');
			$params = $this->uri->uri_to_assoc(3);
			if(isset($params['id']))
			{
				$r = $this->users->getUser($params['id']);
				$u = $r['user'];
				$r = $this->users->getUserRoles($u['id']);
				$roles = $r['rows'];
				$p = array('user'=>$u, 'roles'=>$roles);
				$content = $this->load->view('user_form', $p, true);
			}
			else
			{
				$content = "Unable to look up a user with no id";
			}
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			# try to update user using $_POST
			# if okay, redirect to '/admin/users'
			# if not okay, reload form with error messages
		}
	}
	
# special events
	function specialevents()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();

		$r = array('rows'=>array());
		
		$r['rows'][0] = array(
			'img'=>'/images/Kennedy King thumb.jpg',
			'date'=>'2012-09-08',
			'name'=>'2012 Kennedy/King Dinner',
			'descr'=>'Annual dinner to honor John F Kennedy and Dr Martin Luther King, Jr'
		);
		
		$p = array('events'=>$r['rows'], 'user'=>$userInfo);
		$content = $this->load->view('hcdec_specialevents', $p, true);
		
		$p = array('user'=>$userInfo, 'content'=>$content);
		$this->load->view('public_template', $p);
	}
	
# prpfile management
	function editmyprofile()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		$this->load->model('member');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			# get user's member info and populate form
			$member_id = $userInfo['member_id'];
			$r = $this->member->getMember($member_id);
			if($r['status'] == 'OK')
			{
				$member = $r['memberInfo'];
				$content = $this->load->view('hcdec_member_profile_form', array('member'=>$member), true);
			}
			else
			{
				$content = "error";
			}
			
			$this->load->view('public_template', array('user'=>$userInfo,'content'=>$content));
		}
		else
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			# try to update.  if errors, redisplay form with error msgs
			# else go back to My HCDEC
			$r = $this->member->updateMember($_POST, $userInfo['id']);
			if($r['status'] != 'OK')
			{
				$member = $_POST;
				$errors = $r['errors'];
				$content = $this->load->view('hcdec_member_profile_form', 
					array('member'=>$member, 'errors'=>$errors), true);
				$this->load->view('public_template', array('user'=>$userInfo,'content'=>$content));
			}
			else 
				redirect('/hcdec/myhcdec');
		}
	}

#member management
	function members()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
		$this->load->model('member');
		
		$r = array();
		if(in_array('manage_members', $userInfo['roles']))
		{
			$r = $this->member->getMembers();
		}
		else 
		{
			$r = $this->member->getMembersWithStatus('active');
		}
		
		$p = array('members'=>$r['rows'], 'user'=>$userInfo);
		$content = $this->load->view('hcdec_members', $p, true);
		
		$p = array('user'=>$userInfo, 'content'=>$content);
		$this->load->view('public_template', $p);
		
		# member directory - public, but if user has "manage_members" role
		# there is an "Add Member" link at the top and an "Edit" button next
		# to each member row in the page.
		
		# directory should be sortable by name, type and precinct#
		# and searchable?
	}
	
	function addmember()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if(!in_array('manage_members', $userInfo['roles']))
		{
			setFlashMessage("You are not authorized to do that.");
			redirect('/hcdec/index');
		}
		
		$this->load->model('member');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$member = $this->member->emptyMember();
			$errors = array();
			$p = array('member'=>$member, 'errors'=>$errors, 'user'=>$userInfo, 'action'=>'addmember');
			$content = $this->load->view('hcdec_member_form', $p, true);
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		{
			$r = $this->member->addMember($_POST);
			if('OK' == $r['status'])
				redirect('/hcdec/members');
			else
			if('VALIDATION' == $r['status'])
			{
				$errors = $r['errors'];
				$p = array('member'=>$_POST, 'errors'=>$errors, 'user'=>$userInfo, 'action'=>'addmember');
				$content = $this->load->view('hcdec_member_form', $p, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				setFlashMessage("Our database is not feeling well.");
				redirect('/hcdec/index');
			}
		}
	}
	
	function editmember()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();

		$params = $this->uri->uri_to_assoc(3);
		if(!in_array('manage_members', $userInfo['roles']))
		{
			setFlashMessage("You are not authorized to do that.");
			redirect('/hcdec/index');
		}
		
		$this->load->model('member');
		if('GET' == $_SERVER['REQUEST_METHOD'])
		{
			$parms = $this->uri->uri_to_assoc(3);
			if(!isset($parms['id']))
			{
				setFlashMessage("Invalid member id");
				redirect('/hcdec/members');
			}
			
			$member_id = $parms['id'];
			$r = $this->member->getMember($member_id);
			if('OK' == $r['status'])
			{
				$errors = array();
				$member = $r['memberInfo'];
				$p = array('member'=>$member, 'errors'=>$errors, 'user'=>$userInfo, 'action'=>'editmember');
				$content = $this->load->view('hcdec_member_form', $p, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				setFlashMessage("No such member");
				redirect('/hcdec/members');
			}
		}
		else
		{
			$r = $this->member->updateMember($_POST, $_POST['id']);
			if('OK' == $r['status'])
				redirect('/hcdec/members');
			else
			if('VALIDATION' == $r['status'])
			{
				$errors = $r['errors'];
				$p = array('member'=>$_POST, 'errors'=>$errors, 'user'=>$userInfo, 'action'=>'editmember');
				$content = $this->load->view('hcdec_member_form', $p, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
			}
			else
			{
				setFlashMessage("Our database is not feeling well.");
				redirect('/hcdec/index');
			}
		}
	}
	
# role management
	function roles()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
	function addrole()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}
	
	function editrole()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
		$params = $this->uri->uri_to_assoc(3);
	}
	
	function deleterole()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		$params = $this->uri->uri_to_assoc(3);
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
	}	
	
	function bylaws2012()
	{
		$this->load->view('hcdec_bylaws2012');
	}
	
# Action Alerts
	function alerts()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();		
		$this->load->model('alerts');
		$alerts = $this->alerts->getNewAndActiveAlerts();
		$p = array('alerts'=>$alerts, 'user'=>$userInfo);		
		$content = $this->load->view('hcdec_alerts', $p, true);
		$b = array('content'=>$content);
		$this->load->view('public_template', $b);
	}
	
	# note - these need to go into the admin controller
	function addalert()
	{
		$userInfo = $_SESSION['user'];
		if(null == $userInfo)
		{
			redirect('/hcdec/index');
			exit(0);
		}

		if(!in_array('manage_alerts', $userInfo['roles']))
		{
			redirect('/hcdec/index');
			exit(0);
		}
		
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
		$this->load->model('alerts');
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$alert = $this->alerts->emptyAlert();
			$form_params = array('page'=>'addalert', 
				'button' => 'Add',
				'alert'=>$alert, 
				'action'=>'/hcdec/addalert');
			$content = $this->load->view('hcdec_alert_form', $form_params, true);
			$p = array('user'=>$userInfo, 'content'=>$content);
			$this->load->view('public_template', $p);
		}
		else
		{
			$r = $this->alerts->addAlert( $_POST );
			if($r['status'] == 'OK')
				redirect('/hcdec/alerts');
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
						'action'=>'/hcdec/addalert'
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
		$userInfo = $_SESSION['user'];
		if(null == $userInfo)
		{
			redirect('/hcdec/index');
			exit(0);
		}

		if(!in_array('manage_alerts', $userInfo['roles']))
		{
			redirect('/hcdec/index');
			exit(0);
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$id = -1;
			$arr = $this->uri->segment_array();
			if(isset($arr[3])) $id = $arr[3];
			$this->load->model('alerts');
			$r = $this->alerts->getAlertForId($id);
			if($r['status'] == 'OK')
			{
				if(!isset($r['errors'])) $r['errors'] = array();
				$form_params = array(
						'page'=>'editalert', 
						'id'=>$id,
						'button' => 'Apply',
						'errors'=>$r['errors'],
						'alert'=>$r['rows'][0],
						'action'=>'/hcdec/editalert'
				);
				$content = $this->load->view('hcdec_alert_form', $form_params, true);
				$p = array('user'=>$userInfo, 'content'=>$content);
				$this->load->view('public_template', $p);
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
				redirect('/hcdec/alerts');
		}
	}
	
	function deletealert()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		# if user is not logged in, redirect w/message
		# if user is logged in but does not have role, redirect w/message
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			# display confirmation page
		}
		else
		{
			# delete alert and redirect to /home/alerts
		}
	}

# newsletter articles
	function articles()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
	}
	
	function viewarticle()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		
	}
	
	# available to all members
	function submitarticle()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			
		}	
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
		}	
	}
	
	# only available to users with "edit_newsletter" role
	function reviewarticle()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			
		}	
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
		}	
	}
	
	function submitevent()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$this->load->model('events');
			$event = $this->events->emptyEvent();
			$content = $this->load->view('submit_event', array('user'=>$userInfo,'event'=>$event), true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);			
		}	
		else
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('events');
			$_POST['status'] = 
			$results = $this->events->addUpcomingEvent( $_POST );
			if($results['status']=='OK')
			{
				redirect('/hcdec/myhcdec');
			}
			else
			{
				$errors = $results['errors'];
				$content = $this->load->view('submit_event', array('user'=>$userInfo,'event'=>$event, 'errors'=>$errors), true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);			
			}
		}	
	}
	
	function kennedykingdinner()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		$content = $this->load->view('hcdec_kkdinner_main', array('user'=>$userInfo), true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);			
	}
	
	function tickets()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		$content = $this->load->view('hcdec_kkdinner_tickets', array('user'=>$userInfo), true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);			
	}
	
	function sponsorships()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		$selections = array('ticketHolderName'=>'', 'ticketHolderEmail'=>'', 'ticketHolderPhone'=>'');
		$content = $this->load->view('hcdec_kkdinner_sponsorship', array('user'=>$userInfo, 'selections'=>$selections), true);
		$p = array('content'=>$content, 'user'=>$userInfo);
		$this->load->view('public_template.php', $p);			
	}
	
	function kennedykingcheckout()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if("POST" == $_SERVER['REQUEST_METHOD'])
		{
			#1 capture the vars from the form
			#2 duplicate sponsorship page but with the list of things they bought
			#  plus the total they'll need to pay, plus the "donate" button
			$errors = array();
			
			if( !isset($_POST['ticketHolderName']) || empty($_POST['ticketHolderName']))
			{
				$errors['ticketHolderName'][] = 'Name is required.';
			}
			
			if( !isset($_POST['ticketHolderEmail']) || empty($_POST['ticketHolderEmail']))
			{
				$errors['ticketHolderEmail'][] = 'Email is required.';
			}
			
			if( !isset($_POST['ticketHolderPhone']) || empty($_POST['ticketHolderPhone']))
			{
				$errors['ticketHolderPhone'][] = 'Phone is required.';
			}
			
			if(count($errors)>0)
			{
				$content = $this->load->view('hcdec_kkdinner_sponsorship', 
					array('user'=>$userInfo, 'selections'=>$_POST, 'errors'=>$errors), true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);
			}
			else
			{
				$content = $this->load->view('hcdec_kennedykingcheckout', array('user'=>$userInfo, 'selections'=>$_POST), true);
				$p = array('content'=>$content, 'user'=>$userInfo);
				$this->load->view('public_template.php', $p);
			}
		}			
	}
	
	function kkdinnerpaybycheck()
	{
		if(isset($_SESSION['user'])) $userInfo = $_SESSION['user'];
		else $userInfo = array();
		if('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$content = $this->load->view('hcdec_kennedyking_paybychk', array('user'=>$userInfo, 'selections'=>$_POST), true);
			$p = array('content'=>$content, 'user'=>$userInfo);
			$this->load->view('public_template.php', $p);
		}
	}
}

/* End of file hcdec.php */
/* Location: ./system/application/controllers/hcdec.php */