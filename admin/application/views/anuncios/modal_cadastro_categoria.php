
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" style='width:450px;'>
		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<h3 class="legenda"> Departamento <?php echo $dep->nome; ?> <br> Cadastro de categoria </h3>
			<div class="col-xl-12">			
				<label for="nome"> Nome </label>
				<input type="text" name="nome" id="nome_categoria" class="form-control" />
				<input type="hidden" id="departamento_selecionado" value="<?php echo $dep->id; ?>" />
				
				<br class="clear">
				
				<input type="button" value="Cadastrar"  class="btn btn-success pull-right" onclick="cadastrar_categoria('<?php echo site_url();?>')" />

			</div>
		</fieldset>
	</form>