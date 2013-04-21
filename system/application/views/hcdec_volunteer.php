<?php
	$this->load->helper('form');

	# name/street/precinct/contact info
	$nameField = form_input( array(
		'id'=>'name',
		'name'=>'name',
		'size'=>50,
		'value'=>$volunteer['name']
	) );

	$streetField = form_input( array(
		'id'=>'street',
		'name'=>'street',
		'size'=>50,
		'value'=>$volunteer['street']
	) );
	
	$cityField = form_input( array(
		'id'=>'city',
		'name'=>'city',
		'size'=>40,
		'value'=>$volunteer['city']
	) );
	
	$zipField = form_input( array(
		'id'=>'zip',
		'name'=>'zip',
		'size'=>10,
		'value'=>$volunteer['zip']
	) );
	
	$phoneField = form_input( array(
		'id'=>'phone',
		'name'=>'phone',
		'size'=>16,
		'value'=>$volunteer['phone']
	) );

	$emailField = form_input( array(
		'id'=>'email',
		'name'=>'email',
		'size'=>60,
		'value'=>$volunteer['email']
	) );
	
	$precinctField = form_input( array(
		'id'=>'precinct',
		'name'=>'precinct',
		'size'=>4,
		'value'=>$volunteer['precinct']
	) );
	
	$contact_methods = array(
		'phone'=>'Phone',
		'email'=>'Email',
		'mail'=>'Mail'
	);
	
	$bestMethodField = form_dropdown('best_contact_method', $contact_methods, $volunteer['best_contact_method']);

	$bestDatesField = form_input( array(
		'id'=>'best_time_and_days',
		'name'=>'best_time_and_days',
		'size'=>60,
		'value'=>$volunteer['best_time_and_days']
	) );
	
	# history info
	$yesNo = array('Y'=>'Yes', 'N'=>'No');
	
	# yes/no items
	$registeredDemField = "Are you a registered Democrat residing in Hillsborough County? ".form_dropdown('registered_dem_hillsborough', $yesNo, $volunteer['registered_dem_hillsborough']);
	$decMemberField = "Are you a member of the Hillsborough DEC? ".form_dropdown('member_of_hillsborough_dec', $yesNo, $volunteer['member_of_hillsborough_dec']);
	$decVolunteerField = "Have you volunteered with the Hillsborough DEC before? ".form_dropdown('volunteered_with_hillsborough_dec', $yesNo, $volunteer['volunteered_with_hillsborough_dec']);
	$otherVolunteerField = "Have you volunteered with other organizations before? ".form_dropdown('volunteered_other_orgs', $yesNo, $volunteer['volunteered_other_orgs']);

	#
	$whichOnesField = "If yes, which ones?".form_input( array(
		'id'=>'which_ones',
		'name'=>'which_ones',
		'size'=>80,
		'value'=>$volunteer['which_ones']
	) );
	
	# volunteer job checkboxes
	$cbPhoneBanking = form_checkbox('phone_banking', 'Y', isset($volunteer['phone_banking']))."Phone Banking";	
	$cbRecruitment = form_checkbox('vol_recruitment', 'Y', isset($volunteer['vol_recruitment']))."Volunteer Recruitment";	
	$cbScheduling = form_checkbox('vol_scheduling', 'Y', isset($volunteer['vol_scheduling']))."Volunteer Scheduling";	
	$cbDataEntry = form_checkbox('data_entry', 'Y', isset($volunteer['data_entry']))."Data Entry";	
	$cbFundraising = form_checkbox('fundraising_host', 'Y', isset($volunteer['fundraising_host']))."Fundraising Host";	
	$cbCanvassing = form_checkbox('canvassing', 'Y', isset($volunteer['canvassing']))."Canvassing";	
	$cbEvents = form_checkbox('event_coordinator', 'Y', isset($volunteer['event_coordinator']))."Event Coordinator";	
	$cbBoothVolunteer = form_checkbox('booth_volunteer', 'Y', isset($volunteer['booth_volunteer']))."Booth Volunteer";	
	$cbCandidateSupport = form_checkbox('candidate_support', 'Y', isset($volunteer['candidate_support']))."Candidate Support";	
	$cbPrecinctAssistance = form_checkbox('precinct_assistance', 'Y', isset($volunteer['precinct_assistance']))."Precinct Assistance";	
	$cbHighTrafficCanvassing = form_checkbox('high_traffic_canvassing', 'Y', isset($volunteer['high_traffic_canvassing']))."High Traffic Canvassing";	
	$cbNeighborhoods = form_checkbox('neighborhood_team_leader', 'Y', isset($volunteer['neighborhood_team_leader']))."Neighborhood Team Leader";	
	$cbWriteToOfficials = form_checkbox('write_to_elected_officials', 'Y', isset($volunteer['write_to_elected_officials']))."Write to Officials";	
	$cbOutreach = form_checkbox('community_outreach', 'Y', isset($volunteer['community_outreach']))."Community Outreach";	
	$cbOther = form_checkbox('other', 'Y', isset($volunteer['other']))."Other: ". form_input( array(
		'id'=>'other_what',
		'name'=>'other_what',
		'size'=>40,
		'value'=>$volunteer['other_what']
	) );
	
	# committee checkboxes
	$cbAffirmativeAction = form_checkbox('cmte_affirmative_action', 'Y', FALSE) . "Affirmative Action";	
	$cbCampaign = form_checkbox('cmte_campaign_precinct', 'Y', FALSE) . "Campaign & Precinct";	
	$cbByLaws = form_checkbox('cmte_bylaws', 'Y', FALSE) . "Bylaws";	
	$cbCredentials = form_checkbox('cmte_credentials', 'Y', FALSE) . "Credentials";	
	$cbMembership = form_checkbox('cmte_membership', 'Y', FALSE) . "Membership";	
	$cbFinance = form_checkbox('cmte_finance', 'Y', FALSE) . "Finance";	
	$cbLegislative = form_checkbox('cmte_legislative', 'Y', FALSE) . "Legislative Liaison";	
	$cbPlatform = form_checkbox('cmte_platform', 'Y', FALSE) . "Platform & Issues";	
	$cbPublicity = form_checkbox('cmte_publicity', 'Y', FALSE) . "PR & Publicity";	
	$cbIT = form_checkbox('cmte_it', 'Y', FALSE) . "Information Technology";	
	$cbLegal = form_checkbox('cmte_legal', 'Y', FALSE) . "Legal";	
	$cbLabor = form_checkbox('cmte_labor', 'Y', FALSE) . "Labor";	
	
 ?>
