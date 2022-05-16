

		<h3 class="legenda"> Lista de anúncios</h3>

		<div class="col-md-12">
			<form name="form-gerenciador" class="" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('anuncios/listar'); ?>">
				<p>Há um total de <?php echo $count_anuncios;?> anúncios cadastrados</p>


				<div class="form-group">
					<div class="col-xl-10 pull-left">
						<label for="q" class="label-form"> Nome </label>
						<br class="clear" />
						<input type="text" name="q" id="q" class="form-control" <?php if( $this->input->get('q') ){ ?> value="<?php echo $this->input->get('q'); ?>" <?php } ?> />
					</div>
					<!-- <div class="col-xl-3 pull-left">
						<label for="q" class="label-form"> Departamento </label>
						<br class="clear" />
						<select name="d" class="form-control">
								<option value="">Todos</option>
							<?php foreach ($departamentos as $dep) { ?>
								<option value="<?php echo $dep->id; ?>"<?php if($dep->id==$this->input->get('d')){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>			
							<?php } ?>
						</select>

					</div> -->
					<br class="clear">
					<br class="clear">

					<div class="col-xl-3 pull-left">
						<label for="nome"> Departamento </label>
						<br class="clear">
						<select name="d" id="departamento_id" class="form-control"  onchange="categorias_departamento('<?php echo site_url(); ?>')" >
							<option value="">Todos</option>
							<?php foreach ($departamentos as $dep) { echo $this->input->get('d');?>
							<option value="<?php echo $dep->id; ?>" <?php if($this->input->get('d')  == $dep->id){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>						
						<?php } ?>
						</select>
					</div>

					<div class="col-xl-3 pull-left" >
						<label for="nome"> Categoria </label>
						<br class="clear">
						<select name="c" id="categoria_id" class="form-control"   onchange="subcategorias_categoria('<?php echo site_url(); ?>')" >
							<option value=""></option>
							<?php foreach ($categorias as $cat) { ?>
								<option value="<?php echo $cat->id; ?>" <?php if($this->input->get('c') == $cat->id){ echo "selected";} ?>> <?php echo $cat->nome; ?></option>						
							<?php } ?>
						</select>
					</div>
					<div class="col-xl-3 pull-left" id="div-subcategorias">
						<label for="nome"> Subcategoria </label>
						<br class="clear">
						<select name="sub" id="subcategoria_id" class="form-control">
							<option value=""></option>
							<?php foreach ($subcategorias as $sub) { ?>
								<option value="<?php echo $sub->id; ?>" <?php if($this->input->get('sub')  == $sub->id){ echo "selected";} ?>> <?php echo $sub->nome; ?></option>						
							<?php } ?>
						</select>
						<a href="<?php echo site_url('anuncios/modal_cadastro_subcategoria');?>" class="fancybox_ajax btn btn-default none" style="display: none;" id="modal_cadastro_subcategoria"> 
								<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
						<br class="clear">
					</div>




					<div class="col-xl-3 pull-left" style="    margin-top: 30px;">
						<input type="submit" value="Buscar" class="btn btn-primary pull-left" />
						<!-- <a href="<?php echo site_url('anuncios/listar'); ?>" class="btn btn-default pull-right"> Limpar </a> -->
					</div>
				</div>

			</form>
		</div> 
		<br class="clear">
		<br class="clear">
		<br class="clear">
		<div class="col-md-12">
		<form name="form-gerenciador" class="" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url('anuncios/acao'); ?>">
			<table class="table table-bordered">			    	
			    <thead>
			        <tr>
			        	<th><small><label for="nome">
			        		<input type='checkbox' onclick="marcarTodos(this.checked);" > <br>Selec.<br> tudo </label></small></th>
			            <th style="width: 250px">
			            	
			            </th>
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
				            	<a href="<?php echo site_url("anuncios/duplicar/$anuncio->id"); ?>" title="Duplicar" class="btn btn-warning btn-sm pull-left" >Dupli
				            		<i class="fa fa-files-o" aria-hidden="true"></i>
				            	</a>
				            	 <a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem1);?>" class="fancybox btn btn-sm btn-default  pull-left" title="Foto" style='margin-left:  9px'> 
									<i class="fa fa fa-picture-o" aria-hidden="true"></i>
								</a>
				            	<a href="<?php echo site_url("anuncios/editar/$anuncio->id"); ?>" title="Editar" class="btn btn-primary btn-sm pull-left" style='margin-left: 5px;'>
				            		<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
				            	<a href="<?php echo site_url("anuncios/funcao_excluir/$anuncio->id"); ?>" onclick="return confirmacao()" title="Excluir" class="btn btn-danger  btn-sm pull-left" style='margin-left: 9px;'>
				            		<i class="fa fa-trash" aria-hidden="true"></i>

				            	</a>
				            	<!-- <a   class="btn btn-primary btn-sm pull-left" style='margin-left: 5px;'>Foto</a> -->
						       
				            </td>
				            <td><?php echo $anuncio->nome.'<br>Editora: '.$anuncio->editora_nome; 
				             if ($anuncio->modelo=='r') {
				            	echo "  <i class='fa fa-registered' style='color:green' aria-hidden='true'></i>";
				            }
				            ?></td>	
				            <td><?php echo $anuncio->departamento_nome.'/'.$anuncio->categoria_nome.'/'.$anuncio->subcategoria_nome; ?></td>		     
				            <td><?php echo mostrar_valor($anuncio->valor); ?></td>	
				        </tr>
		        <?php } ?>
			</table>

			<div class="col-xl-4 pull-right">
				<div class="col-xl-8 pull-left">
					<select name="acao" id="acao" class="form-control" onchange="verifica_select()">
							<option value="">Ação</option>
							<option value="f">Finalizar</option>
							<option value="v">Modificar valor</option>
							<option value="promo">Promoção/ percentual</option>
						
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
		</form>
		<br class="clear" />

		<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>

		<br class="clear" />


		<a href="<?php echo site_url('anuncios/cadastrar'); ?>" class="btn btn-success"> Cadastrar </a>
		</div>

			

<script type="text/javascript">
	function verifica_select(){
		var acao = $('#acao').val();
		if (acao=='promo') {
			$('#percentual').show();
		}else{
			$('#percentual').hide();
			if (acao=='v') {
				$('#novo_valor').show();
				}else{
					$('#novo_valor').hide();
			}
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