<?php 

	class Imagens extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Imagem_model', 'imagem');
		}

		public function index()
		{
			redirect('upload');
		}

		public function upload()
		{
			$dados['imagens'] = $this->imagem->getTemp($this->uri->segment(3));
			//echo "<p>".$this->uri->segment(3)."</p>";
			$dados['tipoImagem'] = $this->uri->segment(3);
			$dados['idTipoImagem'] = $this->uri->segment(4);

			$this->load->view('imagens/index', $dados);
			
		}

		public function funcao_upload()
		{
			$nomeImagem = $_FILES['imagem']['name'];
			$tipoImagem = $_POST['tipo'];
			$idTipoImagem = $_POST['idTipo'];

			if( !empty($nomeImagem) ){

				$foto = nome_imagem($nomeImagem);

				$ext = strtolower( pathinfo($nomeImagem, PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					if( upload($tipoImagem,'imagem', $foto) ){

						$this->imagem->save($foto, $tipoImagem, $idTipoImagem);

						echo '{"status":"success"}';
    					exit;
						
					}
					else {
						echo '{"status":"error"}';
    					exit;
					}

				}
				else {
					echo '{"status":"error"}';
    				exit;
				}
			}
			else {
				echo '{"status":"error"}';
    			exit;
			}
		
		}

		public function excluirImg(){
			$idImg = $this->input->get_post("id");

			if($this->imagem->delete($idImg)){
				echo '{"status":"success"}';
			}
			else{
				echo '{"status":"error"}';
			}
		}

		public function editarTitulo()
		{
			if($this->imagem->update()){

				echo '{"status":"success"}';
    			exit;
			
			}
			else {
				
				echo '{"status":"error"}';
				exit;

			}

		}


	}