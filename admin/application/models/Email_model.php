<?php

	class Email_model extends  CI_model{

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
				$query  = $this->db->get_where('email', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query  = $this->db->get('email');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

	

	}
?>