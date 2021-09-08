<?php

	class Empresa_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	    }

	    public function get($id = false)
		{

			$query  = $this->db->get('empresa');
			$result = $query->result();
			$this->data = $result[0];
			
	        return $this->data;

		}

		public function update(){
			$dados = array(
				'titulo' 	 	=> strip_tags( $this->input->post('titulo') ),
				'descricao' 	=> trim( $this->input->post('descricao') ),
				'missao' 	 	=> trim( $this->input->post('missao') ),
				'visao' 	 	=> trim( $this->input->post('visao') ),
				'valores' 	 	=> trim( $this->input->post('valores') )
			);

			$where = array(
				'id' => $this->uri->segment(3)
			);

			return $this->db->update('empresa', $dados, $where);
		}

		public function updateFoto($campo, $valor, $id){
			
			$dados = array($campo => $valor);
			$where = array('id' => $id);

			return $this->db->update('empresa', $dados, $where);
			
		}

	}
?>