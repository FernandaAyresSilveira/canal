<h3 class="legenda"> Editar pedido</h3>

		<div class="col-md-12">	 
		

		<div class="form-group">


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("pedidos/funcao_editar/$pedido->id"); ?>">
		
<!--=================== INFORMAÇOES GERAIS ===================-->

		<fieldset class="area-padrao verde tamanho-100 centro">
			
			<legend class="legenda"> Pedido ID: <?php echo $pedido->id; ?>  </legend>
			<div class="padding">
				
				<div class="col-xl-3 pull-left">
					<label for="status_venda_id" class="label-form"> Status</label>
					<br class="clear" />
					<select name="status_venda_id" id="status_venda_id" class="form-control tamanho-80"  >
					
						<?php foreach($status as $status){ ?>
						<option <?php if($pedido->status_venda_id == $status->id) echo "selected"; ?> value="<?php echo $status->id; ?>"><?php echo $status->nome; ?></option>
							<?php }
							 ?>
					</select>
					<br class="clear" />
				</div>


				<div class="col-xl-3 pull-left">
					<label for="codigo_rastreio" class="label-form"> Cod. Rastreamento </label>
					<br class="clear" />
					<?php $ids = array(1,4,5,6) ?>
					<input type="text" name="codigo_rastreio" id="codigo_rastreio"  class="form-control tamanho-80"  value="<?php echo $pedido->codigo_rastreio; ?>"/>
					<br class="clear" />
				</div>	


				<div class="col-xl-3 pull-left">
					<label for="data" class="label-form"> Data </label>
					<br class="clear" />
					<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo converter_data($pedido->data); ?>" disabled="disabled"/>
					<br class="clear" />
				</div>	
			
				<br class="clear" />
				<?php $tipo_pagamento ='';
				if ($pedido->mercadopago=='1') { $tipo_pagamento = 'Mercado Pago';}
				if ($pedido->paypal=='1') { $tipo_pagamento = 'Paypal';}
				if ($pedido->deposito=='1') { $tipo_pagamento = 'Depósito';}
				 ?>

				<div class="col-xl-3 pull-left">
					<label class="label-form"> Pagamento</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo               $tipo_pagamento; ?>">
					<br class="clear">
				</div>
				<?php if ($pedido->mercadopago=='1') { ?>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Estado</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->collection_status ? $pedido->collection_status : 'N/D'; ?>">
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Alteracção Mercado Pago</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->alteracao_mercadopago ? $pedido->alteracao_mercadopago : 'N/D'; ?>">
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Tipo de pagamento</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->payment_type ? $pedido->payment_type : 'N/D'; ?>">
					<br class="clear">
				</div>


				<?php } ?>

				<?php if ($pedido->paypal=='1') { ?>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Estado</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->status_paypal ? $pedido->status_paypal : 'N/D'; ?>">
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Alteração Mercado Pago</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->alteracao_paypal ? $pedido->alteracao_paypal : 'N/D'; ?>">
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"> Token Paypal</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->token_paypal ? $pedido->token_paypal : 'N/D'; ?>">
					<br class="clear">
				</div>


				<?php } ?>





				<!-- <div class="col-xl-3 pull-left">
					<label class="label-form"> ID transação paypal</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90" value="<?php echo $pedido->token_paypal ? $pedido->token_paypal : 'N/D'; ?>">
					<br class="clear">
				</div>

				<div class="col-xl-3 pull-left">
					<label class="label-form"> Situação paypal</label>
					<br class="clear" />
					<input type="text" disabled="" class="form-control tamanho-90 float-left" value="<?php echo $status_pagseguro.' - Atualizado em '.converter_data($pedido->alteracao_pagseguro) ?>" style="margin-right: 5px;">
					<div title="<?php echo $descricao_status ?>" class="botao-editar botao-acao acao-ajuda float-left" target="_blank"></div>
					<br class="clear">
				</div>
 -->
	
				
				<br class="clear">
				<div class="col-xl-3 pull-left">
					<label for="data" class="label-form"> Cliente</label>
					<br class="clear" />
					<input type="text" name="data" id="data" class="form-control tamanho-80"  value="<?php echo $pedido->cliente_nome; ?>" disabled="disabled" style="margin-right: 5px;"/>
					<a href="<?php echo site_url("clientes/editar/$pedido->cliente_id"); ?>" title="Visualizar cliente" class="botao botao-editar botao-acao acao-visualizar float-left" target="_blank"></a>
					<br class="clear" />
				</div>	
				

				<br class="clear" />
				<input type="submit" value="Salvar" class="btn btn-success pull-right"style="margin-right: 5px;" />
				<a href="<?php echo site_url('pedidos/listar'); ?>" class="btn btn-default pull-right" style="margin-right: 5px;"> Listar </a >
				<a href="<?php echo site_url('pedidos/imprimir/'.$pedido->id); ?>" class="btn btn-warning pull-right" target="blank"style="margin-right: 5px;"> Imprimir para o cliente</a>
				

				
			</div>
		</fieldset>
	</form>
	
	
