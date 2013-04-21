<div class='contentBox'>
<?php
# view page for candidate.  includes larger picture, name, office, slogan, contact info, 
# and contact button.
#var_dump($candidate);
?>
<!--
	"Candidate For"
	Office Sought
	
	+--------------+		Contact:
	|              |			contact name
	|   larger     |			phone#
	|   picture    |			email
	|              |			web site
	|              |		Short bio:
	|              |
	|              |		Statement/slogan:
	+--------------+
	 Name:	 Name	 
	 Status: Filed
	 Intent to qualify: Petition
	 Qualified: mm/dd/yyyy
	 
 -->
<div class="titleBanner"><?= "Candidate for {$candidate['title']} - ".$candidate['firstName']." ".$candidate['middleName']." ".$candidate['lastName']?></div>
<div style='font-family:Helvetica, Arial, Sans-serif; font-size:14pt'>
<div style='float:left'>
<img src="/images/candidates/<?= $candidate['large_picture'] ?>" width=168 style='margin:4px 4px 4px 4px'>
</div>
<em>Contact:</em> <?= $candidate['contact']?> <br> <br>
<em>Address:</em> <?= $candidate['contact_address']?> <br>
<em>Phone:</em> <?= $candidate['contact_phone']?> <br><br>
<em>Email:</em> <?= "<a href=\"mailto:{$candidate['email']}\">{$candidate['email']}</a>" ?> <br>
<em>Web Site:</em> <?= "<a href=\"{$candidate['webSite']}\">{$candidate['webSite']}</a>" ?> <br><br>
<em>Bio:</em> <?= $candidate['short_bio']?> <br><br>
<em>Statement:</em> <?= $candidate['campaign_statement']?> <br>
</div>
</div>