<?php

	class Departamento_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function get($id=null)
	    { 
	    	if ($id) {
				$query = $this->db->select('departamento.*')
								  ->from('departamento')
								  ->where('id', $id)
						  	      ->get();
				$result = $query->row();	
	    	}else{	    	
				$this->db->order_by('id', 'asc');
				$query = $this->db->get('departamento');
				$result = $query->result();	
			}		

			$this->data = $result;
			$this->count = count($this->data);
	        return $result;

	    }

	 



	}
?>