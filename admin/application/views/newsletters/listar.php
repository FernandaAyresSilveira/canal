

	<div class="area-padrao azul">
		<h1 class="legenda"> Lista de newsletters </h1>

		<div class="padding">
			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url('newsletters/listar'); ?>">

				<label for="q" class="label-form"> Palavra-Chave </label>
				<br class="clear" />
				<input type="text" name="q" id="q" class="input-form tamanho-50" <?php if( $this->input->get('q') ){ ?> value="<?php echo $this->input->get('q'); ?>" <?php } ?> />

				<a href="<?php echo site_url('newsletters/listar'); ?>" class="botao botao-editar botao-inline float-right"> Limpar </a>

				<input type="submit" value="Buscar" class="botao botao-cadastrar botao-inline float-right" />

			</form>
			<!-- FIM BUSCA -->			

			<table class="pure-table tamanho-100">
			    <thead>
			        <tr>
			            <th></th>
			            <th>Assunto</th>
			            <th>Tipo</th>
			            <th>Data</th>
			        </tr>
			    </thead>

			    <tbody>

			    	<?php 
			    		foreach( $newsletters AS $n ){
			    			if ($n->tipo == 1)
			    				$tipo = 'Imagem';
			    			elseif($n->tipo == 2)
			    				$tipo = 'HTML';
			    			elseif($n->tipo == 3)
			    				$tipo = 'Produtos';
			    			else
			    				$tipo = 'N/D';
			    	?>
			    	
			        <tr>
			            <td class="area-acao"> 
			            	<a href="<?php echo site_url("newsletters/editar/$n->id"); ?>" title="Reenviar" class="botao botao-editar botao-acao acao-editar float-left"></a>			            	
			            	<a href="<?php echo site_url("newsletters/funcao_excluir_newsletter/$n->id"); ?>" onclick="return confirmacao()" title="Excluir" class="botao botao-excluir botao-acao acao-excluir float-left"></a>
			            </td>
			            <td><?php echo $n->assunto; ?></td>
			            <td><?php echo $tipo; ?></td>
			            <td><?php echo converter_data($n->data); ?></td>
			        </tr>

			        <?php } ?>

			    </tbody>
			</table>

			<br class="clear" />


			<a href="<?php echo site_url('newsletters/cadastrar'); ?>" class="botao botao-cadastrar botao-inline float-left"> Cadastrar </a>
			<br class="clear" />

			<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>
			<br class="clear">

		</div>
	</div>