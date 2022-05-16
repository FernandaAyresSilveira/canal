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
            $query = $this->db->select('categoria.*,departamento.nome as departamento_nome')
								  ->from('categoria')
								  ->order_by('nome ASC')
								  ->get();
				$result = $query->result();
			}

			$this->data = $result;
			$this->count = sizeof($result);
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