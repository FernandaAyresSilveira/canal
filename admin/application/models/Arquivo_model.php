<?php

	class Arquivo_model extends  CI_model{

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
				$query  = $this->db->get_where('arquivo', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query  = $this->db->from('arquivo');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

		public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;
			$busca = $this->input->get('q');

			$like = array(
				'nome'  => $busca
			);

			//Busca
			if( $this->input->get('q') ){

				$query = $this->db->or_like($like)
								  ->order_by('data', 'DESC')
							  	  ->get('arquivo', $i, $first);

				$this->count = $this->db->or_like($like)
										->count_all_results('arquivo');

			}
			else {
				
				$query = $this->db->order_by('data', 'DESC')
								  ->get('arquivo', $i, $first);
				
				$this->count = $this->db->count_all_results('arquivo');

			}

			$this->data  = $query->result();

			return $this->data;
		
		}

		public function save(){

			$dados = array(
				'nome' 	 		=> strip_tags( $this->input->post('nome') ),
				'data '	 			=> date('Y-m-d H:i')
			);

			$query = $this->db->insert('arquivo', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
		}

		public function update($id){
			$dados = array(
				'nome' 	 		=> strip_tags( $this->input->post('nome') ),
				'data '	 			=> date('Y-m-d H:i')
			);

			$where = array(
				'id' => $this->uri->segment(3)
			);

			return $this->db->update('arquivo', $dados, $where);
		}

		public function setArquivo($id, $arquivo)
		{
			$dados = array('arquivo' => $arquivo);
			$where = array('id' => $id);

			return $this->db->update('arquivo', $dados, $where);
		}



		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('arquivo');

		}


	}
?>