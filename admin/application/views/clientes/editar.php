


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url($this->router->class."/funcao_editar/$objeto->id"); ?>">
		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<legend class="legenda"> Editar cliente </legend>
			<div class="padding">
				
				<div class="col-xl-4 pull-left">
					<label for="nome" class="label-form"> Nome </label>
					<br class="clear" />
					<input type="text" name="nome" id="nome" value="<?php echo $objeto->nome; ?>" class="form-control tamanho-100 validate[required]" />
				</div>

				<div class="col-xl-5 pull-left">
					<label for="sobrenome" class="label-form"> Sobrenome </label>
					<br class="clear" />
					<input type="text" name="sobrenome" id="sobrenome" value="<?php echo $objeto->sobrenome; ?>" class="form-control tamanho-100 validate[required]" />
				</div>
					<br class="clear" />
					<br class="clear" />
				<div class="col-xl-3 pull-left">
					<label for="email" class="label-form"> E-mail </label>
					<br class="clear" />
					<input type="text" name="email" id="email" value="<?php echo $objeto->email; ?>" class="form-control tamanho-90 validate[required, custom[email]]" />
					<br class="clear" />
				</div>
				<div class="col-xl-3 pull-left">
					<label for="senha" class="label-form"> Senha </label>
					<br class="clear" />
					<input type="password" name="senha" id="senha" class="form-control tamanho-80" />
					<br class="clear" />
				</div>				
				<div class="col-xl-3 pull-left">
					<label for="confirmacao" class="label-form"> Redigite a senha </label>
					<br class="clear" />
					<input type="password" name="confirmacao" id="confirmacao" class="form-control tamanho-80 validate[equals[senha]]" />
					<br class="clear" />
				</div>
				<br class="clear" />

				
			
					<div class="col-xl-3 pull-left">
						<label for="cpf" class="label-form"> CPF </label>
						<br class="clear" />
						<input type="text" name="cpf" id="cpf" value="<?php echo $objeto->cpf; ?>" class="form-control mascara-cpf tamanho-90 validate[required]" />
						<br class="clear" />
					</div>
				

				<div class="col-xl-3 pull-left">
					<label for="nascimento" class="label-form"> Data de nascimento </label>
					<br class="clear" />
					<input type="text" name="nascimento" id="nascimento" value="<?php echo converter_data($objeto->nascimento); ?>" class="form-control mascara-data tamanho-80 " />
					<br class="clear" />					
				</div>
				<div class="col-xl-3 pull-left">
					<label for="telefone" class="label-form"> Telefone </label>
					<br class="clear" />
					<input type="text" name="telefone" id="telefone" value="<?php echo $objeto->telefone; ?>" class="form-control mascara-celular tamanho-80 " />
					<br class="clear" />					
				</div>	
				<div class="col-xl-3 pull-left">
					<label for="celular" class="label-form"> Celular </label>
					<br class="clear" />
					<input type="text" name="celular" id="celular" value="<?php echo $objeto->celular; ?>" class="form-control mascara-celular tamanho-80 " />
					<br class="clear" />					
				</div>



				<br class="clear">
				<input type="submit" value="Salvar" class="btn btn-success pull-right" style="margin:0 15px" />
				<a href="<?php echo site_url($this->router->class."/listar"); ?>" class="btn btn-default pull-right"> Listar </a>
				
			</div>
		</fieldset>
	</form>

	<br class="clear">

	<fieldset class="area-padrao azul tamanho-90 centro">
		
		<legend class="legenda"> Endereços </legend>
		<div class="col-xl-12 pull-left">
				<div class="col-xl-6 pull-left">
					<label class="label-form"><strong>Cidade</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->cidade_nome.'/'.$objeto->estado_sigla; ?></label>
					<br class="clear">
				</div>
				<br class="clear">

				<div class="col-xl-6 pull-left">
					<label class="label-form"><strong>Rua</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->rua; ?></label>
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"><strong>Número</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->numero; ?></label>
					<br class="clear">
				</div>
				<div class="col-xl-3 pull-left">
					<label class="label-form"><strong>Complemento</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->complemento ? $objeto->complemento : 'N/D'; ?></label>
					<br class="clear">
				</div>
				<br class="clear">

				<div class="col-xl-2 pull-left">
					<label class="label-form"><strong>CEP</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->cep; ?></label>
					<br class="clear">
				</div>						
				<div class="col-xl-3 pull-left">
					<label class="label-form"><strong>Bairro</strong></label>
					<br class="clear">
					<label class="label-form"><?php echo $objeto->bairro; ?></label>
					<br class="clear">
				</div>
				<br class="clear">			
		</div>
	</fieldset>

	<br class="clear">

	<fieldset class="area-padrao azul tamanho-90 centro">
		
		<legend class="legenda"> Pedidos </legend>
		<div class="padding">
			
			<table class="col-12 table table-bordered">
				<thead>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Data</th>
						<th>Valor Total</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pedidos as $pedido) { ?>
						<tr>
							<td class="tamanho-10">
								<a href="<?php echo site_url("pedidos/editar/$pedido->id"); ?>" title="Visualizar" class="btn btn-default pull-left">Editar</a>
							</td>
							<td><?php echo $pedido->id; ?></td>
							<td><?php echo converter_data($pedido->data); ?></td>
							<td>R$ <?php echo mostrar_valor($pedido->valor_final); ?></td>
							<td><?php echo $pedido->status_pedido_nome; ?></td>
						</tr>

					<?php } ?>	
				</tbody>
			</table>

		</div>
	</fieldset>

	<br class="clear">

