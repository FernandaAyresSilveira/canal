<?php

	class Banner_model extends CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function lastInsertId(){
	    	return $this->lastInsertId;
	    }

	    public function save(){
	    	$dados = array(
	    		'nome' => strip_tags( $this->input->post('nome') )
	    	);

	    	$query = $this->db->insert('banner', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }

	    public function get($id=false)
	    {

	    	if($id)
			{
				$query = $this->db->order_by('id', 'DESC')
								  ->get_where('banner', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->order_by('id DESC')
								  ->get('banner');
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;

	    }

	    public function update($id)
	    {

	    	$dados = array(
				'nome' => strip_tags( $this->input->post('nome') )
			);

			return $this->db->update('banner', $dados, array( "id" => $id ));
	    	
	    }

	    public function setFoto($id, $foto)
		{
			$dados = array('imagem' => $foto);
			$where = array('id' => $id);

			return $this->db->update('banner', $dados, $where);
		}

		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('banner');

		}

	}

?>