<form action="/hcdec/volunteer" method="post">
<div style='margin-left:40px;margin-right:40px;'>

	<div class="form">
	
	<div style='float:left;width:49%;'>
	<div style='padding-top:4px;padding-bottom:4px;background-color:#AAAAAA;text-align:center;font-weight:bold'>
	Contact Information:
	</div>	
	<div style='float:left;margin-right: 8px'>
		<?php
		if(isset($errors['name']))
			echo "<span style='color:red'>{$errors['name']}</span><br>";
		?>
		Name: <?= $nameField; ?>
	</div>
	<div style='float:left;margin-right: 8px'>
		<?php
		if(isset($errors['precinct']))
			echo "<span style='color:red'>{$errors['precinct']}</span><br>";
		?>
		Precinct: <?= $precinctField ?><br>	
	</div>
	
	<div style='clear:both;height:4px'></div>
	
	<div style='float:left;margin-right: 8px'>
		<?php
		if(isset($errors['street']))
			echo "<span style='color:red'>{$errors['street']}</span><br>";
		?>
		Address: <?= $streetField; ?><br>	
	</div>
	
	<div style='clear:both;height:4px'></div>
	
	<div style='float:left;margin-right: 8px'>
		<?php
		if(isset($errors['city']))
			echo "<span style='color:red'>{$errors['city']}</span><br>";
		?>
		City: <?= $cityField; ?>
	</div>
	<div style='float:left;margin-right: 8px'>
		Zip: <?= $zipField; ?><br>
	</div>
	
	<div style='clear:both;height:4px'></div>
		
	<div style='height:4px'></div>
	Best method to contact you: <?= $bestMethodField ?><br>
	<div style='height:4px'></div>
	<?php
	if(isset($errors['phone']))
			echo "<span style='color:red'>{$errors['phone']}</span><br>";
	?>
	Phone: <?= $phoneField; ?><br>
	<div style='height:4px'></div>
	<?php
	if(isset($errors['email']))
			echo "<span style='color:red'>{$errors['email']}</span><br>";
	?>
	Email: <?= $emailField; ?><br>
	<div style='height:4px'></div>
	Best days/times to contact you: <?= $bestDatesField ?><br>
	</div>
	
	<div style='float:right;height:100%;width:49%;padding-left:4px'>	
	<div style='padding-top:4px;padding-bottom:4px;padding-left:2px;background-color:#AAAAAA;text-align:center;font-weight:bold'>
	Background Information:
	</div>
	<?= $registeredDemField ?><br>	
	<div style='height:4px'></div>
	<?= $decMemberField ?><br>
	<div style='height:4px'></div>
	<?= $decVolunteerField ?><br>
	<div style='height:4px'></div>
	<?= $otherVolunteerField ?>	<br>
	<div style='height:4px'></div>
	<?= $whichOnesField ?>
	</div>
	
	<div style='clear:both'></div>
	
	<div style='margin-top:8px;margin-bottom:4px;padding-top:4px;padding-bottom:4px;background-color:#AAAAAA;text-align:center;font-weight:bold'>
		What we need help with
	</div>
	
	<div style='float:left;width:33%'>
	<?= $cbPhoneBanking ?><br>	
	<?= $cbRecruitment ?><br>	
	<?= $cbScheduling ?><br>
	<?= $cbDataEntry ?><br>
	<?= $cbFundraising ?>
	</div>
	
	<div style='float:left;width:33%'>
	<?= $cbCanvassing ?><br>
	<?= $cbEvents ?><br>
	<?= $cbBoothVolunteer ?><br>	
	<?= $cbCandidateSupport ?><br>
	<?= $cbPrecinctAssistance ?>
	</div>
	
	<div style='float:left;width:33%'>
	<?= $cbHighTrafficCanvassing ?><br>	
	<?= $cbNeighborhoods ?><br>
	<?= $cbWriteToOfficials ?><br>
	<?= $cbOutreach ?><br>
	<?= $cbOther ?><br>
	</div>
	
	<div style='clear:both'></div>	
	<div style='margin-top:8px;margin-bottom:4px;padding-top:4px;padding-bottom:4px;background-color:#AAAAAA;text-align:center;font-weight:bold'>Committees you can serve on</div>
	<div style='float:left;width:48%'>
	<?= $cbAffirmativeAction ?><br>
	<?= $cbCampaign ?><br>
	<?= $cbByLaws ?><br>
	<?= $cbCredentials ?><br>	
	<?= $cbMembership ?><br>	
	<?= $cbFinance ?><br>
		
	</div>
	
	<div style='float:left;width:48%'>
	<?= $cbLegislative ?><br>	
	<?= $cbPlatform ?><br>
	<?= $cbPublicity ?><br>
	<?= $cbIT ?><br>
	<?= $cbLegal ?><br>
	<?= $cbLabor ?><br>
	</div>
	
	<div style='clear:both'></div>	
	<div style='width:100%;padding-top:4px;padding-bottom:4px;background-color:#AAAAAA;text-align:center;font-weight:bold'></div>
	<div style='text-align:center'>
	<input type=reset value=" Clear ">&nbsp;<input type=submit value=" Submit ">
	</div>
	</div>
</div>
</form>
