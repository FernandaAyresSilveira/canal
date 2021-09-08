<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("editoras/funcao_editar/$editora->id"); ?>">
		

		<fieldset class="area-padrao verde tamanho-80 centro">
			
			<h3 class="legenda"> Editar Editora </h3>
			<div class="padding">

				<div class="col-xl-6 pull-left">			

					<label for="nome" class="label-form"> Nome </label>
					<br class="clear" />
					<input type="text" name="nome" id="nome" value="<?php echo $editora->nome; ?>" class="form-control" required />
					<br class="clear" />
				</div>
				<br class="clear" />
				<div class="col-xl-6 pull-left">			
					<a href="<?php echo site_url("editoras/funcao_excluir/$editora->id"); ?>" onclick="return confirmacao()" class="btn btn-danger pull-right"> Excluir </a>
					<a href="<?php echo site_url('editoras/listar'); ?>" class="btn btn-default pull-right" style='margin-right: 10px;'> Listar </a>
					<input type="submit" value="Salvar" class="btn btn-success pull-right" style='margin-right: 10px;' />
				</div>

				
			</div>
		</fieldset>
	</form>