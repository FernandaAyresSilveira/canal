

		<h3 class="legenda"> Lista de subcategorias</h3>

		<div class="col-md-12">
			<form name="form-gerenciador" class="" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('subcategorias/listar'); ?>">


				<div class="form-group">
					<div class="col-xl-4 pull-left">
						<label for="q" class="label-form"> Nome </label>
						<br class="clear" />
						<input type="text" name="q" id="q" class="form-control" <?php if( $this->input->get('q') ){ ?> value="<?php echo $this->input->get('q'); ?>" <?php } ?> />
					</div>
					<div class="col-xl-4 pull-left">
						<label for="q" class="label-form"> Departamento </label>
						<br class="clear" />
						<select name="d" class="form-control">
								<option value="" >Todos</option>
							<?php foreach ($departamentos as $dep) { ?>
								<option value="<?php echo $dep->id; ?>"<?php if($dep->id==$this->input->get('d')){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>			
							<?php } ?>
						</select>

					</div>

					<div class="col-xl-4 pull-left" style="    margin-top: 30px;">
						<a href="<?php echo site_url('subcategorias/listar'); ?>" class="btn btn-default"> Limpar </a>
						<input type="submit" value="Buscar" class="btn btn-primary" />
					</div>
				</div>

			</form>
		</div> 
		<br class="clear">
		<br class="clear">
		<br class="clear">
		<div class="col-md-12">
			<table class="table table-bordered">			    	
			    <thead>
			        <tr>
			            <th style="width: 180px"></th>
			            <th>Nome </th>
			            <th>Departamento/Categoria</th>
			        </tr>
			    </thead>
		    	<?php foreach( $subcategorias AS $subcategoria ){   	?>
				        <tr>
				            <td class="col-xs-2"> 
				            	<a href="<?php echo site_url("subcategorias/editar/$subcategoria->id"); ?>" title="Editar" class="btn btn-primary pull-left">Editar</a>
				            	<a href="<?php echo site_url("subcategorias/funcao_excluir/$subcategoria->id"); ?>" onclick="return confirmacao()" title="Excluir" class="btn btn-danger pull-right">Excluir</a>
				            </td>
				            <td><?php echo $subcategoria->nome; ?></td>	
				            <td><?php echo $subcategoria->departamento_nome.'/'.$subcategoria->categoria_nome; ?></td>		     
				        </tr>
		        <?php } ?>
			</table>
		<br class="clear" />

		<a href="<?php echo site_url('subcategorias/cadastrar'); ?>" class="btn btn-success"> Cadastrar </a>
		</div>

			

