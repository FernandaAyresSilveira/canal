

		<h3 class="legenda"> Lista de anúncios marcados com promoção</h3>

		<!-- <div class="col-md-12">
			<form name="form-gerenciador" class="" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('anuncios/listar'); ?>">
				<p>Há um total de <?php echo $count_anuncios;?> anúncios cadastrados</p>


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
						<a href="<?php echo site_url('anuncios/listar'); ?>" class="btn btn-default"> Limpar </a>
						<input type="submit" value="Buscar" class="btn btn-primary" />
					</div>
				</div>

			</form>
		</div> 
		<br class="clear">
		<br class="clear">
		<br class="clear"> -->
		<div class="col-md-12">
		<form name="form-gerenciador" class="" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url('anuncios/acao'); ?>">
			<table class="table table-bordered">			    	
			    <thead>
			        <tr>
			        	<th><input type='checkbox' onclick="marcarTodos(this.checked);" > <br>Selec.<br> tudo </label></small></th></th>
			            <th style="width: 250px"></th>
			            <th>Nome </th>
			            <th>Departamento/Categoria/Subcategoria</th>
			            <th>Valor</th>
			        </tr>
			    </thead>
		    	<?php foreach( $anuncios AS $anuncio ){   	?>
				        <tr>
				        	<td>
				        		<input type="checkbox" name="anuncio[]" value="<?php echo $anuncio->id ?>">
				        	</td>
				            <td class="col-xs-2"> 
				            	<a href="<?php echo site_url("anuncios/duplicar/$anuncio->id"); ?>" title="Editar" class="btn btn-default btn-sm pull-left" >Duplicar</a>
				            	<a href="<?php echo site_url("anuncios/editar/$anuncio->id"); ?>" title="Editar" class="btn btn-primary btn-sm pull-left" style='margin-left: 5px;'>Editar</a>
				            	<a href="<?php echo site_url("anuncios/funcao_excluir/$anuncio->id"); ?>" onclick="return confirmacao()" title="Excluir" class="btn btn-danger  btn-sm pull-left" style='margin-left: 5px;'>Excluir</a>
				            </td>
				            <td><?php echo $anuncio->nome.'<br>Editora: '.$anuncio->editora_nome; ?></td>	
				            <td><?php echo $anuncio->departamento_nome.'/'.$anuncio->categoria_nome.'/'.$anuncio->subcategoria_nome; ?></td>		     
				            <td><?php echo 'De:'.mostrar_valor($anuncio->valor).'<br> Por: '.mostrar_valor($anuncio->valor_promocional); ?></td>	
				        </tr>
		        <?php } ?>
			</table>


			<div class="col-xl-4 pull-right">
				<div class="col-xl-8 pull-left">
					<select name="acao" id="acao" class="form-control" onchange="verifica_select()">
							<option value="">Ação</option>
							<option value="f">Finalizar</option>
							<!-- <option value="v">Modificar valor</option> -->
							<option value="promo">Promoção/ percentual</option>
							<option value="desa">Desativar promo</option>
						
					</select>
				</div>
				<input type="submit" value="Aplicar" class="btn btn-primary pull-right" />
			</div>
			<div class="col-xl-2 pull-right" id="novo_valor" style="display: none;">
				<input type="text" class="form-control mascara-dinheiro " name="novo_valor">
			</div>

			<div class="col-xl-2 pull-right" id="percentual" style="display: none;">
				<input type="text" class="form-control mascara-numero" alt="percentual" name="recompensa">
			</div>

			<!-- <div class="col-xl-4 pull-right">
				<div class="col-xl-8 pull-left">
					<select name="acao" id="acao" class="form-control" onchange="verifica_select()">
							<option value="">Ação</option>
							<option value="f">Finalizar</option>
							<option value="v">Modificar valor</option>
						
					</select>
				</div>
				<input type="submit" value="Aplicar" class="btn btn-primary pull-right" />
			</div>
			<div class="col-xl-2 pull-right" id="novo_valor" style="display: none;">
				<input type="text" class="form-control mascara-dinheiro " name="novo_valor">
			</div> -->
		</form>
		<br class="clear" />

		<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>

		<br class="clear" />


		<!-- <a href="<?php echo site_url('anuncios/cadastrar'); ?>" class="btn btn-success"> Cadastrar </a> -->
		</div>

			

<script type="text/javascript">
	function verifica_select(){
		var acao = $('#acao').val();
		if (acao=='v') {
			$('#novo_valor').show();
		}else{
			$('#novo_valor').hide();
		}
	}

	function marcarTodos(marcar){
        var itens = document.getElementsByName('anuncio[]');

        // if(marcar){
        //     document.getElementById('acao').innerHTML = 'Desmarcar Todos';
        // }else{
        //     document.getElementById('acao').innerHTML = 'Marcar Todos';
        // }

        var i = 0;
        for(i=0; i<itens.length;i++){
            itens[i].checked = marcar;
        }


         var itens = document.getElementsByName('anuncio[]');
          var i = 0;
        for(i=0; i<itens.length;i++){
            itens[i].checked = marcar;
        }


    }
</script>