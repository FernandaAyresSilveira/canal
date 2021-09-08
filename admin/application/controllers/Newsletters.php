<?php 

	class Newsletters extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Newsletter_model', 'newsletter');
			$this->load->model('Newsletter_email_model', 'newsletter_email');
			$this->load->model('Email_model', 'email');
			$this->load->model('Configuracao_model', 'configuracao');
		}

		public function index()
		{
			redirect('newsletters/listar');
		}

		public function listar(){

			$i   = 20;//Itens por página
			$p   = $this->input->get('p') ? $this->input->get('p') : 1;//Página

			$data['newsletters'] = $this->newsletter->getNewsPaginate($p, $i);

			$total = $data['total']  = $this->newsletter->count;

			$this->load->library('pagination');
			$config['base_url'] 			= site_url('newsletters/listar');
			$config['total_rows'] 			= $total;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config); 

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/listar', $data);
			$this->load->view('estrutura/rodape');

		}

		public function emails(){

			$i   = 20;//Itens por página
			$p   = $this->input->get('p') ? $this->input->get('p') : 1;//Página

			$data['emails'] = $this->newsletter->getEmailsPaginate($p, $i);

			$total = $data['total']  = $this->newsletter->count;

			$this->load->library('pagination');
			$config['base_url'] 			= site_url('newsletters/emails');
			$config['total_rows'] 			= $total;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config); 

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/emails', $data);
			$this->load->view('estrutura/rodape');

		}

		public function CSV(){

			$this->load->helper('download');
			$list = $this->newsletter->getAllEmails();
			$fp = fopen('php://output', 'w');

			foreach ($list as $fields) {
		        fputcsv($fp, $fields, ";");
		    }

		    $data = file_get_contents('php://output'); 
		    $name = 'lista_de_emails_newletter.csv';

		    // Build the headers to push out the file properly.
		    header('Pragma: public');     // required
		    header('Expires: 0');         // no cache
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Cache-Control: private',false);
		    header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
		    header('Content-Transfer-Encoding: binary');
		    header('Connection: close');
		    exit();

		    force_download($name, $data);
		    fclose($fp);

		}


		public function historico()
		{
			$i   = 20;//Itens por página
			$p   = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			$ids = array('0');//Array que recebera os ids das newsletter

			$n = $this->newsletter;

			$query = $n->getDistinct("newsletter_id");

			foreach ( $query as $row) {

				if( !in_array($row->newsletter_id, $ids) ){//Se o id ainda não constar na array
					array_push($ids, $row->newsletter_id);
				}
			}

			// $ids => Ids usados no where_in | $p => página atual | $i => Quantidade de itens por página
			$data['newsletters'] = $n->pegarHistoricoPaginado($ids, $p, $i);
			$news = $data['newsletters'];

			// for($i=0, $size = sizeof($news[0]); $i<$size; $i++) {

			// 	echo $news[0][$i]->news_env." - ".$news[1][$i]->news_total."<br />";

			// }

			$total = $n->pegarQuantidadeHistorico($ids);

			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('newsletters/historico').'?q='.$this->input->get('q') : site_url('newsletters/historico?g=1');
			$config['total_rows'] 			= $total;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config); 

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/historico_listar', $data);
			$this->load->view('estrutura/rodape');
		}

		public function cadastrar() {

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/cadastrar');
			$this->load->view('estrutura/rodape');
		}

		public function funcao_cadastrar() {

			$n = $this->newsletter;

			/*tipo
				2 = html
				1 = imagem
				3 = produtos
			*/

			if ($this->input->post('tipo') == '2') { /* entra caso for selecionada opção HTML */

				if ($n->save()) {
					$this->session->set_flashdata('mensagem','Newsletter cadastrado com sucesso, veja como ficou');
					$this->session->set_flashdata('tipo','sucesso');
					redirect('newsletters/visualizar/'.$n->lastInsertId );
				}
			}

			elseif ($this->input->post('tipo') == '1') { /* entra caso for selecionada opção IMAGEM */

				if($n->save()){
					if( !empty($_FILES['imagem']['name']) ){

						$foto = nome_imagem($_FILES['imagem']['name']);

						$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
						$per = array('jpg','jpeg','png');

						//Verifica se o arquivo está no array de extensões permitidas
						if( in_array($ext, $per) ){

							//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
							if( upload('newsletters','imagem', $foto) ){

								$n->setFoto($n->lastInsertId, $foto);

								$this->session->set_flashdata('mensagem', 'Newsletter cadastrada com sucesso');
								$this->session->set_flashdata('tipo', 'sucesso');
								
							}
							else {
								$this->session->set_flashdata('mensagem', 'Newsletter cadastrada com sucesso, porém houve um erro ao salvar a nova imagem!');
								$this->session->set_flashdata('tipo', 'neutro');
							}
						}
						else {
							$this->session->set_flashdata('mensagem', 'A extensão do arquivo não é permitida!');
							$this->session->set_flashdata('tipo', 'erro');
						}
					}
					else {
						$this->session->set_flashdata('mensagem', 'Newsletter cadastrada com sucesso');
						$this->session->set_flashdata('tipo', 'sucesso');
					}
					redirect('newsletters/visualizar/'.$n->lastInsertId );

				}
				redirect('newsletters/visualizar/'.$n->lastInsertId );
			}

			redirect("newsletters/listar");
		}

		public function visualizar() {

			$id = $this->uri->segment(3);
			
			$data['newsletter'] = $this->newsletter->get($id);

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/visualizar', $data);
			$this->load->view('estrutura/rodape');						
		}

		public function editar(){

			$id = $this->uri->segment(3);

			$data['newsletter'] = $this->newsletter->get($id);

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/editar', $data);
			$this->load->view('estrutura/rodape');

		}

		public function funcao_editar() {

			$n = $this->newsletter->get($this->uri->segment(3));
			$antiga = $n->imagem;

			$this->newsletter->update($this->uri->segment(3));

			if( !empty($_FILES['imagem']['name']) ){

				$foto = nome_imagem($_FILES['imagem']['name']);

				$ext = strtolower( pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION) );
				$per = array('jpg','jpeg','png');

				//Verifica se o arquivo está no array de extensões permitidas
				if( in_array($ext, $per) ){

					//Apaga a imagem antiga APENAS se o upload da nova imagem deu certo
					if( upload('newsletters','imagem', $foto) ){
						
						if( !empty($antiga) ){
							unlink("./assets/upload/newsletters/$antiga");
						}

						$this->newsletter->setFoto($this->uri->segment(3), $foto);

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

			redirect('newsletters/visualizar/'.$this->uri->segment(3));

		}

		public function funcao_excluir_newsletter()
		{
			$id = $this->uri->segment(3);

			$n = $this->newsletter;
			$news = $n->get($id);

			if($news->imagem != "" && file_exists("assets/upload/newsletters/$news->imagem")){
				unlink("assets/upload/newsletters/$news->imagem");
			}
			
			$np = $this->newsletter;
			$np->getEmailsNewsletter($id);


			if( $n->delete($id) ){
				
				$np->deleteEmailsNewsletter($id);

				$this->session->set_flashdata('mensagem', 'Newsletter excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o newsletter');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('newsletters/listar');

		}

		public function funcao_excluir_email() {
			
			$id = $this->uri->segment(3);

			$e = $this->newsletter;
			//$email = $e->getEmail($id);
			
			//$np->getEmailNewsletter($id);

			if( $e->deleteEmail($id) ){
				
				$np = $this->newsletter;
				$np->deleteEmailsNewsletter($id);

				$this->session->set_flashdata('mensagem', 'Email excluído com sucesso');
				$this->session->set_flashdata('tipo', 'sucesso');
			}
			else {
				$this->session->set_flashdata('mensagem', 'Não foi possível excluir o email');
				$this->session->set_flashdata('tipo', 'erro');
			}

			redirect('newsletters/emails');

		}


		public function destinatarios()
		{
			$id = $this->uri->segment(3);

			$data['pessoas'] = $this->email->get();

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/destinatarios', $data);
			$this->load->view('estrutura/rodape');
		}

		public function funcao_cadastrar_destinatarios()
		{
			$id = $this->uri->segment(3);

			$this->newsletter_email->delete_destinatarios($id);

			foreach ($this->input->post('dest') as $email) {

				$this->newsletter_email->saveEmail($email,$id);
			}

			redirect('newsletters/enviando/'.$id);
		}





		public function enviando() {

			$id = $this->uri->segment(3);

			$data['pessoas'] = $this->newsletter_email->getEmails($id);

			$dados['total'] = $this->newsletter_email->count;

			$this->load->view('estrutura/topo');
			$this->load->view('newsletters/enviando', $dados);
			$this->load->view('estrutura/rodape');

		}


		public function enviar() {

			set_time_limit(0);

			/* id da newsletter passado na url */
			$id = $this->input->get('id');
			/* máximo de emails a serem enviados por bloco */
			$maximo_emails = $this->input->get('y');

			$n =$this->newsletter->get($id);

			$assunto = $n->assunto;

			/* pega os dados da tabela configurações */

            //$conf = $this->configuracao->get();

			//INICIO MONTAGEM CORPO DA MENSAGEM

			if ($n->tipo == 1) { //imagem
				//não to usando base_url pq se usar vai pegar o /admin e quero enviar para a pagina principal

				$url = str_replace('/admin', '', site_url());
				$nome_site = $this->dados_globais['configuracao']->titulo;
				$unsubscribe = $url . 'newsletters/cancelar';
				$imagem = $url.'admin/assets/upload/newsletters/'.$n->imagem;
				$corpo_mensagem = "<html>
							    <head>
							    	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	   						   		<title>$assunto - $nome_site</title>
							    </head>
							    <body>
								    <font face=\"Arial\" size=\"2\" color=\"#333333\">
								    <br />
									    <center>
									    	<a href=\"$url\"><b$nome_site</b></a><br /><br />
									    	<b>$assunto</b><br /><br />
									   		<img src=\"$imagem\" style='max-width:600px; max-height:1000px;' /><br/><br/>
									    	Caso a imagem não tenha sido carregada, <a href=\"$imagem\" target='blank'><u>clique aqui.</u></a>
									   		<br><br>
									   		<font face=\"Arial\" size=\"1\" color=\"#333333\">
									    	<a href=\"$unsubscribe\" target='blank'>
									   			<u>Cancelar recebimento de e-mails.</u>
									   		</a>
									   		</font>
									    </center>
								    </font>
							    </body>
						    </html>";
			}
			else { //html
				$corpo_mensagem = $n->html;
			}
			//FIM MONTAGEM CORPO DA MENSAGEM
			
			/* Pega os itens da tabela newsletter_pessoa com o newsletter_id passado na url do ajax, com o limite estipulado no parametro 'y' */
			$news_email = $this->newsletter_email->getEmailsNoSent($id,$maximo_emails);
			
			

			/* foreach no resultado do get anterior para enviar o email */
			foreach ($news_email as $ne) {
				/* pega o email de cada pessoa para realizar o envio */
				$p = $this->email->get($ne->email_id);

				echo $p->email;

				/* envia os emails */
				if( enviar_email(utf8_decode($assunto),utf8_decode($corpo_mensagem), $p->email, $this->dados_globais['configuracao']) ){
					$this->newsletter_email->updateSent($ne->id);
				}
			}
		}



		public function busca_enviados_newsletter(){

			$id = $this->input->get('id');

			$enviados = $this->newsletter_email->getEmailsSuccess($id);

			echo $this->newsletter_email->count;

		}



}
?>