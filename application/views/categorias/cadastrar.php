
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('categorias/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde tamanho-70 centro">
			
			<h3 class="legenda"> Cadastro de categoria </h3>
			<div class="col-xl-4">

				<label for="nome"> Departamento </label>
				<br class="clear">
				<select name="departamento_id" class="form-control">
					<?php foreach ($departamentos as $dep) { ?>
						<option value="<?php echo $dep->id; ?>"> <?php echo $dep->nome; ?></option>						
					<?php } ?>
				</select>
				<br class="clear">

				
				<label for="nome"> Nome </label>
				<input type="text" name="nome" id="nome" class="form-control" />
				
				<br class="clear">
				
				<input type="submit" value="Cadastrar"  class="btn btn-success pull-right" />

			</div>
		</fieldset>
	</form>