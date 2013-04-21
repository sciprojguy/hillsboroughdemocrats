<div class="contentBox">
<div style='float:right;margin-right:12px'>
<img src="/images/kkBannerSmallerStill.jpg">
</div>
<div style='font-family:Helvetica,Arial,Sans-serif;font-size:14pt'>
<strong>Your Selection</strong> 
</div>
<p/>
<?php
$emailText = "";
echo $selections['ticketHolderName']."<br>";
echo $selections['ticketHolderEmail']."<br>";
echo $selections['ticketHolderPhone']."<p/>";
if(isset($selections['sponsorship']))
{
	$items = array();
	$itemqty = array();
	$itemprice = array();
	$itemttl = array();
	$sponsorship = $selections["sponsorship"];
	switch($sponsorship)
	{
		case "dinner_tickets":
			$qty = $selections['qty_dinner_tickets'];
			
			$itemqty[] = $qty;
			$itemprice[] = "\$125.00";
			$itemttl[] = $qty * 125.00;
			$items[] = "Dinner Tickets";
			
			break;
			
		case "dinner_and_reception":
			
			$qty = $selections['qty_dinner__reception_tickets'];
			
			$itemqty[] = $qty;
			$itemprice[] = "\$250.00";
			$itemttl[] = $qty * 250.00;
			$items[] = "Dinner and Reception Tickets";
			break;
			
		case "community_leader":
			$qty = $selections['qty_reception_tickets_1'];
			
			$itemqty[] = 1;
			$itemprice[] = "\$1000.00";
			$itemttl[] = 1000.0;
			$items[] = "Community Leader / Club Sponsor Sponsorship";
			
			$itemqty[] =  $qty * 125.00;
			$itemprice[] = "\$125.00";
			$itemttl[] = $qty * 125.00;
			$items[] = "Chairman's Reception Tickets";
			
			break;
			
		case "candidates_officials":
			$qty = $selections['qty_reception_tickets_2'];
			
			$itemqty[] = 1;
			$itemprice[] = "\$1,250.00";
			$itemttl[] = 1250.0;
			$items[] = "Candidate/Elected Official Sponsorship";
			
			$itemqty[] =  $qty * 125.00;
			$itemprice[] = "\$125.00";
			$itemttl[] = $qty * 125.00;
			$items[] = "Chairman's Reception Tickets";
						
			break;
			
		case "party_organizer":
			$qty = $selections['qty_reception_tickets_3'];
			
			$itemqty[] = 1;
			$itemprice[] = "\$2,500.00";
			$itemttl[] = 2500.0;
			$items[] = "Party Organizer Sponsorship";
			
			$itemqty[] =  $qty * 125.00;
			$itemprice[] = "\$125.00";
			$itemttl[] = $qty * 125.00;
			$items[] = "Chairman's Reception Tickets";
						
			break;
			
		case "party_leader":
			$itemqty[] = 1;
			$itemprice[] = "\$5,000.00";
			$itemttl[] = 5000.0;
			$items[] = "Party Leader Sponsorship";
			break;
			
		case "keynote_sponsor":
			$itemqty[] = 1;
			$itemprice[] = "\$10,000.00";
			$itemttl[] = 10000.0;
			$items[] = "Keynote Sponsorship";
			break;
	}
	
	# now print out the price and a join() bullet list of the items.
	$priceTotal = 0.0;
	$emailText = "\"{$selections['ticketHolderName']}\" sponsorship reservation:\n\n";
	$emailText .= "\"Email: {$selections['ticketHolderEmail']}\" \n\n";
	$emailText .= "\"Phone: {$selections['ticketHolderPhone']}\" \n\n";
	echo "Your selections:<br>";
	echo "<table border=0 cellpadding=4 cellspacing=0 width=500px>";
	for( $i=0; $i<count($items); $i++ )
	{
		#note - if $itemqty[$i] is 0, don't print this line.  duh.
		if($itemqty[$i]>0)
		{
			echo "<tr>";
			echo "<td>{$items[$i]}</td>";
			echo "<td align=right>{$itemqty[$i]} @ {$itemprice[$i]} = \${$itemttl[$i]}</td>";
			echo "<tr>";
			$emailText .= "* {$items[$i]}, {$itemqty[$i]} @ {$itemprice[$i]} = \${$itemttl[$i]}\n";
			$priceTotal += $itemttl[$i];
		}
	}
	$emailText .= "Total: \$$priceTotal";
	
	$ok = mail('cappyflorida@yahoo.com', "KK dinner", $emailText);
	$ok = mail('kkos1423@gmail.com', "KK dinner", $emailText);
	$ok = mail('sciprojguy@gmail.com', "KK dinner", $emailText);
	$ok = mail('jesse@hillsdems.org', "KK dinner", $emailText);

	echo "<tr><td>Total</td><td align=right>\$$priceTotal</td></tr>";
	echo "</table>";
	echo "<p/>";
	echo "If you are paying by credit card, please click or tap (if you are on a phone or tablet) on the \"Pay by credit card\" button and enter the total amount displayed above.  You may also 
	want to print out this page for your records.";
	echo "<p/>If you are paying by check, please click or tap (if you are on a phone or tablet) on the \"Pay by check\" button.";
	echo "<div style='width:399px;margin-left:auto;margin-right:auto'>
			<form action=\"https://Simplecheckout.authorize.net/payment/CatalogPayment.aspx\" 
				method=\"post\" name=\"form1\" target=\"_blank\">
			  <input type=\"hidden\" name =\"LinkId\" value =\"dd7e22ac-1d8a-4b17-9340-12f3a0050027\" />
			  <input type=\"submit\" name=\"imageField\" value=\" Pay by credit card \" id=\"imageField\" style='width:149px'>
			</form>
			<p/>
			<form action=\"/hcdec/kkdinnerpaybycheck\" method=post>
				<input type=hidden name=ticketHolderInvoiceTotal value=\"$priceTotal\">
				<input type=hidden name=ticketHolderName value=\"{$selections['ticketHolderName']}\">
				<input type=hidden name=ticketHolderEmail value=\"{$selections['ticketHolderEmail']}\">
				<input type=hidden name=ticketHolderPhone value=\"{$selections['ticketHolderPhone']}\">
				<input type=\"submit\" value=\" Pay by check \" style='width:149px'>
			</form>
		</div>";
}
else
{
	echo "You went to the checkout without selecting a sponsorship.  Please go back and select a sponsorship and try again.";
} 
?>
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
