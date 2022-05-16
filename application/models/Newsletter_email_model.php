<?php

	class Newsletter_email_model extends  CI_model{

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
				$query  = $this->db->get_where('newsletter_email', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query  = $this->db->from('newsletter_email.*')
								   ->get('newsletter_email');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

		 public function getEmails($id)
		{

			$query  = $this->db->get_where('newsletter_email', array('newsletter_id'=> $id));
			$result = $query->result();
			

			$this->count = count($result);
	        return $result;

		}

		 public function getEmailsSuccess($id)
		{
			$dados =  array('newsletter_id'=> $id,
							'status' 	   => 1);

			$query  = $this->db->get_where('newsletter_email',$dados);
			$result = $query->result();

			$this->count = sizeof($result);
	        return $result;

		}

		 public function getEmailsNoSent($id,$maximo)
		{
			$dados =  array('newsletter_id'=> $id,
							'status' 	   => 0);

			$query  = $this->db->get_where('newsletter_email',$dados,$maximo);
			$result = $query->result();

			$this->count = sizeof($result);
	        return $result;

		}







		public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;
			$busca = $this->input->get('q');

			$like = array(
				'assunto'  => $busca
			);

			//Busca
			if( $this->input->get('q') ){

				$query = $this->db->or_like($like)
								  ->order_by('data', 'DESC')
							  	  ->get('newsletter_email', $i, $first);

				$this->count = $this->db->or_like($like)
										->count_all_results('newsletter_email');

			}
			else {
				
				$query = $this->db->order_by('data', 'DESC')
								  ->get('newsletter_email', $i, $first);
				
				$this->count = $this->db->count_all_results('newsletter_email');

			}

			$this->data  = $query->result();

			return $this->data;
		
		}

		public function saveEmail($email_id,$id){

			$dados = array(
				'email_id' 	 		=> $email_id,
				'newsletter_id'		=> $id,
				'data '	 			=> date('Y-m-d H:i'),
				'status'			=> '0'
			);

			$query = $this->db->insert('newsletter_email', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
		}

		public function updateSent($id){
			$dados = array(
				'status' 	 		=>  1
			);

			$where = array(
				'id' => $id
			);

			return $this->db->update('newsletter_email', $dados, $where);
		}




		public function delete_destinatarios($id)
		{

			$this->db->where('newsletter_id', $id);
        	return $this->db->delete('newsletter_email');

		}


	}
?>