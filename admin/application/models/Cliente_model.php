<?php

	class Cliente_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function get($id=null)
	    {

	    	if($id)
			{
				$query = $this->db->select('cliente.*,cidade.nome as cidade_nome, estado.sigla as estado_sigla')
								  ->from('cliente')
								  ->join('cidade','cliente.cidade_id = cidade.id','left')
								  ->join('estado','cliente.estado_id = estado.id','left')
								  ->where('cliente.id',$id)
								  ->get();
				$result = $query->row();
			}
			else{
				$query = $this->db->order_by('nome ASC')->get('cliente');
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }


	    public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;
			$busca = $this->input->get('q');

			$like = array(
				'nome'  => $busca,
				'email' => $busca
			);

			//Busca
			if( $this->input->get('q') ){

				$query = $this->db->or_like($like)
								  ->order_by('nome', 'ASC')
							  	  ->get('cliente', $i, $first);

				$this->count = $this->db->or_like($like)
										->count_all_results('cliente');

			}
			else {
				
				$query = $this->db->order_by('nome', 'ASC')
								  ->get('cliente', $i, $first);
				
				$this->count = $this->db->count_all_results('cliente');

			}

			$this->data  = $query->result();

			return $this->data;
		
		}

	        

	    public function update($id)
	    {

	    	$dados = array(
				'nome' 		=> trim(strip_tags($this->input->post('nome'))),
				'sobrenome' => trim(strip_tags($this->input->post('sobrenome'))),
				'email' 	=> strip_tags($this->input->post('email')),
				'cpf' 		=> strip_tags($this->input->post('cpf')) ,
				'sexo' 		=> strip_tags($this->input->post('sexo')),
				'nascimento'=> converter_data(strip_tags($this->input->post('nascimento'))),
				'telefone' 	=> strip_tags($this->input->post('telefone')),
				'celular' 	=> strip_tags($this->input->post('celular'))
			);

			if ( strip_tags($this->input->post('senha') ) ) {
				$dados['senha'] = sha1(strip_tags($this->input->post('senha') ) );
			}

			return $this->db->update('cliente', $dados, array( "id" => $id ));
	    	
	    }


	    public function update_sobrenome($id,$nome, $sobrenome)
	    {

	    	$dados = array(
				'nome' 		=> $nome,
				'sobrenome' 		=> $sobrenome,
				
			);
			return $this->db->update('cliente', $dados, array( "id" => $id ));
	    	
	    }

	 //    public function delete($id)
		// {

		// 	$this->db->where('id', $id);
  //       	return $this->db->delete('cliente');

		// }


	}
?>