<?php

	class Noticia_model extends  CI_model{

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
				$query  = $this->db->get_where('noticia', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query  = $this->db->from('noticia');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

		public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;
			$busca = $this->input->get('q');

			$like = array(
				'titulo'  => $busca,
				'legenda' => $busca,
				'texto'   => $busca,
				'tag' 	  => $busca
			);

			//Busca
			if( $this->input->get('q') ){

				$query = $this->db->or_like($like)
								  ->order_by('data', 'DESC')
							  	  ->get('noticia', $i, $first);

				$this->count = $this->db->or_like($like)
										->count_all_results('noticia');

			}
			else {
				
				$query = $this->db->order_by('data', 'DESC')
								  ->get('noticia', $i, $first);
				
				$this->count = $this->db->count_all_results('noticia');

			}

			$this->data  = $query->result();

			return $this->data;
		
		}

		public function save(){

			$dados = array(
				'titulo' 	 		=> strip_tags( $this->input->post('titulo') ),
				'data '	 			=> date('Y-m-d H:i'),
				'administrador_id'	=> $this->session->userdata('id'),
				'legenda'  			=> strip_tags( trim($this->input->post('legenda')) ),
				'previa' 	 		=> trim( $this->input->post('previa') ),
				'texto' 	 		=> trim( $this->input->post('texto') ),
				'amigavel' 			=> amigavel( $this->input->post('titulo') ),
				'tag' 	 			=> strip_tags( $this->input->post('tag') )
			);

			$query = $this->db->insert('noticia', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
		}

		public function update(){
			$dados = array(
				'titulo' 	 		=> strip_tags( $this->input->post('titulo') ),
				'administrador_id'	=> $this->session->userdata('id'),
				'legenda'  			=> strip_tags( trim($this->input->post('legenda')) ),
				'previa' 	 		=> trim( $this->input->post('previa') ),
				'texto' 	 		=> trim( $this->input->post('texto') ),
				'amigavel' 			=> amigavel( $this->input->post('titulo') ),
				'tag' 	 			=> strip_tags( $this->input->post('tag') )
			);

			$where = array(
				'id' => $this->uri->segment(3)
			);

			return $this->db->update('noticia', $dados, $where);
		}

		public function setFoto($id, $foto)
		{
			$dados = array('imagem' => $foto);
			$where = array('id' => $id);

			return $this->db->update('noticia', $dados, $where);
		}



		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('noticia');

		}


	}
?>