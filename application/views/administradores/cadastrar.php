


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url('administradores/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde">
			
			<legend class="legenda"> Cadastro de Administradores </legend>
			<div class="padding">
				

				<label for="nome" class="label-form"> Nome </label>
				<br class="clear" />
				<input type="text" name="nome" id="nome" class="input-form tamanho-60 validate[required]" />
				<br class="clear" />

				<label for="email" class="label-form"> E-mail </label>
				<br class="clear" />
				<input type="text" name="email" id="email" class="input-form tamanho-60 validate[required, custom[email]]" />
				<br class="clear" />

				<label for="senha" class="label-form"> Senha </label>
				<br class="clear" />
				<input type="password" name="senha" id="senha" class="input-form tamanho-30 validate[required]" />
				<br class="clear" />

				<label for="senha2" class="label-form"> Repita a senha </label>
				<br class="clear" />
				<input type="password" name="senha2" id="senha2" class="input-form tamanho-30 validate[required, equals[senha]]" />
				<br class="clear" />

				<label for="master" class="label-form"> Master </label>
				<br class="clear" />
				<input type="checkbox" name="master" id="master" class="checkbox-form" />
				<br class="clear" />

				<label for="padrao" class="label-form"> Usar avatar padrão </label>
				<br class="clear" />
				<input type="checkbox" name="padrao" id="padrao" class="checkbox-form" onchange="mostrar_esconder('#input-imagem')" />
				<br class="clear" />

				<div id="input-imagem">

					<label for="nome" class="label-form"> Imagem </label>
					<br class="clear" />
					<input type="file" name="imagem" id="imagem" />
					<br class="clear" />

				</div>

				
				<input type="submit" value="Cadastrar" class="botao botao-cadastrar botao-inline float-right" />
				


			</div>
		</fieldset>
	</form>