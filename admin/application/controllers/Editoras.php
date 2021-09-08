<?php 

	class Editoras extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Editora_model', 'editora');
		}


		public function index()
		{
			redirect('editoras/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('editoras/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			
			$data['editoras'] = $this->editora->get();			
			
			$this->load->view('estrutura/topo');
			$this->load->view('editoras/listar', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['editora'] = $this->editora->get( $this->uri->segment(3) );
			
			
			$this->load->view('estrutura/topo');
			$this->load->view('editoras/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{	

			if( $this->editora->save() ){
				$this->session->set_flashdata('mensagem','Editora cadastrada com sucesso');
				$this->session->set_flashdata('tipo','sucesso');							
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar a editora');
				$this->session->set_flashdata('tipo','erro');
			}

			redirect('editoras/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{	
			if( $this->editora->update($this->uri->segment(3)) ){
		
				$this->session->set_flashdata('mensagem', 'Editora editada com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');		

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao editar a editora, tente novamente');
				$this->session->set_flashdata('tipo', 'neutro');
			}

			redirect('editoras/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			if( $this->editora->delete($this->uri->segment(3)) ){

				$this->session->set_flashdata('mensagem', 'Editora excluída com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir a editora');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('editoras/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}