<?php 

	class Anuncios extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Anuncio_model', 'anuncio');
			$this->load->model('Ano_model', 'ano');
			$this->load->model('Departamento_model', 'departamento');
			$this->load->model('Categoria_model', 'categoria');
			$this->load->model('Subcategoria_model', 'subcategoria');
			$this->load->model('Editora_model', 'editora');
		}


		public function index()
		{
			redirect('anuncios/listar');
		}

		/* ==================== CADASTRAR ==================== */
		public function perguntar()
		{
			$this->load->view('estrutura/topo');
			$this->load->view('anuncios/perguntar');
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */


		/* ==================== CADASTRAR ==================== */
		public function cadastrar()
		{
			$data['departamentos'] = $this->departamento->get();
			$data['anos'] = $this->ano->get();
			$data['editoras'] = $this->editora->get();
			//$data['categorias'] = $this->categoria->porDepartamento();

			$this->load->view('estrutura/topo');
			$this->load->view('anuncios/cadastrar',$data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM CADASTRAR ==================== */
		


		/* ==================== LISTAR ==================== */
		public function listar()
		{
			$data['departamentos'] = $this->departamento->get();
			$data['anuncios'] = $this->anuncio->get();
			$data['count_anuncios'] = $this->anuncio->count;
			//print_r($data['anuncios']);

			$this->load->view('estrutura/topo');
			$this->load->view('anuncios/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['anos'] = $this->ano->get();
			$data['editoras'] = $this->editora->get();
			
			$data['anuncio'] = $this->anuncio->get($this->uri->segment(3));

			$data['departamentos'] = $this->departamento->get();
			$data['categorias'] = $this->categoria->porDepartamento($data['anuncio']->departamento_id);
			$data['subcategorias'] = $this->subcategoria->porCategoria($data['anuncio']->categoria_id);

			if( $this->anuncio->count == 0 ){
				redirect('anuncios/listar');
			}


			$this->load->view('estrutura/topo');
			$this->load->view('anuncios/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */

		
		
		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function funcao_cadastrar()
		{
			$b = $this->anuncio;

			if($b->save()){
				$id = $b->lastInsertId();
				$erro = 0;
				$per = array('jpg','jpeg','png');

				// criando a pasta
				mkdir("./assets/upload/anuncios/".$id, 0777);

				if( !empty($_FILES['imagem1']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem1']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem1 = nome_imagem($_FILES['imagem1']['name']);

						if (upload('anuncios/'.$id, 'imagem1', $imagem1)){
							$this->anuncio->setImagem($id,'imagem1', $imagem1);
						}else{
							$erro++;
						}
					}
					else
						$erro++;
				}
								if( !empty($_FILES['imagem2']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem2']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem2 = nome_imagem($_FILES['imagem2']['name']);
						if (!upload('anuncios/'.$id, 'imagem2', $imagem2, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem2', $imagem2);
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem3']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem3']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem3 = nome_imagem($_FILES['imagem3']['name']);
						if (!upload('anuncios/'.$id, 'imagem3', $imagem3, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem3', $imagem3);
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem4']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem4']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem4 = nome_imagem($_FILES['imagem4']['name']);
						if (!upload('anuncios/'.$id, 'imagem4', $imagem4, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem1', $imagem4);
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem5']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem5']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem5 = nome_imagem($_FILES['imagem5']['name']);
						if (!upload('anuncios/'.$id, 'imagem5', $imagem5, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem5', $imagem5);
						}
					}
					else
						$erro++;
				}


				

				

				if( $erro == 0 ){
						$this->session->set_flashdata('mensagem','Anuncio  cadastrado com sucesso');
						$this->session->set_flashdata('tipo','sucesso');
				}
				else {
					$this->session->set_flashdata('mensagem','Anuncio cadastrado, porém houve um erro ao salvar a(s) imagem(s)');
					$this->session->set_flashdata('tipo','neutro');
				}	
			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar banner!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			if ($id > 0) {
				redirect('anuncios/perguntar/'.$id);
			}else{
				redirect('anuncios/cadastrar/');
			}
			

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{	
			$id = $this->uri->segment(3);
			$b = $this->anuncio->get($this->uri->segment(3));
			$antiga1 = $b->imagem1;
			$antiga2 = $b->imagem2;
			$antiga3 = $b->imagem3;
			$antiga4 = $b->imagem4;
			$antiga5 = $b->imagem5;

			$this->anuncio->update($this->uri->segment(3));

			$erro = 0;
			$per = array('jpg','jpeg','png');

			if( !empty($_FILES['imagem1']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem1']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem1 = nome_imagem($_FILES['imagem1']['name']);

						if (upload('anuncios/'.$id, 'imagem1', $imagem1)){
							$this->anuncio->setImagem($id,'imagem1', $imagem1);
							if (file_exists($antiga1) && $antiga1 !='') {
								unlink('./assets/upload/anuncios/'.$id.'/'.$antiga1);
							}
						}else{
							$erro++;
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem2']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem2']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem2 = nome_imagem($_FILES['imagem2']['name']);
						if (!upload('anuncios/'.$id, 'imagem2', $imagem2, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem2', $imagem2);
							if (file_exists($antiga2) && $antiga2 !='') {
								unlink('./assets/upload/anuncios/'.$id.'/'.$antiga2);
							}
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem3']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem3']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem3 = nome_imagem($_FILES['imagem3']['name']);
						if (!upload('anuncios/'.$id, 'imagem3', $imagem3, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem3', $imagem3);
							if (file_exists($antiga3) && $antiga3 !='') {
								unlink('./assets/upload/anuncios/'.$id.'/'.$antiga3);
							}
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem4']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem4']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem4 = nome_imagem($_FILES['imagem4']['name']);
						if (!upload('anuncios/'.$id, 'imagem4', $imagem4, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem4', $imagem4);
							if (file_exists($antiga4) && $antiga4 !='') {
								unlink('./assets/upload/anuncios/'.$id.'/'.$antiga4);
							}
						}
					}
					else
						$erro++;
				}
				if( !empty($_FILES['imagem5']['name']) ){
					$ext = strtolower( pathinfo($_FILES['imagem5']['name'], PATHINFO_EXTENSION) );

					if(in_array($ext, $per)) {

						$imagem5 = nome_imagem($_FILES['imagem5']['name']);
						if (!upload('anuncios/'.$id, 'imagem5', $imagem5, '5000')){
							$erro++;
						}else{
							$this->anuncio->setImagem($id,'imagem5', $imagem5);
							if (file_exists($antiga5) && $antiga5 !='') {
								unlink('./assets/upload/anuncios/'.$id.'/'.$antiga5);
							}
						}
					}
					else
						$erro++;
				}


			

			if( $erro == 0 ){
					$this->session->set_flashdata('mensagem','Anuncio editado com sucesso');
					$this->session->set_flashdata('tipo','sucesso');
			}
			else {
				$this->session->set_flashdata('mensagem','Anuncio editado, porém houve um erro ao salvar a(s) imagem(s)');
				$this->session->set_flashdata('tipo','neutro');
				$this->session->set_flashdata('tipo', 'erro');
			}

			if ($id > 0) {
				redirect('anuncios/perguntar/'.$id);
			}else{
				redirect('anuncios/listar/');
			}

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */

		/* ==================== FUNÇÃO CADASTRAR ==================== */
		public function duplicar()
		{
			$id_duplicar = $this->uri->segment(3);

			$duplicar = $this->anuncio->get($id_duplicar);

			$b = $this->anuncio; 


			if(
				$b->duplicar( $duplicar->nome,$duplicar->valor,$duplicar->descricao,$duplicar->promocao,
							  $duplicar->valor_promocional, $duplicar->mostrar_home,$duplicar->destaque,
							  $duplicar->departamento_id,$duplicar->categoria_id,
							  $duplicar->subcategoria_id,$duplicar->editora_id,$duplicar->referencia,
							  $duplicar->ano_id, $duplicar->comprimento,$duplicar->largura,
							  $duplicar->altura,$duplicar->peso )){
				$id = $b->lastInsertId();
				$erro = 0;
				$per = array('jpg','jpeg','png');

				// criando a pasta
				mkdir("./assets/upload/anuncios/".$id, 0777);

				
				

				

				if( $erro == 0 ){
						$this->session->set_flashdata('mensagem','Anuncio  cadastrado com sucesso');
						$this->session->set_flashdata('tipo','sucesso');
				}
				else {
					$this->session->set_flashdata('mensagem','Anuncio cadastrado, porém houve um erro ao salvar a(s) imagem(s)');
					$this->session->set_flashdata('tipo','neutro');
				}	
			}
			else {
				$this->session->set_flashdata('mensagem', 'Erro ao cadastrar banner!');
				$this->session->set_flashdata('tipo', 'erro');
			}
			
			redirect('anuncios/editar/'.$id);

		}
		/* ==================== FIM FUNÇÃO CADASTRAR ==================== */



		/* ==================== FUNÇÃO EXCLUIR ==================== */
		public function funcao_excluir()
		{

			$b = $this->banner->get();

			$imagem = $b->imagem;

			if( $this->banner->delete( $this->uri->segment(3) ) ){
				$this->session->set_flashdata('mensagem', 'Banner excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');

				if( !empty($imagem) ){
					unlink("./assets/upload/anuncios/$imagem");
				}
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o banner');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('anuncios/listar');

		}
		/* ==================== FIM FUNÇÃO EXCLUIR ==================== */


		public function modificar_ordem_objetos(){

			$this->banner->modificar_ordem_objetos();

			
		}

		public function categorias_departamento()
		{
			$dep = $this->input->get('dep');
			$categorias = $this->categoria->porDepartamento($dep);

			echo "<option>Selecione a categoria</option>";
			foreach ($categorias as $cat) {
				echo "<option value='".$cat->id."'>".$cat->nome."</option>";
			}
		}


		public function modal_cadastro_categoria()
		{
			$data['dep'] = $this->departamento->get( $this->input->get('dep') );

			$this->load->view('anuncios/modal_cadastro_categoria',$data);
		}


		public function cadastrar_categoria_departamento(){
			$dep = $this->input->get('dep');
			$cat = $this->input->get('cat');

			echo $this->anuncio->cadastrar_categoria_departamento($dep,$cat);
		}

		public function subcategorias_categoria()
		{
			$cat = $this->input->get('cat');
			$subcategorias = $this->subcategoria->porCategoria($cat);

			echo "<option>Selecione a subcategoria</option>";
			foreach ($subcategorias as $sub) {
				echo "<option value='".$sub->id."'>".$sub->nome."</option>";
			}
		}


		public function modal_cadastro_subcategoria()
		{
			$data['cat'] = $this->categoria->get( $this->input->get('cat') );

			$this->load->view('anuncios/modal_cadastro_subcategoria',$data);
		}

		public function cadastrar_subcategoria_categoria(){
			$cat = $this->input->get('cat');
			$sub = $this->input->get('sub');

			echo $this->anuncio->cadastrar_subcategoria_categoria($cat,$sub);
		}

		public function modal_cadastro_editora()
		{

			$this->load->view('anuncios/modal_cadastro_editora');
		}


		public function cadastrar_editora(){
			$edi = $this->input->get('edi');

			echo $this->anuncio->cadastrar_editora($edi);
		}


		public function editoras()
		{
			$edi = $this->input->get('edi');
			$editoras = $this->editora->get();

			echo "<option>Selecione a editora</option>";
			foreach ($editoras as $edi) {
				echo "<option value='".$edi->id."'>".$edi->nome."</option>";
			}
		}




}