
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('subcategorias/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde tamanho-70 centro">
			
			<h3 class="legenda"> Cadastro de subcategoria </h3>
			<div class="col-xl-4">

				<label for="nome"> Departamento </label>
				<br class="clear">
				<select name="departamento_id" id="departamento_id" class="form-control" onchange="categorias_departamento('<?php echo site_url(); ?>')">
					<option value="">Selecione um departamento</option>
					<?php foreach ($departamentos as $dep) { ?>
						<option value="<?php echo $dep->id; ?>"> <?php echo $dep->nome; ?></option>						
					<?php } ?>
				</select>
				<br class="clear">

				<div  id="div-categorias" style="display: none;">
					<label for="nome"> Categoria </label>
					<br class="clear">
					<select name="categoria_id" id="categoria_id" class="form-control" style="width: 80% !important;float: left;" onchange="subcategorias_categoria('<?php echo site_url(); ?>')" required>
						<option>Selecione o departamento</option>
					</select>
					<a href="<?php echo site_url('anuncios/modal_cadastro_categoria');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_categoria"> 
							<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
					<br class="clear">
				</div>

				<a href="<?php echo site_url('anuncios/modal_cadastro_subcategoria');?>" class="fancybox_ajax btn btn-default" id="modal_cadastro_subcategoria" style='display: none;'> 
							<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
				

				
				<label for="nome"> Nome </label>
				<input type="text" name="nome" id="nome" class="form-control" />
				
				<br class="clear">
				
				<input type="submit" value="Cadastrar"  class="btn btn-success pull-right" />

			</div>
		</fieldset>
	</form>
	<br class="clear">
	<br class="clear">