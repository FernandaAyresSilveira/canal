<?php 

	class Noticias extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Noticia_model', 'noticia');
		}


		public function index()
		{
			redirect('noticias/listar');
		}


		/* ==================== CADASTRAR ==================== */

		public function cadastrar()
		{
			$this->load->model("Imagem_model", "imagem");
			$dados["imagens"] = json_encode($this->imagem->getJsonTemp('noticias'));

			$this->load->view('estrutura/topo');
			$this->load->view('noticias/cadastrar', $dados);
			$this->load->view('estrutura/rodape');
		}

		public function buscarImagens(){
			$this->load->model("Imagem_model", "imagem");
			echo json_encode($this->imagem->getJsonTemp('noticias'));
		}

		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			$i = 6;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['noticias'] = $this->noticia->get_paginate($p, $i);
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('noticias/listar').'?q='.$this->input->get('q') : site_url('noticias/listar?g=1');
			$config['total_rows'] 			= $this->noticia->count;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);

			$this->load->view('estrutura/topo');
			$this->load->view('noticias/listar', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['noticia'] = $this->noticia->get($this->uri->segment(3));
			
			if( $this->noticia->count > 0 ){
				$this->load->view('estrutura/topo');
				$this->load->view('noticias/editar', $data);
				$this->load->view('estrutura/rodape');
			}
			else {
				$this->session->set_flashdata('mensagem', 'Notícia inválida!');
				$this->session->set_flashdata('tipo', 'neutro');

				redirect('noticias/listar');
			}

		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */

		public function funcao_cadastrar()
		{

			$n = $this->noticia;

			if( $n->save() ){

				if( !empty($_FILES['imagem']['name']) ){

					$foto = nome_imagem($_FILES['imagem']['name']);

					$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
					$per = array('jpg','jpeg','png');

					//Verifica se o arquivo está no array de extensões permitidas
					if( in_array($ext, $per) ){

						if( upload('noticias','imagem', $foto) ){

							$this->noticia->setFoto($n->lastInsertId, $foto);

							$this->session->set_flashdata('mensagem', 'Notícia cadastrada com sucesso');
							$this->session->set_flashdata('tipo', 'sucesso');
							
						}
						else {
							$this->session->set_flashdata('mensagem', 'Notícia cadastrada com sucesso, porém houve um erro ao salvar a nova imagem!');
							$this->session->set_flashdata('tipo', 'neutro');
						}

					}
					else {
						$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
						$this->session->set_flashdata('tipo', 'erro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'Notícia cadastrada com sucesso');
					$this->session->set_flashdata('tipo', 'sucesso');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar notícia!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('noticias/listar');

		}

		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */

		public function funcao_editar(){

			$n = $this->noticia; // Instancia Model Noticia

			$idNoticia = $this->uri->segment(3);
			$noticia = $this->noticia->get($idNoticia); //Pega notícia do ID

			if( $n->update() ){

				if( !empty($_FILES['imagem']['name']) ){

					$foto = nome_imagem($_FILES['imagem']['name']);

					$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
					$per = array('jpg','jpeg','png');

					//Verifica se o arquivo está no array de extensões permitidas
					if( in_array($ext, $per) ){

						if( upload('noticias','imagem', $foto) ){

							$this->noticia->setFoto($idNoticia, $foto);

							if( !empty($antiga) ){
								unlink("./assets/upload/noticias/$noticia->imagem");
							}

							$this->session->set_flashdata('mensagem', 'Notícia editada com sucesso');
							$this->session->set_flashdata('tipo', 'sucesso');
							
						}
						else {
							$this->session->set_flashdata('mensagem', 'Notícia editada com sucesso, porém houve um erro ao salvar a nova imagem!');
							$this->session->set_flashdata('tipo', 'neutro');
						}

					}
					else {
						$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
						$this->session->set_flashdata('tipo', 'erro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'Notícia editada com sucesso');
					$this->session->set_flashdata('tipo', 'sucesso');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar notícia!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('noticias/listar');

		}
		
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */

		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir(){

			$b = $this->noticia->get($this->uri->segment(3));

			$imagem = $b->imagem;

			if( $this->noticia->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Novidade excluída com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if( !empty($imagem) ){
					unlink("./assets/upload/noticias/$imagem");
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o novidade');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('noticias/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}