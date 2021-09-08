<h3 class="legenda"> Lista de pedidos não finalizados</h3>

		<div class="col-md-12">	<div class="area-padrao azul">
		

		<div class="form-group">
					
			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('pedidos/listar_nao_finalizados'); ?>">
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

				<!-- <div class="col-xl-3 pull-left">
					
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

				</div>	 -->	
				
				<div class="col-xl-3 pull-left" style="padding-top: 8px">
					<br class="clear" />

					<a href="<?php echo site_url('pedidos/listar_nao_finalizados'); ?>" class="btn btn-default"> Limpar </a>

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
						<th>Data começo</th>
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
					            	<!-- <a href="<?php echo site_url("pedidos/imprimir_completo/$pedido->id"); ?>" title="Editar" class="btn btn-default btn-sm pull-left" style='margin-left: 5px' target='_blank'>Imprimir</a> -->
					            	
					            </td>
								<td><?php echo $pedido->id; ?></td>
					            <td><?php echo converter_data($pedido->data); ?></td>
					            <td><?php echo "R$ ".number_format($pedido->valor_final, 2,',','.'); ?></td>
								<td><a href="<?php echo site_url("clientes/editar/$pedido->cliente_id") ?>" target="blank">
									<u><?php echo $pedido->cliente_nome; ?></u></a></td>
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