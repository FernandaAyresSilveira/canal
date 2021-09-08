<?php

	class Venda_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	        $lastInsertId;
	    }

	    public function get($id = false)
		{

			if($id){ 
				$query  = $this->db->select('venda.*, status_venda.nome as status_pedido_nome,
											cliente.nome as cliente_nome,
											cliente.sobrenome as cliente_sobrenome,
											 cliente.cpf as cliente_cpf,
											cliente.telefone as cliente_telefone,
											cliente.celular as cliente_celular,
											cliente.email as cliente_email' ) 
								   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
								   ->join('cliente','venda.cliente_id = cliente.id','left')
								   ->where('venda.id',$id)
								   ->get('venda');
				$result = $query->row();
			}
			else{
				$query  = $this->db->select('venda.*, status_venda.nome as status_venda_nome' ) 
								   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
								   ->get('venda');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

		public function itens($id = false)
	    {
	    	if ($id) {
	    		$query = $this->db->select('item.*,anuncio.nome as item_nome,anuncio.id as anuncio_id,
	    									anuncio.referencia as item_referencia, anuncio.peso as item_peso,
	    									anuncio.imagem1 as item_imagem1')
							  ->from('item')
							  ->join('anuncio','item.anuncio_id = anuncio.id')
							  ->order_by('anuncio.referencia','asc')
							  ->order_by('anuncio.nome','asc')
							  ->where('item.venda_id',$id)
							  ->get();
				$result = $query->result();
	    	}else{
	    		$query = $this->db->select('item.*,anuncio.nome as item_nome,anuncio.id as anuncio_id,
	    									anuncio.referencia as item_referencia')
							  ->from('item')
							  ->join('anuncio','item.anuncio_id = anuncio.id')
							  ->where('item.venda_id',$this->session->userdata('session_id'))
							  ->order_by('anuncio.referencia','asc')
							  ->order_by('anuncio.nome','asc')
							  ->get();
				$result = $query->result();

	    	}

			

			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }


		

		
		public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;

			$where = array();
			$like = array();

			if ($this->input->get('status')) {
				$where['status_venda_id'] = $this->input->get('status');
			}

			if ($this->input->get('cliente')) {
				$like['cliente.nome'] = $this->input->get('cliente');
			}

			if ($this->input->get('data')) {
				$where['data >='] = converter_data($this->input->get('data'))." 00:00:00";
				$where['data <='] = converter_data($this->input->get('data'))." 23:59:59";
			}


			$query  = $this->db->select('venda.*, status_venda.nome as status_venda_nome,
										cliente.nome as cliente_nome,cliente.sobrenome as cliente_sobrenome, status_venda.nome as status_pedido_nome' ) 
							   ->from('venda')
							   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
							   ->join('cliente','venda.cliente_id= cliente.id','left')						   
							   ->where($where)
							   ->where('status_venda_id !=',null)
							   ->like($like)
							   ->order_by('venda.data_fechamento','desc')
							   ->limit($i, $first)
							   ->get();
			$result = $query->result();

			//contator
			$query1  = $this->db->select('venda.*, status_venda.nome as status_venda_nome' ) 
							   ->from('venda')
							   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
							   ->join('cliente','venda.cliente_id= cliente.id','left')
							   ->where($where)
							   ->where('status_venda_id !=',null)
							   ->like($like)
							   ->get();
			$result1 = $query1->result();

			$this->data  = $result;
			$this->count = count($result1);

			return $this->data;
		
		}



		public function get_paginate_nao_finalizados($p = null, $i = null){

			$first = ($i*$p)-$i;

			$where = array();
			$like = array();

			if ($this->input->get('status')) {
				$where['status_venda_id'] = $this->input->get('status');
			}

			if ($this->input->get('cliente')) {
				$like['cliente.nome'] = $this->input->get('cliente');
			}

			if ($this->input->get('data')) {
				$where['data >='] = converter_data($this->input->get('data'))." 00:00:00";
				$where['data <='] = converter_data($this->input->get('data'))." 23:59:59";
			}


			$query  = $this->db->select('venda.*, status_venda.nome as status_venda_nome,
										cliente.nome as cliente_nome, cliente.sobrenome as cliente_sobrenome, status_venda.nome as status_pedido_nome' ) 
							   ->from('venda')
							   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
							   ->join('cliente','venda.cliente_id= cliente.id','left')						   
							   ->where($where)
							   ->where('status_venda_id ',null)
							   ->like($like)
							   ->order_by('venda.id','desc')
							   ->limit($i, $first)
							   ->get();
			$result = $query->result();

			//contator
			$query1  = $this->db->select('venda.*, status_venda.nome as status_venda_nome' ) 
							   ->from('venda')
							   ->join('status_venda','venda.status_venda_id= status_venda.id','left')
							   ->join('cliente','venda.cliente_id= cliente.id','left')
							   ->where($where)
							   ->where('status_venda_id ',null)
							   ->like($like)
							   ->get();
			$result1 = $query1->result();

			$this->data  = $result;
			$this->count = count($result1);

			return $this->data;
		
		}


		

		 public function detalheItem($item)
		{

			$query  = $this->db->select('item_venda.*, 
										 quantidade.item_id as quantidade_item_id,
										 item.nome as item_nome,
										 quantidade.tamanho as quantidade_tamanho,
										 venda.cliente_id as cliente_id' ) 
							   ->from('item_venda')
							   ->join('quantidade','item_venda.quantidade_id = quantidade.id ')
							   ->join('item','quantidade.item_id = item.id')
							   ->join('venda','item_venda.venda_id = venda.id')
							   ->where('item_venda.id',$item)
							   ->get();
			$result = $query->row();

			$this->count = sizeof($result);
	        return $result;

		}

	



		public function  status_venda($venda,$status){

			
			$dados = array( 
				'status_venda_id' => $status
			);

			return $this->db->update('venda', $dados, array( "id" => $venda ));

		}

		public function  codigo_rastreio($venda,$codigo_ratreio){

			
			$dados = array( 
				'codigo_rastreio' => $codigo_ratreio
			);

			return $this->db->update('venda', $dados, array( "id" => $venda ));

		}


		

	   


	    



	     public function detalhes_venda(){
			$dados = array();
			$dados['session_id'] = $this->session->userdata('session_id');

			$retorno = '';

			//verifica se a sessão é a mesma do usuário

			$queryy = $this->db->select('venda.*')
							   ->from('venda')
							   //->where('cliente_id',$dados['cliente_id'])
							   ->where('session_id',$dados['session_id'])
							   ->where('status_venda_id',null)
							   ->get();
			return $res = $queryy->row();
		}



		public function getClienteProduto($id)
		{
			$query  = $this->db->select('venda.*, status_venda.nome as status_pedido_nome,cliente.nome as cliente_nome, cliente.sobrenome as cliente_sobrenome' ) 
							   ->join('status_venda','venda.status_venda_id= status_venda.id')
							   ->join('cliente','venda.cliente_id = cliente.id')
							   ->where('venda.cliente_id',$id)
							   ->get('venda');
			$result = $query->result();			

			$this->count = sizeof($result);
	        return $result;

		}








		public function  cancelar_venda_reativar_anuncios($venda){

			
			$dados = array( 
				'status_venda_id' => 6//cancelando
			);

			$this->db->update('venda', $dados, array( "id" => $venda ));

			$itens = $this->itens($venda);

			//var_dump($itens);die;

			foreach ($itens as $item) {



				$dados_reativar = array(
					'finalizado'		=> 0
				);
				$this->db->update('anuncio', $dados_reativar, array( "id" => $item->anuncio_id ));

				//echo $item->anuncio_id;die;
			}

		}

		public function  embalagem($venda){

			$retorno = 'nada';

			$queryy = $this->db->select('venda.*')
							   ->from('venda')
							   ->where('id',$venda)
							   ->get();
			$v = $queryy->row();

			if ($v->embalagem==1) {
				$this->db->update('venda',array('embalagem' =>0), array( "id" => $venda ));
				$retorno = 0;
			}else{
				$this->db->update('venda',array('embalagem' =>1), array( "id" => $venda ));
				$retorno = 1;
			}

			return $retorno;


		}


		public function  aviso_aguard_pag($venda){

			$retorno = 'nada';

			$queryy = $this->db->select('venda.*')
							   ->from('venda')
							   ->where('id',$venda)
							   ->get();
			$v = $queryy->row();

			if ($v->email_aguard_pag==1) {
				$this->db->update('venda',array('email_aguard_pag' =>0), array( "id" => $venda ));
				$retorno = 0;
			}else{
				$this->db->update('venda',array('email_aguard_pag' =>1), array( "id" => $venda ));
				$retorno = 1;
			}

			return $retorno;


		}












		

	}
?>