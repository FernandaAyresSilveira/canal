<?php

	class Configuracao_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	    }

	    public function get($id)
	    {

	    	if($id)
			{
				$query = $this->db->get_where('configuracao', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->get('configuracao');
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;

	    }

	    public function getOne()
	    {

			$query = $this->db->get('configuracao', 1);
			$result = $query->result();

			$this->data = $result[0];
			$this->count = 1;
	        return $result[0];

	    }

	    public function salvarGerais($id){

	    	$dados = array(
				'itens' 			  => strip_tags( $this->input->post('itens') ),
				'titulo' 			  => strip_tags( $this->input->post('titulo') ),
				'email_smtp' 		  => strip_tags( $this->input->post('email_smtp') ),
				'senha_smtp' 		  => strip_tags( $this->input->post('senha_smtp') ),
				'keywords'            => trim( $this->input->post('keywords') ),				
			    'descricao'           => trim( $this->input->post('descricao') ),
			);


			return $this->db->update('configuracao', $dados, array( "id" => $id ));
	    
	    }

	    public function salvarContato($id){
	    	
	    	$dados = array(
					'facebook' 	  => strip_tags( prep_url( $this->input->post('facebook') ) ),
					'twitter' 	  => strip_tags( prep_url( $this->input->post('twitter') ) ),
				    'instagram'   => strip_tags( prep_url( $this->input->post('instagram') ) ),
					'google' 	  => strip_tags( prep_url( $this->input->post('google') ) ),
				    'estado_id'   => strip_tags( $this->input->post('estado') ),
					'cidade' 	  => strip_tags( $this->input->post('cidade') ),
					'bairro' 	  => strip_tags( $this->input->post('bairro') ),
					'rua' 		  => strip_tags( $this->input->post('rua') ),
					'numero' 	  => strip_tags( $this->input->post('numero') ),
					'complemento' => strip_tags( $this->input->post('complemento') ),
				    'telefone1'   => strip_tags( $this->input->post('telefone1') ),
				    'telefone2'   => strip_tags( $this->input->post('telefone2') ),
				    'whatsapp'    => strip_tags( $this->input->post('whatsapp') ),
				    'email' 	  => strip_tags( $this->input->post('email') ),
				    'cep' 		  => strip_tags( $this->input->post('cep') ),
				    'coordenadas' => strip_tags(  $this->input->post('coordenadas')  ),
				    // 'atendimento' => strip_tags( $this->input->post('atendimento') ),
				    'pinterest'   => strip_tags( prep_url( $this->input->post('pinterest') ) ),
				);

	    	return $this->db->update('configuracao', $dados, array( "id" => $id ));

	    }

	    public function salvarAnalytics($id){

	    	$dados = array(
	    		"analytics" => $this->input->post('script')
	    	);

	    	return $this->db->update('configuracao', $dados, array( "id" => $id ));

	    }

	}

?>