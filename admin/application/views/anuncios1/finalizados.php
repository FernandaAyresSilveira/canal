

		<h3 class="legenda"> Lista de anúncios finalizados</h3>

		<div class="col-md-12">
			<form name="form-gerenciador" class="" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('anuncios/finalizados'); ?>">
				<p>Há um total de <?php echo $count_anuncios;?> anúncios finalizados</p>


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
								<option value="">Todos</option>
							<?php foreach ($departamentos as $dep) { ?>
								<option value="<?php echo $dep->id; ?>"<?php if($dep->id==$this->input->get('d')){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>			
							<?php } ?>
						</select>

					</div>

					<div class="col-xl-4 pull-left" style="    margin-top: 30px;">
						<a href="<?php echo site_url('anuncios/finalizados'); ?>" class="btn btn-default"> Limpar </a>
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
			            <th style="width: 250px"></th>
			            <th>Nome </th>
			            <th>Departamento/Categoria/Subcategoria</th>
			            <th>Valor</th>
			            <!-- <th>Pedido</th>
			            <th>Staus pedido</th> -->
			        </tr>
			    </thead>
		    	<?php foreach( $anuncios AS $anuncio ){   	?>
				        <tr>
				            <td class="col-xs-2"> 
				            	<a href="<?php echo site_url("anuncios/duplicar/$anuncio->id"); ?>" title="Editar" class="btn btn-default btn-sm pull-left" >Duplicar</a>
				            	<a href="<?php echo site_url("anuncios/editar/$anuncio->id"); ?>" title="Editar" class="btn btn-primary btn-sm pull-left" style='margin-left: 5px;'>Editar</a>
				            	<!-- <a href="<?php echo site_url("anuncios/funcao_excluir/$anuncio->id"); ?>" onclick="return confirmacao()" title="Excluir" class="btn btn-danger  btn-sm pull-left" style='margin-left: 5px;'>Excluir</a> -->
				            </td>
				            <td><?php echo $anuncio->nome.'<br>Editora: '.$anuncio->editora_nome; ?></td>	
				            <td><?php echo $anuncio->departamento_nome.'/'.$anuncio->categoria_nome.'/'.$anuncio->subcategoria_nome; ?></td>		     
				            <td><?php echo mostrar_valor($anuncio->valor); ?></td>	
				           <!--  <td><?php echo $anuncio->venda_id; ?></td>	
				            <td><?php echo $anuncio->status_venda_nome; ?></td>	 -->
				        </tr>
		        <?php } ?>
			</table>
		<br class="clear" />

		<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>

		<br class="clear" />


		</div>

			

