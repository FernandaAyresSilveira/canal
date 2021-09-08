<h3 class="legenda"> Lista de pedidos</h3>

		<div class="col-md-12">	<div class="area-padrao azul">
		

		<div class="form-group">
					
			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('pedidos/listar'); ?>">
				<div class="col-xl-3 pull-left">
					<div class="elemento-inline tamanho-20" >
						<label for="cliente" class="label-form"> Cliente </label>
						<br class="clear" />
						<input type="text" name="cliente" id="cliente" class="form-control" <?php if( $this->input->get('cliente') ){ ?> value="<?php echo $this->input->get('cliente'); ?>" <?php } ?>/>
						<br class="clear" />
					</div>
				</div>

				<div class="col-xl-3 pull-left">
				
					<div class="elemento-inline tamanho-20" >
						<label for="data" class="label-form"> Data </label>
						<br class="clear" />
						<input type="text" name="data" id="data" class="form-control  mascara-data" <?php if( $this->input->get('data') ){ ?> value="<?php echo $this->input->get('data'); ?>" <?php } ?> />
						<br class="clear" />
					</div>
				</div>

				<div class="col-xl-3 pull-left">
					
					<label for="status" class="label-form"> Status </label>
					<br class="clear" />

					<select name="status" id="status" class="form-control">
						<option></option>
						<?php foreach($status as $status){ ?>
						<option <?php if($this->input->get('status') == $status->id){ echo "selected"; } ?> value="<?php echo $status->id; ?>">
						<?php echo $status->nome; ?>
						</option>
						<?php } ?>
					</select>
					<br class="clear" />

				</div>		
				
				<div class="col-xl-3 pull-left" style="padding-top: 8px">
					<br class="clear" />

					<a href="<?php echo site_url('pedidos/listar'); ?>" class="btn btn-default"> Limpar </a>

					<input type="submit" value="Buscar" class="btn btn-primary" />
					<br class="clear" />
				</div>

			</form>

			<!-- FIM BUSCA -->
			<br class="clear" />

		<div class="col-md-12">
			<table class="table table-bordered">	
			    <thead>
			        <tr>
			            <th style="width: 210px"></th>
						<th>ID</th>
						<th>Data finalizada</th>
						<th>Valor</th>
						<th>Cliente</th>
						<th>Status</th>
					 </tr>
			    </thead>

			    <tbody>

			    	<?php foreach( $pedidos AS $pedido ){ ?>
			    	
					        <tr>
					            <td class="area-acao"> 
					            	<a href="<?php echo site_url("pedidos/editar/$pedido->id"); ?>" title="Editar" class="btn btn-primary btn-sm pull-left" >Editar</a>
					            	<a href="<?php echo site_url("pedidos/imprimir_completo/$pedido->id"); ?>" title="Editar" class="btn btn-default btn-sm pull-left" style='margin-left: 5px' target='_blank'>Imprimir</a>

					            	<?php if($pedido->status_venda_id==1){ 
					            		$classe ='';

					            		if ($pedido->email_aguard_pag==1) {
					            			$classe = 'btn-success';
					            		}else{
					            			$classe = 'btn-default';
					            		}?>
					            		<a onclick="return botao_enviar_aguardando_pag('<?php echo site_url(); ?>','<?php echo $pedido->id; ?>','<?php echo $pedido->email_aguard_pag;?>')"  class="btn <?php echo $classe; ?> btn-sm pull-left" style='margin-left: 5px' id='botao-aviso-pag-<?php echo $pedido->id; ?>' alt='Aviso de espera de pagamento' title='Aviso de espera de pagamento'>
					            		<i class="fa  fa-money" aria-hidden="true"></i></a>
					            	<?php }?>

					            	<?php if($pedido->status_venda_id==2){
					            		$classe ='';

					            		if ($pedido->embalagem==1) {
					            			$classe = 'btn-success';
					            		}else{
					            			$classe = 'btn-warning';
					            		}

					            		?>

					            		<a onclick="return botao_embalagem('<?php echo site_url(); ?>','<?php echo $pedido->id; ?>','<?php echo $pedido->embalagem;?>')"  title="Embalagem" class="btn <?php echo $classe; ?> btn-sm pull-left " style='margin-left: 5px' id='botao-embalagem-<?php echo $pedido->id; ?>' target='_blank'>
					            		<i class="fa fa-archive" aria-hidden="true"></i>
										</a>
					            	<?php } ?>
					            	
					            </td>
								<td><?php echo $pedido->id; ?></td>
					            <td><?php echo converter_data($pedido->data_fechamento); ?></td>
					            <td><?php echo "R$ ".number_format($pedido->valor_final, 2,',','.'); ?></td>
								<td><a href="<?php echo site_url("clientes/editar/$pedido->cliente_id") ?>" target="blank">
									<u><?php echo $pedido->cliente_nome.' '.$pedido->cliente_sobrenome; ?></u></a></td>
								<td><?php echo $pedido->status_pedido_nome; ?></td>
					        </tr>

			        <?php } ?>

			    </tbody>
			</table>

		
			<br class="clear" />

			<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>
			<br class="clear">

		</div>
	</div>