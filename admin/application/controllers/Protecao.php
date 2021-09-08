<?php 

	class Protecao extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Anuncio_model', 'anuncio');
			$this->load->model('Ano_model', 'ano');
			$this->load->model('Departamento_model', 'departamento');
			$this->load->model('Categoria_model', 'categoria');
			$this->load->model('Subcategoria_model', 'subcategoria');
			$this->load->model('Editora_model', 'editora');
		}


		public function index()
		{
			
			redirect('protecao/listar');
		}


		




		/* ==================== LISTAR ==================== */
		public function listar()
		{	
			

			$i = 28;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['anuncios'] = $this->anuncio->get_paginate($p, $i);
			$data['count_anuncios'] = $this->anuncio->count;

			$gets = '';
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get() ? site_url('protecao/listar').'?'.$gets : site_url('protecao/listar?g=1');
			$config['total_rows'] 			= $data['count_anuncios'];
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);
			

			$this->load->view('estrutura/topo');
			$this->load->view('protecao/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */

		










}


