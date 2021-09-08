<?php 

	class Avaliacoes extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Avaliacao_model', 'avaliacao');
		}


		public function index()
		{
			redirect('avaliacoes/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('avaliacoes/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			
			$data['avaliacoes'] = $this->avaliacao->get();			
			
			$this->load->view('estrutura/topo');
			$this->load->view('avaliacoes/listar', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['avaliacao'] = $this->avaliacao->get( $this->uri->segment(3) );
			
			
			$this->load->view('estrutura/topo');
			$this->load->view('avaliacoes/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{	

			if( $this->avaliacao->save() ){
				$this->session->set_flashdata('mensagem','avaliacao cadastrada com sucesso');
				$this->session->set_flashdata('tipo','sucesso');							
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar a avaliacao');
				$this->session->set_flashdata('tipo','erro');
			}

			redirect('avaliacoes/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{	
			if( $this->avaliacao->update($this->uri->segment(3)) ){
		
				$this->session->set_flashdata('mensagem', 'avaliacao editada com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');		

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao editar a avaliacao, tente novamente');
				$this->session->set_flashdata('tipo', 'neutro');
			}

			redirect('avaliacoes/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		// public function funcao_excluir()
		// {

		// 	if( $this->avaliacao->delete($this->uri->segment(3)) ){

		// 		$this->session->set_flashdata('mensagem', 'avaliacao excluída com sucesso');
		// 		$this->session->set_flashdata('tipo', 'sucesso');
		// 	}
		// 	else {
		// 		$this->session->set_flashdata('mensagem', 'Não foi possível excluir a avaliacao');
		// 		$this->session->set_flashdata('tipo', 'erro');
		// 	}

		// 	redirect('avaliacoes/listar');

		//}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}