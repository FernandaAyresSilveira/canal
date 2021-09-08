<?php 

	class Categorias extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Categoria_model', 'categoria');
			$this->load->model('Departamento_model', 'departamento');
		}


		public function index()
		{
			redirect('categorias/listar');
		}

		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$data['departamentos'] = $this->departamento->get();
			$this->load->view('estrutura/topo');
			$this->load->view('categorias/cadastrar',$data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{
			$d = $this->categoria;
			$data['categorias'] = $d->get();

			$data['departamentos'] = $this->departamento->get();

			$this->load->view('estrutura/topo');
			$this->load->view('categorias/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$d = $this->categoria;
			$data['categoria'] = $d->get($this->uri->segment(3));

			$data['departamentos'] = $this->departamento->get();

			if( $d->count == 0 ){
				redirect('categorias/listar');
			}

			$this->load->view('estrutura/topo');
			$this->load->view('categorias/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			if( $this->categoria->save() ){
				$this->session->set_flashdata('mensagem','Categoria cadastrada com sucesso');
				$this->session->set_flashdata('tipo','sucesso');
				
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar a categoria');
				$this->session->set_flashdata('tipo','neutro');
			}

			redirect('categorias/listar');

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{

			if( $this->categoria->update( $this->uri->segment(3) ) ){
				
				$this->session->set_flashdata('mensagem', 'Categoria editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
						
			}
			else {
				$this->session->set_flashdata('mensagem', 'Categoria editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('categorias/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			if( $this->categoria->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Categoria excluída com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir a categoria');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('categorias/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */



		public function modificar_ordem_objetos(){

			$this->categoria->modificar_ordem_objetos();

			
		}


}