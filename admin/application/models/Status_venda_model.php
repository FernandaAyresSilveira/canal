<?php

	class Status_venda_model extends CI_model{

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
								  ->get('status_venda');
				$result = $query->row();
	    	}else{
	    		$query = $this->db->order_by('id ASC')
								  ->get('status_venda');
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

	    	$query = $this->db->insert('status_venda', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }


	    public function update($id)
	    {

	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') )
	    	);

			return $this->db->update('status_venda', $dados, array( "id" => $id ));
	    	
	    }

	    public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('status_venda');

		}

	   




	}

?>