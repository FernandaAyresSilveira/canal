


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("usuarios/funcao_editar/$usuario->id"); ?>">
		

		<fieldset class="area-padrao verde tamanho-50 float-left col-md-6">
			
			<legend class="legenda"> Editar Usuário </legend>
			<div class="padding">
				

				<label for="nome" class="label label-form"> Nome </label>

				<br class="clear" />
				<input type="text" name="nome" id="nome" value="<?php echo $usuario->nome; ?>" class="form-control validate[required]" />
				<br class="clear" />

				<label for="email" class="label-form"> E-mail </label>
				<br class="clear" />
				<input type="text" name="email" id="email" value="<?php echo $usuario->email; ?>" class="form-control  validate[required]" />
				<br class="clear" />

				<label for="senha" class="label-form"> Senha </label>
				<br class="clear" />
				<input type="password" name="senha" id="senha" class="form-control tamanho-30" />
				<br class="clear" />

				<label for="senha2" class="label-form"> Repita a senha </label>
				<br class="clear" />
				<input type="password" name="senha2" id="senha2" class="form-control tamanho-30 validate[equals[senha]]" />
				<br class="clear" />

				


				<!-- <a href="<?php echo site_url("usuarios/funcao_excluir/$usuario->id"); ?>" onclick="return confirmacao()" class="btn btn-danger btn-xs pull-right" style='margin-left: 5px'> Excluir </a>
 -->
				<a href="<?php echo site_url('usuarios/listar'); ?>" class="btn btn-info btn-xs pull-right" style='margin-left: 5px'> Listar </a>

				<input type="submit" value="Salvar" class="btn btn-success btn-xs pull-right" />

				
			</div>
		</fieldset>
	</form>
