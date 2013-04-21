<script type='text/javascript'>
function selectAll() {
}

function selectNone() {
}
</script>
<?php
	$this->load->helper('form');

	# [delete selected]  [update selected] [select all] [select none]
	# format - [ ] date start-end name location
	foreach( $events as $event )
	{
		# spit out a checkbox with name "events[]" and value event_id, followed by date/time, title and location
		# for checkbox DOM class is 'eventCheckbox' to make it easy to select/deselect
	}
 ?>