<!-- INFORMAÇOES DE VALORES -->

	<br class="clear" />
	<fieldset class="area-padrao azul tamanho-100 centro">
		
		<legend class="legenda"> Informações de valores</legend>
		<div class="padding">

			
		
			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form"> Valor produtos </label>
				<br class="clear" />
				<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".mostrar_valor($valor_produtos); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>	
			
			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form">Desconto (cupom) </label>
				<br class="clear" />
				<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".number_format($pedido->valor_desconto, 2,',','.'); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>	

			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form">Desconto (depósito) </label>
				<br class="clear" />
				<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".number_format($pedido->desconto_deposito, 2,',','.'); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>	

			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form"> Valor final </label>
				<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".mostrar_valor($valor_produtos - $pedido->desconto_deposito); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>

			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form"> + Valor frete </label>
				<br class="clear" />
				<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".number_format($pedido->valor_frete, 2,',','.'); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>

			
			
			<div class="col-xl-3 pull-left">
				<label for="data" class="label-form"> = Valor total </label>
				<br class="clear" />
				<input type="text" name="data" id="data" class="form-control tamanho-100"  value="<?php echo "R$ ".number_format($pedido->valor_final, 2,',','.'); ?>" disabled="disabled"/>
				<br class="clear" />
			</div>	
			<br class="clear" />
			
			
			<br class="clear" />
			
			
			
		</div>
	</fieldset>	
	
<!-- INFORMAÇOES DE ENVIO -->
	
	<br class="clear" />
	<fieldset class="area-padrao azul tamanho-100 centro">
		
		<legend class="legenda"> Informações de envio</legend>
		<div class="padding">
		
				<div class="col-xl-3 pull-left">
					<label for="data" class="label-form"> Forma envio </label>
					<br class="clear" />
					<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo $pedido->tipo_frete; ?>" disabled="disabled"/>
					<br class="clear" />
				</div>	
				
				<div class="col-xl-3 pull-left">
					<label for="data" class="label-form"> Valor frete </label>
					<br class="clear" />
					<input type="text" name="data" id="data" class="form-control tamanho-90"  value="<?php echo "R$ ".number_format($pedido->valor_frete, 2,',','.'); ?>" disabled="disabled"/>
					<br class="clear" />
				</div>	
				
				
				<div class="col-xl-3 pull-left">
					<label for="rastreamento" class="label-form"> Rastreamento </label>
					<br class="clear" />
					<input type="text" name="rastreamento" disabled="" id="rastreamento" class="form-control tamanho-100"  value="<?php echo $pedido->codigo_rastreio; ?>"/>
					<br class="clear" />
				</div>
				<br class="clear" />

				
		</div>
	</fieldset>	
<!-- INFORMAÇOES DE ENDEREÇO DE ENTREGA -->
	
	<br class="clear" />
	<fieldset class="area-padrao azul tamanho-100 centro">
		
		<legend class="legenda"> Endereço de entrega</legend>
		<div class="padding">
			
				<div class="col-xl-12 pull-left">
					<label class="label-form"><strong>Nome</strong></label>
					<br class="clear">
					<label class="label-form" style="height: 120px;text-indent: 0;padding-left: 5px;"><?php echo $pedido->endereco; ?></label>
					<br class="clear">
				</div>
				<br class="clear">
										

		</div>
	</fieldset>
	
