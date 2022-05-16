


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("categorias/funcao_editar/$categoria->id"); ?>">
		<h3 class="legenda"> Editar categoria</h3>

		<div class="col-xl-4">

			<label for="nome"> Departamento </label>
			<br class="clear">
			<select name="departamento_id" class="form-control">
				<?php foreach ($departamentos as $dep) { ?>
					<option value="<?php echo $dep->id; ?>"<?php if($dep->id==$categoria->departamento_id){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>						
				<?php } ?>
			</select>
			<br class="clear">

			
			<label for="nome"> Nome </label>
			<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $categoria->nome; ?>" />
			
			<br class="clear">
			
			<input type="submit" value="Salvar"  class="btn btn-success pull-right" />

		</div>


		</fieldset>
	</form>


	