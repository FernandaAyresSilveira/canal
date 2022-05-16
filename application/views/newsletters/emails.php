

	<div class="area-padrao azul">
		<h1 class="legenda"> Lista de inscritos </h1>

		<div class="padding">
			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('newsletters/emails'); ?>">

				<label for="q" class="label-form"> Palavra-Chave </label>
				<br class="clear" />
				<input type="text" name="q" id="q" class="input-form tamanho-50" <?php if( $this->input->get('q') ){ ?> value="<?php echo $this->input->get('q'); ?>" <?php } ?> />

				<a href="<?php echo site_url('newsletters/CSV'); ?>" class="botao botao-editar botao-inline float-right"> Exportar Emails </a>

				<a href="<?php echo site_url('newsletters/emails'); ?>" class="botao botao-editar botao-inline float-right"> Limpar </a>

				<input type="submit" value="Buscar" class="botao botao-cadastrar botao-inline float-right" />

			</form>
			<br class="clear">
			<!-- FIM BUSCA -->
			<small>Total de <?php echo $total; ?> e-mails encontrados.</small>
			<table class="pure-table tamanho-100">
			    <thead>
			        <tr>
			            <th></th>
			            <th>E-mail</th>
			        </tr>
			    </thead>

			    <tbody>

			    	<?php foreach( $emails AS $email ){ ?>
				    	
				        <tr>
				            <td class="tamanho-10"> 
				            	<a href="<?php echo site_url("newsletters/funcao_excluir_email/$email->id"); ?>" onclick="return confirmacao()" title="Excluir" class="botao botao-excluir botao-acao acao-excluir centro"></a>
				            </td>
				            <td><?php echo $email->email; ?></td>
				        </tr>

			        <?php } ?>

			    </tbody>
			</table>

			<br class="clear" />


			<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>
			<br class="clear">

		</div>
	</div>