<!-- INFORMAÇOES DE PRODUTOS DO PEDIDO -->

	
	<br class="clear" />
	<fieldset class="area-padrao azul tamanho-100 centro">
		
		<legend class="legenda"> Produtos do pedido -Total <?php echo count($produtos); ?> de gibis </legend>
		<div class="padding">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td>Itens</td>
						<td>Foto</td>
						<td>Nome</td>
						<td>Valor</td>
						<td>Peso que foi cadastrado</td>
					</tr>
				</thead>
			<?php 
			$i = 1;
			$peso_sistema = 0;
			$peso_recalculado = 0;
			foreach( $produtos as $produto ){
				$peso_sistema = $peso_sistema + $produto->item_peso;
				$peso_recalculado = $peso_recalculado + $produto->item_peso;

			?>
			 <tr>
			 	<td>#<?php echo $i; ?></td>
			 	<td>
			 		<a href="<?php echo base_url('./assets/upload/anuncios/'.$produto->anuncio_id.'/'.$produto->item_imagem1); ?>" class="fancybox">
			 			<img src="<?php echo base_url('./assets/upload/anuncios/'.$produto->anuncio_id.'/'.$produto->item_imagem1); ?>" style='height: 80px;'>
			 		</a>
			 		</td>
			 	<td><?php  echo $produto->item_nome; ?></td>
			 	<td><?php echo "R$ ".number_format($produto->valor, 2,',','.'); $i++;?></td>
			 	<td><?php  echo $produto->item_peso; ?></td>
			 </tr>
			
			<!-- 	<div class="col-xl-2 pull-left">
					 <a href="<?php echo site_url("anuncios/editar/$produto->anuncio_id"); ?>" title="Visualizar produto" class="btn btn-default" target="_blank" style="margin-top:20px !important; margin-left:15px !important;">Editar</a>
					<br class="clear">  
				</div>	
							
				<div class="col-xl-4 pull-left">
					<label class="label-form"><strong>Nome </strong></label>
					<br class="clear">
					<label class="label-form"><?php  echo $produto->item_nome; ?></label>
				</div>
				
				<div class="col-xl-3 pull-left">
					<label class="label-form"><strong>Valor</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo "R$ ".number_format($produto->valor, 2,',','.'); ?></label>
				</div>
				
				<br class="clear">
					
			<hr/>		 -->

			<?php }  
			$diminuir_peso = 0;
			$quantidade = count($produtos);

			if ($quantidade > 2 && $quantidade < 20) {					
				$diminuir_peso = $quantidade * 0.040;
			}
			if ($quantidade >= 20) {					
				$diminuir_peso = $quantidade * 0.045;
			}

			$peso_recalculado = $peso_sistema - $diminuir_peso;
			$peso = $peso_recalculado;
			//$peso = '0.579';


			$valor_impresso = 0;
			if ($peso < 0.100) { $valor_impresso = '4.88';	}
			if ($peso >= 0.101 && $peso <= 0.200) { $valor_impresso = '5.88';	}
			if ($peso >= 0.201 && $peso <= 0.250) { $valor_impresso = '6.40';	}
			if ($peso >=0.251 && $peso <= 0.300) { $valor_impresso = '6.87';	}
			if ($peso >=0.301 && $peso <= 0.350) { $valor_impresso = '7.35';	}
			if ($peso >=0.351 && $peso <= 0.400) { $valor_impresso = '7.92';	}
			if ($peso >=0.401 && $peso <= 0.450) { $valor_impresso = '8.45';	}
			if ($peso >=0.451 && $peso <= 0.500) { $valor_impresso = '8.98';	}
			if ($peso >=0.501 && $peso <= 0.550) { $valor_impresso = '9.35';	}
			if ($peso >=0.551 && $peso <= 0.600) { $valor_impresso = '9.87';	}
			if ($peso >=0.601 && $peso <= 0.650) { $valor_impresso = '10.35';	}
			if ($peso >=0.651 && $peso <= 0.700) { $valor_impresso = '10.71';	}
			if ($peso >=0.701 && $peso <= 0.750) { $valor_impresso = '11.13';	}
			if ($peso >=0.751 && $peso <= 0.800) { $valor_impresso = '11.55';	}
			if ($peso >=0.801 && $peso <= 0.850) { $valor_impresso = '12.07';	}
			if ($peso >=0.851 && $peso <= 0.900) { $valor_impresso = '12.60';	}
			if ($peso >=0.901 && $peso <= 0.950) { $valor_impresso = '13.02';	}
			if ($peso >=0.951 && $peso <= 1.000) { $valor_impresso = '13.44';	}
			if ($peso >=1.001 && $peso <= 2.000) { $valor_impresso = '17.80';	}
			if ($peso >=2.001 && $peso <= 3.000) { $valor_impresso = '22.15';	}
			if ($peso >=3.001 && $peso <= 4.000) { $valor_impresso = '26.14';	}
			if ($peso >=4.001 && $peso <= 5.000) { $valor_impresso = '30.87';	}



			?>
			</table>

			<p>Peso cadastrado no sistema: <?php echo $peso_sistema; ?></p>
			<p>Peso recalculado no sistema: <?php echo $peso_recalculado; ?> Valor: <?php echo $valor_impresso; ?></p>
			<p>Como está o cálculo hoje:<br>
				Se a quantidade de itens for maior que 2 e menor que 20. Cálculo: peso - quantidade*0.040<br>
				Se a quantidade de itens for maior ou igual a 20. Peso - quantidade * 0.045.<br>
				Maior que 5kg não entra no impresso.
			</p>

		</div>
	</fieldset>	