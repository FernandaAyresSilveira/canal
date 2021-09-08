
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('clientes/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<legend class="legenda"> Cadastro de cliente </legend>
			<div class="padding">
				
				<label for="nome" class="label-form"> Nome </label>
				<br class="clear" />
				<input type="text" name="nome" id="nome" class="input-form tamanho-100 validate[required]" />
				<br class="clear" />

				<label for="site" class="label-form"> Site </label>
				<br class="clear" />
				<input type="text" name="site" id="site" class="input-form tamanho-100 validate[required]" />
				<br class="clear" />

				<label for="imagem" class="label-form"> Imagem </label>
				<br class="clear" />
				<input type="file" name="imagem" id="imagem" />
				<br class="clear" />
				
				<input type="submit" value="Cadastrar" class="botao botao-cadastrar botao-inline float-right" />

			</div>
		</fieldset>
	</form>