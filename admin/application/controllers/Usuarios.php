<?php 

	class Usuarios extends MY_Controller {


		public function index()
		{
			redirect('usuarios/listar');
		}

		public function login()
		{
			if( $this->session->userdata('logado') ){
				redirect('home');
			}
			else {
				if( $this->input->post() ){	

					if( $this->usuario->login() ){

						$u = $this->usuario->getUserdata();

						$primeiro_nome  = explode(' ', $u->nome);

						$this->session->set_userdata('id', $u->id);
						$this->session->set_userdata('nome', $primeiro_nome[0]);
						$this->session->set_userdata('email', $u->email);
						$this->session->set_userdata('logado', true);

						redirect('home');
						//Avisa o ajax que o usuário foi encontrado

					}
					else {
						$this->session->set_flashdata('mensagem', 'Login não Encontrado!');
						$this->session->set_flashdata('tipo', 'neutro');
						
						//Avisa o ajax que não encontrou o usuário, e o jquery exibe o aviso de erro
					}

				}

				$this->load->view('usuarios/login');

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
			redirect('usuarios/login');
		}
		/* ==================== FIM LOGOUT ==================== */



		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('usuarios/cadastrar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{	

			$data['usuario'] = $this->usuario->get( $this->uri->segment(3) );

			if( $this->usuario->count ){

				$this->load->view('estrutura/topo');
				$this->load->view('usuarios/editar',$data);
				$this->load->view('estrutura/rodape');
			
			}
			else {

				$this->session->set_flashdata('mensagem', 'Usuário inválido!');
				$this->session->set_flashdata('tipo', 'neutro');

				redirect('usuarios/listar');
			}

			
		}
		/* ==================== FIM EDITAR ==================== */



		/* ==================== LISTAR ==================== */
		public function listar()
		{	

			$this->load->view('estrutura/topo');
			$this->load->view('usuarios/listar');
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM LISTAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{

			if( $this->usuario->save() ){
					
					$this->session->set_flashdata('mensagem', 'Usuário cadastrado com sucesso!');
					$this->session->set_flashdata('tipo', 'sucesso');

			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao realizar o cadastro de usuário!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('usuarios/listar');
			
		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{

			if( $this->input->post() ){

				$a = $this->usuario;     

				$usuario = $a->get( $this->uri->segment(3) );

				if( $a->count() == 0 ){
					$this->session->set_flashdata('mensagem', 'Código de usuário inválido!');
					$this->session->set_flashdata('tipo', 'neutro');

					redirect('usuarios/listar');
				}
				
				if($a->update( $this->uri->segment(3) )){

					if( $this->input->post('senha') ){
						$a->updateSenha( $this->uri->segment(3) );
					}
					
					$this->session->set_flashdata('mensagem', 'Usuário atualizado com sucesso!');
					$this->session->set_flashdata('tipo', 'sucesso');

				}else{
						
					$this->session->set_flashdata('mensagem', 'Usuário não foi atualizado com sucesso');
					$this->session->set_flashdata('tipo', 'erro');				
					
				}

			}
			
			redirect('usuarios/listar');
		

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$adm = $this->uri->segment(3);

			$adm = $this->usuario->get($adm);

			$id  = $adm->id;

			if( $this->usuario->delete($id) ){

				$this->session->set_flashdata('mensagem', 'Usuário excluído com sucesso!');
				$this->session->set_flashdata('tipo', 'sucesso');

			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o usuário!');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('usuarios/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */
		


}
