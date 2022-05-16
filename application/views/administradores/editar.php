


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("administradores/funcao_editar/$administrador->id"); ?>">
		

		<fieldset class="area-padrao verde tamanho-50 float-left">
			
			<legend class="legenda"> Editar Administrador </legend>
			<div class="padding">
				

				<label for="nome" class="label-form"> Nome </label>

				<br class="clear" />
				<input type="text" name="nome" id="nome" value="<?php echo $administrador->nome; ?>" class="input-form tamanho-60 validate[required]" />
				<br class="clear" />

				<label for="email" class="label-form"> E-mail </label>
				<br class="clear" />
				<input type="text" name="email" id="email" value="<?php echo $administrador->email; ?>" class="input-form tamanho-60 validate[required, custom[email]]" />
				<br class="clear" />

				<label for="senha" class="label-form"> Senha </label>
				<br class="clear" />
				<input type="password" name="senha" id="senha" class="input-form tamanho-30" />
				<br class="clear" />

				<label for="senha2" class="label-form"> Repita a senha </label>
				<br class="clear" />
				<input type="password" name="senha2" id="senha2" class="input-form tamanho-30 validate[equals[senha]]" />
				<br class="clear" />

				<label for="master" class="label-form"> Master </label>
				<br class="clear" />
				<input type="checkbox" name="master" id="master" <?php if( $administrador->master ){ echo "checked=\"checked\""; } ?> class="checkbox-form" />
				<br class="clear" />

				<label for="padrao" class="label-form"> Usar avatar padrão </label>
				<br class="clear" />
				<input type="checkbox" name="padrao" id="padrao" class="checkbox-form" <?php if( empty($administrador->foto) ){ echo "checked=\"checked\""; } ?> onchange="mostrar_esconder('#input-imagem')" />
				<br class="clear" />

				<div id="input-imagem" <?php if( !$administrador->foto ){ echo "style=\"display: none;\""; } ?>>

					<label for="nome" class="label-form"> Imagem </label>
					<br class="clear" />
					<input type="file" name="imagem" id="imagem" />
					<br class="clear" />

				</div>

				<a href="<?php echo site_url("administradores/funcao_excluir/$administrador->id"); ?>" onclick="return confirmacao()" class="botao botao-excluir botao-inline float-right"> Excluir </a>
				<a href="<?php echo site_url('administradores/listar'); ?>" class="botao botao-editar botao-inline float-right"> Listar </a>
				<input type="submit" value="Salvar" class="botao botao-cadastrar botao-inline float-right" />

				
			</div>
		</fieldset>
	</form>



	<div class="area-padrao azul tamanho-40 float-right">
		<h1 class="legenda"> Foto atual do administrador </h1>

		<div class="padding">
			
				<?php if( !empty($administrador->foto) ){ ?>
					<a href="<?php echo base_url("./assets/upload/administradores/$administrador->foto"); ?>" class="fancybox">

						<img class="foto-item-editar" src="<?php echo base_url("./assets/upload/administradores/$administrador->foto"); ?>" />

					</a>
				<?php }
					else {
				?>
					<img class="foto-item-editar" src="<?php echo base_url('./assets/upload/administradores/avatar-padrao.png'); ?>" />

				<?php } ?>

		</div>
	</div>