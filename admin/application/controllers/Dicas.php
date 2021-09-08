<?php 

	class Dicas extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Dica_model', 'destaque');
		}


		public function index()
		{
			redirect('dicas/listar');
		}

		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('dicas/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{
			$d = $this->destaque;
			$data['dicas'] = $d->get();

			$this->load->view('estrutura/topo');
			$this->load->view('dicas/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$d = $this->destaque;
			$data['destaque'] = $d->get($this->uri->segment(3));

			if( $d->count == 0 ){
				redirect('dicas/listar');
			}

			$this->load->view('estrutura/topo');
			$this->load->view('dicas/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			$d = $this->destaque;		

			$imagem   = nome_imagem($_FILES['imagem']['name']);
			
			if( $d->save() ){.
				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					if( upload('dicas','imagem', $imagem) ){
						$this->destaque->setFoto($d->lastInsertId, $imagem);

						$this->session->set_flashdata('mensagem','Destaque cadastrado com sucesso');
						$this->session->set_flashdata('tipo','sucesso');
					}
					else {
						$this->session->set_flashdata('mensagem','Destaque cadastrado, porém houve um erro ao salvar a imagem');
						$this->session->set_flashdata('tipo','neutro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso, porém houve um erro ao salvar a nova imagem!');
					$this->session->set_flashdata('tipo', 'neutro');
				}

				
			}
			else {
				$this->session->set_flashdata('mensagem','Erro ao cadastrar o destaque');
				$this->session->set_flashdata('tipo','neutro');
			}


			redirect('dicas/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$d = $this->destaque;
			$destaque = $d->get($this->uri->segment(3) );
			$antiga = $destaque->imagem;

			$d->update( $this->uri->segment(3) );

			if( !empty($_FILES['imagem']['name']) ){

				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('dicas','imagem', $foto) ){
						
						if( !empty($antiga) ){
							unlink("./assets/upload/dicas/$antiga");
						}

						$this->destaque->setFoto($this->uri->segment(3), $foto);

						$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
						$this->session->set_flashdata('tipo', 'sucesso');
						
					}
					else {
						$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso, porém houve um erro ao salvar a nova imagem!');
						$this->session->set_flashdata('tipo', 'neutro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
					$this->session->set_flashdata('tipo', 'erro');
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('dicas/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$b = $this->destaque->get($this->uri->segment(3));

			$imagem = $b->imagem;

			if( $this->destaque->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Destaque excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if( !empty($imagem) ){
					unlink("./assets/upload/dicas/$imagem");
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o destaque');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('dicas/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */

}