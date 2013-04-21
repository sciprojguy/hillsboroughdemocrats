<?php
class News extends Model {

	function News()
	{
		parent::Model();
	}
	
	function emptyNewsItem()
	{
		return array(
			'date'=>'',
			'link'=>'',
			'title'=>'',
			'status'=>'new',
			'front_page'=>false
		);
	}

	function validateNews( $newsEntry )
	{
		$errors = array();
		if(!isset($newsEntry['title']) || empty($newsEntry['title']))
			$errors['title'][] = 'Title for newsletter entry is required';
		if(!isset($newsEntry['link']) || empty($newsEntry['link']))
			$errors['link'][] = 'Link to newsletter entry is required';
		return $errors;
	}
	/*
	function changedFields( $newsEntry, $entryId )
	{
		$changes = array();
		$r = $this->db->get_where('news', array('id'=>$entryId));
		if($r)
		{
			$fields = $this->db->list_fields('news');
			$row = $r->row_array();
			
			foreach($fields as $field) {
				if(isset($newsEntry[$field]))
				{
					if($row[$field] != $newsEntry[$field])
						$changes[$field] = $value;
				}
			}
		}
		return $changes;
	}
	*/
	function getLatestNewsEntry()
	{
		$results = array();
		
		$this->db->limit(1);
		$this->db->order_by('date DESC');
		$this->db->where("status = 'active'");
		$r = $this->db->get('news');
		if($r)
		{
			$results['status'] = 'OK';
			$results['row'] = $r->row_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		return $results;
	}
	
	function getFrontPageEntries()
	{
		$results = array();
		
		$this->db->order_by('date DESC');
		$this->db->where("status = 'active' AND front_page = 1");
		$r = $this->db->get('news');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		return $results;
	}
	
	function addNewsEntry( $newsEntry )
	{
		$results = array();
		$date = date('Y-m-d h:i:s');
		$newsEntry['date'] = $date;
		$errors = $this->validateNews($newsEntry);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			$r = $this->db->insert('news', $newsEntry);
			if($r)
				$results['status'] = 'OK';
			else
				$results['status'] = 'DB'; 
		}
		return $results;
	}
	
	function updateNewsEntry( $newsEntry, $entryId )
	{
		$results = array();
		$errors = $this->validateNews($newsEntry);
		if(count($errors)>0)
		{
			$results['status'] = 'VALIDATION';
			$results['errors'] = $errors;
		}
		else
		{
			if( isset($newsEntry['promote']) && $newsEntry['promote'])
			{
				$date = date('Y-m-d h:i:s');
				$newsEntry['date'] = $date;
				unset($newsEntry['promote']);
			}
			
			if(!isset($newsEntry['front_page']))
			{
				$newsEntry['front_page'] = 0;
			}
			$r = $this->db->update('news', $newsEntry, array('id'=>$entryId));
			if($r)
				$results['status'] = 'OK';
			else
				$results['status'] = 'DB'; 
		}
		return $results;		
	}
	
	function getNewsEntry($entryId)
	{
		$results = array();
		$r = $this->db->get_where('news', array('id'=>$entryId));
		if($r)
		{
			$results['status'] = 'OK';
			$results['row'] = $r->row_array();
		}
		else
			$results['status'] = 'DB'; 
		return $results;		
	}
	
	function deleteNewsEntry( $entryId ) 
	{
		if(!isset($entryId))
			return;
		$r = $this->delete_where('news', array('id'=>$entryId));
	}
	
	function getActiveNewsEntries()
	{
		$results = array();
		
		$this->db->order_by('date DESC');
		$this->db->where("status = 'active'");
		$r = $this->db->get('news');
		if($r)
		{
			$results['status'] = 'OK';
			$results['rows'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		return $results;
	}
	
	function getAllNewsEntries()
	{
		$results = array();
		
		$this->db->order('date DESC');
		$r = $this->db->get('news');
		if($r)
		{
			$results['status'] = 'OK';
			$results['news'] = $r->result_array();
		}
		else
		{
			$results['status'] = 'DB';
		}
		
		return $results;
	}
}
