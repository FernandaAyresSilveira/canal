<?php

	class Ano_model extends CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function get($id=false)
	    {

	    	
				$query = $this->db->order_by('id ASC')
								  ->get('ano');
				$result = $query->result();
			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }

	   




	}

?>