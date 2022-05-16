<?php 

	class Home extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Post_model', 'post');
		}


		public function index()
		{
			$i = 6;
			$data['posts'] = $this->post->get_home($i);
			$data['tags'] = $this->tag->get();


			$this->load->view('estrutura/topo');
			$this->load->view('home/index',$data);
			$this->load->view('estrutura/right');
			$this->load->view('estrutura/rodape');

		}




}
