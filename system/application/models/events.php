<?php

/****************************************************************
 * Since Google calendar is to be used as the main event store,
 * we maintain a list of submitted events - a holding pond.  Once
 * a submitted event is approved, it is added to the Google 
 * calendar for public consumption and syncing with smartphones.
 ****************************************************************/

class Events extends Model {

	function Events()
	{
		parent::Model();
	}

	function emptyEvent()
	{
		return array(
			'type'=>'',
			'date'=>'',
			'startTime'=>'',
			'endTime'=>'',
			'title'=>'',
			'description'=>'',
			'location'=>'',
			'author'=>'',
			'status'=>'',
			'contact'=>'',
			'contact_phone'=>'',
			'contact_email'=>'',
			'contact_url'=>'',
			'type'=>'',
			'tags'=>'',
			'status'=>'new',
			'status_dt'=>'',
			'notes'=>''
		);
	}
	
	function validateEvent( $event )
	{
		# a number of required fields here
		$errors = array();
		if(!isset($event['date']) || empty($event['date']))
			$errors['date'][] = 'Event must have a date';
		if(!isset($event['startTime']) || empty($event['startTime']))
			$errors['startTime'][] = 'Event must have a start time';
		if(!isset($event['endTime']) || empty($event['endTime']))
			$errors['endTime'][] = 'Event must have an end time';
		if(!isset($event['title']) || empty($event['title']))
			$errors['title'][] = 'Event must have a title';
		if(!isset($event['location']) || empty($event['location']))
			$errors['location'][] = 'Event must have a location';
		if(!isset($event['contact']) || empty($event['contact']))
			$errors['contact'][] = 'Event must have a contact person';
		if(!isset($event['contact_phone']) || empty($event['contact_phone']))
			$errors['contact_phone'][] = 'Event must have a contact phone#';
			
		return $errors;
	}
	
/*
# --- methods used for handling Google calendar.

	# pulls in the calendar feed in XML / RSS format.  we should cache
	# these just in case the calendar goes offline for some reasons...
	# from this we need.
	#
	# $events[$n]['title']
	# $events[$n]['description']
	# $events[$n]['location']
	# $events[$n]['startDate'] - this plus next three are parsed from startTime and
	# $events[$n]['endDate']		endTime from feed
	# $events[$n]['startTime']
	# $events[$n]['endTime']
	
	function getEventsFromGoogleCalendar()
	{
		$json = file_get_contents('https://www.google.com/calendar/feeds/hillsboroughcountydemocrats%40gmail.com/private-320a0c6100d42da771a10077853ad6aa/full?alt=json');
		$decoded = json_decode($json,true);
		$events = array();		
		foreach($decoded['feed']['entry'] as $entry)
		{
			$startDateTime = $entry['gd$when'][0]['startTime'];
			$endDateTime = $entry['gd$when'][0]['endTime'];
			
			$startDate = substr($startDateTime, 0, 10);
			$startTime = substr($startDateTime, 11);
			
			$endDate = substr($endDateTime, 0, 10);
			$endTime = substr($endDateTime, 11);
			
			#FIXME need to convert start and end time to local time.
			
			$title = $entry['title']['$t']; echo "<p>";
			$location = $entry['gd$where'][0]['valueString'];
			$description = $entry['content']['$t']; 
			
			$event = array( 'startDate'=>$startDate, 'endDate'=>$endDate, 'startTime'=>$startTime, 'endTime'=>$endTime,
					'title'=>$title, 'location'=>$location, 'description'=>$description );
			
			$events[$startDate][] = $event;
		}
		return $events;
	}
	
	function addEventToGoogleCalendar( $event )
	{
		
	}
	
	function removeEventFromGoogleCalendar( $eventid )
	{
		
	}
	
	function updateEventInGoogleCalendar( $event, $eventid )
	{
		
	}
*/
		
