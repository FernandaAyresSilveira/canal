<?php 

	class Banners extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Banner_model', 'banner');
		}


		public function index()
		{
			redirect('banners/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('banners/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{

			$data['banners'] = $this->banner->get();
			//print_r($data['banners']);

			$this->load->view('estrutura/topo');
			$this->load->view('banners/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			
			$data['banner'] = $this->banner->get($this->uri->segment(3));

			if( $this->banner->count == 0 ){
				redirect('banners/listar');
			}


			$this->load->view('estrutura/topo');
			$this->load->view('banners/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			$b = $this->banner;

			if($b->save()){
				if( !empty($_FILES['imagem']['name']) ){

					$foto = nome_imagem($_FILES['imagem']['name']);

					$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
					$per = array('jpg','jpeg','png');

					//Verifica se o arquivo está no array de extensões permitidas
					if( in_array($ext, $per) ){

						//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
						if( upload('banners','imagem', $foto) ){

							$this->banner->setFoto($b->lastInsertId(), $foto);

							$this->session->set_flashdata('mensagem', 'Banner editado com sucesso');
							$this->session->set_flashdata('tipo', 'sucesso');
							
						}
						else {
							$this->session->set_flashdata('mensagem', 'Banner editado com sucesso, porém houve um erro ao salvar a nova imagem!');
							$this->session->set_flashdata('tipo', 'neutro');
						}
					}
					else {
						$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
						$this->session->set_flashdata('tipo', 'erro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'Banner editado com sucesso');
					$this->session->set_flashdata('tipo', 'sucesso');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar banner!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			
			redirect('banners/listar');

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$b = $this->banner->get($this->uri->segment(3));
			$antiga = $b->imagem;

			$this->banner->update($this->uri->segment(3));

			if( !empty($_FILES['imagem']['name']) ){

				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('banners','imagem', $foto) ){
						
						if( !empty($antiga) ){
							unlink("./assets/upload/banners/$antiga");
						}

						$this->banner->setFoto($this->uri->segment(3), $foto);

						$this->session->set_flashdata('mensagem', 'Banner editado com sucesso');
						$this->session->set_flashdata('tipo', 'sucesso');
						
					}
					else {
						$this->session->set_flashdata('mensagem', 'Banner editado com sucesso, porém houve um erro ao salvar a nova imagem!');
						$this->session->set_flashdata('tipo', 'neutro');
					}
				}
				else {
					$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
					$this->session->set_flashdata('tipo', 'erro');
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Banner editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('banners/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$b = $this->banner->get();

			$imagem = $b->imagem;

			if( $this->banner->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Banner excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if( !empty($imagem) ){
					unlink("./assets/upload/banners/$imagem");
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o banner');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('banners/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


}