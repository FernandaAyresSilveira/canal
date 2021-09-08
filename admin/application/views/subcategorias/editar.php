


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("subcategorias/funcao_editar/$subcategoria->id"); ?>">
		<h3 class="legenda"> Editar subcategoria</h3>

		<div class="col-xl-4">

			<label for="nome"> Departamento </label>
			<br class="clear">
			<select name="departamento_id" class="form-control" disabled="">
				<?php foreach ($departamentos as $dep) { ?>
					<option value="<?php echo $dep->id; ?>"<?php if($dep->id==$categoria->departamento_id){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>						
				<?php } ?>
			</select>
			<br class="clear">

			
			<label for="nome"> Categoria </label>
			<br class="clear">
			<select name="categoria_id" id="categoria_id" class="form-control"  onchange="subcategorias_categoria('<?php echo site_url(); ?>')" required>
				<?php foreach ($categorias as $cat) { ?>
					<option value="<?php echo $cat->id; ?>"<?php if($cat->id==$subcategoria->categoria_id){ echo "selected";} ?>> <?php echo $cat->nome; ?></option>						
				<?php } ?>
			</select>
			<br class="clear">

			
			<label for="nome"> Nome </label>
			<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $subcategoria->nome; ?>" />
			
			<br class="clear">
			
			<input type="submit" value="Salvar"  class="btn btn-success pull-right" />

		</div>


		</fieldset>
	</form>


	