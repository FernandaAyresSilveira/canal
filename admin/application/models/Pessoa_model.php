<?php

	class Pessoa_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	    }


		public function get()
		{

			$query = $this->db->order_by('nome ASC')
								  ->get('pessoa');
			$result = $query->result();

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;


		}


		public function save(){
	    	$dados = array(
	    		'email' => strip_tags( $this->input->post('email') )
	    	);

	    	$query = $this->db->insert('pessoa', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }

	    public function delete($email)
		{

			$this->db->where('email', $email);
        	return $this->db->delete('pessoa');

		}



	}

?>