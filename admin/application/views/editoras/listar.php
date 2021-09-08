

	<div class="area-padrao azul">
		<h3 class="legenda"> Lista de editoras </h3>

		<div class="col-md-12">
			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('editoras/listar'); ?>">

				<div class="form-group">
					<div class="col-xl-12">

						<label for="q" class="label-form"> Palavra-Chave </label>
						<br class="clear" />
						<input type="text" name="q" id="q"  class="form-control " <?php if( $this->input->get('q') ){ ?> value="<?php echo $this->input->get('q'); ?>" <?php } ?> style='width: 60%;float: left;' />

						<div class="col-xl-4 pull-left" >
						<a href="<?php echo site_url('editoras/listar'); ?>" class="btn btn-default"> Limpar </a>
						<input type="submit" value="Buscar" class="btn btn-primary" />
					</div>
					</div>

			</form>
			<br class="clear" />
			<br class="clear" />
			<!-- FIM BUSCA -->			

			<table class="table table-bordered">
			    <thead>
			        <tr>
			            <th style="width: 250px"></th>
			            <th>Nome</th>
			        </tr>
			    </thead>

			    <tbody>

			    	<?php 
			    		foreach( $editoras AS $editora ){
			    	?>
			    	
			        <tr>
			            <td class="area-acao"> 
			            	<a href="<?php echo site_url("editoras/editar/$editora->id"); ?>" title="Editar" class="btn btn-primary btn-sm pull-left" style='margin-left: 5px;'>Editar</a>
			            	<a href="<?php echo site_url("editoras/funcao_excluir/$editora->id"); ?>" onclick="return confirmacao()" title="Excluir" class="btn btn-danger  btn-sm pull-left" style='margin-left: 5px;'>Excluir</a>

			            </td>
			            <td><?php echo $editora->nome; ?></td>
			        </tr>

			        <?php } ?>

			    </tbody>
			</table>

			<br class="clear" />

			<a href="<?php echo site_url('editoras/cadastrar'); ?>" class="btn btn-success pull-left"> Cadastrar </a>

			
		</div>
	</div>