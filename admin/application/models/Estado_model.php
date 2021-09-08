<?php

	class Estado_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	    }


		public function get()
		{

			
			$query = $this->db->get('estado');
			$result = $this->data = $query->result();


			$this->count = $this->db->count_all_results();
	        return $result;

		}

	}

?>