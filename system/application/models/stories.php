<?php
class Stories extends Model {
	
	function Stories() 
	{
		parent::Model();
	}

	function addStory( $story ) 
	{
		$results = array();
		$errors = array();
		
		if(empty($story['title']))
			$errors['title'] = 'Title cannot be empty';
		if(empty($story['lead']))
			$errors['lead'] = 'Lead paragraph cannot be empty';
			
		if(count($errors)>0)
		{
			$results['status'] = -1;
			$results['status_str'] = 'Validation errors';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('stories', $story);
			if(!$r)
			{
				$results['status'] = -1;
				$results['status_str'] = 'DB error';
			}
		}
		
		return $results;
	}
	
	function getStory( $id ) 
	{
	}
	
	function updateStory( $story, $id ) 
	{
	}
	
	function deleteStory( $story ) 
	{
	}
	
	
}