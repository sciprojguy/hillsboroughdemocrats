<?php
// initiate new CALENDAR
$config = array( 'unique_id' => 'www.hillsboroughcountydemocrats.org' );
$v = new vcalendar( $config );

$e = & $v->newComponent( 'vevent' );           // initiate a new EVENT

# for categories, string together the tags the event belongs to
#$e->setProperty( 'categories', 'FAMILY' );                   // catagorize

# take the event date and extract year, month, day, hr24, min, sec = 0
sscanf($event['date'], "%d-%d-%d", &$yr, &$mo, &$dy);
sscanf($event['startTime'], "%d:%d %s", &$shh, &$smm, &$sampm);
if(strtolower($sampm)=='pm')
	$shh += 12;
sscanf($event['endTime'], "%d:%d %s", &$ehh, &$emm, &$eampm);
if(strtolower($eampm)=='pm')
	$ehh += 12;
#echo "<pre>";
#var_dump($event);
#var_dump($shh);
#var_dump($smm);
##var_dump($sampm);
#var_dump($ehh);
#var_dump($emm);
#var_dump($eampm);
#echo "</pre>";
#exit(0);
# since the time and date are stored as hh;mm am/pm need to parse it that way
$e->setProperty( 'dtstart', $yr, $mo, $dy, $shh, $smm, 00 );  // 24 dec 2006 19.30
$e->setProperty( 'dtend', $yr, $mo, $dy, $ehh, $emm, 00 );

#$e->setProperty( 'duration', 0, 0, 3 );                    // 3 hours

$e->setProperty( 'description', $event['description'] );    // describe the event
$e->setProperty( 'location', $event['location'] );                     // locate the event

$v->returnCalendar();
