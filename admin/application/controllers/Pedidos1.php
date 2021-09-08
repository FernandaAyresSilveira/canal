<?php 

	class Pedidos extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Cliente_model', 'cliente');
			$this->load->model('Venda_model', 'pedido');
			$this->load->model('Status_venda_model', 'status_pedido');
		}

		public function index()
		{
			redirect('pedidos/listar');
		}
 
		
		/* ==================== LISTAR ==================== */
		public function listar() {	

			$i = 20;//Itens por página
			$p = $this->input->get('p') ? $this->input->get('p') : 1;//Página
			
			$data['pedidos'] = $this->pedido->get_paginate($p, $i);
			
			$this->load->library('pagination');
			$config['base_url'] 			= $this->input->get('q') ? site_url('pedidos/listar').'?q='.$this->input->get('q') : site_url('pedidos/listar?g=1');
			$config['total_rows'] 			= $this->pedido->count;
			$config['per_page'] 			= $i; 
			$config['first_link'] 			= '<<';
			$config['last_link']  			= '>>';
			$config['use_page_numbers'] 	= TRUE;
			$config['page_query_string'] 	= TRUE;
			$config['query_string_segment'] = 'p';

			$this->pagination->initialize($config);			

			$data['status']= $this->status_pedido->get();

			$this->load->view('estrutura/topo');
			$this->load->view('pedidos/listar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM LISTAR ==================== */



		/* ==================== EDITAR ==================== */
		public function editar()
		{
			$data['pedido'] = $this->pedido->get($this->uri->segment(3));



			$data['produtos'] = $this->pedido->itens($this->uri->segment(3));

			$valor_produtos =0;
			foreach ($data['produtos'] as $p) {
				$valor_produtos = $valor_produtos + $p->valor;
			}
			$data['valor_produtos'] = $valor_produtos;

			/*if( count($data['produtos']) == 0 ){
				redirect('pedidos/listar');
			}*/
			

			$data['status']= $this->status_pedido->get();


///////////// situação pagseguro ///////////////

			$status_pagseguro = 'Indisponível';
					$descricao_status = 'Status não disponível';

			$descricao_status = 'N/D';
			switch ($data['pedido']->status_pagseguro) {
				case '':
				default: 
					$status_pagseguro = 'Indisponível';
					$descricao_status = 'Status não disponível';
				break;
				case 'Canceled_Reversal': 
					$status_pagseguro = 'Cancelado';
					$descricao_status = 'O pedido foi cancelado.';
				break;
				case 'Completed': 
					$status_pagseguro = 'Concluído';
					$descricao_status = 'O pagamento foi concluído e os fundos foram adicionados com sucesso ao saldo da sua conta';
					break;
				case 'Created': 
					$status_pagseguro = 'Criado'; 
					$descricao_status = 'Um pedido foi criado usando o Express Checkout.';
					break;
				case 'Denied': 
					$status_pagseguro = 'Negado'; 
					$descricao_status = 'O pagamento foi negado.';
					break;
				case 'Expired': 
					$status_pagseguro = 'Expirado'; 
					$descricao_status = 'Esta autorização expirou';
					break;
				case 'Failed': 
					$status_pagseguro = 'Falhou'; 
					$descricao_status = 'O valor da transação foi devolvido para o comprador.';
					break;
				case 'Pending': 
					$status_pagseguro = 'Pendente'; 
					$descricao_status = 'O pagamento está pendente';
					break;
				case 'Refunded': 
					$status_pagseguro = 'Reembolsado'; 
					$descricao_status = 'O valor da transação foi devolvido para o comprador.';
					break;
				case 'Reversed': 
					$status_pagseguro = 'Revertido'; 
					$descricao_status = 'Os fundos foram removidos do saldo da sua conta e devolvidos ao comprador';
					break;
				case 'Processed': 
					$status_pagseguro = 'Processado'; 
					$descricao_status = 'Um pagamento foi aceito';
					break;
				case 'Voided': 
					$status_pagseguro = 'Anulado'; 
					$descricao_status = 'Pedido anulado.';
					break;
			}

			$data['status_pagseguro'] =  $status_pagseguro;
			$data['status_paypal'] =$status_pagseguro;
			$data['descricao_status'] = $descricao_status;

			$this->load->view('estrutura/topo');
			$this->load->view('pedidos/editar', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM EDITAR ==================== */





		public function imprimir() {

			$data['pedido'] = $this->pedido->get($this->uri->segment(3));

			$data['itens_pedido'] = $this->pedido->itens($this->uri->segment(3));

			/*if( count($data['pedido']) == 0 ){
				redirect('pedidos/listar');
			}	*/		

			$valor_produtos =0;
			foreach ($data['itens_pedido'] as $p) {
				$valor_produtos = $valor_produtos + $p->valor;
			}
			$data['valor_produtos'] = $valor_produtos;

			
			$this->load->view('pedidos/imprimir', $data);
		}


		/* ==================== FUNÇÃO EDITAR ==================== */
		public function funcao_editar()
		{		
			$venda_antes = $this->pedido->get($this->uri->segment(3));

			$novo_status = $this->input->post('status_venda_id');
			$this->pedido->status_venda($this->uri->segment(3),$this->input->post('status_venda_id'));	

			if ($this->input->post('codigo_rastreio')) {
				$this->pedido->codigo_rastreio($this->uri->segment(3),$this->input->post('codigo_rastreio'));	
			}
			$venda = $this->pedido->get($this->uri->segment(3));

			if ($venda_antes->status_venda_id != $novo_status) {//é um novo status então...
				//se for para pago, aguarddando pagamento, lançae e-mail
				if ($novo_status==2) {
					

					$itens = $this->pedido->itens($venda->id);

					//mostrar entao a linda mensagem de agradecimento pela sua compra
					$tipo_frete = $venda->tipo_frete;
					$mensagem_frete = '';
					if ($tipo_frete=='pac'){
						$mensagem_frete =' PAC (Correios)';
					}
					if ($tipo_frete=='sedex'){
						$mensagem_frete =' Sedex (Correios)';
					}
					if($tipo_frete=='impresso') {
						$mensagem_frete =' Registrado econômico (Correio)';
					}
					if($tipo_frete=='revistaria') {
						$mensagem_frete =' Revistaria São Francisco, que fica localizada na Rua Gonçalves Chaves, 2810 - loja 1 - Centro, Pelotas - RS';
					}

					$detalhe_itens="";
					foreach ($itens as $item) {
						$detalhe_itens.="<i>".$item->item_nome.'</i> -  Valor: R$ '.mostrar_valor($item->valor).'<br>';
					}

					$endereco_entrega = '';
					if ($tipo_frete!='revistaria') {
						$endereco_entrega = '<b>Endereço para entrega</b><br>: '.$venda->endereco.'<br>';
					}
					if ($tipo_frete=='revistaria') {
						$dados_entrega_revistaria = "Caso tenha escolhido a opção de retirada na Revistaria São Francisco, em Pelotas, será avisado quando seu produto estiver à disposição no local. Prazo de 3 dias úteis.<br>";
					}else{
						$dados_entrega_revistaria ='';
					}

					//enviar_email('Pedido cadastrado em nosso sistema','Pendente',$venda->cliente_email);

					$mensagem = "

					<table cellpadding='0' cellspacing='0' width='800px' border='0' style='border-color: #fffff !important'>
					 <tr>
					  <td width='260' valign='top'>
					   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
					    <tr>
					     <td>
					      <img src='".base_url('./assets/img/email-topo.png')."' alt=' width='100%' height='140' style='display: block;' />
					     </td>
					    </tr>
					    <tr>
					     <td style='padding: 25px 0 0 0;font-family:Arial;line-height:160%'>
					      
					      <center>Olá ".$venda->cliente_nome.". 
					      Seu pagamento referente ao pedido ".$venda->id." foi aprovado (identificado). Obrigado pela preferência.<br>
							Seu pedido já está em preparação e será postado nos próximos três dias úteis, para o endereço indicado no ato da compra. Você receberá uma mensagem informando o código de rastreio dos Correios.</br>
		


					".$dados_entrega_revistaria."


									     </td>
					    </tr>
					   </table>
					  </td>
					 <tr>
					  <td width='260' valign='top' style='padding:0px 15px;font-family:Arial;line-height:160%'>
					   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
					    
					    <tr>
					     <td style='padding: 10px ;line-height:160%'>
					     	<b>Pedido</b>: ".$venda->id."<br>
					     	<b>Valor</b>: R$ ".mostrar_valor($venda->valor_final)."<br>
					     	<b>Envio</b>: ".$mensagem_frete."<br><br>

					     	".$endereco_entrega."
					     	<b>Itens do pedido</b><br>
					     	".$detalhe_itens."<br>
					     	Atenciosamente,<br>
					     	Eduardo Lemos<br>
					     	Gerente de vendas


					     </td>
					    </tr>
					   </table>";

				   	enviar_email('Pedido pago, em preparação',$mensagem,$venda->cliente_email);
				}//fim de pago, em preparacao

				   if ($novo_status==3) {//entre na revistaria

						$itens = $this->pedido->itens($venda->id);

						//mostrar entao a linda mensagem de agradecimento pela sua compra
						$tipo_frete = $venda->tipo_frete;
						$mensagem_frete = '';
						if ($tipo_frete=='pac'){
							$mensagem_frete =' PAC (Correios)';
						}
						if ($tipo_frete=='sedex'){
							$mensagem_frete =' Sedex (Correios)';
						}
						if($tipo_frete=='impresso') {
							$mensagem_frete =' Registrado econômico (Correio)';
						}
						if($tipo_frete=='revistaria') {
							$mensagem_frete =' Revistaria São Francisco, que fica localizada na Rua Gonçalves Chaves, 2810 - loja 1 - Centro, Pelotas - RS';
						}

						$detalhe_itens="";
						foreach ($itens as $item) {
							$detalhe_itens.="<i>".$item->item_nome.'</i> -  Valor:'.mostrar_valor($item->valor).'<br>';
						}

						$endereco_entrega = '';
						if ($tipo_frete!='revistaria') {
							$endereco_entrega = '<b>Endereço para entrega</b><br>: '.$venda->endereco.'<br>';
						}
						
							$dados_entrega_revistaria ='';
						

						//enviar_email('Pedido cadastrado em nosso sistema','Pendente',$venda->cliente_email);

						$mensagem = "

						<table cellpadding='0' cellspacing='0' width='800px' border='0' style='border-color: #fffff !important'>
						 <tr>
						  <td width='260' valign='top'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
						    <tr>
						     <td>
						      <img src='".base_url('./assets/img/email-topo.png')."' alt=' width='100%' height='140' style='display: block;' />
						     </td>
						    </tr>
						    <tr>
						     <td style='padding: 25px 0 0 0;font-family:Arial;line-height:160%'>
						      
						      <center>Olá ".$venda->cliente_nome.". 
						      Seu pedido ".$venda->id." já está à disposição para retirada.<br>

						      <b>Local</b>: Revistaria São Francisco, Rua Gonçalves Chaves, 2810 - loja 1 - Centro, Pelotas – RS<br>
						      Para retirada é necessário apenas se identificar no balcão. Atendimento em horário comercial sem fechar ao meio-dia.<br>
						      Agradecemos pela preferência, esperamos ter atendido a suas expectativas.

										     </td>
						    </tr>
						   </table>
						  </td>
						 <tr>
						  <td width='260' valign='top' style='padding:0px 15px;font-family:Arial;line-height:160%'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
						    
						    <tr>
						     <td style='padding: 10px ;line-height:160%'>
						     	<b>Pedido</b>: ".$venda->id."<br>
						     	<b>Valor</b>: ".mostrar_valor($venda->valor_final)."<br>
						     	
						     	<b>Itens do pedido</b><br>
						     	".$detalhe_itens."<br><br>


						     	Qualquer dúvida ou problema entre em contato pelo Whatsapp 053 984060132 - contato@pontodogibi.com.br<br><br>
						     	Atenciosamente,<br>
						     	Eduardo Lemos<br>
						     	Gerente de vendas


						     </td>
						    </tr>
						   </table>";

					   	enviar_email('Seu pedido já está à disposição para retirada',$mensagem,$venda->cliente_email);
				   }//fim do aviso de ta na revistyaria


				    if ($novo_status==4) {//enviado

						$itens = $this->pedido->itens($venda->id);

						//mostrar entao a linda mensagem de agradecimento pela sua compra
						$tipo_frete = $venda->tipo_frete;
						$mensagem_frete = '';
						if ($tipo_frete=='pac'){
							$mensagem_frete =' PAC (Correios)';
						}
						if ($tipo_frete=='sedex'){
							$mensagem_frete =' Sedex (Correios)';
						}
						if($tipo_frete=='impresso') {
							$mensagem_frete =' Registrado econômico (Correio)';
						}
						if($tipo_frete=='revistaria') {
							$mensagem_frete =' Revistaria São Francisco, que fica localizada na Rua Gonçalves Chaves, 2810 - loja 1 - Centro, Pelotas - RS';
						}

						$detalhe_itens="";
						foreach ($itens as $item) {
							$detalhe_itens.="<i>".$item->item_nome.'</i> -  Valor: R$ '.mostrar_valor($item->valor).'<br>';
						}

						$endereco_entrega = '';
						if ($tipo_frete!='revistaria') {
							$endereco_entrega = '<b>Endereço para entrega</b><br>: '.$venda->endereco.'<br>';
						}
						
							$dados_entrega_revistaria ='';
						

						//enviar_email('Pedido cadastrado em nosso sistema','Pendente',$venda->cliente_email);

						$mensagem = "

						<table cellpadding='0' cellspacing='0' width='800px' border='0' style='border-color: #fffff !important'>
						 <tr>
						  <td width='260' valign='top'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
						    <tr>
						     <td>
						      <img src='".base_url('./assets/img/email-topo.png')."' alt=' width='100%' height='140' style='display: block;' />
						     </td>
						    </tr>
						    <tr>
						     <td style='padding: 25px 0 0 0;font-family:Arial;line-height:160%'>
						      
						      <center>Olá ".$venda->cliente_nome.". 
						      Seu pedido ".$venda->id." já foi enviado, código de rastreamento <b>".$venda->codigo_rastreio."</b>.<br> Você pode acompanhar seu pedido no link <a href='http://www2.correios.com.br/sistemas/rastreamento/default.cfm '>http://www2.correios.com.br/sistemas/rastreamento/default.cfm </a>.<br>

						      		Agradecemos pela preferência, esperamos ter atendido a suas expectativas.<br>
									Qualquer dúvida ou problema entre em contato pelo Whatsapp 053 984060132 – contato@pontodogibi.com.br


										     </td>
						    </tr>
						   </table>
						  </td>
						 <tr>
						  <td width='260' valign='top' style='padding:0px 15px;font-family:Arial;line-height:160%'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
						    
						    <tr>
						     <td style='padding: 10px ;line-height:160%'>
						     	<b>Pedido</b>: ".$venda->id."<br>
						     	<b>Valor</b>: R$ ".mostrar_valor($venda->valor_final)."<br>
						     	
						     	<b>Itens do pedido</b><br>
						     	".$detalhe_itens."<br><br>


						     	Qualquer dúvida ou problema entre em contato pelo Whatsapp 053 984060132 - contato@pontodogibi.com.br<br><br>
						     	Atenciosamente,<br>
						     	Eduardo Lemos<br>
						     	Gerente de vendas


						     </td>
						    </tr>
						   </table>";

					   	enviar_email('Pedido enviado',$mensagem,$venda->cliente_email);
				   }//fim do aviso de enviado

				   if ($novo_status == 6) {//cancelando a venda sim
				   	 $this->pedido->cancelar_venda_reativar_anuncios($venda->id);
				   }




				////////////fim email

						# code...
			}		

			$this->session->set_flashdata('mensagem', 'Pedido atualizado com sucesso!');
			$this->session->set_flashdata('tipo', 'sucesso');

			redirect('pedidos/listar/');

		}
		/* ==================== FIM FUNÇÃO EDITAR ==================== */


		public function imprimir_completo() {

			$data['pedido'] = $this->pedido->get($this->uri->segment(3));

			$data['itens_pedido'] = $this->pedido->itens($this->uri->segment(3));

			$valor_produtos =0;
			foreach ($data['itens_pedido'] as $p) {
				$valor_produtos = $valor_produtos + $p->valor;
			}
			$data['valor_produtos'] = $valor_produtos;

			
			$this->load->view('pedidos/imprimir_completo', $data);
		}














	}














