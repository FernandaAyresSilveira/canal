<?php

	class Administrador_model extends  CI_model{

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
				$query = $this->db->get_where('administrador', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];
			}
			else{
				$query = $this->db->get('administrador');
				$result = $query->result();
			}

			$this->count = $this->db->count_all_results();
	        return $result;

		}

		public function login()
		{
			
			$dados = array(
				'email' => strip_tags($this->input->post_get('email')),
				'senha' => sha1($this->input->post_get('senha'))
			);

			$query = $this->db->get_where('administrador', array('email' => $dados['email']));

			$user = $query->result_array();

			$this->userData = $user = $user[0];

			return ($user['senha'] == $dados['senha']) ? $user : false;

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
				"master" => $this->input->post('master') ? 1 : 0,
				"foto"   => empty($_FILES['imagem']['name']) ? '' : rand(0, 999999999).'.jpg',
			);

			$this->foto = $dados['foto'];

			return $this->db->insert('administrador', $dados);

		}

		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('administrador');

		}

		public function update($id)
		{

			$dados = array(
							'nome'   => $this->input->post('nome'),
							'email'  => $this->input->post('email'),
							'master' => $this->input->post('master') ? 1 : 0
						);

			$where = array('id' => $id);

			return $this->db->update('administrador', $dados, $where);

		}

		public function updateSenha($id)
		{

			$dados = array( 'senha' => sha1($this->input->post('senha') ) );

			$where = array('id' => $id);

			return $this->db->update('administrador', $dados, $where);

		}

		public function setDefaultFoto($id)
		{
			return $this->db->update('administrador', array('foto' => ''), array('id' => $id));
		}

		public function setFoto($id, $foto)
		{
			$dados = array('foto' => $foto);
			$where = array('id' => $id);

			return $this->db->update('administrador', $dados, $where);
		}

	}

?>