<?php 

	class Subcategorias extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Categoria_model', 'categoria');
			$this->load->model('Subcategoria_model', 'subcategoria');
			$this->load->model('Departamento_model', 'departamento');
		}


		public function index()
		{
			redirect('subcategorias/listar');
		}

		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$data['departamentos'] = $this->departamento->get();
			//$data['categorias'] = $this->categoria->get();

			$this->load->view('estrutura/topo');
			$this->load->view('subcategorias/cadastrar',$data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{
			$d = $this->subcategoria;
			$data['subcategorias'] = $d->get();

			$data['departamentos'] = $this->departamento->get();

			$this->load->view('estrutura/topo');
			$this->load->view('subcategorias/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$d = $this->subcategoria;
			$data['subcategoria'] = $d->get($this->uri->segment(3));

			$data['categoria'] = $this->categoria->get($data['subcategoria']->categoria_id);
			$data['categorias'] = $this->categoria->porDepartamento($data['categoria']->departamento_id);

			$data['departamentos'] = $this->departamento->get();

			if( $d->count == 0 ){
				redirect('categorias/listar');
			}

			$this->load->view('estrutura/topo');
			$this->load->view('subcategorias/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			if( $this->subcategoria->save() ){
				$this->session->set_flashdata('mensagem','Subcategoria cadastrada com sucesso');
				$this->session->set_flashdata('tipo','sucesso');
				
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar a subcategoria');
				$this->session->set_flashdata('tipo','neutro');
			}

			redirect('subcategorias/listar');

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{

			if( $this->subcategoria->update( $this->uri->segment(3) ) ){
				
				$this->session->set_flashdata('mensagem', 'Subcategoria editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
						
			}
			else {
				$this->session->set_flashdata('mensagem', 'Subcategoria editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('subcategorias/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			if( $this->subcategoria->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Subcategoria excluída com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir a subcategoria');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('subcategorias/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */



		// public function modificar_ordem_objetos(){

		// 	$this->categoria->modificar_ordem_objetos();

			
		// }


}