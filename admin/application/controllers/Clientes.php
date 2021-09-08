<?php
	class Clientes extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Cliente_model', 'cliente');
			$this->load->model('Venda_model', 'pedido');
		}

		public function index() {

			redirect("clientes/listar");
		}

		/* ==================== LISTAR ==================== */
		public function listar()
		{

			$i = 20;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['clientes'] = $this->cliente->get_paginate($p, $i);

			$total = $this->cliente->count;
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('clientes/listar').'?q='.$this->input->get('q') : site_url('clientes/listar?g=1');
			$config['total_rows'] 			= $total;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);


			$data['total'] = $total;

			$this->load->view('estrutura/topo');
			$this->load->view('clientes/listar', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */
		public function editar() {

			$id = $this->uri->segment(3);
			$data['objeto'] = $this->cliente->get($id);

			if(count($data['objeto']) == 0 )
				redirect("clientes");

			$data['pedidos'] = $this->pedido->getClienteProduto($id);
			
			$this->load->view('estrutura/topo');
			$this->load->view('clientes/editar', $data);
			$this->load->view('estrutura/rodape');			
		}

		public function funcao_editar() {

			if($this->input->post()) {

				$this->cliente->update($this->uri->segment(3));

				$this->session->set_flashdata('mensagem','Editado com sucesso');
				$this->session->set_flashdata('tipo','sucesso');

				redirect("clientes/listar");
			}
			else
				redirect("clientes/listar");
		}

		// public function funcao_excluir() {

		// 	$c = new Cliente();
			
		// 	if($c->where("id", $this->uri->segment(3))->update('excluido', 1)) {
		// 		$this->session->set_flashdata('mensagem','Excluído com sucesso');
		// 		$this->session->set_flashdata('tipo','sucesso');
		// 	}
		// 	else {
		// 		$this->session->set_flashdata('mensagem','Ocorreu um erro ao excluir');
		// 		$this->session->set_flashdata('tipo','erro');
		// 	}

		// 	redirect("clientes/listar");
		// }


		public function sobrenome(){

			$clientes = $this->cliente->get();

			foreach ($clientes as $c) {
				$nome_minusculo = mb_strtolower($c->nome);
				$nome_certo = ucwords (trim($nome_minusculo));

				$exp = explode(' ', $nome_certo);

				//echo "nome: ".$exp[0];
				$i=0;
				$nome = '';
				//$nome = $exp[0];
				$sobrenome ='';
				foreach ($exp as $ex => $v) {
					if ($i==0) {
						$nome .= $v.' ';
					}else{
					   $sobrenome .= $v.' ';
					}
					$i++;
				}
				echo "nome: $nome  sobrenome: $sobrenome<br>";
				$this->cliente->update_sobrenome($c->id,trim($nome), trim($sobrenome));
			}

		}


	}