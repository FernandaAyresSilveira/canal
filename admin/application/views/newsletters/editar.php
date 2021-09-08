	<style>
		#tipo-html, #tipo-imagem {
			display: none;
		}
	</style>
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('newsletters/funcao_editar/'.$newsletter->id); ?>">		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<legend class="legenda"> Editar Newsletter </legend>
			<div class="padding">

				<label for="tipo" class="label-form"> Tipo </label>
				<br class="clear" />
				<select name="tipo" id="tipo" class="select-form tamanho-30" onchange="tipo_newsletter(this.value)">
					<option value="1" <?php if($newsletter->tipo == 1) echo "selected" ?>>Imagem</option>
					<option value="2" <?php if($newsletter->tipo == 2) echo "selected" ?>>HTML</option>
					<!-- <option value="3" <?php //if($newsletter->tipo == 3) echo "selected" ?>>Produtos</option> -->
				</select>
				<br class="clear">

				<label for="assunto" class="label-form"> Assunto </label>
				<br class="clear" />
				<input type="text" name="assunto" id="assunto" value="<?php echo $newsletter->assunto; ?>" class="input-form tamanho-100 validate[required]" />
				<br class="clear" />

				<!-- verifica se é tipo 1 = imagem para decidir qual div mostrar -->

				<div id="tipo-imagem" style="<?php if($newsletter->tipo == 1) echo "display:block" ?>">
					<label for="imagem" class="label-form"> Imagem </label>
					<br class="clear" />
					<input type="file" name="imagem" id="imagem" />
					<br class="clear" />

					<label for="link_imagem" class="label-form"> Link <small>(Destino do clique sobre a imagem)</small> </label>
					<br class="clear" />
					<input type="text" name="link_imagem" id="link_imagem" value="<?php echo $newsletter->link_imagem ?>" class="input-form tamanho-100" />
					<br class="clear" />
				</div>

				<div id="tipo-html" style="<?php if($newsletter->tipo == 2) echo "display:block" ?>">
					<label for="html" class="label-form"> HTML </label>
					<br class="clear" />
					<textarea name="html" id="html" class="textarea-form-simples tamanho-100"><?php echo $newsletter->html ?></textarea>
					<br class="clear" />
				</div>
				
				<a href="<?php echo site_url('newsletters/listar'); ?>" class="botao botao-editar botao-inline float-right"> Voltar </a>
				<input type="submit" value="Avançar" class="botao botao-cadastrar botao-inline float-right" />

			</div>
		</fieldset>

		<br class="clear">

				<?php  
					if ($newsletter->tipo == '1') { ?>
						<div class="area-padrao azul tamanho-40 centro">
							<h1 class="legenda"> Imagem atual </h1>

							<div class="padding">
								
								<a href="<?php echo base_url("./assets/upload/newsletters/$newsletter->imagem"); ?>" class="fancybox">

									<img class="foto-item-editar" src="<?php echo base_url("./assets/upload/newsletters/$newsletter->imagem"); ?>" />

								</a>

							</div>
						</div>
				<?php } ?>		

	</form>