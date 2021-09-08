<?php

	class Avaliacao_model extends CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function get($id=false)
	    {

	    	if ($id) {
	    		$query = $query = $this->db->select('avaliacao.*, cliente.nome as cliente_nome, cliente.sobrenome as cliente_sobrenome')
	    					      ->from('avaliacao')
	    					      ->join('cliente','avaliacao.cliente_id = cliente.id','left')
	    						  ->order_by('avaliacao.data desc')
	    						  ->where('avaliacao.id',$id)
								  ->get();
				$result = $query->row();
	    	}else{
	    		$query = $this->db->select('avaliacao.*, cliente.nome as cliente_nome, cliente.sobrenome as cliente_sobrenome')
	    					      ->from('avaliacao')
	    					      ->join('cliente','avaliacao.cliente_id = cliente.id','left')
	    						  ->order_by('avaliacao.data desc')
								  ->get();
				$result = $query->result();
	    	}
	    	
			
			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }

	     public function save(){
	    	$dados = array(
	    		'nome'   				=> strip_tags( $this->input->post('nome') )
	    	);    	

	    	$query = $this->db->insert('avaliacao', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }


	    public function update($id)
	    {

	    	$dados = array(
	    		'liberado'   				=> strip_tags( $this->input->post('liberado') )
	    	);

			return $this->db->update('avaliacao', $dados, array( "id" => $id ));
	    	
	    }

	    public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('avaliacao');

		}


		  public function novas($id=false)
	    {
	    		$query = $query = $this->db->select('avaliacao.*')
	    					      ->from('avaliacao')
	    						  ->order_by('avaliacao.data desc')
	    						  ->where('avaliacao.liberado',0);
				return $result = $query->count_all_results();
		}

	   




	}

?>