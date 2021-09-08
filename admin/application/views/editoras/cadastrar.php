
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" method="post" action="<?php echo site_url('editoras/funcao_cadastrar'); ?>">
		

		<fieldset class="area-padrao verde tamanho-80 centro">
			
			<h3 class="legenda"> Cadastro de editora </h3>
			<div class="col-xl-6 pull-left">	

				<label for="nome" class="label-form"> Nome </label>
				<br class="clear" />
				<input type="text" name="nome" id="nome" class="form-control" required />
				<br class="clear" />
				
				<input type="submit" value="Cadastrar" class="btn btn-success pull-right" />			

			</div>
		</fieldset>
	</form>