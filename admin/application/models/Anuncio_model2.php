<?php

	class Anuncio_model extends CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $data;
	        $count;
	        $lastInsertId;
	    }

	    public function lastInsertId(){
	    	return $this->lastInsertId;
	    }

	    public function save(){
	    	$dados = array(
				'modelo' 			=>  'r',//raul
				'nome' 				=>  ucwords( strip_tags( $this->input->post('nome') ) ),
				'valor' 			=> formatar_valor(strip_tags( $this->input->post('valor') ) ),
				'descricao' 		=> trim( $this->input->post('descricao') ),
				'promocao' 			=> strip_tags( $this->input->post('promocao') ) ? 1 : 0,
				'valor_promocional' => formatar_valor(strip_tags( $this->input->post('valor_promocional') ) ),
				'novo' 				=> strip_tags( $this->input->post('novo') ) ? 1 : 0,
				'destaque' 			=> strip_tags( $this->input->post('destaque') ) ? 1 : 0,
				'colecoes' 			=> strip_tags( $this->input->post('colecoes') ) ? 1 : 0,
				'miniseries' 		=> strip_tags( $this->input->post('miniseries') ) ? 1 : 0,
				'somente_pac'  		=> strip_tags( $this->input->post('somente_pac') ) ? 1 : 0,
				'lombada'			=> strip_tags( $this->input->post('lombada') ),
				'capa'				=> strip_tags( $this->input->post('capa') ),
				'cor'				=> strip_tags( $this->input->post('cor') ),
				'departamento_id'	=> strip_tags( $this->input->post('departamento_id') ),
				'categoria_id'		=> strip_tags( $this->input->post('categoria_id') ),
				'subcategoria_id'	=> strip_tags( $this->input->post('subcategoria_id') ),
				'editora_id'		=> strip_tags( $this->input->post('editora_id') ),
				'referencia'		=> strip_tags( $this->input->post('referencia') ),
				'ano_id'		=> strip_tags( $this->input->post('ano_id') ),


				'comprimento'		=> strip_tags( $this->input->post('comprimento') ),
				'largura'			=> strip_tags( $this->input->post('largura') ),
				'altura'			=> strip_tags( $this->input->post('altura') ),
				'peso'				=> strip_tags( $this->input->post('peso') ),

			);

	    	$query = $this->db->insert('anuncio', $dados);
	    	$this->lastInsertId = $this->db->insert_id();
	    	$id = $this->lastInsertId ;


	    	$queryy = $this->db->select('anuncio.*, editora.nome as editora_nome, ano.ano as ano_ano')
							  ->from('anuncio')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->join('ano','anuncio.ano_id = ano.id','left')
							  ->where('anuncio.id',$id);

			$queryy = $queryy->get()->first_row();


			//dados
			$busca = $queryy->nome.' '. $queryy->descricao.' editora '.$queryy->editora_nome.' ano '.$queryy->ano_ano;
			$dados['busca'] = $busca;

			$this->db->update('anuncio', $dados, array( "id" => $id ));
			



			return $query;
	    }

	    public function total_anuncios(){
	    	$query = $this->db->where('tipo','n')->where('finalizado',0)->where('modelo','r')->get('anuncio');
			$result = $query->num_rows();

			return $result;
	    }

	    public function get($id=false)
	    {
 
	    	if($id)
			{
				$query = $this->db->select('anuncio.*,departamento.nome as departamento_nome,editora.nome as editora_nome')
								  ->from('anuncio')
								  ->join('departamento','anuncio.departamento_id = departamento.id','left')
								  ->join('editora','anuncio.editora_id = editora.id','left')
								  ->where('anuncio.id',$id)  
								  ->get();
				$result = $query->row();
			}
			else{
				$where = array();
				$like = array();

				if ($this->input->get()) {
					if ($this->input->get('q')) {
						$like['anuncio.nome'] = $this->input->get('q'); 
					}
					if ($this->input->get('d')) {
						$where['anuncio.departamento_id'] = $this->input->get('d');
					}
				}
				$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
														categoria.nome as categoria_nome,
														subcategoria.nome as subcategoria_nome,
														editora.nome as editora_nome')
								  ->from('anuncio')
								  ->join('departamento','anuncio.departamento_id = departamento.id','left')
								  ->join('categoria','anuncio.categoria_id = categoria.id','left')
								  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
								  ->join('editora','anuncio.editora_id = editora.id','left')
								  ->like($like)
								  ->where($where)
								  ->get();

				$result = $query->result();
			}

			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }

	     public function get_paginate($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				if ($this->input->get('q')) {
					$like['anuncio.nome'] = $this->input->get('q'); 
				}
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
				if ($this->input->get('c') && $this->input->get('c')!= 'Selecione a categoria') {
					$where['anuncio.categoria_id'] = $this->input->get('c');
				}
				if ($this->input->get('sub') && $this->input->get('sub')!='Selecione a subcategoria') {
					$where['anuncio.subcategoria_id'] = $this->input->get('sub');
				}
			}


			$busca = $this->input->get('q');

			$like = strtoupper($busca);

			$busca = explode(' ', $like);

			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('modelo','r');
					  $this->db->where('finalizado','0');
					   $this->db->order_by("LENGTH(anuncio.nome) asc");
					 $this->db->order_by("anuncio.nome  asc");
			 		  $this->db->limit($i, $first);
					  $query = $this->db->get();
					  $result = $query->result();

			 		 $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('modelo','r');
					  $this->db->where('finalizado','0');
					   $this->db->order_by("LENGTH(anuncio.nome) asc");
					 $this->db->order_by("anuncio.nome  asc");
					  $total = $this->db->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }


	      public function get_paginate_promocaodia($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				if ($this->input->get('q')) {
					$like['anuncio.nome'] = $this->input->get('q'); 
				}
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}


			$busca = $this->input->get('q');

			$like = strtoupper($busca);

			$busca = explode(' ', $like);

			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('finalizado','0');
					  $this->db->where('promocaodia','1');
			 		  $this->db->limit($i, $first);
					  $query = $this->db->get();
					  $result = $query->result();

			 		 $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('finalizado','0');
					  $this->db->where('promocaodia','1');
					  $total = $this->db->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }



	      public function get_paginate_promocao($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				if ($this->input->get('q')) {
					$like['anuncio.nome'] = $this->input->get('q'); 
				}
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}


			$busca = $this->input->get('q');

			$like = strtoupper($busca);

			$busca = explode(' ', $like);

			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('modelo','r');
					  $this->db->where('finalizado','0');
					  $this->db->where('promocao','1');
					 // $this->db->order_by('cast(anuncio.nome as UNSIGNED) desc');
					 $this->db->order_by("LENGTH(anuncio.nome) asc");
					 $this->db->order_by("anuncio.nome  asc");
			 		  $this->db->limit($i, $first);
					  $query = $this->db->get();
					  $result = $query->result();

			 		 $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('modelo','r');
					  $this->db->where('promocao','1');
					  $this->db->where('finalizado','0');
					  $this->db->order_by('nome','asc');
					  $total = $this->db->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }

	    public function update($id)
	    {

	    	$dados = array(
	    		'modelo' 			=>  'r',//raul
				'nome' 				=> ucwords ( strip_tags( $this->input->post('nome') ) ),
				'valor' 			=> formatar_valor(strip_tags( $this->input->post('valor') ) ),
				'descricao' 		=> trim( $this->input->post('descricao') ),
				'promocao' 			=> strip_tags( $this->input->post('promocao') ) ? 1 : 0,
				'valor_promocional' => formatar_valor(strip_tags( $this->input->post('valor_promocional') ) ),
				'novo' 				=> strip_tags( $this->input->post('novo') ) ? 1 : 0,
				'destaque' 			=> strip_tags( $this->input->post('destaque') ) ? 1 : 0,
				'colecoes' 			=> strip_tags( $this->input->post('colecoes') ) ? 1 : 0,
				'miniseries' 		=> strip_tags( $this->input->post('miniseries') ) ? 1 : 0,
				'somente_pac' 		=> strip_tags( $this->input->post('somente_pac') ) ? 1 : 0,
				'lombada'			=> strip_tags( $this->input->post('lombada') ),
				'cor'				=> strip_tags( $this->input->post('cor') ),
				'capa'				=> strip_tags( $this->input->post('capa') ),
				'departamento_id'	=> strip_tags( $this->input->post('departamento_id') ),
				'categoria_id'		=> strip_tags( $this->input->post('categoria_id') ),
				'subcategoria_id'	=> strip_tags( $this->input->post('subcategoria_id') ),
				'editora_id'		=> strip_tags( $this->input->post('editora_id') ),
				'referencia'		=> strip_tags( $this->input->post('referencia') ),
				'ano_id'			=> strip_tags( $this->input->post('ano_id') ),


				'comprimento'		=> strip_tags( $this->input->post('comprimento') ),
				'largura'			=> strip_tags( $this->input->post('largura') ),
				'altura'			=> strip_tags( $this->input->post('altura') ),
				'peso'				=> strip_tags( $this->input->post('peso') ),

				'promocaodia' 			=> strip_tags( $this->input->post('promocaodia') ) ? 1 : 0,
				'recompensa'		=> strip_tags( $this->input->post('recompensa') )

			);

			$this->db->update('anuncio', $dados, array( "id" => $id ));

			$queryy = $this->db->select('anuncio.*, editora.nome as editora_nome, ano.ano as ano_ano')
							  ->from('anuncio')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->join('ano','anuncio.ano_id = ano.id','left')
							  ->where('anuncio.id',$id)->get()->row();


			//dados
			$busca = $queryy->nome.' '. $queryy->descricao.' editora '.$queryy->editora_nome.' ano '.$queryy->ano_ano;
			$dados['busca'] = $busca;

			$this->db->update('anuncio', $dados, array( "id" => $id ));

			return true;


			
	    	
	    }

	    public function setImagem($id, $campo,$imagem)
		{
			$dados = array(
				$campo	 => $imagem	);
			$where = array('id' => $id);

			return $this->db->update('anuncio', $dados, $where);
		}


		 public function duplicar($nome,$valor,$descricao,$promocao,$valor_promocional,
		 						  $novo,$destaque,$departamento_id,$categoria_id,
		 						  $subcategoria_id,$editora_id,$lombada,$cor,
		 						  $referencia,$ano_id,$comprimento,$largura,$altura,$peso,$capa ,$somente_pac,
		 						  $imagem1,  $imagem2, $imagem3, $imagem4, $imagem5){ 
	    	$dados = array(
	    		'modelo'			=> 'r',
				'nome' 				=> $nome,
				'valor' 			=> $valor,
				'descricao' 		=> $descricao,
				'promocao' 			=> $promocao,
				'valor_promocional' => $valor_promocional,
				'novo' 				=> 0,
				'destaque' 			=> 0,
				'departamento_id'	=> $departamento_id,
				'categoria_id'		=> $categoria_id,
				'subcategoria_id'	=> $subcategoria_id,
				'editora_id'		=> $editora_id,
				'lombada'			=> $lombada,
				'cor'				=> $cor,
				'referencia'		=> $referencia,
				'ano_id'			=> $ano_id,
				'somente_pac'		=> $somente_pac,


				'comprimento'		=> $comprimento,
				'largura'			=> $largura,
				'altura'			=> $altura,
				'peso'				=> $peso,
				'capa'				=> $capa,
				'imagem1'			=> $imagem1,
				'imagem2'			=> $imagem2,
				'imagem3'			=> $imagem3,
				'imagem4'			=> $imagem4,
				'imagem5'			=> $imagem5,


			);

	    	$query = $this->db->insert('anuncio', $dados);
	    	$this->lastInsertId = $this->db->insert_id();

			return $query;
	    }



		public function delete($id)
		{

			$this->db->where('id', $id);
        	return $this->db->delete('anuncio');

		}

		public function modificar_ordem_objetos(){
			$ordem  = $this->input->get();			
			$count = 1;

			foreach ($ordem['ordem'] as $ord => $value) {
				$this->db->update('anuncio', array('ordem' => $count ), array( "id" => $value ));
				$count ++;
								
			}
		}


		 public function cadastrar_categoria_departamento($dep,$cat){
	    	$dados = array(
	    		'nome'   				=> $cat,
	    		'departamento_id'   	=> $dep
	    	);
    	

	    	$query = $this->db->insert('categoria', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $this->lastInsertId;
	    }

	     public function cadastrar_subcategoria_categoria($cat,$sub){
	    	$dados = array(
	    		'nome'   			=> $sub,
	    		'categoria_id'   	=> $cat
	    	);    	

	    	$query = $this->db->insert('subcategoria', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $this->lastInsertId;
	    }

	     public function cadastrar_editora($edi){
	    	$dados = array(
	    		'nome'   				=> $edi
	    	);	    	

	    	$query = $this->db->insert('editora', $dados);
	    	
	    	$this->lastInsertId = $this->db->insert_id();

			return $this->lastInsertId;
	    }



	 public function  ajuste_coluna(){

		$query = $this->db->select('anuncio.*, editora.nome as editora_nome, ano.ano as ano_ano')
							  ->from('anuncio')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->join('ano','anuncio.ano_id = ano.id','left')
							  ->where('busca',null)
							  ->limit(100)
							  ->get();

		foreach ($query->result() as $anuncio) {

			//dados
			$busca = $anuncio->nome.' '. $anuncio->descricao.' editora '.$anuncio->editora_nome.' ano '.$anuncio->ano_ano;
			$dados['busca'] = $busca;

			$this->db->update('anuncio', $dados, array( "id" => $anuncio->id ));
			echo $anuncio->id.' - '.$busca.'<br>';
			
		}
	}

	


	public function finalizar()
	    {


	    	foreach ($this->input->post('anuncio') as $a) {
	    		$dados = array( 'finalizado' => '1');

			    $this->db->update('anuncio', $dados, array( "id" => $a ));
	    	}
	    	
	    }

	    public function novo_valor()
	    {


	    	foreach ($this->input->post('anuncio') as $a) {
	    		$dados = array( 'valor' => formatar_valor($this->input->post('novo_valor')) );

			    $this->db->update('anuncio', $dados, array( "id" => $a ));
	    	}
	    	
	    }

	    public function aplicar_promo()
	    {

	    	foreach ($this->input->post('anuncio') as $a) {

	    		//um por um
	    		$query = $this->db->select('anuncio.*,departamento.nome as departamento_nome,editora.nome as editora_nome')
								  ->from('anuncio')
								  ->join('departamento','anuncio.departamento_id = departamento.id','left')
								  ->join('editora','anuncio.editora_id = editora.id','left')
								  ->where('anuncio.id',$a)  
								  ->get();
				$r = $query->row();

				$valor_normal= $r->valor;
				$recompensa = $this->input->post('recompensa');
				$valor_promocional = $valor_normal - (($valor_normal*$recompensa)/100);
				$valor_promocional = $valor_promocional;

	    		$dados = array( 
	    			'recompensa' 		=> $recompensa,
	    			'promocao'	 		=> 1,
	    			'valor_promocional' => $valor_promocional
	    		);

			    $this->db->update('anuncio', $dados, array( "id" => $a ));
	    	}
	    	
	    }

	     public function desativar_promo()
	    {

	    	foreach ($this->input->post('anuncio') as $a) {

	    		//um por um
	    		$query = $this->db->select('anuncio.*,departamento.nome as departamento_nome,editora.nome as editora_nome')
								  ->from('anuncio')
								  ->join('departamento','anuncio.departamento_id = departamento.id','left')
								  ->join('editora','anuncio.editora_id = editora.id','left')
								  ->where('anuncio.id',$a)  
								  ->get();
				$r = $query->row();

				$valor_normal= $r->valor;

	    		$dados = array( 
	    			'recompensa' 		=> 0,
	    			'promocao'	 		=> 0,
	    			'valor_promocional' => 0
	    		);

			    $this->db->update('anuncio', $dados, array( "id" => $a ));
	    	}
	    	
	    }



	    public function  pedidos_aguardando(){

			$query = $this->db->select('venda.*')
								  ->from('venda')
								  ->where('status_venda_id',1)
								  ->count_all_results();

			return $query;
		}

		public function  lista_pedidos_aguardando(){

			$query = $this->db->select('venda.*, cliente.nome as cliente_nome, cliente.email as cliente_email ')
								  ->from('venda')
								  ->join('cliente','venda.cliente_id = cliente.id','left')
								  ->where('status_venda_id',1)
								  ->get();

			return $query->result();
		}

		public function  pedidos_pagos(){

			$query = $this->db->select('venda.*')
								  ->from('venda')
								  ->where('status_venda_id',2)
								  ->count_all_results();

			return $query;
		}
		public function  pedidos_enviados(){

			$query = $this->db->select('venda.*')
								  ->from('venda')
								  ->where('status_venda_id',4)
								  ->count_all_results();

			return $query;
		}
		public function  pedido_revistaria(){

			$query = $this->db->select('venda.*')
								  ->from('venda')
								  ->where('status_venda_id',3)
								  ->count_all_results();

			return $query;
		}
		//destaques

		 public function destaques()
	    {
 
	    	
				$where = array();
				$like = array();

				if ($this->input->get()) {
					if ($this->input->get('q')) {
						$like['anuncio.nome'] = $this->input->get('q'); 
					}
					if ($this->input->get('d')) {
						$where['anuncio.departamento_id'] = $this->input->get('d');
					}
				}

				
				$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
														categoria.nome as categoria_nome,
														subcategoria.nome as subcategoria_nome,
														editora.nome as editora_nome')
								  ->from('anuncio')
								  ->join('departamento','anuncio.departamento_id = departamento.id','left')
								  ->join('categoria','anuncio.categoria_id = categoria.id','left')
								  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
								  ->join('editora','anuncio.editora_id = editora.id','left')
								  ->where('anuncio.tipo','n')
								  ->where('anuncio.destaque','1')
								  ->where('anuncio.finalizado','0')
								  ->like($like)
								  ->where($where)
								  ->get();

				$result = $query->result();
			

			$this->data = $result;
			$this->count = count($result);
	        return $result;

	    }


	    /*  public function get_paginate_finalizados($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				if ($this->input->get('q')) {
					$like['anuncio.nome'] = $this->input->get('q'); 
				}
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}
			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome,
													item.id as item_id,
													item.valor as item_valor,
													venda.id as venda_id,
													status_venda.nome as status_venda_nome')
							  ->from('anuncio')
							  ->join('departamento','anuncio.departamento_id = departamento.id','left')
							  ->join('categoria','anuncio.categoria_id = categoria.id','left')
							  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->join('item','item.anuncio_id = anuncio.id')
							  ->join('venda','item.venda_id = venda.id and venda.status_venda_id < 6')
							  ->join('status_venda','venda.status_venda_id = status_venda.id')
							  ->like($like)
							  ->where($where)
							  ->where('tipo','n')
							  ->where('finalizado','1')
							  ->limit($i, $first)
							  ->get();

			$result = $query->result();

			$total = $query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome')
							  ->from('anuncio')
							  ->join('departamento','anuncio.departamento_id = departamento.id','left')
							  ->join('categoria','anuncio.categoria_id = categoria.id','left')
							  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->join('item','item.anuncio_id = anuncio.id')
							  ->join('venda','item.venda_id = venda.id and venda.status_venda_id < 6')
							  ->join('status_venda','venda.status_venda_id = status_venda.id')
							  ->like($like)
							  ->where($where)
							  ->where('tipo','n')
							   ->where('finalizado','1')
							  ->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }*/

	       public function get_paginate_finalizados_venda($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				// if ($this->input->get('q')) {
				// 	$like['anuncio.nome'] = $this->input->get('q'); 
				// }
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}

			$busca = $this->input->get('q');

			$like = strtoupper($busca);

			$busca = explode(' ', $like);


			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome,
													item.id as item_id,
													item.valor as item_valor,
													venda.id as venda_id,
													status_venda.nome as status_venda_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  $this->db->join('item','item.anuncio_id = anuncio.id');
					  $this->db->join('venda','item.venda_id = venda.id');
					  $this->db->join('status_venda','venda.status_venda_id = status_venda.id');
					 // $this->db->like($like);
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('finalizado','1');
					  $this->db->where('venda.status_venda_id <','6');
					  $this->db->limit($i, $first);
			$query = $this->db->get();
			$result = $query->result();

			$total = $query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome,
													item.id as item_id,
													item.valor as item_valor,
													venda.id as venda_id,
													status_venda.nome as status_venda_nome');
					  $this->db->from('anuncio');
					  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
					  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
					  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
					  $this->db->join('editora','anuncio.editora_id = editora.id','left');
					  $this->db->join('item','item.anuncio_id = anuncio.id');
					  $this->db->join('venda','item.venda_id = venda.id');
					  $this->db->join('status_venda','venda.status_venda_id = status_venda.id');
					 // $this->db->like($like);
					  if ($this->input->get('q')!='') {
					  foreach($busca as $c){             
            			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
         			  }}
					  $this->db->where($where);
					  $this->db->where('tipo','n');
					  $this->db->where('finalizado','1');
					  $this->db->where('venda.status_venda_id <','6');
					  $total = $this->db->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }

	       public function get_paginate_finalizados($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;


			$busca = $this->input->get('q');

			$like = strtoupper($busca);

			$busca = explode(' ', $like);


			if ($this->input->get()) {
				// if ($this->input->get('q')) {
				// 	$like['anuncio.nome'] = $this->input->get('q'); 
				// }
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}
			  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome,
													');
			  $this->db->from('anuncio');
			  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
			  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
			  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
			  $this->db->join('editora','anuncio.editora_id = editora.id','left');					 
			  //->like($like)
			  if ($this->input->get('q')!='') {
				  foreach($busca as $c){             
        			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
     		  }}
			  $this->db->where($where);
			  $this->db->where('tipo','n');
			  $this->db->where('finalizado','1');
			  $this->db->limit($i, $first);
			  $query =  $this->db->get();

			  $result = $query->result();

			  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome');
			  $this->db->from('anuncio');
			  $this->db->join('departamento','anuncio.departamento_id = departamento.id','left');
			  $this->db->join('categoria','anuncio.categoria_id = categoria.id','left');
			  $this->db->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left');
			  $this->db->join('editora','anuncio.editora_id = editora.id','left');
			 
			  //->like($like)
			  if ($this->input->get('q')!='') {
				  foreach($busca as $c){             
        			$this->db->like("UPPER(anuncio.busca)",strtoupper($c),'both');            
     		  }}
			  $this->db->where($where);
			  $this->db->where('tipo','n');
			  $this->db->where('finalizado','1');
			  $total = $this->db->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }


	        public function get_paginate_visualizados($p = null, $i = null)
	    {
 
	    	
			$where = array();
			$like = array();

			$first = ($i*$p)-$i;

			if ($this->input->get()) {
				if ($this->input->get('q')) {
					$like['anuncio.nome'] = $this->input->get('q'); 
				}
				if ($this->input->get('d')) {
					$where['anuncio.departamento_id'] = $this->input->get('d');
				}
			}
			$query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome')
							  ->from('anuncio')
							  ->join('departamento','anuncio.departamento_id = departamento.id','left')
							  ->join('categoria','anuncio.categoria_id = categoria.id','left')
							  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->like($like)
							  ->where($where)
							  ->where('tipo','n')
							  ->where('visualizado >','0')
							 // ->where('finalizado','0')
							  ->limit($i, $first)
							  ->order_by('visualizado','desc')
							  ->get();

			$result = $query->result();

			$total = $query =  $this->db->select('anuncio.*,departamento.nome as departamento_nome,
													categoria.nome as categoria_nome,
													subcategoria.nome as subcategoria_nome,
													editora.nome as editora_nome')
							  ->from('anuncio')
							  ->join('departamento','anuncio.departamento_id = departamento.id','left')
							  ->join('categoria','anuncio.categoria_id = categoria.id','left')
							  ->join('subcategoria','anuncio.subcategoria_id = subcategoria.id','left')
							  ->join('editora','anuncio.editora_id = editora.id','left')
							  ->like($like)
							  ->where($where)
							  ->where('tipo','n')
							  ->where('visualizado >','0')
							  // ->where('finalizado','0')
							  ->count_all_results();

			$this->data = $result;
			$this->total = $total;
			$this->count = count($result);
	        return $result;

	    }



	    public function deletar_foto($id, $coluna)
		{
			if ($coluna==1) { $dados = array( 'imagem1'	 => null	);}	
			if ($coluna==2) { $dados = array( 'imagem2'	 => null	);}	
			if ($coluna==3) { $dados = array( 'imagem3'	 => null	);}	
			if ($coluna==4) { $dados = array( 'imagem4'	 => null	);}	
			if ($coluna==5) { $dados = array( 'imagem5'	 => null	);}	
			
			$where = array('id' => $id);

			return $this->db->update('anuncio', $dados, $where);
		}











	}

?>