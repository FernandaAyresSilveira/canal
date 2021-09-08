


	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" autocomplete="off" action="<?php echo site_url("anuncios/funcao_editar/$anuncio->id"); ?>">
		<h3 class="legenda"> Editar anúncio - Raul</h3>


		<div class="col-xl-11">

				<div class="col-xl-3 pull-left">
					<label for="nome"> Departamento </label>
					<br class="clear">
					<select name="departamento_id" id="departamento_id" class="form-control"  onchange="categorias_departamento('<?php echo site_url(); ?>')" required>
						<option>Selecione o departamento</option>
						<?php foreach ($departamentos as $dep) { ?>
							<option value="<?php echo $dep->id; ?>" <?php if($anuncio->departamento_id  == $dep->id){ echo "selected";} ?>> <?php echo $dep->nome; ?></option>						
						<?php } ?>
					</select>
				</div>

				<div class="col-xl-4 pull-left" id="div-categorias" >
					<label for="nome"> Categoria </label>
					<br class="clear">
					<select name="categoria_id" id="categoria_id" class="form-control" style="width: 80% !important;float: left;" onchange="subcategorias_categoria('<?php echo site_url(); ?>')" required>
						<option>Selecione o departamento</option>
						<?php foreach ($categorias as $cat) { ?>
							<option value="<?php echo $cat->id; ?>" <?php if($anuncio->categoria_id  == $cat->id){ echo "selected";} ?>> <?php echo $cat->nome; ?></option>						
						<?php } ?>

					</select>
					<a href="<?php echo site_url('anuncios/modal_cadastro_categoria');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_categoria"> 
							<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
				</div>
				

				<div class="col-xl-4 pull-left" id="div-subcategorias" >
					<label for="nome"> Subcategoria <small>(Não obrigatório)</small> </label>
					<br class="clear">
					<select name="subcategoria_id" id="subcategoria_id" class="form-control" style="width: 80% !important;float: left;">
						<option>Selecione</option>
						<?php foreach ($subcategorias as $sub) { ?>
							<option value="<?php echo $sub->id; ?>" <?php if($anuncio->subcategoria_id  == $sub->id){ echo "selected";} ?>> <?php echo $sub->nome; ?></option>						
						<?php } ?>
					</select>
					<a href="<?php echo site_url('anuncios/modal_cadastro_subcategoria');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_subcategoria"> 
							<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
					
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12 pull-left">				
					<label for="nome"> Nome </label>
					<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $anuncio->nome; ?>" />
				</div>
				<br class="clear">
				<br class="clear">
				<div class="col-xl-3 pull-left">				
					<label for="valor"> Valor </label>
					<input type="text" name="valor" id="valor" class="form-control mascara-dinheiro" value="<?php echo mostrar_valor($anuncio->valor); ?>"/>
				</div>
				<div class="col-xl-2 pull-left">	
					<label for="promocao" class="pull-left" style="margin-top: 35px"> Promoção </label>
					<input type="checkbox" name="promocao" id="promocao" class="form-control pull-left" style="display: inline; width: auto; margin-top: 41px;margin-left: 5px" onchange="seleciona_promocao(this.value)" <?php if ($anuncio->promocao==1) {
							echo "checked";} ?>/>
				</div>
				<div class="col-xl-2 pull-left" id="mostrar_valor_promocao"  <?php if ($anuncio->promocao==1) { echo "style='display:block'";}else{ echo "style='display:none'";}?>>				
					<label for="valor"> Valor promoção </label>
					<input type="text" name="valor_promocional" id="valor_promocional" class="form-control mascara-dinheiro" value="<?php echo mostrar_valor($anuncio->valor_promocional); ?>"/>
				</div>


				<div class="col-xl-2 pull-left" id="mostrar_off_promocao"  <?php if ($anuncio->promocao==1) { echo "style='display:block'";}else{ echo "style='display:none'";}?>>				
					<label for="valor"> OFF (%) </label>
					<input type="number" name="recompensa" id="recompensa" onchange="calcular_promocao()" class="form-control mascara-numero" value="<?php echo $anuncio->recompensa; ?>"/>
				</div>

				<div class="col-xl-3 pull-left " id="promocaodia" <?php if ($anuncio->promocao==1) { echo "style='display:block'";}else{ echo "style='display:none'";}?>>	
					<label for="promocao" class="pull-left" style="margin-top: 35px"> Promoção do dia </label>
					<input type="checkbox" name="promocaodia" id="promocaodia" class="form-control pull-left" style="display: inline; width: auto; margin-top: 41px;margin-left: 5px" <?php if ($anuncio->promocaodia==1) {
							echo "checked";} ?>/>
				</div>

				<br class="clear">
				<br class="clear">

				<div class="col-xl-2 pull-left">					
						<label for="ano"> Ano </label>
						<select class='form-control' name="ano_id">
						<?php foreach ($anos as $ano) {?>
							<option value="<?php echo $ano->id;?>" <?php if($anuncio->ano_id == $ano->id){ echo "selected";} ?>><?php echo $ano->ano;?></option>
							
						<?php } ?>							
						</select>
					</div>

					<div class="col-xl-4 pull-left">
						<label for="nome"> Editora </label>
						<br class="clear">
						<select name="editora_id" id="editora_id" class="form-control" style="width: 80% !important;float: left;"  required>
							<option>Selecione a editora</option>
							<?php foreach ($editoras as $editora) {?>
							<option value=	"<?php echo $editora->id;?>"	 <?php if($anuncio->editora_id == $editora->id){ echo "selected";} ?>><?php echo $editora->nome;?></option>
							
						<?php } ?>	
						</select>
						<a href="<?php echo site_url('anuncios/modal_cadastro_editora');?>" class="fancybox_ajax btn btn-default" style="float: right;" id="modal_cadastro_categoria"> 
								<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xl-2 pull-left">
						<label for="nome"> Lombada </label>
						<br class="clear">
						<select name="lombada" id="lombada" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="1" <?php if($anuncio->lombada==1){echo "selected";} ?>>Grampos</option>
							<option value="2" <?php if($anuncio->lombada==2){echo "selected";} ?>>Quadrada</option>
							
						} ?>	
						</select>
					</div>
					<div class="col-xl-2 pull-left">
						<label for="cor"> Cor </label>
						<br class="clear">
						<select name="cor" id="cor" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="0"<?php if($anuncio->cor==0){ echo "selected";} ?>>Sem cor definida</option>
							<option value="1"<?php if($anuncio->cor==1){ echo "selected";} ?>>Colorido</option>
							<option value="2"<?php if($anuncio->cor==2){ echo "selected";} ?>>Preto e branco</option>
							<option value="3"<?php if($anuncio->cor==3){ echo "selected";} ?>>Preto e branco/colorido</option>
							
						} ?>	
						</select>
					</div>
					<div class="col-xl-2 pull-left">
						<label for="capa"> Capa </label>
						<br class="clear">
						<select name="capa" id="capa" class="form-control" style="width: 100% !important;float: left;"  required>
							<option value="1"<?php if($anuncio->capa==1){ echo "selected";} ?>>Comum</option>
							<option value="2"<?php if($anuncio->capa==2){ echo "selected";} ?>>Dura</option>
							<option value="0"<?php if($anuncio->capa==0){ echo "selected";} ?>>Sem capa definida</option>
							
						} ?>	
						</select>
					</div>
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12 pull-left">			
					<div class="col-xl-2 pull-left">				
						<label for="referencia"> Estante </label>
						<input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $anuncio->referencia; ?>" />
					</div>
					<div class="col-xl-2 pull-left">	
						<label for="nome"> Comprimento </label>
						<input type="text" name="comprimento" id="comprimento" class="form-control" value="<?php echo $anuncio->comprimento; ?>" />
					</div>	
					<div class="col-xl-2 pull-left">	
						<label for="nome"> Largura </label>
						<input type="text" name="largura" id="largura" class="form-control" value="<?php echo $anuncio->largura; ?>" />
					</div>	
					<div class="col-xl-2 pull-left">	
						<label for="nome"> Altura </label>
						<input type="text" name="altura" id="altura" class="form-control"  value="<?php echo $anuncio->altura; ?>"/>
					</div>	
					<div class="col-xl-2 pull-left">	
						<label for="nome"> Peso <small>g ..ex. 0.100</small></label>
						<input type="text" name="peso" id="peso" class="form-control mascara-peso" value="<?php echo $anuncio->peso; ?>" />
					</div>	
					<div class="col-xl-2 pull-left">
						<br class="clear">
						<input type="submit" value="Salvar" style="margin-top: 5px !important" class="btn btn-success pull-right" />
					</div>
				</div>
				<br class="clear">
				<br class="clear">

				<div class="col-xl-12">				
					<div class="col-xl-12">				
					<label for="nome"> Descrição </label>
					<textarea name="descricao" class="form-control" style="height: 80px"><?php echo $anuncio->descricao; ?></textarea>
				</div>
				</div>
				<br class="clear">
				<div class="col-xl-12">				
					<!-- <label for="nome"> Dimensões para o correio </label>
					<br class="clear"> -->
					<div class="col-xl-3 pull-left">
						<label for="novo" class="pull-left"> Produto novo </label>
						<input type="checkbox" name="novo" id="novo" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" <?php if ($anuncio->novo==1) {
							echo "checked";} ?> />
					</div>
					<div class="col-xl-2 pull-left">
						<label for="destaque" class="pull-left"> Destaque </label>
						<input type="checkbox" name="destaque" id="destaque" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" <?php if ($anuncio->destaque==1) {
							echo "checked";} ?>/>
					</div><!-- 
					<div class="col-xl-2 pull-left">
						<label for="colecoes" class="pull-left"> Coleções </label>
						<input type="checkbox" name="colecoes" id="colecoes" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" <?php if ($anuncio->colecoes==1) {echo "checked";} ?> />
					</div> -->
					<div class="col-xl-4 pull-left">
						<label for="miniseries" class="pull-left">Coleções e Mini-series completas </label>
						<input type="checkbox" name="miniseries" id="miniseries" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" <?php if ($anuncio->miniseries==1) {echo "checked";} ?> />
					</div>

					<div class="col-xl-3 pull-left">
						<label for="somente_pac" class="pull-left">Somente PAC!!!! </label>
						<input type="checkbox" name="somente_pac" id="somente_pac" class="form-control pull-left" style="display: inline; width: auto; margin-top: 6px;margin-left: 5px" <?php if ($anuncio->somente_pac==1) {echo "checked";} ?> />
					</div>
				</div>
				<br class="clear">
				<br class="clear">



				<!-- <div class="col-xl-12">				
					<label for="nome"> Dimensões para o correio </label>
					<br class="clear">
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Comprimento </label>
						<input type="text" name="comprimento" id="comprimento" class="form-control" value="<?php echo $anuncio->comprimento; ?>" />
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Largura </label>
						<input type="text" name="largura" id="largura" class="form-control" value="<?php echo $anuncio->largura; ?>" />
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Altura </label>
						<input type="text" name="altura" id="altura" class="form-control"  value="<?php echo $anuncio->altura; ?>"/>
					</div>	
					<div class="col-xl-3 pull-left">	
						<label for="nome"> Peso <small>em gramas ..ex. 0.100</small></label>
						<input type="text" name="peso" id="peso" class="form-control mascara-peso" value="<?php echo $anuncio->peso; ?>" />
					</div>	
				</div>
				<br class="clear">
				<br class="clear"> -->

				<div class="col-xl-12 pull-left">
					<div class="col-xl-4 pull-left">
						<label for="imagem1" class="label-form"> Imagem 1 <small>principal</small> </label>
						<br class="clear" />
						<input type="file" name="imagem1" id="imagem1"/>
					</div>
					<?php if($anuncio->imagem1 && file_exists('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem1)){?>
					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="imagem-1">
						<a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem1);?>" class="fancybox btn btn-default pull-right"> 
								<i class="fa fa fa-picture-o" aria-hidden="true"></i>
						</a>
					</div>

					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="excluir-1">
						<a  onclick="excluir_foto('<?php echo site_url(); ?>','<?php  echo $anuncio->id; ?>','1')" class="btn btn-default pull-right" title="Excluir foto"> 
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>
					<?php }?>
				</div>
				<br class="clear" />
				<br class="clear" />

				<div class="col-xl-12 pull-left">
					<div class="col-xl-4 pull-left">
						<label for="imagem2" class="label-form"> Imagem 2 </label>
						<br class="clear" />
						<input type="file" name="imagem2" id="imagem2"/>
					</div>
					<?php if($anuncio->imagem2 && file_exists('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem2)){?>
					<div class="col-xl-3 pull-left" style="margin-top: 18px">
						<a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem2);?>" class="fancybox btn btn-default pull-right" > 
								<i class="fa fa fa-picture-o" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="excluir-2">
						<a  onclick="excluir_foto('<?php echo site_url(); ?>','<?php  echo $anuncio->id; ?>','2')" class="btn btn-default pull-right" title="Excluir foto"> 
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>

					<?php }?>
				</div>
				<br class="clear" />
				<br class="clear" />

				<div class="col-xl-12 pull-left">
					<div class="col-xl-4 pull-left">
						<label for="imagem3" class="label-form"> Imagem 3 </label>
						<br class="clear" />
						<input type="file" name="imagem3" id="imagem3"/>
					</div>
					<?php if($anuncio->imagem3 && file_exists('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem3)){?>
					<div class="col-xl-3 pull-left" style="margin-top: 18px">
						<a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem3);?>" class="fancybox btn btn-default pull-right"  > 
								<i class="fa fa fa-picture-o" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="excluir-3">
						<a  onclick="excluir_foto('<?php echo site_url(); ?>','<?php  echo $anuncio->id; ?>','3')" class="btn btn-default pull-right" title="Excluir foto"> 
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>
					<?php }?>
				</div>
				<br class="clear" />
				<br class="clear" />
				<div class="col-xl-12 pull-left">
					<div class="col-xl-4 pull-left">
						<label for="imagem4" class="label-form"> Imagem 4 </label>
						<br class="clear" />
						<input type="file" name="imagem4" id="imagem4"/>
					</div>
					<?php if($anuncio->imagem4 && file_exists('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem4)){?>
					<div class="col-xl-3 pull-left" style="margin-top: 18px">
						<a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem4);?>" class="fancybox btn btn-default pull-right"  > 
								<i class="fa fa fa-picture-o" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="excluir-4">
						<a  onclick="excluir_foto('<?php echo site_url(); ?>','<?php  echo $anuncio->id; ?>','4')" class="btn btn-default pull-right" title="Excluir foto"> 
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>
					<?php }?>
				</div>
				<br class="clear" />
				<br class="clear" />

				<div class="col-xl-12 pull-left">
					<div class="col-xl-4 pull-left">
						<label for="imagem5" class="label-form"> Imagem 5 </label>
						<br class="clear" />
						<input type="file" name="imagem5" id="imagem5"/>
					</div>
					<?php if($anuncio->imagem5 && file_exists('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem5)){?>
					<div class="col-xl-3 pull-left" style="margin-top: 18px">
						<a href="<?php echo base_url('./../admin/assets/upload/anuncios/'.$anuncio->id.'/'.$anuncio->imagem5);?>" class="fancybox btn btn-default pull-right"  > 
								<i class="fa fa fa-picture-o" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xl-3 pull-left" style="margin-top: 18px" id="excluir-5">
						<a  onclick="excluir_foto('<?php echo site_url(); ?>','<?php  echo $anuncio->id; ?>','5')" class="btn btn-default pull-right" title="Excluir foto"> 
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>
					<?php }?>
				</div>
				<br class="clear" />
				<br class="clear" />


				

				<br class="clear">
				<br class="clear">

			<!-- <input type="submit" value="Salvar"  class="btn btn-success pull-right" /> -->
			<br class="clear">
				<br class="clear">

		</div>


		</fieldset>
	</form>


	<script type="text/javascript">
		//recompensa

		function calcular_promocao(){

			var valor_certo = $('#valor').val();

			var recompensa = $('#recompensa').val();

			valor_certo = valor_certo.replace(',','.');

			console.log(valor_certo);



			var novo_valor = valor_certo - ((valor_certo*recompensa)/100);
			novo_valor = novo_valor.toFixed(2);

			novo_valor = novo_valor.replace('.',',');

			$('#valor_promocional').val(novo_valor);

			console.log(novo_valor);



		}
	</script>