<?php

class Tag_model extends CI_model{
	function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	        $lastInsertId;
	    }

		 public function get($id = false)
		{

			if($id)
			{
				$query  = $this->db->get_where('tag', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query = $this->db->group_by('tag_id', 'asc')
							  ->get('post_tag');
			$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

}
?>