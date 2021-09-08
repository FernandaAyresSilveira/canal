<?php 

	class Home extends MY_Controller {


		public function index()
		{

			$this->load->view('estrutura/topo');
			$this->load->view('home/index');
			$this->load->view('estrutura/rodape');

		}




}
