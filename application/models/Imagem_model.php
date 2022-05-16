<?php

	class Imagem_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	    }

	    public function save($foto, $tipo = '', $idTipo = null)
		{
			$tipo = empty($tipo) ? "midia" : $tipo;
			$dados = array(
				'nome'    => $foto,
				'tipo'    => $tipo,
				'id_tipo' => $idTipo
			);

			return $this->db->insert('imagem', $dados);
			
		}

		public function getTemp($tipo = '', $idTipo = null)
		{
			$tipo = empty($tipo) ? "midia" : $tipo;

			$query = $this->db->get_where('imagem', array('tipo' => $tipo, 'status' => 1));
			return $query->result();
		
		}

		public function delete($id)
		{
			$where = array(
				"id" => $id
			);

			$dados = array(
				"status" => 0
			);

			return $this->db->update("imagem", $dados, $where);

		}

		public function getJsonTemp($tipo = '', $idTipo = null)
		{
			$tipo = empty($tipo) ? "midia" : $tipo;

			$query = $this->db->get_where('imagem', array('tipo' => $tipo, 'status' => 1));
			$query = $query->result();

			$json = array();

			foreach($query as $img){
				
				array_push($json, array(
					"title" => ($img->titulo != "") ? $img->titulo : $img->nome,
					"value" => base_url_upload($img->tipo."/".$img->nome)
				));
			
			}

			return $json;
		
		}

		public function update(){
			$dados = array(
				"titulo" => $this->input->get_post("titulo")
			);

			$where = array(
				"id" => $this->input->get_post("id")
			);

			return $this->db->update("imagem", $dados, $where);

		}

	}
?>