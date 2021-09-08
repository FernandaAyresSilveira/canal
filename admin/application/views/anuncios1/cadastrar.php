
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('anuncios/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde tamanho-70 centro">
			
			<h3 class="legenda"> Cadastro de anúncio de gibi </h3>
			<div class="col-xl-10">

				<div class="col-xl-3 pull-left">
					<label for="nome"> Departamento </label>
					<br class="clear">
					<select name="departamento_id" id="departamento_id" class="form-control"  onchange="categorias_departamento('<?php echo site_url(); ?>')" required>
						<option>Selecione o departamento</option>
						<?php foreach ($departamentos as $dep) { ?>
							<option value="<?php echo $dep->id; ?>"> <?php echo $dep->nome; ?></option>						
						<?php } ?>
					</select>
				</div>

				<div class="col-xl-4 pull-left" id="div-categorias" style="display: none;">
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
				

				<div class="col-xl-4 pull-left" id="div-subcategorias" style="display: none;">
					<label for="nome"> Subcategoria <small>(Não obrigatório)</small> </label>
					<br class="clear">
					<select name="subcategoria_id" id="subcategoria_id" class="form-control" style="width: 80% !important;float: left;">
						<option>Selecione</option>
					</select>
					<a href="<?php echo site_url('anuncios/modal_cadastro_subcategoria');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_subcategoria"> 
							<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
					<br class="clear">
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12 pull-left">				
					<label for="nome"> Nome </label>
					<input type="text" name="nome" id="nome" class="form-control" />
				</div>
				<br class="clear">
				<br class="clear">
				<div class="col-xl-3 pull-left">				
					<label for="valor"> Valor </label>
					<input type="text" name="valor" id="valor" class="form-control mascara-dinheiro" />
				</div>
				<div class="col-xl-2 pull-left">	
					<label for="promocao" class="pull-left" style="margin-top: 35px"> Promoção </label>
					<input type="checkbox" name="promocao" id="promocao" class="form-control pull-left" style="display: inline; width: auto; margin-top: 41px;margin-left: 5px" onchange="seleciona_promocao(this.value)" />
				</div>
				<div class="col-xl-3 pull-left" id="mostrar_valor_promocao" style="display: none">				
					<label for="valor"> Valor promoção </label>
					<input type="text" name="valor_promocional" id="valor_promocional" class="form-control mascara-dinheiro" />
				</div>

				<br class="clear">
				<br class="clear">

				
					<div class="col-xl-2 pull-left">					
						<label for="ano"> Ano </label>
						<select class='form-control' name="ano_id">
						<?php foreach ($anos as $ano) {
							echo "<option value='".$ano->id."' >$ano->ano</option>";
							
						} ?>							
						</select>
					</div>

					<div class="col-xl-4 pull-left">
						<label for="nome"> Editora </label>
						<br class="clear">
						<select name="editora_id" id="editora_id" class="form-control" style="width: 80% !important;float: left;"  required>
							<option>Selecione a editora</option>
							<?php foreach ($editoras as $editora) {
							echo "<option value='".$editora->id."' >$editora->nome</option>";
							
						} ?>	
						</select>
						<a href="<?php echo site_url('anuncios/modal_cadastro_editora');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_categoria"> 
								<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</div>

					<div class="col-xl-2 pull-left">
						<label for="nome"> Lombada </label>
						<br class="clear">
						<select name="lombada" id="lombada" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="1">Grampos</option>
							<option value="2">Quadrada</option>
							
						} ?>	
						</select>
					</div>
					<div class="col-xl-2 pull-left">
						<label for="cor"> Cor </label>
						<br class="clear">
						<select name="cor" id="cor" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="0">Sem cor definida</option>
							<option value="1">Colorido</option>
							<option value="2">Preto e branco</option>
							<option value="3">Preto e branco/colorido</option>
							
						} ?>	
						</select>
					</div>
					<div class="col-xl-2 pull-left">
						<label for="capa"> Capa </label>
						<br class="clear">
						<select name="capa" id="capa" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="1">Comum</option>
							<option value="2">Dura</option>
							<option value="0">Sem capa definida</option>
							
						} ?>	
						</select>
					</div>
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12 pull-left">			
					<div class="col-xl-12 pull-left">				
						<label for="referencia"> Estante </label>
						<input type="text" name="referencia" id="referencia" class="form-control" />
					</div>
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12">	
					<div class="col-xl-12 pull-left">					
						<label for="nome"> Descrição </label>
						<textarea name="descricao" class="form-control" style="resize: none;height: 200px"></textarea>
					</div>
				</div>
				<br class="clear">
				<br class="clear">
				<div class="col-xl-12">				
					<!-- <label for="nome"> Dimensões para o correio </label>
					<br class="clear"> -->
					<div class="col-xl-3 pull-left">
						<label for="novo" class="pull-left"> Produto novo </label>
						<input type="checkbox" name="novo" id="novo" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" />
					</div>
					<div class="col-xl-2 pull-left">
						<label for="destaque" class="pull-left"> Destaque </label>
						<input type="checkbox" name="destaque" id="destaque" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" />
					</div>
				<!-- 	<div class="col-xl-2 pull-left">
						<label for="colecoes" class="pull-left"> Coleções </label>
						<input type="checkbox" name="colecoes" id="colecoes" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" />
					</div> -->
					<div class="col-xl-4 pull-left">
						<label for="miniseries" class="pull-left">Coleções e Mini-series completas </label>
						<input type="checkbox" name="miniseries" id="miniseries" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" />
					</div>
				</div>
				<br class="clear">
				<br class="clear">



				<div class="col-xl-12">				
					<label for="nome"> Dimensões para o correio </label>
					<br class="clear">
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Comprimento </label>
						<input type="text" name="comprimento" id="comprimento" class="form-control" />
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Largura </label>
						<input type="text" name="largura" id="largura" class="form-control" />
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Altura </label>
						<input type="text" name="altura" id="altura" class="form-control" />
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Peso <small>em gramas ..ex. 0.100</small> </label>
						<input type="text" name="peso" id="peso" class="form-control mascara-peso" />
					</div>	
				</div>
				<br class="clear">
				<br class="clear">


				<div class="col-xl-12">		
					<div class="col-xl-12">				
					<label for="imagem1" class="label-form"> Imagem 1 <small>principal</small> </label>
					<br class="clear" />
					<input type="file" name="imagem1" id="imagem1"/>
					<br class="clear" />
					<br class="clear" />


					<label for="imagem2" class="label-form"> Imagem 2 </label>
					<br class="clear" />
					<input type="file" name="imagem2" id="imagem2"/>
					<br class="clear" />
					<br class="clear" />

					<label for="imagem3" class="label-form"> Imagem 3 </label>
					<br class="clear" />
					<input type="file" name="imagem3" id="imagem3"/>
					<br class="clear" />
					<br class="clear" />

					<label for="imagem4" class="label-form"> Imagem 4 </label>
					<br class="clear" />
					<input type="file" name="imagem4" id="imagem4"/>
					<br class="clear" />
					<br class="clear" />

					<label for="imagem5" class="label-form"> Imagem 5 </label>
					<br class="clear" />
					<input type="file" name="imagem5" id="imagem5"/>
					<br class="clear" />
					<br class="clear" />
				</div>
			</div>


				

				<br class="clear">
				<br class="clear">
				
				<input type="submit" value="Cadastrar"  class="btn btn-success pull-right" />

					<br class="clear">
				<br class="clear">

			</div>
		</fieldset>
	</form>