<?php 

	class Popups extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Popup_model', 'popup');
		}

		

		public function index()
		{
			redirect('popups/listar');
		}


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{	
			$this->load->view('estrutura/topo');
			$this->load->view('popups/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{	
			$data['popups'] = $this->popup->get();

			$this->load->view('estrutura/topo');
			$this->load->view('popups/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['popup'] = $this->popup->get($this->uri->segment(3));

			if( $this->popup->count == 0 ){
				redirect('popups/listar');
			}

			$this->load->view('estrutura/topo');
			$this->load->view('popups/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */



		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{

			$p = $this->popup;

			if($p->save()){

				$ext = strtolower( pathinfo( $_FILES['imagem']['name'], PATHINFO_EXTENSION ) );
				$per = array('jpg', 'jpeg', 'png');

				if( in_array($ext, $per) ){

					$foto = nome_imagem($_FILES['imagem']['name']);

					if( upload('popups', 'imagem', $foto) ){
						$this->popup->setFoto($p->lastInsertId(), $foto);

						$this->session->set_flashdata('mensagem', 'Popup cadastrada com sucesso!');
						$this->session->set_flashdata('tipo', 'sucesso');
					}
					else {
						$this->session->set_flashdata('mensagem', 'Popup cadastrada com sucesso, porém não foi possível salvar a imagem!');
						$this->session->set_flashdata('tipo', 'neutro');
					}

				}
				else {
					$this->session->set_flashdata('mensagem', 'Extensão de arquivo não permitido!');
					$this->session->set_flashdata('tipo', 'erro');
				}
			}

			redirect('popups/listar');


		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$b = $this->popup->get($this->uri->segment(3));
			$antiga = $b->imagem;

			$this->popup->update($this->uri->segment(3));


			$ext = strtolower( pathinfo( $_FILES['imagem']['name'], PATHINFO_EXTENSION ) );
			$per = array('jpg', 'jpeg', 'png');

			if( !empty($_FILES['imagem']['name']) && in_array($ext, $per) ){

				$nova = nome_imagem($_FILES['imagem']['name']);

				if( upload('popups','imagem', $nova ) ){//Deleta a imagem antiga somente se o upload da nova imagem retornar com sucesso

					if( !empty($antiga) && file_exists("./assets/upload/popups/$antiga")){
						unlink("./assets/upload/popups/$antiga");
					}

					$this->popup->setFoto($this->uri->segment(3), $nova);

					$this->session->set_flashdata('mensagem', 'Popup atualizada com sucesso!');
					$this->session->set_flashdata('tipo', 'sucesso');

				}
				else {
					$this->session->set_flashdata('mensagem', 'Popup editada com sucesso, porém não foi possível salvar a nova imagem!');
					$this->session->set_flashdata('tipo', 'neutro');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Popup editada com sucesso!');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('popups/listar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{
			$b = $this->popup->get( $this->uri->segment(3) );

			$antiga = $b->imagem;

			if( $this->popup->delete( $this->uri->segment(3) ) ){

				$this->session->set_flashdata('mensagem', 'Popup excluída com sucesso!');
				$this->session->set_flashdata('tipo', 'sucesso');

				if (file_exists("./assets/uploads/popups/$antiga")) {
					unlink("./assets/uploads/popups/$antiga");
				}				
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir a popup!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('popups/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */

}