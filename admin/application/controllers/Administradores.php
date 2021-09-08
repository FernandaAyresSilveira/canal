<?php 

	class Administradores extends MY_Controller {


		public function index()
		{
			redirect('administradores/listar');
		}

		public function login()
		{

			if( $this->session->userdata('logado') ){
				redirect();
				//Aviso para o ajax, caso o usuário já esteja logado
				echo "logado";
			}
			else {

				if( $this->input->post() ){					

					if( $this->administrador->login() ){

						$u = $this->administrador->getUserdata();

						$primeiro_nome  = explode(' ', $u['nome']);
						$imagem 	    = base_url('./assets/upload/administradores').'/';
						$imagem 	   .= empty($u['foto']) ? 'avatar-padrao.png' : $u['foto'];


						$this->session->set_userdata('id', $u['id']);
						$this->session->set_userdata('nome', $primeiro_nome[0]);
						$this->session->set_userdata('email', $u['email']);
						$this->session->set_userdata('foto', $imagem );
						$this->session->set_userdata('logado', true);
						$this->session->set_userdata('efeito', true);

						redirect('home');
						//Avisa o ajax que o usuário foi encontrado

					}
					else {
						$this->session->set_flashdata('mensagem', 'Login não Encontrado!');
						$this->session->set_flashdata('tipo', 'neutro');
						
						//Avisa o ajax que não encontrou o usuário, e o jquery exibe o aviso de erro
					}

				}

				$this->load->view('administradores/login');

			}

		}

		/* ==================== FIM LOGIN ==================== */



		/* ==================== LOGOUT ==================== */
		public function logout()
		{
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('nome');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('imagem');
			$this->session->unset_userdata('logado');
			redirect('administradores/login');
		}
		/* ==================== FIM LOGOUT ==================== */



		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('administradores/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{	

			$data['administrador'] = $this->administrador->get( $this->uri->segment(3) );

			if( $this->administrador->count ){

				$this->load->view('estrutura/topo');
				$this->load->view('administradores/editar',$data);
				$this->load->view('estrutura/rodape');
			
			}
			else {

				$this->session->set_flashdata('mensagem', 'Administrador inválido!');
				$this->session->set_flashdata('tipo', 'neutro');

				redirect('administradores/listar');
			}

			
		}
		/* ==================== FIM EDITAR ==================== */



		/* ==================== LISTAR ==================== */
		public function listar()
		{	

			$this->load->view('estrutura/topo');
			$this->load->view('administradores/listar');
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{

			if( $this->administrador->save() ){

				$foto = $this->administrador->foto;

				if( !empty($foto) && !$this->input->post('padrao') ){//Caso usuário seleciona uma imagem e selecione que NÃO quer usar avatar padrão
					

					if( upload('administradores','imagem', $foto) ){

						$this->session->set_flashdata('mensagem', 'Administrador cadastrado com sucesso!');
						$this->session->set_flashdata('tipo', 'sucesso');

					}
					else {
						$this->session->set_flashdata('mensagem', 'Administrador cadastrado com sucesso, mas não foi possível salvar sua imagem!');
						$this->session->set_flashdata('tipo', 'neutro');
					}

				}
				else {
					$this->session->set_flashdata('mensagem', 'Administrador cadastrado com sucesso!');
					$this->session->set_flashdata('tipo', 'sucesso');
				}

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao realizar o cadastro de administrador!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('administradores/listar');
			
		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{

			if( $this->input->post() ){

				$a = $this->administrador;

				$administrador = $a->get( $this->uri->segment(3) );

				if( $a->count() == 0 ){
					$this->session->set_flashdata('mensagem', 'Código de administrador inválido!');
					$this->session->set_flashdata('tipo', 'neutro');

					redirect('administradores/listar');
				}
				
				if($a->update( $this->uri->segment(3) )){

					//============ Atualiza Senha ====================================
					
					if( $this->input->post('senha') ){

						$a->updateSenha( $this->uri->segment(3) );

					}
					
					//============ /Atualiza Senha ===================================

					//=========== Seta Avatar padrao =================================
					
					if( $this->input->post('padrao') ){

						//Deleta a foto atual, se houver

						if( !empty($administrador->foto) ){
							unlink("./assets/upload/administradores/$administrador->foto");
						}

						$a->setDefaultFoto($administrador->id);

						if( $administrador->id == $this->session->userdata('id') ){//Muda o avatar da sessão, caso o admin editado seja o admin logado
							$this->session->set_userdata('foto', base_url("./assets/upload/administradores/avatar-padrao.png") );
							$this->session->set_flashdata('mensagem', 'Administrador atualizado com sucesso!');
							$this->session->set_flashdata('tipo', 'sucesso');
						}
						
					}
					else {

						if( !empty($_FILES['imagem']['name']) ){

							$foto = nome_imagem($_FILES['imagem']['name']);

							//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
							if( upload('administradores','imagem', $foto) ){

								if( !empty($administrador->foto) ){
									unlink("./assets/upload/administradores/$administrador->foto");
								}

								$a->setFoto($administrador->id, $foto);

								$this->session->set_flashdata('mensagem', 'Administrador atualizado com sucesso!');
								$this->session->set_flashdata('tipo', 'sucesso');

								//Se usuário editado for o mesmo usuário logado, re-escreve a sessão de IMAGEM
								if( $administrador->id == $this->session->userdata('id') ){
									$this->session->set_userdata('foto', base_url("./assets/upload/administradores/$foto") );
								}
							}

						}
						else {
							$this->session->set_flashdata('mensagem', 'Administrador atualizado com sucesso, porem não foi possível salvar nova imagem!');
							$this->session->set_flashdata('tipo', 'neuro');
						}
					
					}

					//============= /Seta Avatar padrao ==============================
					
				}

			}
			
			redirect('administradores/listar');
		

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$adm = $this->uri->segment(3);

			$adm = $this->administrador->get($adm);

			$id  = $adm->id;

			if( $this->administrador->delete($id) ){

				if( !empty($adm->foto) ){
					unlink("./assets/upload/administradores/$adm->foto");
				}

				if( $id == $this->session->userdata('id') ){//Se o usuário excluido é o usuário logado, desloga o usuário
					redirect('administradores/logout');
				}

				$this->session->set_flashdata('mensagem', 'Administrador excluído com sucesso!');
				$this->session->set_flashdata('tipo', 'sucesso');

			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o administrador!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('administradores/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */
		


}
