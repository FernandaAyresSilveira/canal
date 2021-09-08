<?php

	class Popup_model extends CI_model{

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
				'nome'          => strip_tags( $this->input->post('nome') ),
				'data_inicial'  => converter_data(strip_tags( $this->input->post('data_inicial') ) ),
				'data_final'    => converter_data(strip_tags( $this->input->post('data_final') ) )
			);

	    	$query = $this->db->insert('popup', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }

	    public function get($id=false)
	    {

	    	if($id)
			{
				$query = $this->db->order_by('id', 'DESC')
								  ->get_where('popup', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->order_by('id DESC')
								  ->get('popup');
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;

	    }

	    public function update($id)
	    {

	    	$dados = array(
				'nome'          => strip_tags( $this->input->post('nome') ),
				'data_inicial'  => converter_data(strip_tags( $this->input->post('data_inicial') ) ),
				'data_final'    => converter_data(strip_tags( $this->input->post('data_final') ) )
			);


			return $this->db->update('popup', $dados, array( "id" => $id ));
	    	
	    }

	    public function setFoto($id, $foto)
		{
			$dados = array('imagem' => $foto);
			$where = array('id' => $id);

			return $this->db->update('popup', $dados, $where);
		}

		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('popup');

		}

	}

?>