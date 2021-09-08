<?php

	class Editora_model extends CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function get($id=false)
	    {

	    	if ($id) {
	    		$query = $this->db->where('id',$id)
								  ->get('editora');
				$result = $query->row();
	    	}else{
	    		$query = $this->db->order_by('nome ASC')
								  ->get('editora');
				$result = $query->result();
	    	}
	    	
			
			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }

	     public function save(){
	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') )
	    	);    	

	    	$query = $this->db->insert('editora', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }


	    public function update($id)
	    {

	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') )
	    	);

			return $this->db->update('editora', $dados, array( "id" => $id ));
	    	
	    }

	    public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('editora');

		}

	   




	}

?>