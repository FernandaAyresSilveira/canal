<?php

	class Subcategoria_model extends  CI_model{

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
				$query = $this->db->get_where('subcategoria', array('id'=> $id), 1);
				$result = $query->row();
			}
			else{
				$where =array();
				$like = array();
				if ($this->input->get()) {
					if ($this->input->get('q')) {
						$like['subcategoria.nome'] =$this->input->get('q');
					}
					if ($this->input->get('d')) {
						$where['departamento.id'] =$this->input->get('d');
					}
				}
				$query = $this->db->select('subcategoria.*,departamento.nome as departamento_nome,
															  categoria.nome as categoria_nome')
								  ->from('subcategoria')
								  ->join('categoria','subcategoria.categoria_id = categoria.id','left')
								  ->join('departamento','categoria.departamento_id = departamento.id','left')
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
	    		'categoria_id'   	=> strip_tags( $this->input->post('categoria_id') )
	    	);

	    	

	    	$query = $this->db->insert('subcategoria', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }


	    public function update($id)
	    {

	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') ),
	    		'categoria_id'   	=> strip_tags( $this->input->post('categoria_id') )
	    	);

			return $this->db->update('subcategoria', $dados, array( "id" => $id ));
	    	
	    }

	    public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('subcategoria');

		}



		public function modificar_ordem_objetos(){
			$ordem  = $this->input->get();			
			$count = 1;

			foreach ($ordem['ordem'] as $ord => $value) {
				$this->db->update('subcategoria', array('ordem' => $count ), array( "id" => $value ));
				$count ++;
								
			}
		}



		 public function porCategoria($categoria)
	    {

			
			$query = $this->db->select('subcategoria.*,categoria.nome as categoria_nome')
							  ->from('subcategoria')
							  ->join('categoria','subcategoria.categoria_id = categoria.id')
							  ->where('subcategoria.categoria_id',$categoria)
							  ->order_by('nome ASC')
							  ->get();
			$result = $query->result();
			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }






	}
?>