<div class="contentBox">
<div style='float:right;margin-right:12px'>
<img src="/images/kkBannerSmallerStill.jpg">
</div>
<div style='font-family:Helvetica,Arial,Sans-serif;font-size:14pt'>
<strong>Tickets & Sponsorships</strong> 
</div>
<p/>
<form method=post action="/hcdec/kennedykingcheckout">
Contact Information <em>(all fields required)</em><p/>
<div style='font-family:Helvetica,Arial,Sans-serif;font-size:12pt'>
<?php
if(isset($errors['ticketHolderName']))
{
	$errs = join('*', $errors['ticketHolderName']);
	echo "<div style='color:red'>$errs</div>";
} 
?>
Your name:<br>
<input type=text name=ticketHolderName size=64 value="<?= $selections['ticketHolderName'] ?>"><p/>
<?php
if(isset($errors['ticketHolderEmail']))
{
	$errs = join('*', $errors['ticketHolderEmail']);
	echo "<div style='color:red'>$errs</div>";
} 
?>
Your email address:<br>
<input type=text name=ticketHolderEmail size=80 value="<?= $selections['ticketHolderEmail'] ?>"><p/>
<?php
if(isset($errors['ticketHolderPhone']))
{
	$errs = join('*', $errors['ticketHolderPhone']);
	echo "<div style='color:red'>$errs</div>";
} 
?>
Your phone #<br>
<input type=text name=ticketHolderPhone size=16 value="<?= $selections['ticketHolderPhone'] ?>"><p/>

<input type=radio name="sponsorship" value="dinner_tickets"> <strong>Tickets to dinner</strong> - <em>$125</em>
<br>&nbsp;&nbsp;How many?&nbsp;&nbsp;<input type=text name="qty_dinner_tickets" size=4 value="0">
<p/>
<input type=radio name="sponsorship" value="dinner_and_reception"> <strong>Ticket to Dinner and Chairman's Reception</strong> - <em>$250.00</em><br>
<br>&nbsp;&nbsp;How many?&nbsp;&nbsp;<input type=text name="qty_dinner__reception_tickets" size=4 value="0"> 
(includes open bar, hors d'ouevres and a photo opportunity with featured speaker)<p/>

<input type=radio name="sponsorship" value="community_leader"> <strong>Community Leader / Club Sponsor</strong> - <em>$1,000</em><br>
10 dinner tickets (Table),
2 Speaker's Reception tickets,
photo opportunity with featured speaker, 
preferred seating<br>
additional tickets to chairman's reception are available for <em>$125</em><br>&nbsp;&nbsp;How many?&nbsp;&nbsp;<input type=text name="qty_reception_tickets_1" size=4 value="0">
<p/>
<input type=radio name="sponsorship" value="candidates_officials"> <strong>Candidate/Elected Officials</strong> - <em>$1,250</em>
<br>
10 tickets to dinner, 
2 chairman's reception tickets, 
photo opportunity with featured speaker, 
recognition from podium during program,  
preferred seating,
logo on screen during dinner<br>
additional tickets to chairman's reception are available for <em>$125</em>
<br>&nbsp;&nbsp;How many?&nbsp;&nbsp;<input type=text name="qty_reception_tickets_2" size=4 value="0">
<p/>
<input type=radio name="sponsorship" value="party_organizer"> <strong>Party Organizer</strong> - <em>$2,500</em><br>
10 tickets to dinner, 
6 chairman's reception tickets,  
photo opportunity with featured speaker, 
recognition from podium during program, 
priority seating, 
inclusion of logo on screen during dinner<br> 
additional tickets to chairman's reception are available for <em>$125</em>
<br>&nbsp;&nbsp;How many?&nbsp;&nbsp;<input type=text name="qty_reception_tickets_3" size=4 value="0">
<p/>
<input type=radio name="sponsorship" value="party_leader"> <strong>Party Leader</strong> - <em>$5,000</em><br>
10 tickets to dinner, 
10 chairman's reception tickets,  
photo opportunity with featured speaker, 
recognition from podium during program, 
premium seating, 
inclusion of logo on screen during dinner,  
inclusion of logo on website
<p/>
<input type=radio name="sponsorship" value="keynote_sponsor"> <strong>Keynote Sponsor (only one available)</strong> - <em>$10,000</em><br>
20 tickets to dinner, 
20 chairman's reception tickets,  
photo opportunity with featured speaker, 
recognition from podium during program, 
premium seating, 
inclusion of logo on screen during dinner,  
chairman's reception will named on after donor<p/>
<input type=submit style='font-size:14pt;font-weight:bold;' value=" Reserve your tickets & Sponsorship ">
</form>
<p/>
Tickets purchased by September 18 will be mailed. Thereafter, tickets will be available at the Will Call table the night of the event. Seating will be assigned based on the order in which the reservation was received.<br>
Tickets are available by reservation only.
<p/>

To learn more about sponsorship opportunities, print deadlines and ad specifications please contact:<br> 
Jesse Meadow at jesse@hillsdems.org
<p/>




<span style='font-family:Helvetica,Arial,Sans-serif;font-size:11pt'>
<em>Paid for by the Hillsborough County Democratic Party and not authorized by any federal candidate or candidate's committee. Corporate contributions accepted. Contributions are not tax deductible for federal or state income tax purposes.</em>
</span>
</div>

<p/>
</div>
