/*
myTimePicker

width:200px;
height:300px;

+-----------------------------------+
| select time                   [x] |
+-----------------------------------+
|  1:00  1:15  1:30  1:45 | AM | PM |
|  2:00  2:15  2:30  2:45 |         |
|  3:00  3:15  3:30  3:45 |         |
|  4:00  4:15  4:30  4:45 |         |
|  5:00  5:15  5:30  5:45 |         |
|  6:00  6:15  6:30  6:45 |         |
|  7:00  7:15  7:30  7:45 |         |
|  8:00  8:15  8:30  8:45 |         |
|  9:00  9:15  9:30  9:45 |         |
| 10:00 10:15 10:30 10:45 |         |
| 11:00 11:15 11:30 11:45 |         |
| 12:00 12:15 12:30 12:45 |         |
+-----------------------------------+
*/

function leftPadWithSpace(n)
{
	if(n<10)
		return ' '+n;
	else
		return ''+n;
}

function leftPadWithZero(n)
{
	if(n<10)
		return '0'+n;
	else
		return ''+n;
}

function setTime(elementId,time)
{
	
}

function formatTime(hr,mn)
{
	return leftPadWithSpace(hr) + ':' + leftPadWithZero(mn);
}

function makeTimePicker(elementId)
{
	// input element
	var element = document.getElementById(elementId);
	var initialTime = element.value;
	
	var innerHTML = '<table border=1>';
	innerHTML = innerHTML + '<tr>';
	innerHTML = innerHTML + '<td>' + '' + '</td>';
	for( int hr=1; hr <= 12; hr++ )
	{
		innerHTML = innerHTML + '<tr>';
		for( int mn=0; mn<60; mn+=15 )
		{
			timeSlotLink = '<div onclick="setTime("'+elementId+'");">'+formatTime(hr,mn)+'</div>';
		}
		innerHTML = innerHTML + '</tr>';
	}	
}

function showTimePicker(elementId)
{
}

function hideTimePicker(elementId)
{
}