<?php
class Boxitems extends Model {
	
	function Boxitems() 
	{
		parent::Model();
	}

	function getItemsForPage( $pageName ) 
	{
		$results = array();
		$r = $this->db->get_where('boxitems', array( 'pageName'=>$pageName ) );
		if($r)
		{
			$rows = array();
			foreach ($r->result_array() as $row)
			{
				$rows[] = $row;
			}
			$results['status'] = 'OK';
			$results['rows'] = $rows;
		}
		else
		{
		}
		return $results;
	}
	
	function addBoxItem( $boxItemInfo )
	{
		$results = array();
		$r = $this->db->insert('boxitems',$boxItemInfo);
		if($r->affected_rows()>0)
		{
			$results['status'] = 'OK';
		}
		else
		{
			$results['status'] = 'ERR';
		}
		return $results;
	}
	
	function getBoxItem( $boxItemId )
	{
		$results = array();
		$r = $this->db->get_where('boxitems',array('id'=>$boxItemId));
		if($r)
		{
			$results['status'] = 'OK';
			$results['item'] = $r->row_array();
		}
		else
		{
			$results['status'] = 'ERR';
		}
		return $results;
	}
	
	function updateBoxItem( $boxItemInfo, $boxItemId )
	{
		# build update array from $boxItemInfo and apply it
	}

	function deleteBoxItem( $boxItemId )
	{
		$results = array();
		$r = $this->db->delete('boxitems',array('id'=>$boxItemId));
		if($r->affected_rows()>0)
		{
			$results['status'] = 'OK';
		}
		else
		{
			$results['status'] = 'ERR';
		}
		return $results;
	}
}