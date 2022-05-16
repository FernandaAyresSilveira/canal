<?php

	class Newsletter_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	    }

	    function getDistinct($campo){

	    	$query = $this->db->select($campo)
	    					  ->distinct()
	    					  ->get("newsletter_email");

	    	return $query->result();
	    
	    }

	    public function pegarHistoricoPaginado($ids, $p, $i){
	    	
	    	$first = ($i*$p)-$i;

	    	$query = $this->db->select("n.*, COUNT(nt.newsletter_id) AS news_total")
	    					  ->from("newsletter n")
	    					  ->join("newsletter_email nt", "nt.newsletter_id = n.id")
	    					  ->where_in('n.id', $ids)
	    					  ->group_by('n.id');
	    	
	    	$news_total = $query->get();

	    	$query2 = $this->db->select("n2.*, COUNT(nt2.newsletter_id) AS news_env")
	    					  ->from("newsletter n2")
	    					  ->join("newsletter_email nt2", "nt2.newsletter_id = n2.id")
	    					  ->order_by('n2.id', 'DESC')
	    					  ->where('nt2.status', 1)
	    					  ->where_in('n2.id', $ids)
	    					  ->group_by('n2.id');

	    	$news_env   = $query2->get();

			// $query = $this->db->order_by('id', 'DESC')
			// 				  ->where_in('id', $ids)
			// 				  ->get('newsletter', $i, $first);

			$this->data = array(
				$news_env->result(),
				$news_total->result() 
			);

			return $this->data;

	    }

	    public function pegarQuantidadeHistorico($ids){
	    	
	    	$query = $this->db->order_by('id', 'DESC')
							  ->where_in('id', $ids)
							  ->get('newsletter');

			$this->data  = $query->result();

	    }



	    public function get($id = false)
		{

			if($id)
			{
				$query = $this->db->get_where('newsletter', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->get('newsletter')
								  ->order_by("id", "DESC");
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = $this->db->count_all_results();
	        return $result;

		}

		public function getEmail($id)
		{

			$query  = $this->db->where("id", $id)
							   ->get('email');

			$emails = $query->result();
			$this->data  = $emails[0];

			$this->count = $this->db->count_all_results('email');
			
	        return $this->data;

		}


		public function getEmails()
		{

			$query  = $this->db->order_by("id", "DESC")
							   ->get('email');

			$this->data  = $query->result();

			$this->count = $this->db->count_all_results('email');
			
	        return $this->data;

		}

		public function getNewsPaginate($p = null, $i = null){

			$first = ($i*$p)-$i;

			//Busca
				
			$query = $this->db->order_by('data', 'DESC')
							  ->get('newsletter', $i, $first);
			
			$this->count = $this->db->count_all_results('newsletter');


			$this->data  = $query->result();

			return $this->data;
		
		}

		public function getEmailsPaginate($p = null, $i = null){

			$first = ($i*$p)-$i;

			//Busca
				
			$query = $this->db->order_by('id', 'DESC')
							  ->get('email', $i, $first);
			
			$this->count = $this->db->count_all_results('email');


			$this->data  = $query->result();

			return $this->data;
		
		}

		public function getAllEmails()
		{

			$query  = $this->db->order_by("id", "DESC")
							   ->get('email');

			$this->data = $query->result_array();
			
	        return $this->data;

		}

		public function save(){

			$dados = array(
				'assunto' 	 		=> strip_tags($this->input->post('assunto')),
				'data '	 			=> date('Y-m-d H:i'),
				'html'				=> $this->input->post('html'),
				'tipo'				=> $this->input->post('tipo'),
				'link_imagem'		=> $this->input->post('link_imagem')
			);

			$query = $this->db->insert('newsletter', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
		}

		public function setFoto($id, $foto)
		{
			$dados = array('imagem' => $foto);
			$where = array('id' => $id);

			return $this->db->update('newsletter', $dados, $where);
		}
		
		public function update(){
			$dados = array(
				'assunto' 	 		=> strip_tags($this->input->post('assunto')),
				'data '	 			=> date('Y-m-d H:i'),
				'html'				=> $this->input->post('html'),
				'tipo'				=> $this->input->post('tipo'),
				'link_imagem'		=> $this->input->post('link_imagem')
			);

			$where = array(
				'id' => $this->uri->segment(3)
			);

			return $this->db->update('newsletter', $dados, $where);
		}

		public function updateFoto($campo, $valor, $id){
			
			$dados = array($campo => $valor);
			$where = array('id' => $id);

			return $this->db->update('newsletter', $dados, $where);
			
		}

		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('newsletter');

		}

		public function deleteEmail($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('email');

		}

		public function getEmailsNewsletter($id)
		{

			$query  = $this->db->where("newsletter_id", $id)
							   ->get('newsletter_email');

			$this->data = $query->result_array();
			
	        return $this->data;

		}

		public function deleteEmailsNewsletter($id)
		{

			$this->db->where("email_id", $id);
        	return $this->db->delete('newsletter_email');

		}

	}
?>