<?php 

	class Cupons extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Cupom_model', 'cupom');
		}


		public function index()
		{
			redirect('cupons/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('cupons/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			$data['cupons'] = $this->cupom->get();

			$this->load->view('estrutura/topo');
			$this->load->view('cupons/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			
			$data['cupom'] = $this->cupom->get($this->uri->segment(3));

			if( $this->cupom->count == 0 ){
				redirect('cupons/listar');
			}


			$this->load->view('estrutura/topo');
			$this->load->view('cupons/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			$b = $this->cupom;

			if($b->save()){			

				$this->session->set_flashdata('mensagem', 'cupom cadastrado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');						
			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar cupom!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			
			redirect('cupons/listar');

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$b = $this->cupom->get($this->uri->segment(3));

			if( $this->cupom->update($this->uri->segment(3)) ){

				$this->session->set_flashdata('mensagem', 'cupom editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');					
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível editar o cupom');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('cupons/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$b = $this->cupom->get();

			if( $this->cupom->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'cupom excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o cupom');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('cupons/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}