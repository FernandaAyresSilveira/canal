
	
	<form name="form-gerenciador" enctype="multipart/form-data" id="form-gerenciador" action="#">
		

		<fieldset class="area-padrao verde tamanho-70 centro">
			
			<h3 class="legenda">Próximo passo </h3>
			<br class="clear">
			<br class="clear">
			<div class="col-xl-10">
				<a href="<?php echo site_url('anuncios/duplicar/'.$this->uri->segment(3)); ?>"> 
					<input type="button" value="Novo cadastro idêntico "  class="btn btn-success pull-left" />
				</a>

				<a href="<?php echo site_url('anuncios/cadastrar'); ?>"> 
					<input type="button" value="Novo cadastro"  class="btn btn-primary pull-left" style="margin-left: 50px;" />
				</a>

				<a href="<?php echo site_url('anuncios/listar'); ?>"> 
					<input type="button" value="Listar"  class="btn btn-default pull-right" />
				</a>
			</div>
					<br class="clear">
				<br class="clear">
		</fieldset>
	</form>