<?php

class Categoria_model extends CI_model{
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
				$query  = $this->db->get_where('categoria', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query = $this->db->order_by('nome', 'asc')
							  ->get('categoria');
			$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

}
?>