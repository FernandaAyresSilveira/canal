<?php

	class Usuario_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $user;
	        $count;
	        $foto;
	    }


		public function get($id = false)
		{

			if($id)
			{
				$query = $this->db->get_where('usuario', array('id'=> $id), 1);
				$result = $query->row();
			}
			else{
				$query = $this->db->get('usuario');
				$result = $query->result();
			}

			$this->count = count($result);
	        return $result;

		}

		public function login()
		{
			
			$dados = array(
				'email' => strip_tags($this->input->post_get('email')),
				'senha' => sha1($this->input->post_get('senha'))
			);

			$query = $this->db->get_where('usuario', array('email' => $dados['email'],'master' => 1))->row();

			$user = $query;

			$user = $user ? $user : '';

			$this->userData = $user ;

			if ($user !='' && $user->senha == $dados['senha']) {
				return $user;

			}else{
				return false;
			}

			
		}

		public function getUserData()
		{
			
			return $this->userData;

		}

		public function count()
		{
			return $this->count;
		}

		public function save()
		{     

			$dados = array(
				"nome"   => $this->input->post('nome'),
				"email"  => $this->input->post('email'),
				"senha"  => sha1( $this->input->post('senha') ),
			);
       

			return $this->db->insert('usuario', $dados);

		}

		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('usuario');

		}

		public function update($id)
		{

			$dados = array(
							'nome'   => $this->input->post('nome'),
							'email'  => $this->input->post('email'),
						);

			$where = array('id' => $id);

			return $this->db->update('usuario', $dados, $where);

		}

		public function updateSenha($id)
		{

			$dados = array( 'senha' => sha1($this->input->post('senha') ) );

			$where = array('id' => $id);

			return $this->db->update('usuario', $dados, $where);

		}
	}

?>