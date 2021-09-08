<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<?php echo link_tag('./assets/css/listas.css'); ?>

		<title>Imprimir</title>

		<style type="text/css">
			
			body {
				font-family: sans-serif;
				font-size: 13px;
			}

			.print-container {
				width: 20cm;
				height: 28cm;
				page-break-after: always;
				padding: 10px;
			}

			.clear {
				clear: both;
			}

			h1, h2, h4 {
				margin: 10px 0 10px 0;
				text-align: center !important;
			}

			table{
				margin-top: 30px;
			}

			.quebra {
				page-break-after: always;
			}

			.right {
				float: right;
			}
			.left {
				float: left;
			}

		</style>
	</head>


	
	<body onload="print_window()">
	<!-- <body> -->
		<div class="print-container">
			
			<div class="right"><?php echo date('d/m/Y H:i:s') ?></div>
			<br class="clear">

			<h1>Ponto do gibi</h1>
			<h4>Descrição de pedido</h4>

			<div class="left" style="width:49%">
				<p><strong>Nº Pedido: </strong><?php echo $pedido->id ?></p>
				<p><strong>Situação: </strong><?php echo $pedido->status_pedido_nome ?></p>
				<p><strong>Cliente: </strong><?php echo $pedido->cliente_nome;?></p>
				<p><strong>CPF: </strong><?php echo $pedido->cliente_cpf; ?></p>
				<p><strong>Telefone(s): </strong>
					<?php 
						echo $pedido->cliente_telefone;
						echo " / ";
						echo $pedido->cliente_celular;
					?>
				</p>
				<p><strong><u>Endereço de entrega:</u></strong></p>
				<p><strong>Identificação: </strong><?php echo $pedido->endereco; ?></p>
			</div>

			<div class="right" style="width:49%">
				<p><strong>Valor produtos: </strong> R$<?php echo mostrar_valor($valor_produtos) ?> </p>
				<p><strong>Valor desconto: </strong> R$<?php echo mostrar_valor($pedido->valor_desconto) ?> </p>
				<p><strong>Valor frete: </strong> R$<?php echo mostrar_valor($pedido->valor_frete) ?> </p>
				<p><strong>Tipo frete: </strong> <?php echo $pedido->tipo_frete; ?> </p>
				<p><strong>Valor total: </strong> R$<?php echo mostrar_valor($pedido->valor_final) ?> </p><!-- 
				<p><strong>Observações para entrega: </strong><?php echo $pedido->observacao ? $pedido->observacao : 'N/D' ?></p> -->
			</div>

			<br class="clear">

			<table class="pure-table" style="width:100%">
				<thead>
					<tr>
						<th>Item número</th>
						<th>Produto</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;
						foreach($itens_pedido as $item) { 
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $item->item_nome ?></td>
								<td>R$<?php echo mostrar_valor($item->valor ) ?></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>



		</div>
	</body>
</html>

<script>
	function print_window(){
		window.print();
		setTimeout(function () { 
			window.open('', '_self', '');
			window.close();
		}, 100);
	}
</script>