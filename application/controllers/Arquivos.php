<?php 

	class Arquivos extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Arquivo_model', 'arquivo');
		}


		public function index()
		{
			redirect('arquivos/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('arquivos/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			$i = 6;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['arquivos'] = $this->arquivo->get_paginate($p, $i);
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('arquivos/listar').'?q='.$this->input->get('q') : site_url('arquivos/listar?g=1');
			$config['total_rows'] 			= $this->arquivo->count;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);

			$this->load->view('estrutura/topo');
			$this->load->view('arquivos/listar', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['arquivo'] = $this->arquivo->get( $this->uri->segment(3) );
			
			
			$this->load->view('estrutura/topo');
			$this->load->view('arquivos/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{

			$ext = strtolower( pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION) );
			$per = array('jpg','jpeg','png', 'docx', 'pdf', 'doc', 'xls', 'xlsx');

			//Verifica se o arquivo está no array de extensões permitidas
			if( in_array($ext, $per) ){
				
				$arq = nome_imagem($_FILES['arquivo']['name']);

				if( $this->arquivo->save() ){
					//Faz o upload da imagem somente se o cadastro retorna com sucesso
					if( upload('arquivos','arquivo', $arq) ){
						
						$this->arquivo->setArquivo($this->arquivo->lastInsertId, $arq);

						$this->session->set_flashdata('mensagem','Arquivo cadastrado com sucesso');
						$this->session->set_flashdata('tipo','sucesso');
					}
					else {
						$this->session->set_flashdata('mensagem','Arquivo cadastrado, porém houve um erro ao salvar o arquivo');
						$this->session->set_flashdata('tipo','neutro');
					}					
				}
				else {
					$this->session->set_flashdata('mensagem','Erro ao cadastrar o arquivo');
					$this->session->set_flashdata('tipo','erro');
				}

			}
			else {
				$this->session->set_flashdata('mensagem','A extensão do arquivo selecionado não é permitida!');
				$this->session->set_flashdata('tipo','erro');
			}

			redirect('arquivos/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{	
			$a = $this->arquivo->get($this->uri->segment(3));
			$antiga = $a->arquivo;

			$this->arquivo->update($this->uri->segment(3));


			if( !empty($_FILES['arquivo']['name']) ){

				$ext = strtolower( pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png', 'docx', 'pdf', 'doc');

				$arq = nome_imagem($_FILES['arquivo']['name']);
				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Deleta a arquivo antiga apenas se o upload da nova arquivo retornar com sucesso
					if( upload('arquivos','arquivo',$arq) ){
						if (file_exists("./assets/upload/arquivos/$antiga")) {
							unlink("./assets/upload/arquivos/$antiga");
						}
						$this->arquivo->setArquivo($this->uri->segment(3), $arq);		

						$this->session->set_flashdata('mensagem', 'Arquivo editado com sucesso');
						$this->session->set_flashdata('tipo', 'sucesso');

					}
					else {
						$this->session->set_flashdata('mensagem', 'Arquivo editado com sucesso, porém houve um erro ao salvar o novo arquivo!');
						$this->session->set_flashdata('tipo', 'neutro');
					}

				}
				else {
					$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
					$this->session->set_flashdata('tipo', 'erro');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Arquivo editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('arquivos/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$a =$this->arquivo->get($this->uri->segment(3));

			$arquivo = $a->arquivo;


			if( $this->arquivo->delete($this->uri->segment(3)) ){

				$this->session->set_flashdata('mensagem', 'Arquivo excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if (file_exists("./assets/upload/arquivos/$arquivo")) {
					unlink("./assets/upload/arquivos/$arquivo");
				}

				
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o arquivo');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('arquivos/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}