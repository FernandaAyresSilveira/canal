<?php 

	class Posts extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Post_model', 'post');
			$this->load->model('Categoria_model', 'categoria');
		}

		public function index()
		{
			redirect('posts/listar');
		}
		/* ==================== LISTAR ==================== */
		public function list()
		{	

			$i = 10;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['posts'] = $this->post->get_paginate($p, $i);
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('posts/list').'?q='.$this->input->get('q') : site_url('posts/list?g=1');
			$config['total_rows'] 			= $this->post->count;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);

			$this->load->view('estrutura/topo');
			$this->load->view('posts/list', $data);
			$this->load->view('estrutura/right');
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */

		/* ==================== LISTAR ==================== */
		public function tags()
		{	
			$tag_id = $this->uri->segment(3);
			$data['tag'] = $this->tag->get($tag_id);

			$i = 100;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['posts'] = $this->post->get_paginate_tag($p, $i,$tag_id);

			$this->load->view('estrutura/topo');
			$this->load->view('posts/tags', $data);
			$this->load->view('estrutura/right');
			$this->load->view('estrutura/rodape');

		}

		/* ==================== LISTAR ==================== */
		public function categories()
		{	
			$cat_id = $this->uri->segment(3);
			$data['cat'] = $this->categoria->get($cat_id);

			$i = 100;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['posts'] = $this->post->get_paginate_cat($p, $i,$cat_id);

			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('posts/list').'?q='.$this->input->get('q') : site_url('posts/list?g=1');
			$config['total_rows'] 			= $this->post->count;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);

			$this->load->view('estrutura/topo');
			$this->load->view('posts/categories', $data);
			$this->load->view('estrutura/right');
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */
		public function details()
		{	
			
			$data['post'] = $this->post->get($this->uri->segment(3));

			$this->load->view('estrutura/topo');
			$this->load->view('posts/details', $data);
			$this->load->view('estrutura/right');
			$this->load->view('estrutura/rodape');

		}






		
		


}
