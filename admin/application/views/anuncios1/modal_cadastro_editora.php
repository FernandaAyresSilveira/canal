
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" style='width:450px;'>
		

		<fieldset class="area-padrao verde tamanho-90 centro">
			
			<h3 class="legenda"> Cadastro de editora </h3>
			<div class="col-xl-12">			
				<label for="nome"> Nome </label>
				<input type="text" name="nome" id="nome_editora" class="form-control" />
				
				<br class="clear">
				
				<input type="button" value="Cadastrar"  class="btn btn-success pull-right" onclick="cadastrar_editora('<?php echo site_url();?>')" />

			</div>
		</fieldset>
	</form>