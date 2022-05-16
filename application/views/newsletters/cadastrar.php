
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('newsletters/funcao_cadastrar'); ?>">		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<legend class="legenda"> Cadastro de Newsletter </legend>
			<div class="padding">


				<label for="tipo" class="label-form"> Tipo </label>
				<br class="clear" />
				<select name="tipo" id="tipo" class="select-form tamanho-30" onchange="tipo_newsletter(this.value)">
					<option value="1">Imagem</option>
					<option value="2">HTML</option>
					<!-- <option value="3">Produtos</option> -->
				</select>
				<br class="clear">

				<label for="assunto" class="label-form"> Assunto </label>
				<br class="clear" />
				<input type="text" name="assunto" id="assunto" class="input-form tamanho-100 validate[required]" />
				<br class="clear" />


				<div id="tipo-imagem">
					<label for="imagem" class="label-form"> Imagem </label>
					<br class="clear" />
					<input type="file" name="imagem" id="imagem" />
					<br class="clear" />

					<label for="link_imagem" class="label-form"> Link <small>(Destino do clique sobre a imagem)</small> </label>
					<br class="clear" />
					<input type="text" name="link_imagem" id="link_imagem" class="input-form tamanho-100" />
					<br class="clear" />
				</div>

				<div id="tipo-html" style="display:none;">
					<label for="html" class="label-form"> HTML </label>
					<br class="clear" />
					<textarea name="html" id="html" class="textarea-form tamanho-100"></textarea>
					<br class="clear" />
				</div>
				
				<input type="submit" value="Avançar" class="botao botao-cadastrar botao-inline float-right" />

			</div>
		</fieldset>

		<br class="clear">

	</form>