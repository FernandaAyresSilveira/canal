<?php 

	class Conteudos_home extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Conteudo_home_model', 'conteudo_home');
		}


		public function index()
		{
			redirect('conteudos_home/editar');
		}

		


		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );
			$antiga1 = $conteudo_home->imagem1_espaco;
			$antiga2 = $conteudo_home->imagem2_espaco;
			$antiga3 = $conteudo_home->imagem_area_coringa;

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update( 1 );

			if( !empty($_FILES['imagem1']['name']) ){

				$foto = nome_imagem($_FILES['imagem1']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem1']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem1', $foto) ){
						
						if( !empty($antiga1) && file_exists("./assets/upload/conteudos_home/$antiga1")){
							unlink("./assets/upload/conteudos_home/$antiga1");
						}
						$this->conteudo_home->setFoto($foto, 'imagem1_espaco');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

			if( !empty($_FILES['imagem2']['name']) ){

				$foto = nome_imagem($_FILES['imagem2']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem2']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem2', $foto) ){
						
						if( !empty($antiga2) && file_exists("./assets/upload/conteudos_home/$antiga2")){
							unlink("./assets/upload/conteudos_home/$antiga2");
						}
						$this->conteudo_home->setFoto($foto, 'imagem2_espaco');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

			if( !empty($_FILES['imagem_area_coringa']['name']) ){

				$foto = nome_imagem($_FILES['imagem_area_coringa']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem_area_coringa']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem_area_coringa', $foto) ){
						
						if( !empty($antiga3) && file_exists("./assets/upload/conteudos_home/$antiga3")){
							unlink("./assets/upload/conteudos_home/$antiga3");
						}
						$this->conteudo_home->setFoto($foto, 'imagem_area_coringa');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar_espaco()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/home_espaco', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar_espaco()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );
			$antiga1 = $conteudo_home->imagem1_espaco;
			$antiga2 = $conteudo_home->imagem2_espaco;

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update_espaco( 1 );

			if( !empty($_FILES['imagem1']['name']) ){

				$foto = nome_imagem($_FILES['imagem1']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem1']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem1', $foto) ){
						
						if( !empty($antiga1) && file_exists("./assets/upload/conteudos_home/$antiga1")){
							unlink("./assets/upload/conteudos_home/$antiga1");
						}
						$this->conteudo_home->setFoto($foto, 'imagem1_espaco');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

			if( !empty($_FILES['imagem2']['name']) ){

				$foto = nome_imagem($_FILES['imagem2']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem2']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem2', $foto) ){
						
						if( !empty($antiga2) && file_exists("./assets/upload/conteudos_home/$antiga2")){
							unlink("./assets/upload/conteudos_home/$antiga2");
						}
						$this->conteudo_home->setFoto($foto, 'imagem2_espaco');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

		

			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar_espaco');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */




		/* ==================== EDITAR ==================== */
		public function editar_area_link()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/home_area_link', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar_area_link()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );
			$antiga3 = $conteudo_home->imagem_area_coringa;

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update_area_link( 1 );

			
			if( !empty($_FILES['imagem_area_coringa']['name']) ){

				$foto = nome_imagem($_FILES['imagem_area_coringa']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem_area_coringa']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('conteudos_home','imagem_area_coringa', $foto) ){
						
						if( !empty($antiga3) && file_exists("./assets/upload/conteudos_home/$antiga3")){
							unlink("./assets/upload/conteudos_home/$antiga3");
						}
						$this->conteudo_home->setFoto($foto, 'imagem_area_coringa');
					}
					else {
						$erro_upload++;
					}
				}
				else {
					$erro_formato++;
				}
			}

			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar_area_link');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */




		/* ==================== EDITAR ==================== */
		public function editar_servico_beleza()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/home_servico_beleza', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar_servico_beleza()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update_servico_beleza( 1 );

			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar_servico_beleza');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */

		/* ==================== EDITAR ==================== */
		public function editar_servico_estetica()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/home_servico_estetica', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar_servico_estetica()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update_servico_estetica( 1 );
			
			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar_servico_estetica');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */


		/* ==================== EDITAR ==================== */
		public function editar_novidade()
		{
			$d = $this->conteudo_home;
			$data['conteudo'] = $d->get(1);

			$this->load->view('estrutura/topo');
			$this->load->view('conteudos_home/home_novidade', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar_novidade()
		{
			$d = $this->conteudo_home;
			$conteudo_home = $d->get($this->uri->segment(3) );

			$erro_formato = 0;
			$erro_upload = 0;

			$d->update_novidade( 1 );
			
			if ($erro_formato > 0) {
				$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($erro_upload > 0) {
				$this->session->set_flashdata('mensagem', 'Não foi possível realizar o envio das imagens!');
				$this->session->set_flashdata('tipo', 'erro');
			}


			if ($erro_formato == 0 && $erro_upload == 0 ) {
				$this->session->set_flashdata('mensagem', 'Destaque editado com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}

			redirect('conteudos_home/editar_novidade');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */




}