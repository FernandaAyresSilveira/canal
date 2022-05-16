<?php

	class Conteudo_home_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	    }

	    public function get($id=null)
	    {

	    	if($id)
			{
				$query = $this->db->get_where('conteudo_home', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->get('conteudo_home');
				$result = $query->result();
			}

			$this->data = $result;
	        return $result;

	    }

	 

	    public function setFoto($foto, $campo)
		{
			$dados = array($campo => $foto);
			$where = array('id' => 1);

			return $this->db->update('conteudo_home', $dados, $where);
		}	    

	    public function update($id)
	    {

	    	$dados = array( 
				'titulo_espaco'   => strip_tags( $this->input->post('titulo_espaco') ),
			    'texto_espaco'    => trim( $this->input->post('texto_espaco') ),
			    'titulo_servicos' => strip_tags( $this->input->post('titulo_servicos') ),
			    'texto_servicos'  => trim( $this->input->post('texto_servicos') ),
			    'titulo_area_coringa' => strip_tags( $this->input->post('titulo_area_coringa') ),
			    'texto_area_coringa'  => trim( $this->input->post('texto_area_coringa') ),
			    'link_area_coringa' => strip_tags( $this->input->post('link_area_coringa') ),
			    'titulo_servicos_beleza' => strip_tags( $this->input->post('titulo_servicos_beleza') ),
			    'texto_servicos_beleza'  => trim( $this->input->post('texto_servicos_beleza') ),
			    'titulo_novidades' => strip_tags( $this->input->post('titulo_novidades') ),
			    'subtitulo_novidades' => strip_tags( $this->input->post('subtitulo_novidades') ),
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }


	    public function update_espaco($id)
	    {

	    	$dados = array( 
				'titulo_espaco'   => strip_tags( $this->input->post('titulo_espaco') ),
			    'texto_espaco'    => trim( $this->input->post('texto_espaco') ),
			   
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }

	     public function update_area_link($id)
	    {

	    	$dados = array( 
				 'titulo_area_coringa' => strip_tags( $this->input->post('titulo_area_coringa') ),
			    'texto_area_coringa'  => trim( $this->input->post('texto_area_coringa') ),
			    'link_area_coringa' => strip_tags( $this->input->post('link_area_coringa') ) 			    
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }


	     public function update_servico_beleza($id)
	    {

	    	$dados = array( 				
			    'titulo_servicos_beleza' => strip_tags( $this->input->post('titulo_servicos_beleza') ),
			    'texto_servicos_beleza'  => trim( $this->input->post('texto_servicos_beleza') )
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }


	    public function update_servico_estetica($id)
	    {

	    	$dados = array( 
			    'titulo_servicos' => strip_tags( $this->input->post('titulo_servicos') ),
			    'texto_servicos'  => trim( $this->input->post('texto_servicos') )		   
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }


	    public function update_novidade($id)
	    {

	    	$dados = array( 				
			    'titulo_novidades' => strip_tags( $this->input->post('titulo_novidades') ),
			    'subtitulo_novidades' => strip_tags( $this->input->post('subtitulo_novidades') ),
			);

			return $this->db->update('conteudo_home', $dados, array( "id" => 1 ));
	    	
	    }



	   

	}
?>