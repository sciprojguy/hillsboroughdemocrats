<?php
class Calendar extends Model {

	function Calendar()
	{
		parent::Model();
		require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
	}

	function clientLogin( $username, $password )
	{
		$username = 'username';
		$password = 'password';
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; 
		$token = Zend_Gdata_ClientLogin::getHttpClient($username,$password,$service);
		return $token;
	}

	function listCalendars($token)
	{
		$gdataCal = new Zend_Gdata_Calendar($token);
		$calFeed = $gdataCal->getCalendarListFeed();
		return $calFeed;
	}
	
	function listEvents($token)
	{
		$gdataCal = new Zend_Gdata_Calendar($token);
		$eventFeed = $gdataCal->getCalendarEventFeed();		
		return $eventFeed;
	}
	
	function listEventsInRange($token, $startDate, $endDate)
	{
		$gdataCal = new Zend_Gdata_Calendar($token);
		$query = $gdataCal->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		$query->setStartMin($startDate);
		$query->setStartMax($endDate);
		$eventFeed = $gdataCal->getCalendarEventFeed($query);
		return $eventFeed;
	}
	
	# can use this to search for tags?  need to have a structured
	# event description for that, or at least [tags: x, y, z]
	# always added.
	
	function listEventsFullTextQuery($token, $text)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$query = $gdataCal->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setQuery($text);
		$eventFeed = $gdataCal->getCalendarEventFeed($query);
		return $eventFeed;
	}
	
    /**
     * Create an event
     * @param String $client Access token
     * @param Associative Array $eventArray
     *                          'desc'      =>  'This is a description for the event',
								'where'     =>  'Location',
								'startDate' =>  'YYYY-MM-DD',
								'startTime' =>  'HH:MM', // 24hr time
								'endDate'   =>  'YYYY-MM-DD',
								'endTime'   =>  'HH:MM', // 24hr time
								'tzOffset'  =>  '00' // timezone offset from GMT
     * @return String - ID of created event
     */
	function createEvent($client, $eventArray){
		$gdataCal = new Zend_Gdata_Calendar($client);
		$newEvent = $gdataCal->newEventEntry();
		
		$newEvent->title = $gdataCal->newTitle($eventArray['title']);
		$newEvent->where = array($gdataCal->newWhere($eventArray['where']));
		$newEvent->content = $gdataCal->newContent($eventArray['desc']);
		
		$when = $gdataCal->newWhen();
		$when->startTime = "{$eventArray['startDate']}T{$eventArray['startTime']}:00.000{$eventArray['tzOffset']}:00";
		$when->endTime = "{$eventArray['endDate']}T{$eventArray['endTime']}:00.000{$eventArray['tzOffset']}:00";
		$newEvent->when = array($when);
		
		//upload the even to the calendar server
		//a copy of the event as it is recorded on the server is returned
		$createdEvent = $gdataCal->insertEvent($newEvent);
		return $createdEvent->id->text;
	}
	
}