	function getAllCalendarEvents()
	{
		$results = array();
		$this->db->select('id, title, date, startTime, endTime, location, tags, status');
		$this->db->order_by('date desc, startTime desc');
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getCalendarEventsWithStatus($status)
	{
		$results = array();
		$this->db->select('id, title, date, startTime, endTime');
		$this->db->where("status = '$status'");
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getSubmittedEvents()
	{
		return getCalendarEventsWithStatus('submitted');
	}
	
	function getApprovedEvents()
	{
		return getCalendarEventsWithStatus('approved');
	}
	
	function getEventsWithStatusBetween( $status, $date1, $date2 )
	{
		$this->db->where("status = '$status' AND date >= '$date1' AND date <= '$date2'");
		$this->db->select(array('id','date','startTime','title'));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}	
	
	function getEventsWithStatusForMonthAndYear( $status, $month, $year )
	{
		$results = array();
		$this->db->where("status = '$status' AND month(date) = '$month' AND year(date) = 'year'");
		$this->db->select(array('id','date','startTime','title'));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}	
	
	function getApprovedEventsForMonthAndYear($month, $year)
	{
		$results = array();
		$this->db->where("status = 'approved' AND month(date) = '$month' AND year(date) = '$year'");
		$this->db->order_by('date');
		$this->db->select(array('id','status', 'date','startTime','endTime','title','month(date) as month', 'day(date) as day'));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$rows = array();
			foreach($r->result_array() as $row)
			{
				$rows[$row['day']][] = $row;
			}
			$results['rows'] = $rows;
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getApprovedEventsForDate($date)
	{
		$results = array();
		$this->db->where("status = 'approved' AND date = '$date'");
		#TODO - parse out the AM/PM and prepend it onto the actual time so it can sort correctly
		$this->db->order_by('sortTime asc');
		$this->db->select(array('id','status', 'date','startTime','endTime','title','location', 'right(startTime,2)||startTime as sortTime'));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$rows = array();
			foreach($r->result_array() as $row)
			{
				$rows[] = $row;
			}
			$results['rows'] = $rows;
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	# this + next month wrapping around, idx by date []
	function getApprovedEventsForFrontPage($month, $year)
	{
		$nextMonth = $month+1;
		$nextYear = $year;
		if($nextMonth>12)
		{
			$nextYear++;
			$nextMonth = 1;
		}
		
		# now we have current date and next month date
		$curDate = date('Y-m-d');
 		$days_in_month = cal_days_in_month(0, $month, $year) ;
		$nextDate = sprintf("%04d-%02d-%02d", $nextYear, $nextMonth, $days_in_month);
		$results = array();
		$this->db->where("status = 'approved' AND date >= '$curDate' AND date <= '$nextDate'");
		$this->db->order_by('date, startTime');
		$this->db->select(array('id','status', 'date','startTime','endTime','title','dayname(date) as dayofweek','monthname(date) as moname', 'day(date) as dateday', 'year(date) as yr'));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$rows = array();
			foreach($r->result_array() as $row)
			{
				$date = $row['dayofweek'].", ".$row['date'];
				$rows[$date][] = $row;
			}
			$results['rows'] = $rows;
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function getApprovedEventsForUpcomingWeek( $month, $day, $year )
	{
		
	}
	
	function getEvent( $id )
	{
		$results = array();
		$this->db->where(array('id'=>$id));
		$r = $this->db->get('events');
		if($r)
		{
			$results['status'] = 'OK';
			$results['event'] = $r->row_array();
			$r->free_result();
		}
		else
		{
			$results['status'] = 'DB';
			$results['rows'] = array();
		}
		return $results;
	}
	
	function insertEvent( $event )
	{
		$results = array();
		$errors = $this->validateEvent($event);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
			return $results;
		}
		
		$event['status_dt'] = date('Y-m-d h:i:s');
		if(isset($event['tags']))
		{
			$eventTags = implode(',', $event['tags']);
			$event['tags'] = $eventTags;
		}
		
		$r = $this->db->insert('events', $event);
		if($r)
		{
			$results['status'] = 'OK';
		}
		else
		{
			$results['status'] = 'DB';
			#$results['message'] = $this->db->error_mesage();
		}
		
		return $results;
	}
	
	function updateEvent( $event, $id )
	{
		$results = array();
		$errors = $this->validateEvent($event);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}

		if(isset($event['tags']))
		{
			$eventTags = implode(',', $event['tags']);
			$event['tags'] = $eventTags;
		}
		
		$this->db->where("id = $id");
		$r = $this->db->update('events', $event );
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
	
	function deleteEventsWithIds($idsArray)
	{
		$results = array();
		$this->db->where_in('id', $idsArray);
		$this->db->delete('events');
		$results = array('status'=>'OK');
		return $results;
	}
	
	function getSubmittedEventsWithTags( $tagNameArray )
	{
	}	
}