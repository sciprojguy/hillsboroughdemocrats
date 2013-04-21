<!--

The member page will have some general membership stuff in it:

	* date/time of next general meeting
	* link to precinct committeeperson materials
	* notes of interest to all members
	
as well as a login form in the upper right.  Once the member is logged
in, this page will contain all of the above plus things specific to the
logged-in member:

	* HCDEC to-do's (committee action items, requests for this and that,
		etc.)
	* list of upcoming calendar events (next general meeting, next cmte
		meeting, etc.)
 -->
<?php
	$username = "";
?>
<tr>
	<td colspan=2>
	<table border=0 cellpadding=4 align=center width="100%">
	<tr>
	<td width="100%">
	<div style='font-family:Helvetica;font-size:12pt;color:white'>
		Introductory copy for member page goes here.  May include info on how to become a DEC member and what's expected of you.
	</div>
	</td>
	</tr>
	<tr>
	<td width="100%">
		<div style='width:150px;margin:0px auto;font-family:Helvetica;font-size:12pt;color:white'>
		<form method=POST action="/home/login">
			Username:<br>
			<input type=text name=username value="<?php echo $username ?>"><p/>
			Password:<br>
			<input type=password name=password><p/>
			<input type=submit value="Log In">
		</form>
		</div>
	</td>
	</tr>
	</table>
	</td>
</tr>