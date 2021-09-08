<?php

	class Cupom_model extends CI_model{

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

	    	//var_dump($this->input->post());die;
	    	$dados = array(
	    		'nome' 				=> strip_tags( $this->input->post('nome') ),
	    		'data_inicial'		=> converter_data(strip_tags( $this->input->post('data_inicial') )),
	    		'data_final'		=> converter_data(strip_tags( $this->input->post('data_final') )),
	    		'recompensa' 		=> strip_tags( $this->input->post('recompensa') ),
	    		'max_utilizacoes'	=> strip_tags( $this->input->post('max_utilizacoes') ),
	    		'codigo'			=> strip_tags( $this->input->post('codigo') ),

	    	);

	    	$query = $this->db->insert('cupom', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }

	    public function get($id=false)
	    {

	    	if($id)
			{
				$query = $this->db->order_by('id', 'DESC')
								  ->get_where('cupom', array('id'=> $id), 1);
				$result = $query->row();
			}
			else{
				$query = $this->db->order_by('id DESC')
								  ->get('cupom');
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;

	    }

	    public function update($id)
	    {

	    	$dados = array(
	    		'nome' 				=> strip_tags( $this->input->post('nome') ),
	    		'data_inicial'		=> converter_data(strip_tags( $this->input->post('data_inicial') )),
	    		'data_final'		=> converter_data(strip_tags( $this->input->post('data_final') )),
	    		'recompensa' 		=> strip_tags( $this->input->post('recompensa') ),
	    		'max_utilizacoes'	=> strip_tags( $this->input->post('max_utilizacoes') ),
	    		'codigo'			=> strip_tags( $this->input->post('codigo') ),

	    	);

			return $this->db->update('cupom', $dados, array( "id" => $id ));
	    	
	    }


		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('cupom');

		}

	}

?>