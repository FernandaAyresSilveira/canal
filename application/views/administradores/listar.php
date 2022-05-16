<div class="area-padrao azul">
	<h1 class="legenda"> Lista de administradores </h1>

	<div class="padding">

		<table class="pure-table tamanho-100">
		    <thead>
		        <tr>
		            <th></th>
		            <th>Nome</th>
		            <th>Email</th>
		            <th>Master</th>
		            <th>Imagem</th>
		        </tr>
		    </thead>

		    <tbody>

		    	<?php 
		    		foreach( $this->dados_globais['administradores'] AS $admin ){
		    			$master = $admin->master ? 'Sim' : 'Não';
		    			$foto   = empty($admin->foto) ? 'avatar-padrao.png' : $admin->foto;
		    	?>
		    	
		        <tr>
		            <td class="area-acao"> 
		            	<a href="<?php echo site_url("administradores/editar/$admin->id"); ?>" title="Editar" class="botao botao-editar botao-acao acao-editar float-left"></a>
		            	<a href="<?php echo site_url("administradores/funcao_excluir/$admin->id"); ?>" onclick="return confirmacao()" title="Excluir" class="botao botao-excluir botao-acao acao-excluir float-left"></a>
		            </td>
		            <td><?php echo $admin->nome; ?></td>
		            <td><?php echo $admin->email; ?></td>
		            <td><?php echo $master; ?></td>
		            <td class="texto-centro">
		            	<a href="<?php echo base_url("./assets/upload/administradores/$foto"); ?>" class="botao botao-editar botao-acao acao-visualizar centro fancybox" title="Imagem de <?php echo $admin->nome; ?>"></a>
		            </td>
		        </tr>

		        <?php } ?>

		    </tbody>
		</table>

		<br class="clear" />

		<a href="<?php echo site_url('administradores/cadastrar'); ?>" class="botao botao-cadastrar float-left"> Cadastrar </a>


	</div>
</div>