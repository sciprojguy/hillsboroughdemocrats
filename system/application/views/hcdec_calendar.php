<div class='calendarBox'>
<script type='text/javascript'>
function loadMonth() {
	var moField = document.getElementById('month');
	var yrField = document.getElementById('year');
	console.log(moField);
	console.log(yrField);
	document.location = '/hcdec/calendar/month/'+moField.value+'/year/'+yrField.value;
}
</script>
<?php

# TODO
# add forward/backward links, and make month and year popups
 $this->load->helper('form');
 $cellWidth = 1020/7;
 $first_day = mktime(0,0,0,$month, 1, $year) ; 
 $title = date('F', $first_day) ;

 $months = array( 1=>"January", 2=>"February", 3=>"March", 4=>"April", 5=>"May", 
 	6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October", 11=>"November", 12=>"December");
 $years = array(2012=>2012,2013=>2013,2014=>2014);
 
 $month_popup = form_dropdown('month',$months, $month, "id='month' class='formMenu' onchange='loadMonth();'");
 $year_popup = form_dropdown('year',$years, $year, "id='year' class='formMenu' onchange='loadMonth();'");
 
 $day_of_week = date('D', $first_day) ; 
 switch($day_of_week){ 
	case "Sun": $blank = 0; break; 
 	case "Mon": $blank = 1; break; 
	case "Tue": $blank = 2; break; 
	case "Wed": $blank = 3; break; 
	case "Thu": $blank = 4; break; 
	case "Fri": $blank = 5; break; 
	case "Sat": $blank = 6; break; 
 }
 
 $todays_day = date('d');
 $todays_month = date('m');
 $todays_year = date('Y');
 
 $days_in_month = cal_days_in_month(0, $month, $year) ;
  
 echo "<table border=0 width=100% height=100% cellpadding=0 cellspacing=0>";
 echo "<tr>
 	<td colspan=7>
 	<div style='font-family:Helvetica,Arial,Sans-serif;font-weight:bold;text-align:center'>
 		$month_popup $year_popup
 	</div> 
 	</td>
 </tr>";
 echo "<tr>
 	<td width=$cellWidth align=center>Sun</td>
 	<td width=$cellWidth align=center>Mon</td>
 	<td width=$cellWidth align=center>Tue</td>
 	<td width=$cellWidth align=center>Wed</td>
 	<td width=$cellWidth align=center>Thu</td>
 	<td width=$cellWidth align=center>Fri</td>
 	<td width=$cellWidth align=center>Sat</td>
 	</tr>";
 $day_count = 1;
 echo "<tr>";
 while ( $blank > 0 ) 
 { 
 	echo "<td width=$cellWidth height=80>
 		<div style='border:1px solid lightgray;width:$cellWidth; height:100%;'></div>
 	</td>"; 
 	$blank = $blank-1; 
 	$day_count++;
 }
  
 //sets the first day of the month to 1 
 $day_num = 1;
 
 //count up the days, untill we've done all of them in the month
 while ( $day_num <= $days_in_month ) 
 {
 	// get $events[$day_num] -> formatted for calendar day
 	// we can also add "special days" like MLK day 
 	if($day_num == $todays_day && $month == $todays_month && $year == $todays_year )
 		$background_color = '#daecf9';
 	else
 		$background_color = 'white';
 		
 	$daysDate = sprintf("%04d-%02d-%02d", $year, $month, $day_num);
 	if(isset($events[$day_num]) && count($events[$day_num])>0)
 	{
 		$day_num_for_display = "<a href=\"/hcdec/daysevents/date/$daysDate\">$day_num</a>";
 	}
 	else
 	{
 		$day_num_for_display = $day_num;
 	}
 	
	echo "<td width=$cellWidth height=100 valign=top>
	<div style='background-color:$background_color;border:1px solid lightgray;width:$cellWidth;height:100%;'>
	<div style='width:100%;font-family:Helvetica,Arial,Sans-serif;text-align:right;padding-right:15px;'>
		$day_num_for_display &nbsp;
	</div>";
	echo "<div style='height:1px;background-color:lightgray;width:90%;margin-left:auto;margin-right:auto'> </div>";
	echo "<div style='height:92px;width:100%;overflow:auto;'>";
 	if(isset($events[$day_num]))
 	{
 		foreach($events[$day_num] as $event)
 		{
 			echo "<div style='font-family:Helvetica,Arial,Sans-serif;font-size:8pt;padding-left:2px;'>{$event['title']}</div>";
 		}
 	}
 	echo "</div>";
 	
	echo "</div>";
	echo "</td>"; 
	$day_num++; 
 	$day_count++;

	//Make sure we start a new row every week

	if ($day_count > 7)
	{
		echo "</tr><tr>";
		$day_count = 1;
 	}

 }
  
	while ( $day_count >1 && $day_count <=7 ) 
	{ 
		echo "<td width=130 height=90 align=right valign=top> </td>"; 
		$day_count++; 
	} 

echo "</tr></table>"

?>
 </div>