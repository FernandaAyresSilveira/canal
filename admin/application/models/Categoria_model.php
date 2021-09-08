<?php

	class Categoria_model extends  CI_model{

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
				$query = $this->db->get_where('categoria', array('id'=> $id), 1);
				$result = $query->row();
			}
			else{
				$where =array();
				$like = array();
				if ($this->input->get()) {
					if ($this->input->get('q')) {
						$like['categoria.nome'] =$this->input->get('q');
					}
					if ($this->input->get('d')) {
						$where['departamento.id'] =$this->input->get('d');
					}
				}
				$query = $this->db->select('categoria.*,departamento.nome as departamento_nome')
								  ->from('categoria')
								  ->join('departamento','categoria.departamento_id = departamento.id')
								  ->where($where)
								  ->like($like)
								  ->order_by('nome ASC')
								  ->get();
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }

	     public function save(){
	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') ),
	    		'departamento_id'   	=> strip_tags( $this->input->post('departamento_id') )
	    	);

	    	

	    	$query = $this->db->insert('categoria', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }


	    public function update($id)
	    {

	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') ),
	    		'departamento_id'   	=> strip_tags( $this->input->post('departamento_id') )
	    	);

			return $this->db->update('categoria', $dados, array( "id" => $id ));
	    	
	    }

	    public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('categoria');

		}



		public function modificar_ordem_objetos(){
			$ordem  = $this->input->get();			
			$count = 1;

			foreach ($ordem['ordem'] as $ord => $value) {
				$this->db->update('categoria', array('ordem' => $count ), array( "id" => $value ));
				$count ++;
								
			}
		}



		 public function porDepartamento($departamento)
	    {

			
			$query = $this->db->select('categoria.*,departamento.nome as departamento_nome')
							  ->from('categoria')
							  ->join('departamento','categoria.departamento_id = departamento.id')
							  ->where('categoria.departamento_id',$departamento)
							  ->order_by('nome ASC')
							  ->get();
			$result = $query->result();
			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }






	}
?>