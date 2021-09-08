


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url('usuarios/funcao_cadastrar'); ?>">
		

		<fieldset class="col-md-6">
			
			<legend class="legenda"> Cadastro de Usuário </legend>
			<div class="padding">
				

				<label for="nome" class="label-form"> Nome </label>
				<br class="clear" />
				<input type="text" name="nome" id="nome" class="form-control validate[required]" />
				<br class="clear" />

				<label for="email" class="label-form"> E-mail </label>
				<br class="clear" />
				<input type="text" name="email" id="email" class="form-control validate[required, custom[email]]" />
				<br class="clear" />

				<label for="senha" class="label-form"> Senha </label>
				<br class="clear" />
				<input type="password" name="senha" id="senha" class="form-control validate[required]" />
				<br class="clear" />

				<label for="senha2" class="label-form"> Repita a senha </label>
				<br class="clear" />
				<input type="password" name="senha2" id="senha2" class="form-control validate[required, equals[senha]]" />
				<br class="clear" />

				
				
				<input type="submit" value="Cadastrar" class="btn btn-success btn-xs pull-right" onclick="return valida_senha_iguais()" />
				


			</div>
		</fieldset>
	</form>