<?php 

	class Posts extends MY_Controller {

	

		public function index()
		{
			redirect('posts/listar');
		}

		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('usuarios/cadastrar');
			$this->load->view('estrutura/rodape');
		}==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{
			$d = $this->post;
			$data['posts'] = $d->get();

			$this->load->view('estrutura/topo');
			$this->load->view('posts/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$d = $this->post;
			$data['post'] = $d->get($this->uri->segment(3));

			if( $d->count == 0 ){
				redirect('posts/listar');
			}

			$this->load->view('estrutura/topo');
			$this->load->view('posts/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			$d = $this->post;		

			$imagem   = nome_imagem($_FILES['imagem']['name']);
			
			if( $d->save() ){
				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					if( upload('posts','imagem', $imagem) ){
						$this->post->setFoto($d->lastInsertId, $imagem);

						$this->session->set_flashdata('mensagem','post cadastrado com sucesso');
						$this->session->set_flashdata('tipo','sucesso');
					}
					else {
						$this->session->set_flashdata('mensagem','post cadastrado, porém houve um erro ao salvar a imagem');
						$this->session->set_flashdata('tipo','neutro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'post editado com sucesso, porém houve um erro ao salvar a nova imagem!');
					$this->session->set_flashdata('tipo', 'neutro');
				}

				
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar o post');
				$this->session->set_flashdata('tipo','neutro');
			}


			redirect('posts/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$d = $this->post;
			$post = $d->get($this->uri->segment(3) );
			$antiga = $post->imagem;

			$d->update( $this->uri->segment(3) );

			if( !empty($_FILES['imagem']['name']) ){

				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('posts','imagem', $foto) ){
						
						if( !empty($antiga) ){
							unlink("./assets/upload/posts/$antiga");
						}

						$this->post->setFoto($this->uri->segment(3), $foto);

						$this->session->set_flashdata('mensagem', 'post editado com sucesso');
						$this->session->set_flashdata('tipo', 'sucesso');
						
					}
					else {
						$this->session->set_flashdata('mensagem', 'post editado com sucesso, porém houve um erro ao salvar a nova imagem!');
						$this->session->set_flashdata('tipo', 'neutro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
					$this->session->set_flashdata('tipo', 'erro');
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'post editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('posts/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$b = $this->post->get($this->uri->segment(3));

			$imagem = $b->imagem;

			if( $this->post->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'post excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if( !empty($imagem) ){
					unlink("./assets/upload/posts/$imagem");
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o post');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('posts/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */

}