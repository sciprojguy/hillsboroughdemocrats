	<tr>
		<td colspan=2 width="100%" bgcolor="#E1E1E1" valign=top>
			<!--
			add link that takes you to the alert.php form.
			list of box items, each with Edit / Delete links.  if you can see this page you can see those controls.
			  -->
		<?php
			$this->load->model('alerts');
			$alerts = $this->alerts->getAlerts();
			foreach($alerts as $alert)
			{
				# format alert for line.  if uInfo indicates edit perm, add "edit" link and "delete" link.  if uInfo indicates
				# add perm, add "add" link at top.
			}
		 ?>
		</td>
	</tr>
	

