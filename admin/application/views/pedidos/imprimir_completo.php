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

			<!-- <h1>Ponto do gibi</h1> -->
			<h4>Pedido <?php echo $pedido->id ?></h4>

			<div class="left" style="width:50%; border: 1px solid #000;box-sizing: border-box;padding: 10px 20px; font-size: 17px;" >
				<p>
				   <strong>Destino: </strong><br><?php echo $pedido->cliente_nome." ".$pedido->cliente_sobrenome;?><br>
				   Rua: <?php echo $pedido->endereco; ?></p>
			</div>

			<div class="right" style="width:48%">


			<table class="pure-table" style="width:100%;font-size: 11px;">
				<thead>
					<tr>
						<th>#</th>
						<th>Gibi</th>
						<th>Estante</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;
						foreach($itens_pedido as $item) { 
							$i++;
					?>
							<tr>
								<td>#<?php echo $i ?></td>
								<td><?php echo $item->item_nome ?></td>
								<td><?php echo $item->item_referencia; ?></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>

				
			</div>

			<br class="clear">



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